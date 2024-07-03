<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MeterReading extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'meter_readings';

    /**
     * @var string[]
     */
    protected $fillable = [
        'meter_id',
        'reading',
        'reading_date',
        'reader_id',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function meter()
    {
        return $this->belongsTo(Meter::class);
    }

}
