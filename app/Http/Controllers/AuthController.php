<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyStoreRequest;
use App\Models\JobSeeker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\JobSeekerStoreRequest;
use App\Models\Company;

class AuthController extends Controller
{
    public function login_jobseeker(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => 'required'
        ]);

        $jobSeeker = JobSeeker::firstWhere('email', $request->all()['email']);
        if (!$jobSeeker) {
            return response()->json([
                'success' => 'false',
                'message' => 'Email does not exists'
            ], 401);
        }

        if (!Hash::check($request->all()['password'], $jobSeeker->password)) {
            return response()->json([
                'success' => 'false',
                'message' => 'Incorrect password'
            ], 401);
        }

        return response()->json([
            'job_seeker' => $jobSeeker,
            'token' => $jobSeeker->createToken('token')->plainTextToken 
        ], 200);
    }

    public function register_jobseeker(JobSeekerStoreRequest $request) 
    {
        $request->validate([
            'email' => 'required|unique:job_seekers',
            'password' => 'required'
        ]);

        $jobSeeker = JobSeeker::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        return response()->json([
            'job_seeker' => $jobSeeker,
            'token' => $jobSeeker->createToken('token')->plainTextToken 
        ], 200);
    }

    public function login_company(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => 'required'
        ]);

        $company = Company::firstWhere('email', $request->all()['email']);
        if (!$company) {
            return response()->json([
                'success' => 'false',
                'message' => 'Email does not exists'
            ], 401);
        }

        if (!Hash::check($request->all()['password'], $company->password)) {
            return response()->json([
                'success' => 'false',
                'message' => 'Incorrect password'
            ], 401);
        }

        return response()->json([
            'data' => $company,
            'token' => $company->createToken('company-token')->plainTextToken 
        ], 200);
    }

    public function register_company(CompanyStoreRequest $request) 
    {
        $request->validate([
            'email' => 'required|unique:companies',
            'password' => 'required'
        ]);

        $company = Company::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        return response()->json([
            'data' => $company,
            'token' => $company->createToken('company-token')->plainTextToken 
        ], 200);
    }
}
