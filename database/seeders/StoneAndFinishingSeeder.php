<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StoneAndFinishingSeeder extends Seeder
{
    public function run(): void
    {
        // ── STONE TYPES ───────────────────────────────────────────
        $stones = [
            'Marmer Premium',
            'Granit Alam',
            'Batu Landscape',
            'Andesit',
            'Palimanan',
            'Batu Candi',
            'Batu Templek',
            'Paras Jogja',
        ];

        foreach ($stones as $name) {
            DB::table('stone_types')->insertOrIgnore([
                'name'         => $name,
                'is_available' => true,
                'created_at'   => now(),
                'updated_at'   => now(),
            ]);
        }

        // ── FINISHING TYPES ───────────────────────────────────────
        $finishings = [
            'Bakar',
            'Bush Hammer',
            'Poles',
            'Tekstur',
            'Sandblast',
            'Alur',
            'Natural',
        ];

        foreach ($finishings as $name) {
            DB::table('finishing_types')->insertOrIgnore([
                'name'         => $name,
                'is_available' => true,
                'created_at'   => now(),
                'updated_at'   => now(),
            ]);
        }

        $this->command->info('✅ Stone types & finishing types seeded.');
    }
}
