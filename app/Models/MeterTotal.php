<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MeterTotal extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'meter_id',
        'total_value',
    ];

    /**
     * Get the meter that owns the total.
     */
    public function meter()
    {
        return $this->belongsTo(Meter::class);
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
        $meterTotal = $this->meter()->findOrFail($meterId);
        $meterTotal->total_value += $value;
        $meterTotal->save();
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
        $meterTotal = $this->meter()->findOrFail($meterId);
        $meterTotal->total_value -= $value;
        $meterTotal->save();
    }
}
