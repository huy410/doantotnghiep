<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Customer;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Customer::factory(50)->create();
        $token = Str::random(64);
        Customer::create([
            'name' => 'hiepdz',
            'password' => Hash::make('123123'),
            'email' => 'hiepbui312000@gmail.com',
            'is_email_verified' => 1,
            'remember_token' => $token,
        ]);
        $this->call([
            CategorySeeder::class,
            ProductSeeder::class,
            PermissionSeeder::class,
            UserSeeder::class,
            NotificationAdminSeeder::class,
        ]);
    }
}
