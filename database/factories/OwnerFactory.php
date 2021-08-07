<?php

namespace Database\Factories;

use App\Models\Owner;
use Illuminate\Database\Eloquent\Factories\Factory;

class OwnerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Owner::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'identification' => $this->faker->buildingNumber(),
            'first_name' => $this->faker->firstName() ,
            'second_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'direction' => $this->faker->address(),
            'phone' => $this->faker->phoneNumber(),
            'city' => $this->faker->city(),
            'vehicle_id' => $this->faker->numberBetween(1,5),
        ];
    }
}
