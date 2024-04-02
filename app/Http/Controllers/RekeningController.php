<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rekening;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class RekeningController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index(Request $request)
    {
        $rekening_id = $request->input('rekening_id');

        $rekenings = Rekening::when($rekening_id, function ($query) use ($rekening_id) {
            return $query->where('rekening_id', 'like', '%' . $rekening_id . '%');
        })->get();

        return response()->json($rekenings);
    }

    public function show($id)
    {
        try {
            $rekening = Rekening::find($id);
            return response()->json($rekening);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Rekening not found'], 404);
        }
    }

    public function store(Request $request)
    {
        $rekening = Rekening::create($request->all());

        return response()->json($rekening, 201);
    }

    public function update(Request $request, $id)
    {
        try {
            $rekening = Rekening::findOrFail($id);
            $rekening->update($request->all());
            return response()->json($rekening, 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Rekening not found'], 404);
        }
    }

    public function destroy($id)
    {
        try {
            $rekening = Rekening::findOrFail($id);
            $rekening->delete();
            return response()->json(null, 204);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Rekening Not Found'], 404);
        }
    }
}
