<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Statistic extends Model
{
    protected $fillable = [
        'value', 'cost', 'type', 'level',
    ];

    protected $appends = [
        'next_level', 'next_cost',
    ];

    public function getNextLevelAttribute()
    {
        if (!$stat = Statistic::where('level', $this->level + 1)->where('type', $this->type)->first()) {
            return 'MAX';
        }

        return $stat->value;
    }

    public function getNextCostAttribute()
    {
        if (!$stat = Statistic::where('level', $this->level + 1)->where('type', $this->type)->first()) {
            return 'MAX';
        }

        return $stat->cost;
    }
}
