<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sidebar;

class SidebarController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        $sidebarItems = Sidebar::with('children', 'privilages')->whereNull('parent_id')->get();
        return response()->json($sidebarItems);
    }

    public function store(Request $request)
    {
        // $request->validate([
        //     'label' => 'required|string',
        //     'icon' => 'required|string',
        //     'parent_label' => 'nullable|string',
        //     'url' => 'nullable|string|url',
        // ]);

        // Create the new sidebar item
        $newMenuItem = Sidebar::create([
            'label' => $request->label,
            'icon' => $request->icon,
            'url' => $request->url,
            'parent_id' => $this->getParentId($request->parent_label),
        ]);

        return response()->json($newMenuItem, 201);
    }

    private function getParentId($parentLabel)
    {
        if ($parentLabel === null) {
            return null; // No parent for level 1 item
        }

        $parentMenu = Sidebar::where('label', $parentLabel)->first();
        if (!$parentMenu) {
            return null; // Parent not found
        }

        return $parentMenu->id;
    }

    public function show($id)
    {
        $sidebarItem = Sidebar::findOrFail($id);
        return response()->json($sidebarItem);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'label' => 'required|string',
            'icon' => 'nullable|string',
            'url' => 'nullable|string',
            'parent_id' => 'nullable|exists:sidebar,id',
        ]);

        $sidebarItem = Sidebar::findOrFail($id);
        $sidebarItem->update($request->all());
        return response()->json($sidebarItem, 200);
    }

    public function destroy($id)
    {
        $sidebarItem = Sidebar::findOrFail($id);
        $sidebarItem->delete();
        return response()->json(null, 204);
    }
}
