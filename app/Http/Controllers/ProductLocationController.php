<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ProductLocationController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'product_id' => 'required|exists:products,id',
            'location_id' => 'required|exists:locations,id',
            'stock' => 'required|integer|min:0'
        ]);

        $exists = DB::table('product_location')
            ->where('product_id', $data['product_id'])
            ->where('location_id', $data['location_id'])
            ->exists();

        if ($exists) {
            return response()->json(['message' => 'Relation already exists'], 409);
        }

        DB::table('product_location')->insert([
            'product_id' => $data['product_id'],
            'location_id' => $data['location_id'],
            'stock' => $data['stock'],
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return response()->json(['message' => 'Product assigned to location'], 201);
    }
}
