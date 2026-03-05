<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MemberProfile extends Model
{
    use HasFactory;
    protected $fillable = ['name','photo','description','user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}