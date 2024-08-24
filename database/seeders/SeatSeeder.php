<?php

namespace Database\Seeders;

use App\Models\seat;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SeatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        seat::query()->insert([
            [
                'title' => 'first class seats'
            ],
            [
                'title' => 'second class seats'
            ],
            [
                'title' => 'third class seats'
            ],
            [
                'title' => 'four class seats'
            ],
        ]);
    }
}
