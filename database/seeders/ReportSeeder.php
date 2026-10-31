<?php

namespace Database\Seeders;

use App\Models\ExternalParty;
use App\Models\Forwarding;
use App\Models\Report;
use App\Models\ReviewNote;
use App\Models\User;
use Illuminate\Database\Seeder;

class ReportSeeder extends Seeder
{
    public function run(): void
    {
        $pelapor1 = User::where('username', 'pelapor1')->first();
        $pelapor2 = User::where('username', 'pelapor2')->first();
        $relawan = User::where('username', 'relawan1')->first();
        $koordinator = User::where('username', 'koordinator1')->first();

        $bpbd = ExternalParty::where('name', 'BPBD Kabupaten')->first();
        $manggala = ExternalParty::where('name', 'Manggala Agni')->first();

        Report::create([
            'user_id' => $pelapor1->id,
            'description' => 'Terlihat asap tipis dari arah kebun warga di pinggir jalan desa.',
            'condition_level' => 'asap_tipis',
            'incident_at' => '2026-10-28 15:30:00',
            'area' => 'Kampar',
            'location_detail' => 'Dekat jembatan desa',
            'latitude' => 0.3301000,
            'longitude' => 101.0412000,
            'status' => 'baru',
        ]);

        Report::create([
            'user_id' => $pelapor2->id,
            'description' => 'Asap cukup tebal dari lahan kosong, bau terbakar tercium sampai jalan.',
            'condition_level' => 'asap_tebal',
            'incident_at' => '2026-10-29 10:00:00',
            'area' => 'Siak',
            'location_detail' => 'Belakang sekolah dasar',
            'latitude' => 0.8012000,
            'longitude' => 102.0511000,
            'status' => 'baru',
        ]);

        $report3 = Report::create([
            'user_id' => $pelapor1->id,
            'description' => 'Asap tebal dari arah perkebunan, belum terlihat api.',
            'condition_level' => 'asap_tebal',
            'incident_at' => '2026-10-26 13:00:00',
            'area' => 'Pelalawan',
            'location_detail' => 'Jalan menuju kebun sawit',
            'latitude' => 0.2105000,
            'longitude' => 101.9203000,
            'status' => 'ditinjau',
        ]);

        ReviewNote::create([
            'report_id' => $report3->id,
            'user_id' => $relawan->id,
            'note' => 'Data lokasi dan bukti sesuai, masih dipantau.',
        ]);

        $report4 = Report::create([
            'user_id' => $pelapor2->id,
            'description' => 'Api terlihat di lahan gambut, asap menyebar ke pemukiman.',
            'condition_level' => 'api_terlihat',
            'incident_at' => '2026-10-27 16:45:00',
            'area' => 'Kampar',
            'location_detail' => 'Sebelah barat kantor desa',
            'latitude' => 0.3520000,
            'longitude' => 101.0805000,
            'status' => 'perlu_diteruskan',
        ]);

        ReviewNote::create([
            'report_id' => $report4->id,
            'user_id' => $relawan->id,
            'note' => 'Api terlihat jelas di foto, perlu diteruskan ke pihak terkait.',
        ]);

        $report5 = Report::create([
            'user_id' => $pelapor1->id,
            'description' => 'Api kecil terlihat di semak dekat kanal.',
            'condition_level' => 'api_terlihat',
            'incident_at' => '2026-10-24 11:20:00',
            'area' => 'Bengkalis',
            'location_detail' => 'Pinggir kanal',
            'latitude' => 1.4702000,
            'longitude' => 102.1104000,
            'status' => 'diteruskan',
        ]);

        ReviewNote::create([
            'report_id' => $report5->id,
            'user_id' => $relawan->id,
            'note' => 'Lokasi dekat kanal, perlu diteruskan.',
        ]);

        Forwarding::create([
            'report_id' => $report5->id,
            'external_party_id' => $bpbd->id,
            'user_id' => $koordinator->id,
            'forwarded_at' => '2026-10-24 14:00:00',
            'note' => 'Diteruskan lewat telepon.',
        ]);

        $report6 = Report::create([
            'user_id' => $pelapor2->id,
            'description' => 'Asap tebal dari lahan bekas tebangan.',
            'condition_level' => 'asap_tebal',
            'incident_at' => '2026-10-20 09:15:00',
            'area' => 'Indragiri Hulu',
            'location_detail' => 'Dekat pos ronda',
            'latitude' => -0.3501000,
            'longitude' => 102.3207000,
            'status' => 'selesai',
        ]);

        ReviewNote::create([
            'report_id' => $report6->id,
            'user_id' => $relawan->id,
            'note' => 'Asap terlihat dari beberapa titik, perlu diteruskan.',
        ]);

        Forwarding::create([
            'report_id' => $report6->id,
            'external_party_id' => $manggala->id,
            'user_id' => $koordinator->id,
            'forwarded_at' => '2026-10-20 13:00:00',
            'note' => null,
        ]);

        ReviewNote::create([
            'report_id' => $report6->id,
            'user_id' => $relawan->id,
            'note' => 'Sudah ditangani pihak terkait, proses di aplikasi selesai.',
        ]);

        $report7 = Report::create([
            'user_id' => $pelapor1->id,
            'description' => 'Asap tipis dari pembakaran sampah rumah tangga.',
            'condition_level' => 'asap_tipis',
            'incident_at' => '2026-10-22 17:00:00',
            'area' => 'Siak',
            'location_detail' => null,
            'latitude' => 0.7804000,
            'longitude' => 102.0302000,
            'status' => 'selesai',
        ]);

        ReviewNote::create([
            'report_id' => $report7->id,
            'user_id' => $relawan->id,
            'note' => 'Hanya pembakaran sampah kecil, tidak perlu diteruskan.',
        ]);
    }
}