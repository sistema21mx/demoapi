<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCondominiaQuotasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('condominia_quotas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('condominia_id')->unsigned()->nullable()->comment('');
            $table->bigInteger('year')->unsigned()->nullable()->comment('');
            $table->bigInteger('period')->unsigned()->nullable()->comment('');
            $table->string('type', 50)->nullable()->comment('');
            $table->string('description', 200)->nullable()->comment('');
            // $table->string('referenceapp', 100)->nullable()->comment('');
            $table->float('amount', 12, 2)->default(0);
            // $table->float('amountapp', 12, 2)->default(0);
            $table->date('datedoc')->nullable();
            $table->date('datedue')->nullable();
            // $table->date('dateapp')->nullable();
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
        Schema::dropIfExists('condominia_quotas');
    }
}
