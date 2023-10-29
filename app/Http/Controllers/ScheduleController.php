<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreScheduleRequest;
use App\Http\Requests\UpdateScheduleRequest;
use App\Models\Img_path;
use App\Models\Schedule;
use Carbon\Carbon;



class ScheduleController extends Controller
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
     * 発注登録
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('create.index');
    }

    //確認画面
    public function conform(Request $request)
    {

    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreScheduleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        //$validated = $request->validate();
        $validated = $request->validate([
            'order_day' => 'required',
            'material' => 'required',
            'product_name' => 'required',
            'quantity' => 'required|integer',
            'request' => 'required',
            'specify_arrival_date' => 'required',
            'gazou' => 'required',
        ]);


        //画像名の取得
        $file_name = $request->file('gazou')->getClientOriginalName();

        //画像の保存先フォルダ
        $todayDate = Carbon::now();
        $folder = $todayDate->format('U'); // UNIXタイム
        $directoryPath = 'public/image/'.$folder;
        $imgSrcPath = 'image/'.$folder;

        //フォルダがなければ新規作成
        if (!Storage::exists($directoryPath)) {
            Storage::makeDirectory($directoryPath);
        }
        //画像をディレクトに保存
        $file_name = $directoryPath.'/'.$file_name;
        $img = $request->file('gazou')->storeAs('public', $file_name ); //storage/image/1698132385/seobu.jpeg

        //Img_path::create(['img_path' => $file_name]);

        //発注テーブルに登録
        $schedule = Schedule::create([
            'order_day' => $validated['order_day'],
            'material' => $validated['material'],
            'product_name' => $validated['product_name'],
            'quantity' => $validated['quantity'],
            'request' => $validated['request'],
            'specify_arrival_date' => $validated['specify_arrival_date'],
            'img_path' => $file_name,
        ]);

        //管理番号を作成
        $num=1000 + $schedule->id;
        $management_number='OFM'.$num;
        Schedule::where('id',$schedule->id)
          ->update(['management_number' => $management_number]);

          $schedules = Schedule::orderBy('created_at', 'desc')->paginate(10);
          return view('create.list_display',compact('schedules'));
        
    }

    public function list_display()
    {
        $schedules = Schedule::orderBy('created_at', 'desc')->paginate(10);
        return view('create.list_display',compact('schedules'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
     
    public function show($id)
    {

        $schedule=Schedule::where('id',$id)->first();
        return view('create.show',compact('schedule'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function edit(Schedule $schedule)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateScheduleRequest  $request
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //dd($request->id);
        $validated_ship = $request->validate([
            'ship_date' => 'required',
            'delivery_status' => 'required',
            'shipping_company' => 'required',
            'slip_number' => 'required',
        ]);
        
        $update=Schedule::where('id',$request->id)
        ->update([
            'ship_date' => $request->ship_date,
            'delivery_status' => $request->delivery_status,
            'shipping_company' => $request->shipping_company,
            'slip_number' => $request->slip_number,
        ]);
        
        $schedules = Schedule::where('delivery_status','=',NULL)->orderBy('created_at', 'desc')->paginate(10);
        return view('shipping.index',compact('schedules'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function generate_pdf() {
        $pdf = \PDF::loadView('generate_pdf');
        return $pdf->stream('title.pdf');
    }


    public function shipping(Request $request)
    {
        $schedules = Schedule::where('delivery_status','=',NULL)->orderBy('created_at', 'desc')->paginate(10);
        return view('shipping.index',compact('schedules'));
    }

    public function shipping_show($id)
    {
        $schedule=Schedule::where('id',$id)->first();
        return view('shipping.show',compact('schedule'));
    }


    public function processed(Request $request)
    {
        $schedules = Schedule::where('delivery_status','=','出荷済み')->orderBy('created_at', 'desc')->paginate(10);
        return view('processed.index',compact('schedules'));
    }
    public function processed_show($id)
    {
        $schedule=Schedule::where('id',$id)->first();
        return view('processed.show',compact('schedule'));
    }


    public function user(Request $request)
    {
        return view('user.index');
    }

    public function calendar()
    {
        return view('calendar');
    }


    public function getEvents()
    {

        $schedules=Schedule::all();

        $data=[];
        foreach($schedules as $schedule){
            $title = $schedule -> management_number;
            $description = $schedule -> product_name;
            $start = $schedule -> specify_arrival_date;
            $url = 'http://lookingfor.jp/schedules/show/'.$schedule->id;
            array_push($data,[ 'title' => $title, 'description' => $description, 'url' => $url ,'start' => $start ]);
        }
        return $data;
        /*
        return [
            [
                'title' => '美容院',
                'description' => '人気の美容室予約取れた',
                'start' => '2023-10-10',
                'end'   => '2023-10-10',
            ],
            [
                'title' => 'シルバーウィーク旅行',
                'description' => '人気の旅館の予約が取れた',
                'start' => '2023-10-20 10:00:00',
                'end'   => '2023-10-22 18:00:00',
                'url'   => 'https://admin.juno-blog.site',
            ],
            [
                'title' => '給料日',
                'start' => '2023-11-30',
                'color' => '#ff44cc',
            ],
        ];
        */
    }
}
