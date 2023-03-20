<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Secondoption extends Model
{
    use HasFactory;

    public function getBuildings()
    {
        return $this->belongsToMany(Building::class, 'building_secondoptions', 'secondoption_id', 'building_id');
    }
}
