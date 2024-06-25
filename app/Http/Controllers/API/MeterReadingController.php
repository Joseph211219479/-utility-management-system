<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Repositories\MeterReadingRepository;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Repositories\MeterRepository;
use Illuminate\Support\Facades\Log;
use App\Models\Meter;

class MeterReadingController extends Controller
{
    /**
     * @var MeterReadingRepository
     */
    protected MeterReadingRepository $meterReadingRepository;

    protected MeterRepository $meterRepository;

    public function __construct(MeterReadingRepository $meterReadingRepository , MeterRepository $meterRepository)
    {
        $this->meterReadingRepository = $meterReadingRepository;
        $this->meterRepository = $meterRepository;
    }

    public function index()
    {
        $readings = $this->meterReadingRepository->getAll();
        return response()->json($readings);
    }

    public function store(Request $request)
    {
        try{
            $validatedData = $request->validate([
                'meter_id' => 'required|exists:meters,id',
                'reading' => 'required',
                'reader_id' => 'required|exists:users,id',
            ]);

            $reading = $this->meterReadingRepository->create($validatedData);

            Meter::calculateTotal($validatedData['meter_id']);

            return response()->json($reading, 201);

        }catch (\Exception $e)
        {
            return response()->json(['message' => 'Failed to create meter', 'error' => $e->getMessage()], 500);
        }

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
