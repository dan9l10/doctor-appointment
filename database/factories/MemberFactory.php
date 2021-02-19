<?php

namespace Database\Factories;

use App\Models\Member;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class MemberFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Member::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id'=>rand(1,10),
            'id_role'=>rand(1,4),
        	'id_spec'=>rand(1,14),
            'created_at'=>now(),
            'updated_at'=>now(),
            'id_card'=>rand(1,10),
        ];
    }
}
