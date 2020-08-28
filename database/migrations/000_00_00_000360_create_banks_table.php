<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBanksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 200)->nullable()->comment('');
            $table->string('branch', 40)->nullable()->comment('');
            $table->string('account', 40)->nullable()->comment('');
            $table->string('clabe', 40)->nullable()->comment('');
            $table->date('initialDay')->nullable();
            $table->float('initialBalance', 12, 2)->default(0);
            $table->bigInteger('fund_id')->unsigned()->nullable()->comment('');
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
        Schema::dropIfExists('banks');
    }
}
