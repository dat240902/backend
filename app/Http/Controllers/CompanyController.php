<?php

namespace App\Http\Controllers;

use App\Http\Middleware\RestrictAdminOnly;
use App\Http\Requests\CompanyStoreRequest;
use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:sanctum')->only(['store', 'destroy', 'update']);
        $this->middleware(RestrictAdminOnly::class)->only(['store', 'destroy']);    
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Company::with('images')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CompanyStoreRequest $request)
    {
        $data = $request->all();
        $company = Company::createEntry($data);
        return $company;
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $company = Company::findOrFail($id);
        return $company;
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
        if ($id != $request->user()->id) {
            return response()->json([
               'message' => 'Permission denied' 
            ], 401);
        }
        $company = Company::findOrFail($id);
        $company->update($request->all());
        return $company;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $company = Company::findOrFail($id);
        $company->delete();
        return response()->json(["success" => "true"], 204);
    }
}
