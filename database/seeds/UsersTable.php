<?php

use Illuminate\Database\Seeder;

class UsersTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        /*
        DB::table('users')->insert([ 
            'sysname' => 'admin',
            'firstname' => 'Admin',
            'midname' => 'D',
            'lastname' => 'Sistema',
            'movil' => '9876543210',
            'active' => '1',
            'email' => 'carlos_asrnet@hotmail.com',
            'password' => '$2y$10$HQVIHdcwvQco/kZk8o9uouPwnnb.EnplDlF1.Rq0zLWEeqUObqn9G'
        ]);
        ("admin", "Admin", "D", "Sistema", "9876543210", "1", "carlos_asrnet@hotmail.com", "$2y$10$r7voDFUyItl47kAK2JC6juCIUjVYAoLu5UR9cjVXnBdaZerO9Dlli"),

        */
        DB::insert('INSERT INTO users ' . 
		' (sysname, firstname, midname, lastname, movil, active, email, password)
        VALUES 
        ("rasecfer", "Fernando", "Zambrans", "Cardiel", "4423453333", "1", "rasecfer@gmail.com", "$2y$10$/wpCE0oSFQkdgNJho4FcvO4tiPjnp/q.k80KOTvz68xLVOvbAg7bq"),
        ("admin", "Admin", "D", "Sistema", "9876543210", "1", "carlos_asrnet@hotmail.com", "' . password_hash('4dmin', PASSWORD_DEFAULT) . '"),
        ("demo", "Usuario", "De", "Mo", "3232322332", "1", "sistema21mx@mail.com", "$2y$10$6YCiDpeg8p6iRvRtfkwECuenksFo/wqVfFdIVEp0zVp9yeiXN/UQi"),
        ("prueba", "Usuario", "De", "Prueba", "4425468383", "0", "prueba@mail.com", "$2y$10$4pEjl4bdCA7jkfKTP5qbSuhvYXIKPjvn0VT.ukRoLQO6XPR6tJQUW")
		') ;

    }
}
