<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aplications', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('docSource')->unsigned()->nullable()->comment('');
            $table->bigInteger('docLink')->unsigned()->nullable()->comment('');
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
        Schema::dropIfExists('aplications');
    }
}
