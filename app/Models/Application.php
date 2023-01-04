<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    protected $table = 'applications';

    protected $fillable = ['job_id', 'jobseeker_id', 'educations', 'experiences', 'skills', 'qualifications'];

    public function jobseeker() {
        return $this->belongsTo(JobSeeker::class, 'jobseeker_id');
    }

    public function job() {
        return $this->belongsTo(Job::class, 'job_id');
    }
}
