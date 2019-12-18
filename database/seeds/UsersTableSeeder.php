<?php

use App\User;
use Illuminate\Support\Facades\DB;
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
        //look for the user
        $user = User::where('email', 'davsong01@gmail.com')->first();

        //if user doesnt exist, create it
        if(!$user){
            User::create([
                'name' => 'David Oghi',
                'email' => 'davsong01@gmail.com',
                'role' => 'admin',
                'password' => bcrypt('passwordpassword'),
                
            ]);
        }
    }
}
