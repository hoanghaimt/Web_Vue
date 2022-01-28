<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Khách vãng lai',
            'email' => 'default@gmail.com',
            'phone' => '000000000',
            'status' => '1',
            'address' => 'shop default user',
            'password' => bcrypt('1212123'),
        ]);
    }
}
