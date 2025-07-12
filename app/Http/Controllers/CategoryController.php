<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Location;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function index() {
        $category = Category::get();

        if (is_null($category->first())) {
            return response()->json([
                'status' => 'failed',
                'message' => 'No data found!',
            ], 200);
        }

        $response = [
            'status' => 'success',
            'message' => 'Data are retrieved successfully.',
            'data' => $category,
        ];

        return response()->json($response);
    }

    public function store(Request $request) {
        $data = $request->validate([
            'name' => 'required'
        ]);

        $category = Category::create($data);

        $response = [
            'status' => 'success',
            'message' => 'Data is added successfully.',
            'data' => $category,
        ];
        return response()->json($response, 201);
    }

    public function show($id) {
        $category = Category::find($id);
        
        if (is_null($category)) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Data is not found!',
            ], 200);
        }

        $response = [
            'status' => 'success',
            'message' => 'Data is retrieved successfully.',
            'data' => $category,
        ];

        return response()->json($response);
    }

    public function update(Request $request, $id) {
        $category = Category::find($id);
     
        if (is_null($category)) {
           return response()->json([
                'status' => 'failed',
                'message' => 'No data found!',
            ], 200);
        }
        
        $data = $request->validate([
            'name' => 'required'
        ]);

        $data = [
            'name'  => $request->name ?? $category->name,
        ];
        
        $category->update($data);

        $response = [
            'status' => 'success',
            'message' => 'Data is updated successfully.',
            'data' => $category,
        ];

        return response()->json($response);
    }

    public function destroy($id) {
        $category = Category::find($id);
        
        if (!$category) {
            return response()->json([
                'status' => 'failed',
                'message' => 'No data found!',
            ], 200);
        }

        $category->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Data is deleted successfully.'
            ], 200);
    }
}
