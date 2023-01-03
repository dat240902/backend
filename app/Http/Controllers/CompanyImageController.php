<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyImageStoreRequest;
use App\Models\CompanyImage;
use Illuminate\Http\Request;

class CompanyImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return CompanyImage::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CompanyImageStoreRequest $request)
    {
        $data = $request->all();
        $companyImage = CompanyImage::create($data);
        return $companyImage;
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $companyImage = CompanyImage::findOrFail($id);
        return $companyImage;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CompanyImage  $companyImage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
        $companyImage = CompanyImage::findOrFail($id);
        $companyImage->update($request->all());
        return $companyImage;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $companyImage = CompanyImage::findOrFail($id);
        $companyImage->delete();
        return response()->json(["success" => "true"], 204);
    }
}
