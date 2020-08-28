<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $tableName = 'menus';
        Schema::create($tableName, function (Blueprint $table) {
            $table->bigIncrements('id')
            ->comment('Id key');
            $table->bigInteger('type')->unsigned()
            ->comment('Option type');
            $table->tinyInteger('orderlist')->nullable()->default('0')
            ->comment('List order in menu');
            $table->string('label', 100)->nullable()
            ->comment('Option label');
            $table->string('link', 100)->unique()->unique()
            ->comment('Option link');
            $table->string('description', 100)->nullable()
            ->comment('Option descripcion');
            $table->string('icon', 30)->nullable()
            ->comment('Option icon');
            $table->enum('active',['1','0'])->default('1')
            ->comment('Option status');
            // $table->foreign('type')->references('id')->on('menutypes')
            // ->onDelete('cascade')
            // ->comment('Option type');
            $table->timestamps();
        });
        DB::statement("ALTER TABLE `$tableName` comment 'It contains the list Menus'");

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menus');
    }
}
