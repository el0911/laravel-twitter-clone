<?php

use Illuminate\Database\Seeder;
use App\User;
use App\tweet;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class, 5)->create()->each(function ($u) {
        $u->tweets()->save(factory(tweet::class)->make());
    	});
    }
}