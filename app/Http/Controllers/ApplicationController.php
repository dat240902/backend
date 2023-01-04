<?php

namespace App\Http\Controllers;

use App\Http\Middleware\RestrictAdminOnly;
use App\Http\Requests\ApplicationStoreRequest;
use App\Models\Application;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum')->only(['index', 'store', 'show', 'destroy']);    
        
        $this->middleware(RestrictAdminOnly::class)->only(['index']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Application::with(['jobseeker', 'job'])->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ApplicationStoreRequest $request)
    {
        $data = $request->all();
        if ($request->user()->id != $data['jobseeker_id']) {
            return response()->json([
               'message' => 'Permission denied' 
            ], 401);
        }

        $application = Application::firstOrNew([
            'jobseeker_id' => $data['jobseeker_id'],
            'job_id' => $data['job_id']
        ]);

        $application->update($data);
        $application->save();
        return $application;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Application  $application
     * @return \Illuminate\Http\Response
     */
    public function show(Application $application)
    {
        return $application::with(['jobseeker', 'job'])->get();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Application  $application
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Application $application)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Application  $application
     * @return \Illuminate\Http\Response
     */
    public function destroy(Application $application)
    {
        $application->delete();
    }
}
