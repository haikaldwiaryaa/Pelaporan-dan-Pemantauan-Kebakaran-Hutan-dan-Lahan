<?php

namespace App\Services;

use App\Models\Report;

class ReportService
{
    public function create(array $data, int $userId): Report
    {
        $data['user_id'] = $userId;
        $data['status'] = 'baru';

        return Report::create($data);
    }
}