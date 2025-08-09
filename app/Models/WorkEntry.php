<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
}
