<?php

namespace Database\Seeders;

use App\Models\branch;
use App\Models\company;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class branchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $branches = [

            ['branch_name' => 'Accra_Main', 'branch_code' => '3003', 'company_id' => 1],
            ['branch_name' => 'Junction_Mall', 'branch_code' => '3002', 'company_id' => 1],
            ['branch_name' => 'Accra_Mall', 'branch_code' => '3006', 'company_id' => 1],
            ['branch_name' => 'Achimota_Mall', 'branch_code' => '3009', 'company_id' => 1],
            ['branch_name' => 'West Hill Mall', 'branch_code' => '3012', 'company_id' => 1],
            ['branch_name' => 'Adum_Kumasi', 'branch_code' => '6753', 'company_id' => 1],
            ['branch_name' => 'Takoradi', 'branch_code' => '6822', 'company_id' => 1],
            ['branch_name' => 'Tema_Community_1', 'branch_code' => '6824', 'company_id' => 1],
            ['branch_name' => 'Tema_Community_11', 'branch_code' => '4127', 'company_id' => 1],
            ['branch_name' => 'Airport', 'branch_code' => '6735', 'company_id' => 1],
            ['branch_name' => 'Makola', 'branch_code' => '4126', 'company_id' => 1],
            ['branch_name' => 'Kpando', 'branch_code' => '5012', 'company_id' => 1],

            ['branch_name' => 'Legon', 'branch_code' => 'L4000', 'company_id' => 2],
            ['branch_name' => 'Kwashieman', 'branch_code' => 'KW5002', 'company_id' => 2],
            ['branch_name' => 'Lapaz', 'branch_code' => 'LA4001', 'company_id' => 2],
            ['branch_name' => 'Circle', 'branch_code' => 'C4009', 'company_id' => 2],
            ['branch_name' => 'Madina', 'branch_code' => 'MD4002', 'company_id' => 2],
            ['branch_name' => 'Mallam', 'branch_code' => 'M4090', 'company_id' => 2],
            ['branch_name' => 'Kasoa', 'branch_code' => 'K4022', 'company_id' => 2],
            ['branch_name' => 'Kumasi', 'branch_code' => 'KU3090', 'company_id' => 2],
            ['branch_name' => 'Takoradi', 'branch_code' => 'T4087', 'company_id' => 2],
            ['branch_name' => 'Achimota', 'branch_code' => 'ACH5009', 'company_id' => 2],
            ['branch_name' => 'Nungua', 'branch_code' => 'NU4128', 'company_id' => 2],
            ['branch_name' => 'Kaneshie', 'branch_code' => 'KA2000', 'company_id' => 2],

        ];

        foreach ($branches as $key => $value) {
            branch::create($value);
        }
    }
}
