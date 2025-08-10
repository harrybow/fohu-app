<?php

namespace App\Http\Controllers;

use App\Models\WorkEntry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class WorkEntryController extends Controller
{
    /**
     * Show form to create a new work entry.
     */
    public function create(): View
    {
        $participant = Auth::user()->participants()->first();

        return view('work_entries.create', [
            'participant' => $participant,
        ]);
    }

    /**
     * Persist a new work entry.
     */
    public function store(Request $request): RedirectResponse
    {
        $participant = Auth::user()->participants()->first();
        $validated = $this->validateEntry($request);

        if ($participant) {
            $participant->update([
                'tshirt_size' => $validated['tshirt_size'],
                'needs_car_ticket' => $validated['needs_car_ticket'] ?? false,
                'arrival_date' => $validated['arrival_date'] ?? null,
                'departure_date' => $validated['departure_date'] ?? null,
            ]);

            $participant->workEntries()->create([
                'phase_id' => $request->input('phase_id', 1),
                'work_date' => $validated['work_date'],
                'duration' => $validated['duration'],
            ]);
        }

        return redirect()->route('work-entries.create')->with('status', 'work-entry-created');
    }

    /**
     * Show the form for editing a work entry.
     */
    public function edit(WorkEntry $workEntry): View
    {
        $participant = Auth::user()->participants()->first();

        return view('work_entries.edit', [
            'participant' => $participant,
            'workEntry' => $workEntry,
        ]);
    }

    /**
     * Update an existing work entry.
     */
    public function update(Request $request, WorkEntry $workEntry): RedirectResponse
    {
        $participant = Auth::user()->participants()->first();
        $validated = $this->validateEntry($request);

        if ($participant) {
            $participant->update([
                'tshirt_size' => $validated['tshirt_size'],
                'needs_car_ticket' => $validated['needs_car_ticket'] ?? false,
                'arrival_date' => $validated['arrival_date'] ?? null,
                'departure_date' => $validated['departure_date'] ?? null,
            ]);
        }

        $workEntry->update([
            'work_date' => $validated['work_date'],
            'duration' => $validated['duration'],
        ]);

        return redirect()->route('work-entries.edit', $workEntry)->with('status', 'work-entry-updated');
    }

    /**
     * Validate common fields.
     */
    protected function validateEntry(Request $request): array
    {
        return $request->validate([
            'work_date' => ['required', 'date'],
            'duration' => ['required', 'numeric', 'in:0.5,1,1.5,2'],
            'tshirt_size' => ['required', 'in:XS,S,M,L,XL,XXL'],
            'needs_car_ticket' => ['sometimes', 'boolean'],
            'arrival_date' => ['nullable', 'date'],
            'departure_date' => ['nullable', 'date', 'after_or_equal:arrival_date'],
        ]);
    }
}
