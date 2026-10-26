<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $testimonials = [
            [
                'image' => 'frontend/images/client_img_1.jpg',
                'name' => 'Sarah Johnson',
                'designation' => 'Food Blogger',
                'details' => 'The food quality and customer service here are unmatched. Every dish is seasoned to perfection, and the ambiance makes you feel right at home.',
                'rating' => 5,
                'status' => 1,
            ],
            [
                'image' => 'frontend/images/client_img_3.jpg',
                'name' => 'David Miller',
                'designation' => 'Executive Chef',
                'details' => 'As a chef myself, I truly respect the authenticity and fresh ingredients they use. The burgers and pasta are absolutely world-class!',
                'rating' => 5,
                'status' => 1,
            ],
            [
                'image' => 'frontend/images/client_img_1.jpg',
                'name' => 'Emily Watson',
                'designation' => 'Regular Customer',
                'details' => 'Super fast delivery and the packaging keeps everything hot and crispy. The online table reservation was so easy and smooth.',
                'rating' => 5,
                'status' => 1,
            ],
        ];

        foreach ($testimonials as $item) {
            Testimonial::updateOrCreate(['name' => $item['name']], $item);
        }
    }
}

