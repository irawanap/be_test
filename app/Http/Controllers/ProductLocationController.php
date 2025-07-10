<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductLocationController extends Controller
{
    //Retrieve product to location with started stok
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'location_id' => 'required|exists:locations,id',
            'stok' => 'required|integer|min:0',
        ]);

        $product = Product::find($request->product_id);
        $product->locations()->attach($request->location_id, ['stok' => $request->stok]);

        return response()->json([
            'message' => 'Product has been attached to loaction with stok.'
        ], 201);
    }

    //update stok in pivot table
    public function update(Request $request): JsonResponse
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'location_id' => 'required|exists:locations,id',
            'stok' => 'required|integer',
        ]);

        $product = Product::find($request->product_id);
        $product->locations()->updateExistingPivot($request->location_id, ['stok' => $request->stok]);

        return response()->json(['message' => 'Stok has been updated.']);
    }

    //show all relation product_location
    public function index(): JsonResponse
    {
        $data = Product::with('locations')->get();

        return response()->json($data);
    }
}
