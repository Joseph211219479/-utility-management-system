<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use App\Models\MeterReading;
use Illuminate\Support\Facades\Log;

class Meter extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'meters';

    /**
     * @var string[]
     */
    protected $fillable = [
        'source_name',
        'status',
        'measurement_type'
    ];

    /**
     * @param string $status
     * @return Collection
     */
    public function getMetersByStatus(string $status = 'active'): Collection
    {
        return DB::table($this->table)->where('status', $status)->get();
    }

    /**
     * @param $meterId
     * @return void
     */
    public function removeMeterReading($meterId){
        $this->meterReadings()->where('id', $meterId)->delete();

        $this->update(['total' => $this->calculateTotal()]);
    }

    /**
     * @param $meterId
     * @return \Illuminate\Http\JsonResponse
     */
    public static function calculateTotal($meterId){

        $meterReadings = MeterReading::where('meter_id', $meterId)->get();
        $totalReading = 0;

        foreach ($meterReadings as $reading) {
            $totalReading += $reading->reading;
        }

        $meter = Meter::find($meterId);

        if ($meter) {
            $meter->total_reading = $totalReading;
            $meter->save();

            return response()->json(['message' => 'Total reading updated successfully!', 'total_reading' => $meter->total_reading]);
        }

        return response()->json(['message' => 'Meter not found.'], 404);
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
