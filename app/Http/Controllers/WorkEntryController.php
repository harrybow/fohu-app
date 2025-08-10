<?php

namespace App\Http\Controllers;

use App\Models\WorkEntry;
use Illuminate\Http\Request;

class WorkEntryController extends Controller
{
    /**
     * Display a listing of the work entries grouped by date and participant.
     */
    public function index(Request $request)
    {
        $start = $request->query('start');
        $end = $request->query('end');

        $entriesByDate = WorkEntry::with('participant.user')
            ->forDateRange($start, $end)
            ->groupedByDateAndParticipant()
            ->get()
            ->groupBy('work_date');

        $totalDuration = WorkEntry::forDateRange($start, $end)->sum('duration');

        return view('work_entries.index', [
            'entriesByDate' => $entriesByDate,
            'totalDuration' => $totalDuration,
            'start' => $start,
            'end' => $end,
        ]);
    }
}

