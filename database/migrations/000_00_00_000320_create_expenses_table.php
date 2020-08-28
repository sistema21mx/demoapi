<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExpensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expenses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('datedoc')->nullable();
            $table->date('datedue')->nullable();
            $table->date('dateapp')->nullable();
            $table->string('description', 200)->nullable()->comment('');
            $table->string('referenceapp', 100)->nullable()->comment('');
            $table->bigInteger('provider_id')->unsigned()->nullable()->comment('');
            $table->bigInteger('budget_id')->unsigned()->nullable()->comment('');
            $table->float('amount', 12, 2)->default(0);
            $table->float('amountapp', 12, 2)->default(0);
            $table->enum('approved',['1','0'])->default('0')->comment('');
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
        Schema::dropIfExists('expenses');
    }
}
