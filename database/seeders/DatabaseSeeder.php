<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        DB::table('users')->insert([
            [
                'name' => 'admin_1',
                'email' => 'admin_1',
                'powers' => json_encode(['save', 'remove', 'read']),
                'password' => Hash::make('123'),
            ],
            [
                'name' => 'admin_2',
                'email' => 'admin_2',
                'powers' => json_encode(['read']),
                'password' => Hash::make('123'),
            ],
            [
                'name' => 'admin_3',
                'email' => 'admin_3',
                'powers' => json_encode(['save', 'read']),
                'password' => Hash::make('123'),
            ],
            [
                'name' => 'admin_4',
                'email' => 'admin_4',
                'powers' => json_encode(['remove', 'read']),
                'password' => Hash::make('123'),
            ]
        ]);

        DB::table('deposits')->insert([
            [
                'title' => 'AA'
            ],
            [
                'title' => 'BB'
            ],
            [
                'title' => 'CC'
            ]
        ]);

        DB::table('levels')->insert([
            [
                'title' => 'I',
                'coefficient' => 0.01
            ],
            [
                'title' => 'II',
                'coefficient' => 0.03
            ],
            [
                'title' => 'III',
                'coefficient' => 0.05
            ],
            [
                'title' => 'IV',
                'coefficient' => 0.01
            ],
            [
                'title' => 'V',
                'coefficient' => 0.03
            ]
        ]);

        DB::table('boreholes')->insert([
            [
                'deposit_id' => 1,
                'title' => '10Д',
                'type' => 'добывающая',
                'condition' => 'Наблюдательная',
                'level_id' => 5,
                'q_liquids' => 11.6,
                'water_cut' => 88.6,
                'oil_density' => 0.83,
                'saved' => true,
            ],
            [
                'deposit_id' => 1,
                'title' => '33Г',
                'type' => 'добывающая',
                'condition' => 'В работе',
                'level_id' => 1,
                'q_liquids' => 1.8,
                'water_cut' => 98,
                'oil_density' => 0.82,
                'saved' => true,
            ],
            [
                'deposit_id' => 1,
                'title' => '37Г',
                'type' => 'добывающая',
                'condition' => 'В работе',
                'level_id' => 2,
                'q_liquids' => 12.46,
                'water_cut' => 83,
                'oil_density' => 0.83,
                'saved' => true,
            ],
            [
                'deposit_id' => 3,
                'title' => '47',
                'type' => 'добывающая',
                'condition' => 'Наблюдательная',
                'level_id' => 4,
                'q_liquids' => 20.11,
                'water_cut' => 91.64,
                'oil_density' => 0.82,
                'saved' => true,
            ],
            [
                'deposit_id' => 1,
                'title' => '14',
                'type' => 'добывающая',
                'condition' => 'В работе',
                'level_id' => 2,
                'q_liquids' => 20.33,
                'water_cut' => 50,
                'oil_density' => 0.82,
                'saved' => true,
            ],
            [
                'deposit_id' => 1,
                'title' => '26',
                'type' => 'добывающая',
                'condition' => 'Наблюдательная',
                'level_id' => 2,
                'q_liquids' => 9.76,
                'water_cut' => 90.86,
                'oil_density' => 0.83,
                'saved' => true,
            ],
            [
                'deposit_id' => 2,
                'title' => '27',
                'type' => 'добывающая',
                'condition' => 'В простое',
                'level_id' => 3,
                'q_liquids' => null,
                'water_cut' => 39.92,
                'oil_density' => 0.83,
                'saved' => true,
            ],
            [
                'deposit_id' => 1,
                'title' => '28Г',
                'type' => 'добывающая',
                'condition' => 'В простое',
                'level_id' => 4,
                'q_liquids' => 7.82,
                'water_cut' => null,
                'oil_density' => 0.82,
                'saved' => true,
            ],
            [
                'deposit_id' => 2,
                'title' => '29Г',
                'type' => 'добывающая',
                'condition' => 'Наблюдательная',
                'level_id' => 2,
                'q_liquids' => 6.17,
                'water_cut' => 99.99,
                'oil_density' => 0.83,
                'saved' => true,
            ],
            [
                'deposit_id' => 2,
                'title' => '32Г',
                'type' => 'добывающая',
                'condition' => 'В работе',
                'level_id' => 3,
                'q_liquids' => 6.84,
                'water_cut' => 99.99,
                'oil_density' => 0.82,
                'saved' => true,
            ],
            [
                'deposit_id' => 3,
                'title' => '34Г',
                'type' => 'добывающая',
                'condition' => 'В простое',
                'level_id' => 1,
                'q_liquids' => null,
                'water_cut' => 99.99,
                'oil_density' => 0.83,
                'saved' => true,
            ],
            [
                'deposit_id' => 3,
                'title' => '35Г',
                'type' => 'добывающая',
                'condition' => 'В работе',
                'level_id' => 5,
                'q_liquids' => 16.17,
                'water_cut' => null,
                'oil_density' => 0.82,
                'saved' => true,
            ],
        ]);


        DB::table('boreholes')->insert([
            [
                'deposit_id' => 1,
                'title' => '203',
                'type' => 'добывающая',
                'condition' => 'Наблюдательная',
                'level_id' => 5,
                'q_liquids' => 11.6,
                'water_cut' => 12.73,
                'oil_density' => 0.83,
                'saved' => false,
            ],
            [
                'deposit_id' => 1,
                'title' => '204',
                'type' => 'добывающая',
                'condition' => 'В работе',
                'level_id' => 1,
                'q_liquids' => 1.8,
                'water_cut' => 70.45,
                'oil_density' => 0.82,
                'saved' => false,
            ],
            [
                'deposit_id' => 1,
                'title' => '205',
                'type' => 'добывающая',
                'condition' => 'В работе',
                'level_id' => 2,
                'q_liquids' => 12.46,
                'water_cut' => 25.18,
                'oil_density' => 0.83,
                'saved' => false,
            ],
            [
                'deposit_id' => 3,
                'title' => '206',
                'type' => 'добывающая',
                'condition' => 'Наблюдательная',
                'level_id' => 4,
                'q_liquids' => 20.11,
                'water_cut' => 90.6,
                'oil_density' => 0.82,
                'saved' => false,
            ],
            [
                'deposit_id' => 1,
                'title' => '208',
                'type' => 'добывающая',
                'condition' => 'В работе',
                'level_id' => 2,
                'q_liquids' => 20.33,
                'water_cut' => 89.57,
                'oil_density' => 0.82,
                'saved' => false,
            ],
            [
                'deposit_id' => 1,
                'title' => '210',
                'type' => 'добывающая',
                'condition' => 'Наблюдательная',
                'level_id' => 2,
                'q_liquids' => 9.76,
                'water_cut' => 92.69,
                'oil_density' => 0.83,
                'saved' => false,
            ],
            [
                'deposit_id' => 2,
                'title' => '211',
                'type' => 'добывающая',
                'condition' => 'В простое',
                'level_id' => 3,
                'q_liquids' => null,
                'water_cut' => 67.82,
                'oil_density' => 0.83,
                'saved' => false,
            ],
            [
                'deposit_id' => 1,
                'title' => '212',
                'type' => 'добывающая',
                'condition' => 'В простое',
                'level_id' => 4,
                'q_liquids' => 7.82,
                'water_cut' => 20.27,
                'oil_density' => 0.82,
                'saved' => false,
            ],
            [
                'deposit_id' => 2,
                'title' => '213',
                'type' => 'добывающая',
                'condition' => 'Наблюдательная',
                'level_id' => 2,
                'q_liquids' => 6.17,
                'water_cut' => 43,
                'oil_density' => 0.83,
                'saved' => false,
            ],
            [
                'deposit_id' => 2,
                'title' => '215',
                'type' => 'добывающая',
                'condition' => 'В работе',
                'level_id' => 3,
                'q_liquids' => 6.84,
                'water_cut' => 89.77,
                'oil_density' => 0.82,
                'saved' => false,
            ],
            [
                'deposit_id' => 3,
                'title' => '216',
                'type' => 'добывающая',
                'condition' => 'В простое',
                'level_id' => 1,
                'q_liquids' => null,
                'water_cut' => 48.64,
                'oil_density' => 0.83,
                'saved' => false,
            ],
            [
                'deposit_id' => 3,
                'title' => '219',
                'type' => 'добывающая',
                'condition' => 'В работе',
                'level_id' => 5,
                'q_liquids' => 16.17,
                'water_cut' => 86.86,
                'oil_density' => 0.82,
                'saved' => false,
            ],
        ]);
    }
}
