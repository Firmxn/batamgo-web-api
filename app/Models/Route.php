<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    protected $fillable = ['name', 'description'];
    public function buses()
    {
        return $this->hasMany(Bus::class);
    }
    public function shelters()
    {
        return $this->belongsToMany(Shelter::class);
    }
}
