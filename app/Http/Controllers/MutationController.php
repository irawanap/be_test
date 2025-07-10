<?php

namespace App\Http\Controllers;

use App\Models\Mutation;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;

class MutationController extends Controller
{
    public function index(): JsonResponse
    {
        $mutations = Mutation::with(['user', 'product', 'location'])->get();

        return response()->json($mutations);
    }

    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'date' => 'required|date',
            'mutation_type' => 'required|in:input,output',
            'amount' => 'required|integer|min:1',
            'description' => 'nullable|string',
            'product_id' => 'required|exists:products,id',
            'location_id' => 'required|exists:locations,id',
        ]);

        // Get the product-location relation
        $product = Product::findOrFail($request->product_id);
        $location = $request->location_id;

        $pivot = $product->locations()->where('location_id', $location)->first();

        if (!$pivot) {
            return response()->json(['message' => 'Product not found at the specified location.'], 404);
        }

        $currentStock = $pivot->pivot->stok;

        $newStock = $request->mutation_type === 'input'
            ? $currentStock + $request->amount
            : $currentStock - $request->amount;

        if ($newStock < 0) {
            return response()->json(['message' => 'Insufficient stock for output mutation.'], 400);
        }

        $product->locations()->updateExistingPivot($location, ['stok' => $newStock]);

        $mutation = Mutation::create([
            'date' => $request->date,
            'mutation_type' => $request->mutation_type,
            'amount' => $request->amount,
            'description' => $request->description,
            'user_id' => Auth::id(),
            'product_id' => $request->product_id,
            'location_id' => $request->location_id,
        ]);

        return response()->json([
            'message' => 'Mutation saved successfully.',
            'data' => $mutation,
        ]);
    }
}
