<?php

namespace App\Http\Controllers;

use App\Models\ExternalParty;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Validation\Rule;

class ExternalPartyController extends Controller
{
    public function index(): View
    {
        $parties = ExternalParty::orderBy('name')->get();

        return view('external-parties.index', compact('parties'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:external_parties,name'],
            'contact' => ['nullable', 'string', 'max:50'],
        ]);

        ExternalParty::create($data);

        return redirect()
            ->route('external-parties.index')
            ->with('success', 'Pihak terkait berhasil ditambahkan.');
    }
    public function edit(ExternalParty $externalParty): View
    {
        return view('external-parties.edit', compact('externalParty'));
    }

    public function update(Request $request, ExternalParty $externalParty): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', Rule::unique('external_parties', 'name')->ignore($externalParty->id)],
            'contact' => ['nullable', 'string', 'max:50'],
        ]);

        $externalParty->update($data);

        return redirect()
            ->route('external-parties.index')
            ->with('success', 'Pihak terkait berhasil diubah.');
    }
}