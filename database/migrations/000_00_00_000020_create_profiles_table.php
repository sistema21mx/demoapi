<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $tableName = 'profiles';
        Schema::create($tableName, function (Blueprint $table) {
            $table->bigIncrements('id')
            ->comment('Id key');
            $table->tinyInteger('usr_id')->nullable()
            ->comment('Id user');
            $table->tinyInteger('mnu_id')->nullable()
            ->comment('Id Menu');
            $table->enum('active',['1','0'])->default('1')
            ->comment('Profile active');
            $table->timestamps();
        });
        DB::statement("ALTER TABLE `$tableName` comment 'It contains the profile by user'");

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profiles');
    }
}
