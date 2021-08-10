<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function market()
    {
        return $this->belongsTo('App\Market');
    }

    public function industry()
    {
        return $this->belongsTo('App\Industry');
    }    

    public function daily_prices()
    {
        return $this->hasMany('App\DailyPrice');
    }    
}
