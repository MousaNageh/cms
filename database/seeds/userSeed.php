<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class userSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::where("email","200moussa200@gmail.com")->first() ;
        if(!$user){
            User::create([
                "name"=>"mousa nageh" ,
                "email"=>"200moussa200@gmail.com" ,
                "role"=>"admin" ,
                "password"=>Hash::make("mousamousa1234")
            ]) ;
        }
    }
}
