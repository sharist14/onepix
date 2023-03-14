<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBuildingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buildings', function (Blueprint $table) {
            $table->id();
            $table->string('title')->comment('Название комплекса');
            $table->string('address')->comment('Адрес');
            $table->unsignedBigInteger('builder_id')->default(0)->comment('id застройщика');
            $table->unsignedBigInteger('housing_id')->default(0)->comment('id типа жилья');
            $table->string('image_preview')->comment('превью изображение');
            $table->integer('metro_distance')->default(0)->comment('время до метро');
            $table->timestamp('start_time')->nullable()->comment('время сдачи проекта');
            $table->unsignedDecimal('service_price', 10, 2)->default(0)->comment('стоимость услуг');

            $table->timestamps();

            $table->index('builder_id', 'building_builder_idx');
            $table->index('housing_id', 'building_housing_idx');


            $table->foreign('builder_id', 'building_builder_fk')->on('builders')->references('id');
            $table->foreign('housing_id', 'building_housing_fk')->on('housings')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('buildings');
    }
}
