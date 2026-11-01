<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReportRequest;
use App\Models\Report;
use App\Services\ReportService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Http\Requests\UpdateReportRequest;
use Illuminate\Support\Facades\Storage;

class ReportController extends Controller
{
    public function index(): View
    {
        $user = Auth::user();

        $reports = Report::query()
            ->with('user')
            ->when($user->role === 'pelapor', function ($q) use ($user) {
                $q->where('user_id', $user->id);
            })
            ->orderBy('incident_at', 'desc')
            ->paginate(10);

        return view('reports.index', compact('reports'));
    }
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
            ->route('reports.index')
            ->with('success', 'Laporan berhasil dikirim.');
    }
    public function show(Report $report): View
    {
        $user = Auth::user();

        if ($user->role === 'pelapor') {
            abort_unless($report->user_id === $user->id, 403);
        }

        return view('reports.show', compact('report'));
    }
    public function edit(Report $report): View
    {
        abort_unless($report->user_id === Auth::id(), 403);

        $areas = Report::AREAS;
        $conditionLevels = Report::CONDITION_LEVELS;

        return view('reports.edit', compact('report', 'areas', 'conditionLevels'));
    }

    public function update(UpdateReportRequest $request, Report $report): RedirectResponse
    {
        abort_unless($report->user_id === Auth::id(), 403);

        $data = $request->validated();

        if ($request->hasFile('evidence')) {
            if ($report->evidence_path) {
                Storage::disk('public')->delete($report->evidence_path);
            }
            $data['evidence_path'] = $request->file('evidence')->store('evidence', 'public');
        }

        $report->update($data);

        return redirect()
            ->route('reports.show', $report)
            ->with('success', 'Laporan berhasil diubah.');
    }
}