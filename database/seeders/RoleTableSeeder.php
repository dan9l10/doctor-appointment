<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = ['admin','patient','doctor','moderator'];
        $data = [];
        foreach ($roles as $role) {
            $data[] = [
                'name' => $role,
                'guard_name' =>'web',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),

            ];
        }
        DB::table('roles')->insert($data);
    }
}
