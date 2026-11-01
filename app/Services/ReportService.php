<?php

namespace App\Services;

use App\Models\Report;
use DomainException;
use Illuminate\Support\Facades\Storage;

class ReportService
{
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
}