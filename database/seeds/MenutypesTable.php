<?php

use Illuminate\Database\Seeder;

class MenutypesTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::insert('INSERT INTO menutypes ' . 
        ' (id, description, icon, active)
        VALUES 
        (1, "Sistema", "local_activity", 1),
        (2, "Catalogo", "local_activity", 1),
        (3, "Registro", "local_activity", 1),
        (4, "Consulta", "local_activity", 1)
        ') ;
    }
}
