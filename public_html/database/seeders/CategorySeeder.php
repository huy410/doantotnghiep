<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categoryName = [ 'Đồ điện tử trong bếp', 'Máy tính & laptop', 'Điện thoại', 'Robot thông minh', 'Máy ảnh', 'Máy tính bảng', 
        'Router wifi', 'Phụ kiện máy tính', 'Đồng hồ thông minh', 'Các thiết bị điện tử khác'];
        for($i = 0; $i < count($categoryName); $i++) {
            if($i <= 5 ) {
                Category::create([
                    'name' => $categoryName[$i],
                    'display_home' => 1,
                ]);
            } else {
                Category::create([
                    'name' => $categoryName[$i],
                    'display_home' => 0,
                ]);
            }
        }
    }
}
