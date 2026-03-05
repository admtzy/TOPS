<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function agendas()
    {
        return $this->belongsToMany(Agenda::class)
                    ->withPivot('paid')
                    ->withTimestamps();
    }

    public function memories()
    {
        return $this->hasMany(Memory::class);
    }

    public function memberProfile()
    {
        return $this->hasOne(MemberProfile::class);
    }

    public function isAdmin() { return $this->role === 'admin'; }
    public function isMember() { return $this->role === 'member'; }
}