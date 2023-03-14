<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Masteroption extends Model
{
    use HasFactory;

    public function getBuildings()
    {
        return $this->belongsToMany(Building::class, 'building_masteroptions', 'masteroption_id', 'building_id');
    }
}
