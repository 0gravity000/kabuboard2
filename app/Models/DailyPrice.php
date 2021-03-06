<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyPrice extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function stock()
    {
        return $this->belongsTo('App\Models\Stock');
    }

    public function signal_daily_prices()
    {
        return $this->hasMany('App\Models\SignalDailyPrice');
    }    
}
