<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index() {
        $user = User::get();

        if (is_null($user->first())) {
            return response()->json([
                'status' => 'failed',
                'message' => 'No data found!',
            ], 200);
        }

        $response = [
            'status' => 'success',
            'message' => 'Data are retrieved successfully.',
            'data' => $user,
        ];

        return response()->json($response);
    }

    public function store(Request $request) {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6'
        ]);
        $data['password'] = bcrypt($data['password']);

        if($data->fails()){  
            return response()->json([
                'status' => 'failed',
                'message' => 'Validation Error!',
                'data' => $data->errors(),
            ], 403);    
        }

        $user = User::create($data);

        $response = [
            'status' => 'success',
            'message' => 'Data is added successfully.',
            'data' => $user,
        ];
        return response()->json($response, 201);
    }

    public function show(User $user) {
        if (is_null($user)) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Data is not found!',
            ], 200);
        }

        $response = [
            'status' => 'success',
            'message' => 'Data is retrieved successfully.',
            'data' => $user,
        ];

        return response()->json($response);
    }

    public function update(Request $request, User $user) {
        $data = $request->only('name', 'email');
        if ($request->has('password')) {
            $data['password'] = bcrypt($request->password);
        }
        $user->update($data);

        $response = [
            'status' => 'success',
            'message' => 'Data is updated successfully.',
            'data' => $user,
        ];

        return response()->json($response);
    }

    public function destroy(User $user) {
        $user->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Data is deleted successfully.'
            ], 200);
    }
}
