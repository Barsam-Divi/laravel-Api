<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hall extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function seats()
    {
        return $this->belongsToMany(seat::class , 'hall_seat')
            ->withPivot(['seat_count','unit_cost']);
    }
}
