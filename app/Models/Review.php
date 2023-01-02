<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = ['text', 'rating', 'job_id', 'jobseeker_id'];

    public function job() {
        return $this->belongsTo(Job::class);
    }

    public function jobseeker() {
        return $this->belongsTo(JobSeeker::class);
    }
}
