<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $fillable = [
        'nick', 'password', 'points', 'cash', 'per_click_level', 'per_sec_level',
    ];

    protected $appends = [
        'per_click',
        'per_sec',
    ];

    public function getPerClickAttribute()
    {
        return Statistic::where('level', $this->per_click_level)->where('type', 'click')->first();
    }

    public function getPerSecAttribute()
    {
        return Statistic::where('level', $this->per_sec_level)->where('type', 'sec')->first();
    }

    public function increaseByClick()
    {
        $stat = Statistic::where('level', $this->per_click_level)
            ->where('type', 'click')
            ->first();

        $this->update([
            'points' => $this->points + $stat->value,
            'cash'   => $this->cash + $stat->value,
        ]);
    }

    public function increaseBySec()
    {
        $stat = Statistic::where('level', $this->per_sec_level)
            ->where('type', 'sec')
            ->first();

        $this->update([
            'points' => $this->points + $stat->value,
            'cash'   => $this->cash + $stat->value,
        ]);
    }

    public function canBuyStatistic($stat)
    {
        return $this->cash >= $stat->cost;
    }

    public function buy($stat)
    {
        $type = 'per_' . $stat->type . '_level';

        $this->update([
            "$type" => $stat->level,
            'cash'  => $this->cash - $stat->cost,
        ]);
    }
}
