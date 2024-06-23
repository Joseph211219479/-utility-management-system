<?php

namespace App\Http\Controllers;

use App\Models\MeterTotal;
use Illuminate\Http\Request;

class MeterTotalController extends Controller
{

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // todo trigger this create and set value to 0 at start when a new meter is created
    }

    /**
     * Display the specified resource.
     */
    public function show(MeterTotal $meterTotal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function addTooEntry(MeterTotal $meterTotal)
    {
        //
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MeterTotal $meterTotal)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MeterTotal $meterTotal)
    {
        // todo trigger when meter is removed
    }
}
