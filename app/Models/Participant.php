<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    protected $fillable = [
        'user_id',
        'festival_id',
        'tshirt_size',
        'needs_car_ticket',
        'arrival_date',
        'departure_date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function festival()
    {
        return $this->belongsTo(Festival::class);
    }

    public function workEntries()
    {
        return $this->hasMany(WorkEntry::class);
    }
}
