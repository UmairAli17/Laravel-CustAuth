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
        	'name' => 'Admin',
        	'email' => '123@gmail.com',
        	'password' => bcrypt('123456'),
        ]);

        DB::table('users')->insert([
        	'name' => 'Author',
        	'email' => '1234@gmail.com',
        	'password' => bcrypt('1234567'),
        ]);
    }
}
