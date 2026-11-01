<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class RecapController extends Controller
{
    public function index(Request $request): View
    {
        $request->validate([
            'area' => ['nullable', Rule::in(Report::AREAS)],
        ]);

        $area = $request->query('area');
        $areaOptions = Report::AREAS;
        $statuses = Report::STATUSES;
        $selectedAreas = $area ? [$area] : Report::AREAS;

        $rows = [];
        foreach ($selectedAreas as $item) {
            $row = ['area' => $item, 'total' => 0];

            foreach ($statuses as $status) {
                $row[$status] = Report::where('area', $item)->where('status', $status)->count();
                $row['total'] += $row[$status];
            }

            $rows[] = $row;
        }

        $total = 0;
        $done = 0;
        foreach ($rows as $row) {
            $total += $row['total'];
            $done += $row['selesai'];
        }
        $active = $total - $done;

        return view('recap.index', compact('rows', 'statuses', 'areaOptions', 'area', 'total', 'active', 'done'));
    }
}