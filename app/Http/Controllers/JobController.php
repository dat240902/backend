<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class JobController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum')->only('getJobApplicant', 'store', 'createJob');    
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Job::with('company:id,name')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $company = $request->user();
        if ($company->id != $request->all()['company_id']) {
            return response()->json([
               'message' => 'Permission denied' 
            ], 401);
        }

        $data = $request->all();
        $job = Job::create($data);
        return $job;
    }

    /**
     * Company create new job
     *
     * @param  \Illuminate\Http\Request  $request
     * @param int $company_id
     * @return \Illuminate\Http\Response
     */
    public function createJob(Request $request, int $company_id)
    {
        $data = $request->all();

        if (!Gate::allows('create-post', $company_id)) {
            return response()->json([
               'message' => 'Permission denied' 
            ], 401);
        }

        $company = Company::findOrFail($company_id);
        $job = $company->jobs()->create($data);
        return $job;
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $job = Job::findOrFail($id);    //
        $job->load('company');
        $job->load('applications');
        return $job;
    }

    /**
     * Display the specified resource.
     *
     * @param  int $company_id
     * @return \Illuminate\Http\Response
     */
    public function showJobsInCompany(int $company_id)
    {
        $company = Company::findOrFail($company_id);
        return $company->jobs;
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
        $job = Job::findOrFail($id);
        $job->update($request->all());
        return $job;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $job = Job::findOrFail($id);
        $job->delete();
        return response()->json(["success" => "true"], 204);
    }

    public function getJobApplicant(Request $request, int $id) {
        $company = $request->user();
        $job = Job::findOrFail($id);    //
        $job->load('company');

        echo($job->company->id);
        if ($company->id != $job->company->id) {
            return response()->json([
               'message' => 'Permission denied' 
            ], 401);
        }

        $job->load('applications.jobseeker');
        return $job;
    }
}
