<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->truncateTables([
            'users','controlpermissions','menus','menutypes','profiles'
        ]);
        $this->call(UsersTable::class);
        $this->call(ControlpermissionsTable::class);
        $this->call(MenusTable::class);
        $this->call(MenutypesTable::class);
        $this->call(ProfilesTable::class);

    }
    public function truncateTables(array $tables)
    {
        //
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
        foreach ($tables as $table){
            DB::table($table)->truncate();
        }
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
    }

}
