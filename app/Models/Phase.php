<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Phase extends Model
{
    protected $fillable = [
        'festival_id',
        'name',
        'start_date',
        'end_date',
    ];

    public function festival()
    {
        return $this->belongsTo(Festival::class);
    }

    public function workEntries()
    {
        return $this->hasMany(WorkEntry::class);
    }
}
