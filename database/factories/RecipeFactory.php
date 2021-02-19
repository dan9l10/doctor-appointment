<?php

namespace Database\Factories;

use App\Models\Recipe;
use Illuminate\Database\Eloquent\Factories\Factory;

class RecipeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Recipe::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $id_doc=rand(1,10);
        do{
            $id_user=rand(1,10);
        }while(in_array($id_user,array($id_doc)));
        return [
            'id_user'=>$id_user,
            'id_doc'=>$id_doc,
            'description'=>$this->faker->realText(30),
            'created_at'=>$this->faker->date(),
        ];
    }
}
