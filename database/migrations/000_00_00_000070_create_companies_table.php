<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $tableName = 'companies';
        Schema::create($tableName, function (Blueprint $table) {
            $table->bigIncrements('id')
            ->comment('');
            $table->string('name', 150)->nullable()
            ->comment('');
            $table->string('companyCode', 50)->nullable()
            ->comment('');
            $table->string('rfc', 40)->nullable()
            ->comment('');
            $table->string('movil', 20)->nullable()
            ->comment('');
            $table->string('address', 200)->nullable()
            ->comment('');
            $table->string('colony', 100)->nullable()
            ->comment('');
            $table->string('town', 100)->nullable()
            ->comment('');
            $table->string('city', 100)->nullable()
            ->comment('');
            $table->string('zipCode', 10)->nullable()
            ->comment('');
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->enum('active',['1','0'])->default('1')
            ->comment('');
            $table->string('email', 100)->nullable()
            ->comment('');
            $table->timestamps();
        });
        DB::statement("ALTER TABLE `$tableName` comment 'It contains the Company data'");
        DB::insert('INSERT INTO ' .$tableName. 
		' (name, companyCode, rfc, movil, address, colony, town, city, zipCode, email)
        VALUES 
        ("Ana Rosa Garcia Ordonez", "ARGO", "ARGO1341445", "5515413479", "Tenochtitlan No 16, Int 5", "San Pedro Xalostoc", "Ecatepec", "Edo. de Mex.", "55310","mail@mail.com" )
		') ;
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('companies');
    }
}
