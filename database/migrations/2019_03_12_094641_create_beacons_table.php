<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBeaconsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('beacons', function (Blueprint $table) {
            
            $table->increments('id');
            $table->string('EddystoneNamespace');
            $table->string('IBeaconUUID');
            $table->string('uuid');
            $table->string('product');
            $table->timestamps();

            $table->unsignedInteger('user_id');
            $table->unsignedInteger('emp_id')->nullable();
            $table->unsignedInteger('campaign_id')->nullable();

            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade');

            $table->foreign('emp_id')
                ->references('id')->on('employees')
                ->onDelete('cascade');

            $table->foreign('campaign_id')
                ->references('id')->on('campaigns')
                ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('beacons');
    }
}
