<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Structure extends Model
{
    protected $fillable = [
        'circle_id',
        'member_id',
        'position'
    ];

    public function circle()
    {
        return $this->belongsTo(Circle::class);
    }

    public function member()
    {
        // Penting: arahkan ke User
        return $this->belongsTo(User::class, 'member_id');
    }
}