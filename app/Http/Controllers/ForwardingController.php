<?php

namespace App\Http\Controllers;

use App\Models\Forwarding;
use App\Models\Report;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ForwardingController extends Controller
{
    public function store(Request $request, Report $report): RedirectResponse
    {
        $data = $request->validate([
            'external_party_id' => ['required', 'exists:external_parties,id'],
            'note' => ['nullable', 'string', 'max:255'],
        ]);

        Forwarding::create([
            'report_id' => $report->id,
            'external_party_id' => $data['external_party_id'],
            'user_id' => Auth::id(),
            'forwarded_at' => now(),
            'note' => $data['note'],
        ]);

        return redirect()
            ->route('reports.show', $report)
            ->with('success', 'Penerusan berhasil dicatat.');
    }
}