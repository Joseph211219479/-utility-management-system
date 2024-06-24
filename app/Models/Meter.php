<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;


class Meter extends Model
{
    use HasFactory;

    protected $table = 'meters';

    protected $fillable = ['source_name', 'status', 'measurement_type'];

    /**
     * Create a new meter record.
     *
     * @param array $data
     * @return Meter
     */
    public function create(array $data): Meter
    {
        return static::create($data);
    }

    /**
     * @param string $status
     * @return Collection
     */
    public function getMetersByStatus(string $status = 'active'): Collection
    {
        return DB::table($this->table)->where('status', $status)->get();
    }



    public function addInitialMeterReading($meterReading){
        // enter a new reading instance
        // set totals value to init meter reading

    }

    public function removeMeterReading($meterId){
        //todo : delete the related meter reading entries
        // todo delete the entry from the totals table

        // Delete related meter reading entries
        $this->meterReadings()->where('id', $meterId)->delete();

        // Update the entry from the totals table
        // Assuming you have a totals table associated with each meter
        $this->update(['total' => $this->calculateTotal()]);
    }

    private function validateMeasurementType(){
        //todo add code to make sure adding new measurments to meter its in the correct measurement

    }

    /**
     * Add to the meter total.
     *
     * @param int $meterId
     * @param float $value
     * @return void
     */
    public function addTo($meterId, $value)
    {
      /*  $meterTotal = $this->meter()->findOrFail($meterId);
        $meterTotal->total_value += $value;
        $meterTotal->save();*/
    }

    /**
     * Remove from the meter total.
     *
     * @param int $meterId
     * @param float $value
     * @return void
     */
    public function removeFrom($meterId, $value)
    {
       /* $meterTotal = $this->meter()->findOrFail($meterId);
        $meterTotal->total_value -= $value;
        $meterTotal->save();*/
    }

    /**
     * Define a one-to-many relationship with MeterReading model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    private function meterReadings()
    {
        return $this->hasMany(MeterReading::class);
    }
}
