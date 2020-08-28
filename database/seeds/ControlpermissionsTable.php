<?php

use Illuminate\Database\Seeder;

class ControlpermissionsTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::insert('INSERT INTO controlpermissions ' . 
		' (readonly,suspended)
        VALUES 
        ("0","0")
		') ;
    }
}
