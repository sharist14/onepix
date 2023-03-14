<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBuildingMasteroptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('building_masteroptions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('building_id');
            $table->unsignedBigInteger('masteroption_id');
            $table->index('building_id', 'building_masteroptions_building_idx');
            $table->index('masteroption_id', 'building_masteroptions_masteroption_idx');
            $table->foreign('building_id', 'building_masteroptions_building_fk')->on('buildings')->references('id');
            $table->foreign('masteroption_id', 'building_masteroptions_masteroption_fk')->on('masteroptions')->references('id');
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
        Schema::dropIfExists('building_masteroptions');
    }
}
