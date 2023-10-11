<?php

namespace Database\Seeders;

use App\Models\NotificationAdmin;
use Illuminate\Database\Seeder;

class NotificationAdminSeeder extends Seeder
{
    public function run()
    {
        NotificationAdmin::create([
            'user_id' => 1,
            'name' => 'Customer registered',
            'link' => "customers",
            'checked' => false,
        ]);
        NotificationAdmin::create([
            'user_id' => 1,
            'name' => 'Order recieved',
            'link' => "orders",
            'checked' => false,
        ]);
        NotificationAdmin::create([
            'user_id' => 1,
            'name' => 'Review',
            'link' => "reviews",
            'checked' => false,
        ]);
        NotificationAdmin::create([
            'user_id' => 2,
            'name' => 'Customer registered',
            'link' => "customers",
            'checked' => false,
        ]);
        NotificationAdmin::create([
            'user_id' => 2,
            'name' => 'Order recieved',
            'link' => "orders",
            'checked' => false,
        ]);
        NotificationAdmin::create([
            'user_id' => 2,
            'name' => 'Review',
            'link' => "reviews",
            'checked' => false,
        ]);
    }
}
