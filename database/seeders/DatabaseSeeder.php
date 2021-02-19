<?php

namespace Database\Seeders;

use App\Models\Appointment;
use App\Models\MedicalCard;
use App\Models\Meet;
use App\Models\Member;
use App\Models\Recipe;
use App\Models\Time;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleTableSeeder::class);
        $this->call(SpecialsTableSeeder::class);
        MedicalCard::factory(10)->create();
        User::factory(10)->create();
        Member::factory(10)->create();

        Meet::factory(10)->create();
        Recipe::factory(10)->create();
        Appointment::factory(10)->create();
        Time::factory(10)->create();
    }
}
