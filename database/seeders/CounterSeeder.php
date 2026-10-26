<?php

namespace Database\Seeders;

use App\Models\Counter;
use Illuminate\Database\Seeder;

class CounterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $counters = [
            [
                'icon' => 'fas fa-utensils',
                'number' => '350',
                'title' => 'Total Food Items',
                'status' => 1,
            ],
            [
                'icon' => 'fas fa-users',
                'number' => '15000',
                'title' => 'Satisfied Customers',
                'status' => 1,
            ],
            [
                'icon' => 'fas fa-calendar-alt',
                'number' => '12',
                'title' => 'Years of Experience',
                'status' => 1,
            ],
            [
                'icon' => 'fas fa-trophy',
                'number' => '28',
                'title' => 'Winning Awards',
                'status' => 1,
            ],
        ];

        foreach ($counters as $counter) {
            Counter::updateOrCreate(['title' => $counter['title']], $counter);
        }
    }
}

