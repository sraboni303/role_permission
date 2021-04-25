<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::where('email', 'sr@gmail.com')->first();

        if(is_null($user)){
            $user = new User();
            $user->name = "Sraboni";
            $user->email = "sr@gmail.com";
            $user->password = Hash::make('asdfg');
            $user->save();
        }

    }
}
