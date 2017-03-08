<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //***** The following are seeds for the tables. Comment them out once you've finished with a seed. Remove comments so you can use them when migrating the database.****//
        
        //$this->call(UsersTableSeeder::class);
        //\$this->call(RolesTableSeeder::class);
        //$this->call(AssignRolesUsers::class);
        $this->call(AddAdminModerateMenuPermSeeder::class);

    }
}
