<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Hotel;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class HotelController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        $hotels = Hotel::all();
        return response()->json($hotels);
    }

    public function show($id)
    {
        try {
            $hotel = Hotel::find($id);
            return response()->json($hotel);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Hotel not found'], 404);
        }
    }

    public function store(Request $request)
    {
        $hotel = Hotel::create($request->all());

        return response()->json($hotel, 201);
    }

    public function update(Request $request, $id)
    {
        try {
            $hotel = Hotel::findOrFail($id);
            $hotel->update($request->all());
            return response()->json($hotel, 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Hotel not found'], 404);
        }
    }

    public function destroy($id)
    {
        try {
            $hotel = Hotel::findOrFail($id);
            $hotel->delete();
            return response()->json(null, 204);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Hotel Not Found'], 404);
        }
    }
}
