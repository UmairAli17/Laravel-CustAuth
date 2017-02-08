<?php

use Illuminate\Database\Seeder;

class AddAdminModerateMenuPermSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->insert([
        	'name' => 'moderate-users',
        	'label' => 'Moderate Users',
        ]);

        DB::table('permissions')->insert([
        	'name' => 'moderate-posts',
        	'label' => 'Moderate Posts',
        ]);

        DB::table('permissions')->insert([
            'name' => 'add-landlord-residence',
            'label' => 'Moderate Posts',
        ]);
    }
}
