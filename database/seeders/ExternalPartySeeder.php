<?php

namespace Database\Seeders;

use App\Models\ExternalParty;
use Illuminate\Database\Seeder;

class ExternalPartySeeder extends Seeder
{
    public function run(): void
    {
        $parties = [
            ['name' => 'BPBD Kabupaten', 'contact' => '0812-0000-0001'],
            ['name' => 'Manggala Agni', 'contact' => '0812-0000-0002'],
            ['name' => 'Kantor Desa', 'contact' => '0812-0000-0003'],
        ];

        foreach ($parties as $item) {
            ExternalParty::firstOrCreate(['name' => $item['name']], $item);
        }
    }
}