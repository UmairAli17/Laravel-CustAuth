<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('roles')->insert([
        	'name' => 'admin',
        	'label' => 'Admin User',
        ]);


        DB::table('roles')->insert([
        	'name' => 'author',
        	'label' => 'Author Role',
        ]);

        DB::table('roles')->insert([
        	'name' => 'user',
        	'label' => 'General User.',
        ]);
    }
}
