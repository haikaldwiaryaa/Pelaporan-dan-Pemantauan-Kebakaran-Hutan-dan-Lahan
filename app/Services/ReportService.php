<?php

namespace App\Services;
use App\Models\ReviewNote;
use Illuminate\Support\Facades\DB;
use App\Models\Report;
use DomainException;
use Illuminate\Support\Facades\Storage;
use App\Models\Forwarding;

class ReportService
{
    private const TRANSITIONS = [
        'baru' => ['ditinjau'],
        'ditinjau' => ['perlu_diteruskan', 'selesai'],
        'perlu_diteruskan' => [],
        'diteruskan' => ['selesai'],
        'selesai' => [],
    ];
    public function create(array $data, int $userId): Report
    {
        $data['user_id'] = $userId;
        $data['status'] = 'baru';

        return Report::create($data);
    }
    public function update(Report $report, array $data): Report
    {
        if ($report->status !== 'baru') {
            throw new DomainException('Laporan sudah ditinjau dan tidak dapat diubah lagi.');
        }

        if (isset($data['evidence'])) {
            if ($report->evidence_path) {
                Storage::disk('public')->delete($report->evidence_path);
            }
            $data['evidence_path'] = $data['evidence']->store('evidence', 'public');
        }

        $report->update($data);

        return $report;
    }
    public function review(Report $report, array $data, int $userId): void
    {
        if ($report->status === 'selesai') {
            throw new DomainException('Laporan sudah selesai dan tidak dapat diberi catatan lagi.');
        }
        $newStatus = $data['status'] ?? null;

        if ($newStatus) {
            $allowed = self::TRANSITIONS[$report->status] ?? [];

            if (!in_array($newStatus, $allowed, true)) {
                throw new DomainException("Status tidak bisa diubah dari {$report->status} ke {$newStatus}.");
            }
        }

        DB::transaction(function () use ($report, $data, $userId, $newStatus) {
            ReviewNote::create([
                'report_id' => $report->id,
                'user_id' => $userId,
                'note' => $data['note'],
            ]);

            if ($newStatus) {
                $report->update(['status' => $newStatus]);
            }
        });
    }
    public function forward(Report $report, array $data, int $userId): void
    {
        if ($report->status !== 'perlu_diteruskan') {
            throw new DomainException('Laporan hanya bisa diteruskan kalau statusnya perlu_diteruskan.');
        }

        DB::transaction(function () use ($report, $data, $userId) {
            Forwarding::create([
                'report_id' => $report->id,
                'external_party_id' => $data['external_party_id'],
                'user_id' => $userId,
                'forwarded_at' => now(),
                'note' => $data['note'] ?? null,
            ]);

            $report->update(['status' => 'diteruskan']);
        });
    }
}