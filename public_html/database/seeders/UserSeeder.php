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
        $user1 = User::create([
            'name' => 'hiepdz',
            'password' => Hash::make('123123'),
            'email' => 'hiepbui312000@gmail.com',
        ]);
        $user1->assignRole('super-admin');
        $user2 = User::create([
            'name' => 'hiepdz',
            'password' => Hash::make('123123'),
            'email' => 'henbui312000@gmail.com',
        ]);
        $user2->assignRole('admin');
       
    }
}
