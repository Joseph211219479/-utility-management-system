<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Repositories\MeterReadingRepository;
use Illuminate\Http\Request;


class MeterReadingController extends Controller
{
    protected $meterReadingRepository;

    public function __construct(MeterReadingRepository $meterReadingRepository)
    {
        $this->meterReadingRepository = $meterReadingRepository;
    }

    public function index()
    {
        $readings = $this->meterReadingRepository->getAll();
        return response()->json($readings);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'meter_id' => 'required|exists:meters,id',
            'status' => 'required|numeric',
            'total_reading' => '',
        ]);

        $reading = $this->meterReadingRepository->create($validatedData);
        return response()->json($reading, 201);
    }

    public function show($id)
    {
        $reading = $this->meterReadingRepository->findById($id);
        return response()->json($reading);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'reading_value' => 'required|numeric',
            'reading_time' => 'required|date',
        ]);

        $reading = $this->meterReadingRepository->update($id, $validatedData);
        return response()->json($reading);
    }

    public function destroy($id)
    {
        $this->meterReadingRepository->delete($id);
        return response()->json(null, 204);
    }
}
