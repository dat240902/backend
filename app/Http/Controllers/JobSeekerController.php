<?php

namespace App\Http\Controllers;

use App\Http\Middleware\RestrictAdminOnly;
use App\Http\Requests\JobSeekerStoreRequest;
use App\Models\JobSeeker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class JobSeekerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum')->only(['index', 'show', 'destroy', 'update']);
        $this->middleware(RestrictAdminOnly::class)->only('index');    
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return JobSeeker::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\JobSeekerStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(JobSeekerStoreRequest $request)
    {
        $data = $request->all();
        $jobSeeker = JobSeeker::createEntry($data);
        return $jobSeeker;
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $jobSeeker = JobSeeker::findOrFail($id);
        return $jobSeeker;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
        $jobSeeker = JobSeeker::findOrFail($id);
        $jobSeeker->update($request->all());
        return $jobSeeker;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $jobSeeker = JobSeeker::findOrFail($id);
        $jobSeeker->delete();
        return response()->json(["success" => "true"], 204);
    }
}
