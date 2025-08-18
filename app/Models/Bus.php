<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bus extends Model
{
    protected $fillable = ['route_id', 'plate_number', 'capacity', 'departure_time', 'duration_in_minutes', 'arrival_time'];
    public function route()
    {
        return $this->belongsTo(Route::class);
    }
}
