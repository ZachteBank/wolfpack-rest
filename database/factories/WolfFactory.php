<?php

namespace Database\Factories;

use Date;
use Illuminate\Database\Eloquent\Factories\Factory;

class WolfFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $gender = $this->faker->boolean() ? "male" : "female";
        return [
            'gender' => $gender,
            'name' => $this->faker->name($gender),
            'birthday' => $this->faker->dateTimeThisCentury()->format("Y-m-d"),
            'lat' => $this->faker->latitude(51.23116, 52.35960),
            'lng' => $this->faker->longitude(4.40102, 6.68160),
        ];
    }
}
