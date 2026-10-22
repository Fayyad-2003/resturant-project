<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DeliveryAreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('upazilas')->truncate();
        DB::table('districts')->truncate();
        DB::table('divisions')->truncate();

        // ----------------------------------------------------
        // 1. محافظة دمشق (Damascus)
        // ----------------------------------------------------
        $divDamascus = DB::table('divisions')->insertGetId([
            'name'         => 'Damascus',
            'bn_name'      => 'مدينة دمشق',
            'status'       => '1',
            'delivery_fee' => '10', // تكلفة التوصيل داخل دمشق
            'created_at'   => now(),
            'updated_at'   => now(),
        ]);

        // مناطق دمشق (Districts)
        $distOldCity = DB::table('districts')->insertGetId([
            'division_id' => $divDamascus,
            'name'        => 'Old City',
            'bn_name'     => 'دمشق القديمة',
            'status'      => '1',
            'created_at'  => now(),
            'updated_at'  => now(),
        ]);

        $distCenter = DB::table('districts')->insertGetId([
            'division_id' => $divDamascus,
            'name'        => 'Central Damascus',
            'bn_name'     => 'وسط دمشق',
            'status'      => '1',
            'created_at'  => now(),
            'updated_at'  => now(),
        ]);

        $distWest = DB::table('districts')->insertGetId([
            'division_id' => $divDamascus,
            'name'        => 'West Damascus',
            'bn_name'     => 'غرب دمشق',
            'status'      => '1',
            'created_at'  => now(),
            'updated_at'  => now(),
        ]);

        // أحياء دمشق (Upazilas / Neighborhoods)
        DB::table('upazilas')->insert([
            // دمشق القديمة
            ['district_id' => $distOldCity, 'name' => 'Bab Touma', 'bn_name' => 'باب توما', 'status' => '1', 'created_at' => now(), 'updated_at' => now()],
            ['district_id' => $distOldCity, 'name' => 'Al-Qimariyah', 'bn_name' => 'القيمرية', 'status' => '1', 'created_at' => now(), 'updated_at' => now()],
            ['district_id' => $distOldCity, 'name' => 'Bab Sharqi', 'bn_name' => 'باب شرقي', 'status' => '1', 'created_at' => now(), 'updated_at' => now()],
            ['district_id' => $distOldCity, 'name' => 'Al-Midan', 'bn_name' => 'الميدان', 'status' => '1', 'created_at' => now(), 'updated_at' => now()],

            // وسط دمشق
            ['district_id' => $distCenter, 'name' => 'Al-Shaalan', 'bn_name' => 'الشعلان', 'status' => '1', 'created_at' => now(), 'updated_at' => now()],
            ['district_id' => $distCenter, 'name' => 'Abu Rummaneh', 'bn_name' => 'أبو رمانة', 'status' => '1', 'created_at' => now(), 'updated_at' => now()],
            ['district_id' => $distCenter, 'name' => 'Al-Malki', 'bn_name' => 'المالكي', 'status' => '1', 'created_at' => now(), 'updated_at' => now()],
            ['district_id' => $distCenter, 'name' => 'Al-Qasaa', 'bn_name' => 'القصاع', 'status' => '1', 'created_at' => now(), 'updated_at' => now()],

            // غرب دمشق
            ['district_id' => $distWest, 'name' => 'Mezzeh Autostrad', 'bn_name' => 'المزة أوتوستراد', 'status' => '1', 'created_at' => now(), 'updated_at' => now()],
            ['district_id' => $distWest, 'name' => 'Mezzeh Villas', 'bn_name' => 'المزة فيلات', 'status' => '1', 'created_at' => now(), 'updated_at' => now()],
            ['district_id' => $distWest, 'name' => 'Kafr Sousa', 'bn_name' => 'كفرسوسة', 'status' => '1', 'created_at' => now(), 'updated_at' => now()],
            ['district_id' => $distWest, 'name' => 'Dummar Project', 'bn_name' => 'مشروع دمر', 'status' => '1', 'created_at' => now(), 'updated_at' => now()],
        ]);

        // ----------------------------------------------------
        // 2. محافظة ريف دمشق (Rural Damascus)
        // ----------------------------------------------------
        $divRural = DB::table('divisions')->insertGetId([
            'name'         => 'Rural Damascus',
            'bn_name'      => 'ريف دمشق',
            'status'       => '1',
            'delivery_fee' => '15', // تكلفة التوصيل لريف دمشق
            'created_at'   => now(),
            'updated_at'   => now(),
        ]);

        // مناطق ريف دمشق (Districts)
        $distSouthSuburbs = DB::table('districts')->insertGetId([
            'division_id' => $divRural,
            'name'        => 'South Suburbs',
            'bn_name'     => 'الضواحي الجنوبية',
            'status'      => '1',
            'created_at'  => now(),
            'updated_at'  => now(),
        ]);

        $distWestSuburbs = DB::table('districts')->insertGetId([
            'division_id' => $divRural,
            'name'        => 'West Suburbs',
            'bn_name'     => 'الضواحي الغربية',
            'status'      => '1',
            'created_at'  => now(),
            'updated_at'  => now(),
        ]);

        // أحياء ريف دمشق (Upazilas / Neighborhoods)
        DB::table('upazilas')->insert([
            // الضواحي الجنوبية
            ['district_id' => $distSouthSuburbs, 'name' => 'Jaramana', 'bn_name' => 'جرمانا', 'status' => '1', 'created_at' => now(), 'updated_at' => now()],
            ['district_id' => $distSouthSuburbs, 'name' => 'Sahnaya', 'bn_name' => 'صحنايا', 'status' => '1', 'created_at' => now(), 'updated_at' => now()],
            ['district_id' => $distSouthSuburbs, 'name' => 'Ashrafiyat Sahnaya', 'bn_name' => 'أشرفية صحنايا', 'status' => '1', 'created_at' => now(), 'updated_at' => now()],
            ['district_id' => $distSouthSuburbs, 'name' => 'Sayyidah Zaynab', 'bn_name' => 'السيدة زينب', 'status' => '1', 'created_at' => now(), 'updated_at' => now()],

            // الضواحي الغربية
            ['district_id' => $distWestSuburbs, 'name' => 'Qudsaya', 'bn_name' => 'قدسيا', 'status' => '1', 'created_at' => now(), 'updated_at' => now()],
            ['district_id' => $distWestSuburbs, 'name' => 'Dahiyat Qudsaya', 'bn_name' => 'ضاحية قدسيا', 'status' => '1', 'created_at' => now(), 'updated_at' => now()],
            ['district_id' => $distWestSuburbs, 'name' => 'Al-Sabboura', 'bn_name' => 'الصبورة', 'status' => '1', 'created_at' => now(), 'updated_at' => now()],
            ['district_id' => $distWestSuburbs, 'name' => 'Yaafour', 'bn_name' => 'يعفور', 'status' => '1', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
