<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $brand = ['samsung','apple', 'xiaomi', 'huawei', 'toshiba', 'google', 'microsoft'];
        $randKeyBrand = array_rand($brand,1);
        return [
            'name' => Str::random(10),
            'brand' => $brand[$randKeyBrand],
            'price' => random_int(1000000, 20000000),
            'discount' => random_int(0, 99),
            'remaining' => random_int(1, 100),
            'display_home' => random_int(0, 1),
            'category_id' => random_int(1, 10),
            'image' => '1-product_m-01.jpg|1-product_m-02.jpg|1-product_s-01.jpg',
            'description' => Str::random(50),
            'specifications' => Str::random(50),
        ];
    }
}
