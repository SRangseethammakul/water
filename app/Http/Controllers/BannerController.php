<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Banner;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Image;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $banners = Banner::orderby('sort_order','asc')->get();
        return view('backend.banner.index',[
            'banners' => $banners
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('backend.banner.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $new_banner = new Banner();
        $new_banner->banner_name = $request->banner_name;
        $new_banner->is_publish = $request->banner_is_publish;
        $new_banner->banner_startdate = Carbon::createFromFormat('d/m/Y', $request->banner_startdate)->format('Y-m-d');
        $new_banner->banner_enddate = Carbon::createFromFormat('d/m/Y', $request->banner_enddate)->format('Y-m-d');
        $new_banner->banner_url = $request->banner_url;
        $new_banner->banner_description = $request->banner_description;
        if($request->hasFile('banner_image')){
            $newFileName    =   uniqid().'.'.$request->banner_image->extension();//gen name
            $image = $request->file('banner_image');
            $t = Storage::disk('do_spaces')->put('banners/'.$newFileName, file_get_contents($image));
            $new_banner->banner_image = $newFileName;
        }
        $new_banner->save();
        return "Add Banner Success";
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
