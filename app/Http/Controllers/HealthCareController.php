<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Province;
use App\HealthCare;
use Carbon\Carbon;

class HealthCareController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return "HealthCareController Add";
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $provinces = Province::orderByRaw('convert (province_name using tis620) ASC') ->get();
        return view('backend.healthcare.add',[
            'provinces' => $provinces
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $new_healthcare = new HealthCare();
        $new_healthcare->user_id = auth()->user()->id;
        $new_healthcare->name = $request->healthcare_name;
        $new_healthcare->volume = $request->volume;
        $new_healthcare->created_date = Carbon::createFromFormat('d/m/Y', $request->banner_startdate)->format('Y-m-d');
        $new_healthcare->symptom = $request->symptom;
        $new_healthcare->timing = $request->runnumber;
        $new_healthcare->remark = $request->remark;
        $new_healthcare->hospital = $request->hospital;
        $new_healthcare->province_id = $request->province;
        $new_healthcare->save();
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
