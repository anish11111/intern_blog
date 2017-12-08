<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user=App\User::create([
        	'name'=>'Anil Baniya',
        	'email'=>'anil@god.com',
        	'password'=>bcrypt('password'),
            'admin'=>1,
        ]);

        App\Profile::create([
            'user_id'=>$user->id,
            'avatar'=>'uploads/avatars/1.jpg',
            'about'=>'This is about me Anil',
            'fb'=>'link to fb',
            'youtube'=>'link to youtube'
        ]);
    }
}
