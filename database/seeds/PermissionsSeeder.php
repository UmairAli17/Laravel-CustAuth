<?php

use Illuminate\Database\Seeder;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->insert([
        	'name' => 'admin',
        	'label' => 'Admin Permission',
        ]);

        DB::table('permissions')->insert([
        	'name' => 'landlord',
        	'label' => 'Landlord Permissions',
        ]);

        DB::table('permissions')->insert([
        	'name' => 'student',
        	'label' => 'Student Permissions',
        ]);
    }
}
