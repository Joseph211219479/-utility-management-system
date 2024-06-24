<?php

namespace App\Repositories;

use App\Models\Meter;

class MeterRepository
{
    public function getAll()
    {
        return Meter::all();
    }

    public function findById($id)
    {
        return Meter::findOrFail($id);
    }

    public function create(array $data)
    {
        return Meter::create($data);
    }

    public function update($id, array $data)
    {
        $meter = $this->findById($id);
        $meter->update($data);
        return $meter;
    }

    public function delete($id)
    {
        $meter = $this->findById($id);
        $meter->delete();
    }
}
