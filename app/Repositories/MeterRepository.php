<?php

namespace App\Repositories;

use App\Models\Meter;

class MeterRepository
{
    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAll()
    {
        return Meter::all();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function findById($id)
    {
        return Meter::findOrFail($id);
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        return Meter::create($data);
    }

    /**
     * @param $id
     * @param array $data
     * @return mixed
     */
    public function update($id, array $data)
    {
        $meter = $this->findById($id);
        $meter->update($data);
        return $meter;
    }

    /**
     * @param $id
     * @return void
     */
    public function delete($id): void
    {
        $meter = $this->findById($id);
        $meter->delete();
    }
}
