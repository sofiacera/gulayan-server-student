<?php

namespace App\Http\Controllers;

use App\Models\PlantModel;
use Illuminate\Http\Request;

class PlantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = (int) $request->query('per_page', 10);
        $perPage = $perPage > 0 ? min($perPage, 100) : 10;

        return PlantModel::orderBy('created_at', 'desc')
            ->paginate($perPage);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'variety' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
            'date_planted' => 'nullable|date',
            'seedling_count' => 'nullable|integer|min:0',
            'batch_name' => 'nullable|string|max:255',
            'starting_fund' => 'nullable|numeric|min:0',
            'seedling_source' => 'nullable|string|max:255',
        ]);

        $plant = PlantModel::create($validated);

        return response()->json($plant, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(PlantModel $plant)
    {
        return response()->json($plant);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PlantModel $plant)
    {
        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'variety' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
            'date_planted' => 'nullable|date',
            'seedling_count' => 'nullable|integer|min:0',
            'batch_name' => 'nullable|string|max:255',
            'starting_fund' => 'nullable|numeric|min:0',
            'seedling_source' => 'nullable|string|max:255',
        ]);

        $plant->update($validated);

        return response()->json($plant);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PlantModel $plant)
    {
        $plant->delete();

        return response()->json([
            'message' => 'Plant deleted successfully.',
        ]);
    }
}
