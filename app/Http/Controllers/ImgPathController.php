<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests\StoreImg_pathRequest;
use App\Http\Requests\UpdateImg_pathRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use App\Models\Img_path;
use Carbon\Carbon;


class ImgPathController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $file_name = $request->image->getClientOriginalName();
        $todayDate = Carbon::now();
        $folder = $todayDate->format('U'); // UNIXタイム

        //保存先
        $directoryPath = 'public/image/'.$folder;
        $imgSrcPath = 'image/'.$folder;
        //フォルダ作成
        if (!Storage::exists($directoryPath)) {
            Storage::makeDirectory($directoryPath);
        }
        //保存
        $file_name = $directoryPath.'/'.$file_name;
        $img = $request->image->storeAs('public', $file_name ); //storage/image/1698132385/seobu.jpeg

        Img_path::create(['img_path' => $file_name]);
        //return view('adminlte.create',compact('file_name'));
        //return redirect()->route('create')->with(['file_name' => $file_name]);
        return back()->withInput();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreImg_pathRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreImg_pathRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Img_path  $img_path
     * @return \Illuminate\Http\Response
     */
    public function show(Img_path $img_path)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Img_path  $img_path
     * @return \Illuminate\Http\Response
     */
    public function edit(Img_path $img_path)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateImg_pathRequest  $request
     * @param  \App\Models\Img_path  $img_path
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateImg_pathRequest $request, Img_path $img_path)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Img_path  $img_path
     * @return \Illuminate\Http\Response
     */
    public function destroy(Img_path $img_path)
    {
        //
    }
    /**
     * 画面保存
     */
    public function add_image(Request $request)
    {
        $file_name = $request->image->getClientOriginalName();
        $todayDate = Carbon::now();
        $folder = $todayDate->format('U'); // UNIXタイム

        //保存先
        $directoryPath = 'public/image/'.$folder;
        $imgSrcPath = 'image/'.$folder;
        //フォルダ作成
        if (!Storage::exists($directoryPath)) {
            Storage::makeDirectory($directoryPath);
        }
        //保存
        $file_name = $directoryPath.'/'.$file_name;
        $img = $request->image->storeAs('public', $file_name ); //storage/image/1698132385/seobu.jpeg

        Img_path::create(['img_path' => $file_name]);
        return view('adminlte.create',compact('file_name'));
    }

}
