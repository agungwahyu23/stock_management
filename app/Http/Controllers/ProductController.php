<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function index() {
        $product = Product::get();

        if (is_null($product->first())) {
            return response()->json([
                'status' => 'failed',
                'message' => 'No data found!',
            ], 200);
        }

        $response = [
            'status' => 'success',
            'message' => 'Data are retrieved successfully.',
            'data' => $product,
        ];

        return response()->json($response);
    }

    public function store(Request $request) {
        $data = $request->validate([
            'name' => 'required',
            'code' => 'required|unique:products',
            'category_id' => 'required',
            'unit' => 'required'
        ]);

        $product = Product::create($data);

        $response = [
            'status' => 'success',
            'message' => 'Data is added successfully.',
            'data' => $product,
        ];
        return response()->json($response, 201);
    }

    public function show($id) {
        $product = Product::find($id);
        
        if (is_null($product)) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Data is not found!',
            ], 200);
        }

        $response = [
            'status' => 'success',
            'message' => 'Data is retrieved successfully.',
            'data' => $product,
        ];

        return response()->json($response);
    }

    public function update(Request $request, $id) {
        $product = Product::find($id);
     
        if (is_null($product)) {
           return response()->json([
                'status' => 'failed',
                'message' => 'No data found!',
            ], 200);
        }
        
        $data = $request->validate([
            'name' => 'required',
            'code' => 'required',
            'category_id' => 'required',
            'unit' => 'required'
        ]);

        $data = [
            'name'  => $request->name ?? $product->name,
            'code'  => $request->code ?? $product->code,
            'category_id'  => $request->category_id ?? $product->category_id,
            'unit'  => $request->unit ?? $product->unit,
        ];
        
        $product->update($data);

        $response = [
            'status' => 'success',
            'message' => 'Data is updated successfully.',
            'data' => $product,
        ];

        return response()->json($response);
    }

    public function destroy($id) {
        $product = Product::find($id);
        
        if (!$product) {
            return response()->json([
                'status' => 'failed',
                'message' => 'No data found!',
            ], 200);
        }

        $product->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Data is deleted successfully.'
            ], 200);
    }
}
