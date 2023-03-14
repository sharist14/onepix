<?php

namespace Database\Seeders;

use App\Models\Builder;
use App\Models\Building;
use App\Models\Housing;
use App\Models\Masteroption;
use App\Models\Secondoption;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Застройщики
        $data_builder = Builder::factory()->count(5)->make();
        Builder::insert( $data_builder->toArray() );

        // Класс жилья
        $data_housing = [["title" => "Эконом"], ["title" => "Комфорт"], ["title" => "Бизнес"], ["title" => "Элит"]];
        Housing::insert( $data_housing );

        // Основные опции
        $data_masteroption = [["title" => "Благоустроенный двор", "icon" => "icon-garden"], ["title" => "Отделка под ключ", "icon" => "icon-paint"], ["title" => "Подземный паркинг", "icon" => "icon-parking"], ["title" => "Кирпичный дом", "icon" => "icon-brick"], ["title" => "Вид на реку", "icon" => "icon-water"], ["title" => "Лес рядом", "icon" => "icon-tree"], ["title" => "Есть акции", "icon" => "icon-sale"]];
        Masteroption::insert( $data_masteroption );
        $masteroptions = Masteroption::all();

        // Дополнительные опции
        $data_secondoption = [["title" => "Двор без машин"], ["title" => "Высокие потолки"], ["title" => "Есть кладовые"], ["title" => "Панорамные окна"], ["title" => "Малоэтажный (<10 этажей)"], ["title" => "Панорамные окна"], ["title" => "Малоэтажный (<10 этажей)"], ["title" => "Двор без машин"], ["title" => "Высокие потолки"], ["title" => "Есть кладовые"]];
        Secondoption::insert( $data_secondoption );
        $secondoptions = Secondoption::all();


        // Объекты
        Building::factory()->count(10)->create();

        // Присваиваем объектам главные опции
        Building::all()->each(function ($building) use ($masteroptions) {
            $building->getMasteroptions()->attach(
                $masteroptions->random(rand(1, 3))->pluck('id')->toArray()
            );
        });

        // Присваиваем объектам дополнительные опции
        Building::all()->each(function ($building) use ($secondoptions) {
            $building->getSecondoptions()->attach(
                $secondoptions->random(rand(1, 3))->pluck('id')->toArray()
            );
        });


        // \App\Models\User::factory(10)->create();
    }
}
