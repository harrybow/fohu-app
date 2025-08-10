<?php

namespace App\Http\Controllers;

use App\Models\WorkEntry;
use Illuminate\Http\Request;
use Illuminate\View\View;

class WorkEntryController extends Controller
{
    /**
     * Display a listing of the work entries grouped by date and participant.
     *
     * @param  Request  $request
     */
    public function index(Request $request): View
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

