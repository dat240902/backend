<?php

use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\CompanyImageController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\JobSeekerController;
use App\Http\Controllers\ReviewController;
use App\Models\CompanyImage;
use App\Models\JobSeeker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('auth/js/login', [AuthController::class, 'login_jobseeker']);
Route::post('auth/js/register', [AuthController::class, 'register_jobseeker']);
Route::post('auth/companies/login', [AuthController::class, 'login_company']);
Route::post('auth/companies/register', [AuthController::class, 'register_company']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('jobseekers', JobSeekerController::class);
Route::apiResource('companies', CompanyController::class);
Route::apiResource('jobs', JobController::class);
Route::apiResource('reviews', ReviewController::class);
Route::apiResource('images', CompanyImageController::class);
Route::apiResource('applications', ApplicationController::class);

Route::post('companies/{company_id}/jobs/', [JobController::class, 'createJob']);

Route::get('companies/{company_id}/jobs/', [JobController::class, 'showJobsInCompany']);

Route::get('jobs/{id}/applications', [JobController::class, 'getJobApplicant']);
