<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Agent;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class AgentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        $agents = Agent::all();
        return response()->json($agents);
    }

    public function show($id)
    {
        try {
            $agent = Agent::find($id);
            return response()->json($agent);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'agent not found'], 404);
        }
    }

    public function store(Request $request)
    {
        $agent = Agent::create($request->all());

        return response()->json($agent, 201);
    }

    public function update(Request $request, $id)
    {
        try {
            $agent = Agent::findOrFail($id);
            $agent->update($request->all());
            return response()->json($agent, 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'agent not found'], 404);
        }
    }

    public function destroy($id)
    {
        try {
            $agent = Agent::findOrFail($id);
            $agent->delete();
            return response()->json(null, 204);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'agent Not Found'], 404);
        }
    }
}
