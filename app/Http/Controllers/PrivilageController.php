<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Privilage;

class PrivilageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        $privilageItems = Privilage::with('sidebar')->get();
        return response()->json($privilageItems);
    }

    public function byRole(Request $request)
    {
        $role_id = $request->query('role_id');
        $privilages = Privilage::with('sidebar')
            ->where('role_id', $role_id)
            ->get();

        $sidebarData = $privilages->map(function ($privilage) {
            return $privilage->sidebar;
        });

        return response()->json($sidebarData);
    }

    public function store(Request $request)
    {
        // Create the new privilage item
        $newMenuItem = Privilage::create([
            'role_id' => $request->role_id,
            'sidebar_id' => $request->sidebar_id,
        ]);

        return response()->json($newMenuItem, 201);
    }

    public function show($id)
    {
        $privilageItem = Privilage::findOrFail($id);
        return response()->json($privilageItem);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'role_id' => 'required|string',
            'sidebar_id' => 'nullable|string',
        ]);

        $privilageItem = Privilage::findOrFail($id);
        $privilageItem->update($request->all());
        return response()->json($privilageItem, 200);
    }

    public function destroy($id)
    {
        $privilageItem = Privilage::findOrFail($id);
        $privilageItem->delete();
        return response()->json(null, 204);
    }
}
