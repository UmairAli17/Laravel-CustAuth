<?php

use Illuminate\Database\Seeder;

class AssignRolesUsers extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	//Assign the "Admin user the Admin Role
        DB::table('roles_user')->insert([
        	'roles_id' => '1',
        	'user_id' => '1',
        ]);

        //Assign the "Author user the Author Role
        DB::table('roles_user')->insert([
        	'roles_id' => '2',
        	'user_id' => '2',
        ]);
    }
}
