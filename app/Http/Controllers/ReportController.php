<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReportRequest;
use App\Models\Report;
use App\Services\ReportService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ReportController extends Controller
{
    public function create(): View
    {
        $areas = Report::AREAS;
        $conditionLevels = Report::CONDITION_LEVELS;

        return view('reports.create', compact('areas', 'conditionLevels'));
    }

    public function store(StoreReportRequest $request, ReportService $service): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('evidence')) {
            $data['evidence_path'] = $request->file('evidence')->store('evidence', 'public');
        }

        $service->create($data, Auth::id());

        return redirect()
            ->route('dashboard')
            ->with('success', 'Laporan berhasil dikirim.');
    }
}