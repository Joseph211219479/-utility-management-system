<?php

namespace App\Repositories;

use App\Models\MeterReading;

class MeterReadingRepository
{
    public function getAll()
    {
        return MeterReading::all();
    }

    public function findById($id)
    {
        return MeterReading::findOrFail($id);
    }

    public function create(array $data)
    {
        return MeterReading::create($data);
    }

    public function update($id, array $data)
    {
        $reading = $this->findById($id);
        $reading->update($data);
        return $reading;
    }

    public function delete($id)
    {
        $reading = $this->findById($id);
        $reading->delete();
    }
}
