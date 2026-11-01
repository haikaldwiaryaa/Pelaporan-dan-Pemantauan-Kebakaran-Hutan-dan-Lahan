<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $pelapor1 = User::firstOrCreate(
            ['username' => 'xall'],
            [
                'name' => 'Haikal',
                'password' => Hash::make('password'),
            ]
        );
        $pelapor1->role = 'pelapor';
        $pelapor1->save();

        $pelapor2 = User::firstOrCreate(
            ['username' => 'angpaboy'],
            [
                'name' => 'Daffa',
                'password' => Hash::make('password'),
            ]
        );
        $pelapor2->role = 'pelapor';
        $pelapor2->save();

        $relawan = User::firstOrCreate(
            ['username' => 'relawan1'],
            [
                'name' => 'Andi Relawan',
                'password' => Hash::make('password'),
            ]
        );
        $relawan->role = 'relawan';
        $relawan->save();

        $koordinator = User::firstOrCreate(
            ['username' => 'koordinator1'],
            [
                'name' => 'Rina Koordinator',
                'password' => Hash::make('password'),
            ]
        );
        $koordinator->role = 'koordinator';
        $koordinator->save();
    }
}