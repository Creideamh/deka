<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\branch::all()->each(function ($branch) {
            $branch->users()->save(\App\Models\User::factory(\App\Models\User::class)->make());
        });
    }
}
