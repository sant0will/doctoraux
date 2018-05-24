<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('types')->insert([
            'name' => 'Administrador'
        ]);
        DB::table('types')->insert([
            'name' => 'Médico'
        ]);
        DB::table('types')->insert([
            'name' => 'Usuário'
        ]);
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin123'),
            'access' => '1',
            'type_id' => '1',    
        ]);
    }
}
