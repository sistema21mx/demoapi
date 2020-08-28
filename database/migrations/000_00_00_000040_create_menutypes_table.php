<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenutypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $tableName = 'menutypes';
        Schema::create($tableName, function (Blueprint $table) {
            $table->bigIncrements('id')
            ->comment('Id key');
            $table->string('description', 100)->nullable()
            ->comment('Description type menu');
            $table->string('icon', 30)->nullable()
            ->comment('Type menu Icon');
            $table->enum('active',['1','0'])->default('1')
            ->comment('Type menu active');
            $table->timestamps();
        });
        DB::statement("ALTER TABLE `$tableName` comment 'It contains the menu types'");

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menutypes');
    }
}
