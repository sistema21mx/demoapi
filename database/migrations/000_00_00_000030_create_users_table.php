<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $tableName = 'users';
        Schema::create($tableName, function (Blueprint $table) {
            $table->bigIncrements('id')
            ->comment('');
            $table->string('sysname', 30)->nullable()
            ->comment('');
            $table->string('firstname', 100)->nullable()
            ->comment('');
            $table->string('midname', 100)->nullable()
            ->comment('');
            $table->string('lastname', 100)->nullable()
            ->comment('');
            $table->string('movil', 20)->nullable()
            ->comment('');
            $table->enum('active',['1','0'])->default('1')
            ->comment('');
            $table->string('email', 100)->nullable()->unique()
            ->comment('');
            $table->timestamp('email_verified_at')->nullable()
            ->comment('');
            $table->string('password', 200)->nullable()
            ->comment('');
            $table->rememberToken()
            ->comment('');
            $table->timestamps();
        });
        DB::statement("ALTER TABLE `$tableName` comment 'It contains the User data'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
