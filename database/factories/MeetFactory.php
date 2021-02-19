<?php

namespace Database\Factories;

use App\Models\Meet;
use Illuminate\Database\Eloquent\Factories\Factory;

class MeetFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Meet::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $id_doc = random_int(1,10);
        do {
            $id_user = rand(1,10);
        } while(in_array($id_user, array($id_doc)));

        return [
            'id_doc'=>$id_doc,
            'id_user'=>$id_user,
            'time'=>$this->faker->time(),
            'date'=>$this->faker->dateTimeBetween('now','+ 5 days'),
            'created_at'=>now(),
            'updated_at'=>now()
        ];
    }
}
