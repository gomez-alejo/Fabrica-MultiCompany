<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'username',
        'name',
        'password',
        'company_id',
    ];

    public function requests() {
        return $this->hasMany(Requestt::class);
    }
    public function company() {
        return $this->belongsTo(Company::class);
    }
}
