<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Agenda extends Model
{
    use HasFactory;

    protected $fillable = [
        'created_by',
        'title',
        'date',
        'location',
        'description',
        'is_paid',
        'amount',
        'qris'
    ];

    protected $casts = [
        'date' => 'datetime'
    ];

    public function circle()
    {
        return $this->belongsTo(Circle::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function users()
    {
        return $this->belongsToMany(User::class)
                    ->withPivot('paid','payment_proof')
                    ->withTimestamps();
    }
}