<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        $users = User::where('email', '!=', 'admin123@gmail.com')->get();
        return response()->json($users);
    }


    public function show($id)
    {
        try {
            $user = User::find($id);
            return response()->json($user);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'User not found'], 404);
        }
    }

    public function store(Request $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            // 'password' => Hash::make($request->password),
            'password' => Hash::make('12345678'),
        ]);

        return response()->json($user, 201);
    }

    public function update(Request $request, $id)
    {
        try {
            $user = User::findOrFail($id);
            $user->update($request->all());
            return response()->json($user, 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'User not found'], 404);
        }
    }

    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();
            return response()->json(null, 204);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'User Not Found'], 404);
        }
    }

    public function resetPassword($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->update([
                'password' => Hash::make('12345678')
            ]);
            return response()->json(['message' => 'Password reset successfully'], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'User not found'], 404);
        }
    }

    public function changePassword(Request $request, $id)
    {
        try {
            $user = User::findOrFail($id);
            $user->update([
                'password' => Hash::make($request->password)
            ]);

            return response()->json(['message' => 'Password changed successfully'], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'User not found'], 404);
        }
    }
}
