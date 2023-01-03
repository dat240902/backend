<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class Company extends Authenticatable
{
    use HasFactory, HasApiTokens;

    protected $fillable = [
        'name', 'email',
        'password', 'description',
        'address', 'major', 'status'
    ];

    protected $hidden = ['password'];

    // relationships
    public function jobs() {
        return $this->hasMany(Job::class);
    }

    public function images() {
        return $this->hasMany(CompanyImage::class);
    }

    public function applications() {
        return $this->hasMany(Application::class);
    }

    public static function createEntry($data) {
        $data['password'] = Hash::make($data['password']);
        return Company::create($data);
    }
}
