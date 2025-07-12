<?php

namespace App\Http\Controllers;

use App\Models\Mutation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class MutationController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'product_location_id' => 'required|exists:product_location,id',
            'mutation_type' => 'required|in:in,out',
            'qty' => 'required|integer|min:1',
            'note' => 'nullable|string',
            'date' => 'required|date',
        ]);

        $data['user_id'] = auth()->id();

        $mutation = Mutation::create($data);

        $pivot = DB::table('product_location')->where('id', $data['product_location_id'])->first();
        $stock = $pivot->stock;

        if ($data['mutation_type'] === 'in') {
            $stock += $data['qty'];
        } else {
            $stock -= $data['qty'];
        }

        DB::table('product_location')->where('id', $data['product_location_id'])->update(['stock' => $stock]);

        $response = [
            'status' => 'success',
            'message' => 'Data is added successfully.',
            'data' => $mutation,
        ];

        return response()->json($response, 201);
    }

    public function productHistory($id)
    {
        $mutations = Mutation::whereHas('product_location', function ($q) use ($id) {
            $q->where('product_id', $id);
        })->with('user')->get();

        if (is_null($mutations)) {
            $response = [
                'status' => 'success',
                'message' => 'Data history not found.',
                'data' => NULL,
            ];
            return response()->json($response);
        }

        $response = [
            'status' => 'success',
            'message' => 'Data are retrieved successfully.',
            'data' => $mutations,
        ];
        return response()->json($response);
    }

    public function userHistory($id)
    {
        $mutations = Mutation::where('user_id', $id)->with('product_location')->get();
        
        if ($mutations->count() <= 0) {
            $response = [
                'status' => 'success',
                'message' => 'Data history not found.',
                'data' => NULL,
            ];
            return response()->json($response);
        }

        $response = [
            'status' => 'success',
            'message' => 'Data are retrieved successfully.',
            'data' => $mutations,
        ];
        return response()->json($response);
    }
}
