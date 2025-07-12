<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LocationController extends Controller
{
    public function index() {
        $location = Location::with('products')->get();

        if (is_null($location->first())) {
            return response()->json([
                'status' => 'failed',
                'message' => 'No data found!',
            ], 200);
        }

        $response = [
            'status' => 'success',
            'message' => 'Data are retrieved successfully.',
            'data' => $location,
        ];

        return response()->json($response);
    }

    public function store(Request $request) {
        $data = $request->validate([
            'code' => 'required|unique:locations',
            'name' => 'required'
        ]);

        $location = Location::create($data);

        $response = [
            'status' => 'success',
            'message' => 'Data is added successfully.',
            'data' => $location,
        ];
        return response()->json($response, 201);
    }

    public function show($id) {
        $location = Location::find($id);
        
        if (is_null($location)) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Data is not found!',
            ], 200);
        }

        $response = [
            'status' => 'success',
            'message' => 'Data is retrieved successfully.',
            'data' => $location->load('products'),
        ];

        return response()->json($response);
    }

    public function update(Request $request, $id) {
        $location = Location::find($id);
     
        if (is_null($location)) {
           return response()->json([
                'status' => 'failed',
                'message' => 'No data found!',
            ], 200);
        }
        
        $data = $request->validate([
            'name' => 'required',
            'code' => 'required'
        ]);

        $data = [
            'name'  => $request->name ?? $location->name,
            'code'  => $request->code ?? $location->code,
        ];
        
        $location->update($data);

        $response = [
            'status' => 'success',
            'message' => 'Data is updated successfully.',
            'data' => $location,
        ];

        return response()->json($response);
    }

    public function destroy($id) {
        $location = Location::find($id);
        
        if (!$location) {
            return response()->json([
                'status' => 'failed',
                'message' => 'No data found!',
            ], 200);
        }

        $location->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Data is deleted successfully.'
            ], 200);
    }
}
