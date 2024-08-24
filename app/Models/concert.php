<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class concert extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $casts = [
        'started_at' => 'datetime',
        'end_at' => 'datetime'
    ];

    public function artist()
    {
        return $this->belongsTo(Artist::class);
    }

    public function hall()
    {
        return $this->belongsTo(Hall::class);
    }
}
