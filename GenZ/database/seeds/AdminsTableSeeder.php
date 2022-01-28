<?php

use Illuminate\Database\Seeder;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'phone' => '01649573828',
            'address' => 'Buôn Ma Thuột',
            'status' => '1',
            'level' => '100',
            'password' => bcrypt('1212123'),
        ]);
    }
}
