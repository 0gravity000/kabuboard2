<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SignalDailyVolume extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function signal()
    {
        return $this->belongsTo('App\Models\Signal');
    }

    public function daily_volume()
    {
        return $this->belongsTo('App\Models\DailyVolume');
    }
}
