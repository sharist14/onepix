<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Building extends Model
{
    use HasFactory;

    public function housingName()
    {
        return $this->hasOne(Housing::class,'id','housing_id');
    }

    public function getMasteroptions()
    {
        return $this->belongsToMany(Masteroption::class, 'building_masteroptions', 'building_id', 'masteroption_id');
    }

    public function getSecondoptions()
    {
        return $this->belongsToMany(Secondoption::class, 'building_secondoptions', 'building_id', 'secondoption_id');
    }
}
