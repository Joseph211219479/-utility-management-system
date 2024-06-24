<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Meter;
use Illuminate\Http\Request;


class MeterController extends Controller
{

    protected $meter;

    public function __construct(Meter $meter)
    {
        $this->meter = $meter;
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
