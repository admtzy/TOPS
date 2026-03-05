<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Circle extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'logo',
        'description',
        'created_by'
    ];

    public function agendas()
    {
        return $this->hasMany(Agenda::class);
    }
    public function structures()
    {
        return $this->hasMany(Structure::class);
    }
}