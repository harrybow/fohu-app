<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Festival;
use App\Models\Phase;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PhaseController extends Controller
{
    public function index(): View
    {
        $phases = Phase::with('festival')->get();

        return view('admin.phases.index', compact('phases'));
    }

    public function create(): View
    {
        $festivals = Festival::all();

        return view('admin.phases.create', compact('festivals'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'festival_id' => ['required', 'exists:festivals,id'],
            'name' => ['required', 'string'],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date'],
        ]);

        Phase::create($data);

        return redirect()->route('admin.phases.index');
    }

    public function show(Phase $phase): View
    {
        return view('admin.phases.show', compact('phase'));
    }

    public function edit(Phase $phase): View
    {
        $festivals = Festival::all();

        return view('admin.phases.edit', compact('phase', 'festivals'));
    }

    public function update(Request $request, Phase $phase): RedirectResponse
    {
        $data = $request->validate([
            'festival_id' => ['required', 'exists:festivals,id'],
            'name' => ['required', 'string'],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date'],
        ]);

        $phase->update($data);

        return redirect()->route('admin.phases.index');
    }

    public function destroy(Phase $phase): RedirectResponse
    {
        $phase->delete();

        return redirect()->route('admin.phases.index');
    }
}
