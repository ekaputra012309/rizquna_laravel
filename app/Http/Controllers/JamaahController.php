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
        $cabangId = $request->input('cabang_id');
        $tgl = $request->input('tgl_berangkat');

        $query = Jamaah::query();

        if ($cabangId) {
            $query->where('cabang_id', $cabangId);
        }

        if ($tgl) {
            $query->whereDate('tgl_berangkat', $tgl);
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
