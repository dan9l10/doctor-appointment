<?php

namespace Database\Factories;

use App\Models\MedicalCard;
use Illuminate\Database\Eloquent\Factories\Factory;

class MedicalCardFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = MedicalCard::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'path' => $this->faker->sentence(rand(1,2)),
        ];
    }
}
