<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePayExpensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pay_expenses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('datedoc')->nullable();
            $table->float('amount', 12, 2)->default(0);
            $table->string('reference', 200)->nullable()->comment('');
            $table->string('bank', 200)->nullable()->comment('');
            $table->string('comments', 200)->nullable()->comment('');
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
        Schema::dropIfExists('pay_expenses');
    }
}
