<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBudgetIncomesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('budget_incomes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code', 100)->unique()->comment('');
            $table->string('name', 200)->nullable()->comment('');
            $table->bigInteger('year')->default(0);
            $table->float('netAmt', 12, 2)->default(0);
            $table->enum('active',['1','0'])->default('1')->comment('');
            $table->enum('closed',['1','0'])->default('0')->comment('');
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
        Schema::dropIfExists('budget_incomes');
    }
}
