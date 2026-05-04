<?php

namespace App\Http\Controllers;

use App\Models\PlantModel;
use Illuminate\Http\Request;
use \Illuminate\Validation\ValidationException;
use Carbon\Carbon;

class PlantController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index(Request $request)
  {
    $perPage = $request->query('per_page', 15);
    $plants = PlantModel::paginate($perPage);
    
    return response()->json($plants);
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    try {
      $validated = $request->validate([
        'name' => 'required|string|max:255',
        'variety' => 'required|string|max:255',
        'notes' => 'nullable|string',
        'date_planted' => 'required|date',
        'seedling_count' => 'required|integer|min:1',
        'batch_name' => 'required|string|max:255',
        'starting_fund' => 'required|numeric|min:0',
        'seedling_source' => 'nullable|string|max:255'
      ]);

      $plant = PlantModel::create($validated);

      return response()->json([
        'message' => 'Plant record created successfully',
        'data' => $plant
      ], 201);
    } catch (ValidationException $e) {
      return response()->json([
        'message' => 'Validation failed',
        'errors' => $e->errors()
      ], 422);
    }
  }

  /**
   * Display the specified resource.
   */
  public function show(PlantModel $plantController)
  {
    return response()->json([
      'message' => 'Plant record retrieved successfully',
      'data' => $plantController
    ], 200);
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, PlantModel $plantController)
  {
    try {
      $validated = $request->validate([
        'name' => 'sometimes|required|string|max:255',
        'variety' => 'sometimes|required|string|max:255',
        'notes' => 'nullable|string',
        'date_planted' => 'sometimes|required|date',
        'seedling_count' => 'sometimes|required|integer|min:1',
        'batch_name' => 'sometimes|required|string|max:255',
    $plant->delete();

    return response()->json([
      'message' => 'Plant record deleted successfully'
    ], 200);eric|min:0',
        'seedling_source' => 'nullable|string|max:255'
      ]);

      $plantController->update($validated);

      return response()->json([
        'message' => 'Plant record updated successfully',
        'data' => $plantController->fresh()
      ], 200);
    } catch (ValidationException $e) {
      return response()->json([
        'message' => 'Validation failed',
        'errors' => $e->errors()
      ], 422);
    }
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(PlantModel $plant)
  {
    //TODO : implement delete record functionality
  }
}
