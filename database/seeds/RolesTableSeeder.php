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
        	'name' => 'landlord',
        	'label' => 'Landlord Role',
        ]);

        DB::table('roles')->insert([
        	'name' => 'student',
        	'label' => 'Student - General User.',
        ]);
    }
}
