<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\MeterRepository;
//use Spatie\Permission\Models\Role;
use App\Models\Meter;
use Illuminate\Support\Facades\Log;

class MeterController extends Controller
{

    /**
     * @var MeterRepository
     */
    protected MeterRepository $meterRepository;

    /**
     * @param MeterRepository $meterRepository
     */
    public function __construct(MeterRepository $meterRepository)
    {
        $this->meterRepository = $meterRepository;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $meters = $this->meterRepository->getAll();
        return response()->json($meters);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'source_name' => 'required|string|max:255',
                'measurement_type' => 'required|string',
                'status' => 'required',
                'total_reading' => '',
            ]);

            $meter = $this->meterRepository->create($validatedData);

            return response()->json($meter, 201);

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
     * @param $status
     * @return void
     */
    public function getMetersByStatus($status){
        Meter::getMetersByStatus($status);
    }

    /**
     * @param string $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Http\JsonResponse
     */
    public function edit(string $id)
    {
        try {
            $meter = $this->meterRepository->findById($id);
            if (!$meter) {
                return response()->json(['message' => 'Meter not found'], 404);
            }

            return view('meters.edit', compact('meter'));
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to retrieve meter for editing', 'error' => $e->getMessage()], 500);
        }
    }

    /**
     * @param Request $request
     * @param string $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'source_name' => 'required|string|max:255',
            'measurement_type' => 'required|string',
            'status' => 'required',
            'total_reading' => '',
        ]);

        try {
            $meter = $this->meterRepository->update($id, $validatedData);
            return response()->json(['message' => 'Meter updated successfully', 'meter' => $meter], 200);

        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to update meter', 'error' => $e->getMessage()], 500);
        }
    }


    /**
     * @param string $id
     * @return \Illuminate\Http\JsonResponse
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
