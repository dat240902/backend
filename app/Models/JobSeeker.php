<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;

class JobSeeker extends Authenticatable
{
    use HasFactory, HasApiTokens;

    protected $fillable = [
        'name', 'email',
        'password', 'resume_url',
        'avatar_url', 'gender', 'status'
    ];

    protected $hidden = ['password', 'role'];

    public static function createEntry($data) {
        $data['password'] = Hash::make($data['password']);
        return JobSeeker::create($data);
    }
}
