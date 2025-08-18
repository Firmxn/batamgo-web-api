<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shelter extends Model
{
    protected $fillable = ['name', 'latitude', 'longitude', 'address'];
    public function routes()
    {
        return $this->belongsToMany(Route::class);
    }
}
