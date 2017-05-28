<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Tweet;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      factory(App\User::class, 5)->create()->each(function ($u) {
       $u->tweets()->save(factory(App\Tweet::class)->make());
   });
      DB::table('users')->insert(
        [
            'username' => 'somto121',
            'name' => 'Somto Achu',
            'email' => 'somto121@gmail.com',
            'password' => bcrypt('password'),
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ]);
    }
}
