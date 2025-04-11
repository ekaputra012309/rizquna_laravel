<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Jamaah;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class JamaahController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index(Request $request)
    {
        $query = Jamaah::with('user');
        if ($request->has('cabang_id')) {
            $query->where('cabang_id', $request->cabang_id);
        }
        $jamaahs = $query->get();
        return response()->json($jamaahs);
    }

    public function show($id)
    {
        try {
            $jamaah = Jamaah::with('user')->find($id);
            return response()->json($jamaah);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'jamaah not found'], 404);
        }
    }

    public function store(Request $request)
    {
        $jamaah = Jamaah::create($request->all());

        return response()->json($jamaah, 201);
    }

    public function update(Request $request, $id)
    {
        try {
            $jamaah = Jamaah::findOrFail($id);
            $jamaah->update($request->all());
            return response()->json($jamaah, 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'jamaah not found'], 404);
        }
    }

    public function destroy($id)
    {
        try {
            $jamaah = Jamaah::findOrFail($id);
            $jamaah->delete();
            return response()->json(null, 204);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'jamaah Not Found'], 404);
        }
    }
}
