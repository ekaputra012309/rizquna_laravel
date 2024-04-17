<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Room;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class RoomController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        $kamars = Room::with('user')->get();
        return response()->json($kamars);
    }

    public function show($id)
    {
        try {
            $kamar = Room::with('user')->find($id);
            return response()->json($kamar);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Kamar not found'], 404);
        }
    }

    public function store(Request $request)
    {
        $kamar = Room::create($request->all());

        return response()->json($kamar, 201);
    }

    public function update(Request $request, $id)
    {
        try {
            $kamar = Room::findOrFail($id);
            $kamar->update($request->all());
            return response()->json($kamar, 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Kamar not found'], 404);
        }
    }

    public function destroy($id)
    {
        try {
            $kamar = Room::findOrFail($id);
            $kamar->delete();
            return response()->json(null, 204);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Kamar Not Found'], 404);
        }
    }
}
