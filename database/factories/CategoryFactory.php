<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;

class AppModelsCategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Category::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        Category::factory(function (Faker $faker) {
            return [
                'name'          =>  $faker->name,
                'description'   =>  $faker->realText(100),
                'parent_id'     =>  1,
                'menu'          =>  1,
            ];
        });
    }
}
