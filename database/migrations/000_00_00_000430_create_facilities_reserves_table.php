<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFacilitiesReservesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('facilities_reserves', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->dateTime('dateStart', 0)->nullable();
            $table->dateTime('dateEnd', 0)->nullable();
            $table->bigInteger('facilities_id')->unsigned()->nullable()->comment('');
            $table->bigInteger('tenant_id')->unsigned()->nullable()->comment('');
            $table->string('reason', 200)->nullable()->comment('');
            $table->enum('confirm',['1','0'])->default('0')->comment('');
            $table->enum('active',['1','0'])->default('1')->comment('');
            $table->bigInteger('user_id')->unsigned()->nullable()->comment('');
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
        Schema::dropIfExists('facilities_reserves');
    }
}
