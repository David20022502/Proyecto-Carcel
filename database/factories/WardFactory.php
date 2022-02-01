<?php

namespace Database\Factories;

use App\Models\Ward;
use Illuminate\Database\Eloquent\Factories\Factory;

class WardFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     * 
     */
    protected $model = Ward::class;
    public function definition()
    {
        return [
            'name'=>$this->faker->streetName,
            'location'=>$this->faker->streetName,
            'description'=>$this->faker->text($macNBchars=45),
        ];
    }
}
