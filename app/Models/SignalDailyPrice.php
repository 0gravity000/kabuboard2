<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SignalDailyPrice extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function signal()
    {
        return $this->belongsTo('App\Models\Signal');
    }

    public function daily_price()
    {
        return $this->belongsTo('App\Models\DailyPrice');
    }
}
