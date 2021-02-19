<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SpecialsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $specials=['Акушер-гинеколог','Аллерголог-иммунолог','Андролог','Ароматерапевт',
            'Анестезиолог','Венеролог', 'Гематолог','Дерматолог','Кардиолог','Диетолог','Инфекционист',
            'Психотерапевт','Психиатр','Проктолог'];
        $data=[];

        foreach ($specials as $value){
            $data[] = [
                'name'=>$value
            ];
        }
        DB::table('specials')->insert($data);
    }
}
