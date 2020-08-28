<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProvidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $tableName = 'providers';
        Schema::create($tableName, function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code', 100)->unique()->comment('');
            $table->string('description', 200)->nullable()->comment('');
            $table->string('movil', 15)->nullable()->comment('');
            $table->string('bank', 200)->nullable()->comment('');
            $table->string('payMethod', 200)->nullable()->comment('');
            $table->string('fund', 40)->nullable()->comment('');
            $table->bigInteger('budgetExpenditure_id')->unsigned()->nullable()->comment('');
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
        Schema::dropIfExists('providers');
    }
}
