<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Repositories\MeterReadingRepository;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;


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
        try{
            $validatedData = $request->validate([
                'meter_id' => 'required|exists:meters,id',
                'reading' => 'required',
            ]);

            $reading = $this->meterReadingRepository->create($validatedData);

            $role = $this->determineUserRole($validatedData);
            $reading->assignRole($role);

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

    protected function determineUserRole($userData)
    {
        if ($userData['role'] === 'admin') {
            return Role::where('name', 'admin')->first();
        } elseif($userData['role'] === 'reader') {
            return Role::where('name', 'reader')->first();
        }else{
            return Role::where('name', 'client')->first();

        }
    }
}
