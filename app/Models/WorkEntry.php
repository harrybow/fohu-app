<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class WorkEntry extends Model
{
    protected $fillable = [
        'participant_id',
        'phase_id',
        'work_date',
        'duration',
        'checked',
        'recorded',
    ];

    public function participant()
    {
        return $this->belongsTo(Participant::class);
    }

    public function phase()
    {
        return $this->belongsTo(Phase::class);
    }

    /**
     * Scope a query to only include entries within the given date range.
     *
     * @param  string|null  $start
     * @param  string|null  $end
     */
    public function scopeForDateRange(Builder $query, ?string $start = null, ?string $end = null): Builder
    {
        if ($start) {
            $query->whereDate('work_date', '>=', $start);
        }

        if ($end) {
            $query->whereDate('work_date', '<=', $end);
        }

        return $query;
    }

    /**
     * Scope a query to aggregate durations grouped by date and participant.
     */
    public function scopeGroupedByDateAndParticipant(Builder $query): Builder
    {
        return $query
            ->select('participant_id', 'work_date', DB::raw('SUM(duration) as total_duration'))
            ->groupBy('participant_id', 'work_date');
    }
}
