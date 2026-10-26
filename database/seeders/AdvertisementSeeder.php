<?php

namespace Database\Seeders;

use App\Models\Advertisement;
use Illuminate\Database\Seeder;

class AdvertisementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ads = [
            [
                'image' => 'frontend/images/banner2_img_1.jpg',
                'title' => 'Delicious Cheesy Burger',
                'details' => 'Taste the crunchiest burger made with fresh ingredients and signature melted cheese.',
                'url' => '#',
                'status' => 1,
            ],
            [
                'image' => 'frontend/images/banner2_img_2.jpg',
                'title' => 'Special Crispy Chicken',
                'details' => 'Crispy on the outside, tender on the inside, served with hot spicy sauce.',
                'url' => '#',
                'status' => 1,
            ],
            [
                'image' => 'frontend/images/banner2_img_3.jpg',
                'title' => 'French Fries & Combos',
                'details' => 'Enjoy up to 50% discount on combo family meals and soft drinks.',
                'url' => '#',
                'status' => 1,
            ],
        ];

        foreach ($ads as $ad) {
            Advertisement::updateOrCreate(['title' => $ad['title']], $ad);
        }
    }
}

