<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\NavLocation;

class NavLocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        NavLocation::create(
            [
            'title' => 'Main Navigation',
            'status' => 'Active'
            ],
            [
                'title' => 'Top Header',
                'status' => 'Active'
            ],
            [
                'title' => 'Footer',
                'status' => 'Active'
            ]
        );
    }
}
