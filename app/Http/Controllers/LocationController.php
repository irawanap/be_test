<?php

namespace App\Http\Controllers;

use App\Http\Resources\LocationResource;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;

class LocationController extends Controller
{
    //get all locations
    public function index(): JsonResponse
    {
        $location = Location::all();

        return $this->sendResponse(LocationResource::collection($location), 'Product retrieved successfully.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) : JsonResponse {
        $input = $request->all();

        $validator = Validator::make($input,[
            'name_location' => 'required',
            'code_location' => 'required|unique:locations,code_location',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $location = Location::create($input);

        return $this->sendResponse(new LocationResource($location), 'Location created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Location  $location
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id): JsonResponse
    {
        $location = Location::find($id);

        if (is_null($location)) {
            return $this->sendError('Location not found.');
        }

        return $this->sendResponse(new LocationResource($location), 'Location retrieved successfully.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Location  $location
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id): JsonResponse
    {
        $location = Location::find($id);
        if (!$location) {
            return $this->sendError('Product not found.');
        }

        $input = $request->all();
   
        $validator = Validator::make($input, [
            'name_location' => 'required',
            'code_location' => 'required|unique:locations,code_location,' . $id,
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
   
        $location->update($input);
   
        return $this->sendResponse(new LocationResource($location), 'Location updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Location  $location
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id): JsonResponse
    {
        $location = Location::find($id);
        if (!$location) {
            return $this->sendError('Location not found.');
        }

        $location->delete();

        return $this->sendResponse([], 'Location deleted successfully.');
    }
}


