<?php

namespace Database\Seeders;

use App\Models\Chef;
use Illuminate\Database\Seeder;

class ChefSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $chefs = [
            [
                'name' => 'Sima Ahmed',
                'image' => 'frontend/images/chef_1.jpg',
                'designation' => 'Executive Chef',
                'facebook' => 'https://facebook.com',
                'instagram' => 'https://instagram.com',
                'twitter' => 'https://twitter.com',
                'behance' => 'https://behance.net',
                'show_at_home' => 1,
                'status' => 1,
            ],
            [
                'name' => 'Rajib Khan',
                'image' => 'frontend/images/chef_2.jpg',
                'designation' => 'Senior Sous Chef',
                'facebook' => 'https://facebook.com',
                'instagram' => 'https://instagram.com',
                'twitter' => 'https://twitter.com',
                'behance' => 'https://behance.net',
                'show_at_home' => 1,
                'status' => 1,
            ],
            [
                'name' => 'Tanvir Hasan',
                'image' => 'frontend/images/chef_3.jpg',
                'designation' => 'Grill & BBQ Master',
                'facebook' => 'https://facebook.com',
                'instagram' => 'https://instagram.com',
                'twitter' => 'https://twitter.com',
                'behance' => 'https://behance.net',
                'show_at_home' => 1,
                'status' => 1,
            ],
            [
                'name' => 'Nafisa Akter',
                'image' => 'frontend/images/chef_4.jpg',
                'designation' => 'Pastry Specialist',
                'facebook' => 'https://facebook.com',
                'instagram' => 'https://instagram.com',
                'twitter' => 'https://twitter.com',
                'behance' => 'https://behance.net',
                'show_at_home' => 1,
                'status' => 1,
            ],
            [
                'name' => 'Rashida Khatun',
                'image' => 'frontend/images/chef_5.jpg',
                'designation' => 'Dessert Artist',
                'facebook' => 'https://facebook.com',
                'instagram' => 'https://instagram.com',
                'twitter' => 'https://twitter.com',
                'behance' => 'https://behance.net',
                'show_at_home' => 1,
                'status' => 1,
            ],
            [
                'name' => 'Hasan Rafi',
                'image' => 'frontend/images/chef_6.jpg',
                'designation' => 'Italian Cuisine Chef',
                'facebook' => 'https://facebook.com',
                'instagram' => 'https://instagram.com',
                'twitter' => 'https://twitter.com',
                'behance' => 'https://behance.net',
                'show_at_home' => 1,
                'status' => 1,
            ],
            [
                'name' => 'Ayerin Ira',
                'image' => 'frontend/images/chef_7.jpg',
                'designation' => 'Salad & Healthy Chef',
                'facebook' => 'https://facebook.com',
                'instagram' => 'https://instagram.com',
                'twitter' => 'https://twitter.com',
                'behance' => 'https://behance.net',
                'show_at_home' => 0,
                'status' => 1,
            ],
            [
                'name' => 'Kamal Hossain',
                'image' => 'frontend/images/chef_8.jpg',
                'designation' => 'Seafood Expert',
                'facebook' => 'https://facebook.com',
                'instagram' => 'https://instagram.com',
                'twitter' => 'https://twitter.com',
                'behance' => 'https://behance.net',
                'show_at_home' => 0,
                'status' => 1,
            ],
        ];

        foreach ($chefs as $chef) {
            Chef::updateOrCreate(['name' => $chef['name']], $chef);
        }
    }
}

