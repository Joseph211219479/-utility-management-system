<?php

namespace App\Repositories;

use App\Models\MeterReading;

class MeterReadingRepository
{
    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAll()
    {
        return MeterReading::all();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function findById($id)
    {
        return MeterReading::findOrFail($id);
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        return MeterReading::create($data);
    }

    /**
     * @param $id
     * @param array $data
     * @return mixed
     */
    public function update($id, array $data)
    {
        $reading = $this->findById($id);
        $reading->update($data);
        return $reading;
    }

    /**
     * @param $id
     * @return void
     */
    public function delete($id)
    {
        $reading = $this->findById($id);
        $reading->delete();
    }
}
