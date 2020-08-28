<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDepositsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deposits', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('datedoc')->nullable();
            $table->string('reference', 100)->nullable()->comment('');
            $table->string('comment', 100)->nullable()->comment('');
            $table->float('amount', 12, 2)->default(0);
            $table->string('type', 50)->nullable()->comment('');
            $table->bigInteger('bank_id')->unsigned()->nullable()->comment('');
            $table->bigInteger('payMethod_id')->unsigned()->nullable()->comment('');
            $table->bigInteger('condominia_id')->unsigned()->nullable()->comment('');
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
        Schema::dropIfExists('deposits');
    }
}
