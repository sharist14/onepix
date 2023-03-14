<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBuildingSecondoptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('building_secondoptions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('building_id');
            $table->unsignedBigInteger('secondoption_id');
            $table->index('building_id', 'building_secondoptions_building_idx');
            $table->index('secondoption_id', 'building_secondoptions_secondoption_idx');
            $table->foreign('building_id', 'building_secondoptions_building_fk')->on('buildings')->references('id');
            $table->foreign('secondoption_id', 'building_secondoptions_secondoption_fk')->on('secondoptions')->references('id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('building_secondoptions');
    }
}
