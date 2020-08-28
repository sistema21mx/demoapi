<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountPayablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('account_payables', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('description', 200)->nullable()->comment('');
            $table->string('reference', 200)->nullable()->comment('');
            $table->date('datedoc')->nullable();
            $table->date('datedue')->nullable();
            $table->float('amount', 12, 2)->default(0);
            $table->bigInteger('provider_id')->unsigned()->nullable()->comment('');
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
        Schema::dropIfExists('account_payables');
    }
}
