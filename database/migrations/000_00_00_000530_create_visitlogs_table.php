<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVisitlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visitlogs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('datedoc')->nullable();
            $table->dateTime('datein', 0)->nullable()->comment('');
            $table->dateTime('dateout', 0)->nullable()->comment('');
            $table->string('name', 200)->nullable()->comment('');
            $table->bigInteger('condominia_id')->unsigned()->nullable()->comment('');
            $table->string('reference', 200)->nullable()->comment('');
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
        Schema::dropIfExists('visitlogs');
    }
}
