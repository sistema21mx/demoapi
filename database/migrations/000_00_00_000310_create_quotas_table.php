<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuotasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quotas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code', 100)->unique()->comment('');
            $table->string('description', 200)->nullable()->comment('');
            $table->tinyInteger('dueDays')->default(0);
            $table->float('amount', 12, 2)->default(0);
            $table->bigInteger('percentagediscount')->unsigned()->nullable()->comment('');
            $table->bigInteger('fund_id')->unsigned()->nullable()->comment('');
            $table->bigInteger('budget_incomes_id')->unsigned()->nullable()->comment('');
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
        Schema::dropIfExists('quotas');
    }
}
