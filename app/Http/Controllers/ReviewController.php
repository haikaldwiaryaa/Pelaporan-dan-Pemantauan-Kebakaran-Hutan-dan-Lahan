<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Report;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use DomainException;
use App\Services\ReportService;


class ReviewController extends Controller
{
    public function store(Request $request, Report $report, ReportService $service): RedirectResponse
    {
        $data = $request->validate([
            'note' => ['required', 'string', 'min:5'],
            'status' => ['nullable', Rule::in(['ditinjau', 'perlu_diteruskan', 'selesai'])],
        ]);

        try {
            $service->review($report, $data, Auth::id());
        } catch (DomainException $e) {
            return back()
                ->withInput()
                ->withErrors(['status' => $e->getMessage()]);
        }

        return redirect()
            ->route('reports.show', $report)
            ->with('success', 'Catatan berhasil disimpan.');
    }
}
