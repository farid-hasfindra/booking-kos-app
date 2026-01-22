<?php

namespace Database\Seeders;

use App\Models\LandingInfo;
use Illuminate\Database\Seeder;

class LandingInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        LandingInfo::create([
            'value' => '20+',
            'text' => 'Kamar Eksklusif',
        ]);

        LandingInfo::create([
            'value' => '24/7',
            'text' => 'Keamanan & CCTV',
        ]);

        LandingInfo::create([
            'value' => 'Full',
            'text' => 'Fasilitas Lengkap',
        ]);

        LandingInfo::create([
            'value' => '100%',
            'text' => 'Bebas Banjir',
        ]);
    }
}
