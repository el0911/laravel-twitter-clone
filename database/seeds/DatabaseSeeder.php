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
   		//no need for the tweet seeder. the tweets are generated from the UsersTableSeeder.
   	   $this->call(UsersTableSeeder::class);
   }
}
