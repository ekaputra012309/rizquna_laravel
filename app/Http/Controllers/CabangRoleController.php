<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CabangRole;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CabangRoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        $cabangrole = CabangRole::with('user', 'cabang')->where('user_id', '!=', '1')->get();
        return response()->json($cabangrole);
    }

    public function show($id)
    {
        $cabangroleItem = CabangRole::with('user', 'cabang')->findOrFail($id);
        return response()->json($cabangroleItem);
    }

    public function store(Request $request)
    {
        $cabangrole = CabangRole::create($request->all());

        return response()->json($cabangrole, 201);
    }

    public function update(Request $request, $id)
    {
        try {
            $cabangrole = CabangRole::findOrFail($id);
            $cabangrole->update($request->all());
            return response()->json($cabangrole, 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Role not found'], 404);
        }
    }

    public function destroy($id)
    {
        $cabangrole = CabangRole::findOrFail($id);
        $cabangrole->delete();
        return response()->json(null, 204);
    }
}
