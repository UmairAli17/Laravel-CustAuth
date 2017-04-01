<?php

use Illuminate\Database\Seeder;

// composer require laracasts/testdummy
use Laracasts\TestDummy\Factory as TestDummy;

class AssignPermissionsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('permissions_roles')->insert([
        	'permissions_id' => '1',
        	'roles_id' => '1',
        ]);

        DB::table('permissions_roles')->insert([
        	'permissions_id' => '2',
        	'roles_id' => '1',
        ]);


        DB::table('permissions_roles')->insert([
        	'permissions_id' => '3',
        	'roles_id' => '2',
        ]);
    }
}
