<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Report;
use App\Models\ReviewNote;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(Request $request, Report $report): RedirectResponse
    {
        $data = $request->validate([
            'note' => ['required', 'string', 'min:5'],
        ]);

        ReviewNote::create([
            'report_id' => $report->id,
            'user_id' => Auth::id(),
            'note' => $data['note'],
        ]);

        return redirect()
            ->route('reports.show', $report)
            ->with('success', 'Catatan berhasil disimpan.');
    }
}
