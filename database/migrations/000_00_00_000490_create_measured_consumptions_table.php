<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMeasuredConsumptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('measured_consumptions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('description', 200)->nullable()->comment('');
            $table->float('costPerUnit', 12, 2)->default(0);
            $table->date('dateReading')->nullable();
            $table->date('dateDue')->nullable();
            $table->string('fund', 40)->nullable()->comment('');
            $table->bigInteger('budgetExpenditure_id')->unsigned()->nullable()->comment('');
            //
            $table->bigInteger('condominia_id')->unsigned()->nullable()->comment('');
            $table->float('ReadPrev', 12, 2)->default(0);
            $table->float('ReadNew', 12, 2)->default(0);
            $table->float('amount', 12, 2)->default(0);
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
        Schema::dropIfExists('measured_consumptions');
    }
}
