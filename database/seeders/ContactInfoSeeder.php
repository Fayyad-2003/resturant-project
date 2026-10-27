<?php

namespace Database\Seeders;

use App\Models\ContactInfo;
use Illuminate\Database\Seeder;

class ContactInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $infos = [
            [
                'icon' => 'fal fa-phone-alt',
                'title' => 'Call Us',
                'info_1' => '+123 456 7890',
                'info_2' => '+123 456 7899',
                'status' => true,
            ],
            [
                'icon' => 'fal fa-envelope',
                'title' => 'Email Us',
                'info_1' => 'support@foodpark.com',
                'info_2' => 'info@foodpark.com',
                'status' => true,
            ],
            [
                'icon' => 'fal fa-map-marker-alt',
                'title' => 'Location',
                'info_1' => '7232 Broadway Suite 308,',
                'info_2' => 'Jackson Heights, NY 11372',
                'status' => true,
            ],
        ];

        foreach ($infos as $info) {
            ContactInfo::updateOrCreate(['title' => $info['title']], $info);
        }
    }
}

