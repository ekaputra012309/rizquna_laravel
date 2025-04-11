<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cabang;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CabangController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        $cabangs = Cabang::with('user')->get();
        return response()->json($cabangs);
    }

    public function show($id)
    {
        try {
            $cabang = Cabang::with('user')->find($id);
            return response()->json($cabang);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'cabang not found'], 404);
        }
    }

    public function store(Request $request)
    {
        $cabang = Cabang::create($request->all());

        return response()->json($cabang, 201);
    }

    public function update(Request $request, $id)
    {
        try {
            $cabang = Cabang::findOrFail($id);
            $cabang->update($request->all());
            return response()->json($cabang, 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'cabang not found'], 404);
        }
    }

    public function destroy($id)
    {
        try {
            $cabang = Cabang::findOrFail($id);
            $cabang->delete();
            return response()->json(null, 204);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'cabang Not Found'], 404);
        }
    }
}
