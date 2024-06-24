<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Meter;
use Illuminate\Http\Request;


class MeterController extends Controller
{

    protected $meterRepository;

    public function __construct(MeterRepository $meterRepository)
    {
        $this->meterRepository = $meterRepository;
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $meters = $this->meterRepository->getAll();
        return response()->json($meters);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'source_name' => 'required|string|max:255',
            'measurement_type' => 'required|string',
        ]);

        try {
            $this->meter->create($validatedData);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to create meter', 'error' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $meter = Meter::findOrFail($id);
        return response()->json($meter);
    }

    /**
     * returns a list of active meters.
    */
    public function getMetersByStatus($status){
        Meter::getMetersByStatus($status);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $meter = $this->meterRepository->findById($id);
            if (!$meter) {
                return response()->json(['message' => 'Meter not found'], 404);
            }

            // Assuming you have a blade view for editing meters
            return view('meters.edit', compact('meter'));
        } catch (\Exception $e) {
            // Handle exceptions
            return response()->json(['message' => 'Failed to retrieve meter for editing', 'error' => $e->getMessage()], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'source_name' => 'required|string|max:255',
            'measurement_type' => 'required|string',
        ]);

        try {
            $meter = $this->meterRepository->update($id, $validatedData);
            return response()->json(['message' => 'Meter updated successfully', 'meter' => $meter], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to update meter', 'error' => $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $this->meterRepository->delete($id);
            return response()->json(['message' => 'Meter deleted successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to delete meter', 'error' => $e->getMessage()], 500);
        }
    }
}
