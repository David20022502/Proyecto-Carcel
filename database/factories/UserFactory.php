<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = User::class;
    public function definition()
    {
        return [
            'first_name'=>$this->faker->firstName,
            'last_name'=>$this->faker->lastName,
            'username'=>$this->faker->userName,
            'personal_phone'=> '09'. $this->faker->randomNumber(8),
            'home_phone'=>'02'. $this-> faker->randomNumber(7),
            'address'=>$this->faker->streetAddress,
            'password'=>Hash::make('secret'),
            'email'=>$this->faker-> unique()->safeEmail,
            'birthdate'=>$this->faker->dateTimeBetween('-50 years','now'),
            'email_verified_at'=>now(),
            'remember_token'=>Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
