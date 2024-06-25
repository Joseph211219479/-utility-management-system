<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MeterReading extends Model
{
    use HasFactory;

    protected $table = 'meter_readings';

    protected $fillable = [
        'meter_id',
        'reading',
        'reading_date',
        'reader_id',
    ];

    // Define relationships, if any
    public function meter()
    {
        return $this->belongsTo(Meter::class);
    }

}
