<?php

namespace App\Http\Controllers\Meter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DeleteController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // minus from totals table after removing entry


    }
}
