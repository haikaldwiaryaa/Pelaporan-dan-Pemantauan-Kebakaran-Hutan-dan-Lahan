<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Services\ReportService;
use DomainException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ForwardingController extends Controller
{
    public function store(Request $request, Report $report, ReportService $service): RedirectResponse
    {
        $data = $request->validate([
            'external_party_id' => ['required', 'exists:external_parties,id'],
            'note' => ['nullable', 'string', 'max:255'],
        ]);

        try {
            $service->forward($report, $data, Auth::id());
        } catch (DomainException $e) {
            return back()
                ->withInput()
                ->withErrors(['external_party_id' => $e->getMessage()]);
        }

        return redirect()
            ->route('reports.show', $report)
            ->with('success', 'Penerusan berhasil dicatat.');
    }
}