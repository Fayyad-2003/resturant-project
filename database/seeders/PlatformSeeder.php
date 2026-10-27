<?php

namespace Database\Seeders;

use App\Models\Platform;
use Illuminate\Database\Seeder;

class PlatformSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $platforms = [
            [
                'icon' => 'fab fa-google-play',
                'title' => 'Available on the',
                'heading' => 'Google Play',
                'url' => 'https://play.google.com',
                'status' => true,
            ],
            [
                'icon' => 'fab fa-apple',
                'title' => 'Download on the',
                'heading' => 'Apple Store',
                'url' => 'https://apple.com/app-store',
                'status' => true,
            ],
        ];

        foreach ($platforms as $platform) {
            Platform::updateOrCreate(
                ['heading' => $platform['heading']],
                $platform
            );
        }
    }
}

