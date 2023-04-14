<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;

class CompanySeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\company::factory(10)->create()->each(function ($company) {
            $company->branches()->save(\App\Models\branch::factory(\App\Models\branch::class)->make());
        });
    }
}
