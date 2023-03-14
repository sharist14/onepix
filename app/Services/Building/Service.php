<?php

namespace App\Services\Building;
use App\Models\Building;
use App\Models\BuildingMasteroption;
use App\Models\BuildingSecondoption;
use App\Models\Masteroption;
use Illuminate\Support\Facades\DB;

class Service
{
    public function getFilterData($params, $on_page = 5)
    {
        $query = Building::query();

        // Расстояние до метро
        if( isset($params['metro_distance']) && !in_array('0', $params['metro_distance']) ){
            $distances = $params['metro_distance'];
            $query->where(function ($query) use ($distances) {

                foreach($distances as $distance){
                    switch ($distance){
                        case '10':
                            $query->orWhere(function ($query) {
                                $query->whereBetween('metro_distance', [0, 9]);
                            });
                            break;
                        case '20':
                            $query->orWhere(function ($query) {
                                $query->whereBetween('metro_distance', [10, 19]);
                            });
                            break;
                        case '40':
                            $query->orWhere(function ($query) {
                                $query->whereBetween('metro_distance', [20, 39]);
                            });
                            break;
                        case '41':
                            $query->orWhere(function ($query) {
                                $query->where('metro_distance', '>', 40);
                            });
                            break;
                    }
                }
            });
        }

        // Срок сдачи
        if( isset($params['deadline']) && $params['deadline'] != 'all' ){
            $deadline = $params['deadline'];
            $query->where(function ($query) use ($deadline) {
                $cur_time = new \DateTime();

                switch ($deadline) {
                    case 'passed':  // Сдан
                        $query->orWhere(function ($query) use($cur_time) {
                            $query->where('start_time', '<', $cur_time->format('Y-m-d'));
                        });
                        break;
                    case 'this-year':
                        $query->orWhere(function ($query) use($cur_time) {
                            $query->whereBetween('start_time', [$cur_time->format('Y-m-d'), $cur_time->format('Y') . '-12-31']);
                        });
                        break;
                    case 'next-year':
                        $cur_time->modify('+1 year');
                        $query->orWhere(function ($query) use($cur_time) {
                            $query->whereBetween('start_time', [$cur_time->format('Y') . '-01-01', $cur_time->format('Y') . '-12-31']);
                        });
                        break;
                }
            });
        }


        // Класс жилья
        if( isset($params['housing']) ){
            $housings = $params['housing'];
            $query->where(function ($query) use ($housings) {

                foreach($housings as $housing){
                    switch ($housing){
                        case 'economical':
                            $query->orWhere(function ($query) {
                                $query->where('housing_id', '=', 1);
                            });
                            break;
                        case 'comfort':
                            $query->orWhere(function ($query) {
                                $query->where('housing_id', '=', 2);
                            });
                            break;
                        case 'business':
                            $query->orWhere(function ($query) {
                                $query->where('housing_id', '=', 3);
                            });
                            break;
                        case 'elite':
                            $query->orWhere(function ($query) {
                                $query->where('housing_id', '=', 4);
                            });
                            break;
                    }
                }
            });
        }

        // Основные опции
        if( isset($params['master_opt']) ){
            $buildings_ids_m = BuildingMasteroption::whereIn('masteroption_id', $params['master_opt'])->get()->pluck('building_id')->toArray();
            $query->whereIn("id", array_unique($buildings_ids_m));
        }


        // Доп опции
        if( isset($params['second_opt']) ){
            $buildings_ids_s = BuildingSecondoption::whereIn('secondoption_id', $params['second_opt'])->get()->pluck('building_id')->toArray();
            $query->whereIn("id", array_unique($buildings_ids_s));
        }

        // Услуги 0%
        if( isset($params['free_service']) ){
            $query->where('service_price', '=', 0);
        }


        $result = $query->get()->take($on_page);

        return $result;
    }


}