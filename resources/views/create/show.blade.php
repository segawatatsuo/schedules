@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>発注内容</h1>
@stop

@section('content')


    @if ($errors->any())
        <div class="alert alert-danger mt-3">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif



    <div class="card card-info card-outline">
        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-edit"></i>
                発注内容
            </h3>
        </div>

        <form method="POST" action="{{ route('store') }}" enctype="multipart/form-data">
            @csrf
            <div class="card-body">

                <div class="row">
                    <div class="col-sm-12">


                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <div><label>注文日：</label>{{ $schedule->order_day }}</div>
                                    <div><label>生地番号：</label>{{ $schedule->material }}</div>
                                    <div><label>商品名：</label>{{ $schedule->product_name }}</div>
                                    <div><label>数量：</label>{{ $schedule->quantity }}</div>
                                    <div><label>至急/普通：</label>{{ $schedule->request }}</div>
                                    <div><label>到着日指定：</label>{{ $schedule->specify_arrival_date }}</div>
                                </div>
                            </div>
                        </div>     
                        
<!--
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>注文日</label>
                                    <input name="order_day" value="{{ $schedule->order_day }}" type="date"
                                        class="form-control" placeholder="" />
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>生地番号</label>
                                    <input name="material" value="{{ $schedule->material }}" type="text" class="form-control"
                                        placeholder="" />
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>商品名</label>
                                    <input name="product_name" value="{{ $schedule->product_name }}" type="text"
                                        class="form-control" placeholder="" />
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>数量</label>
                                    <input name="quantity" value="{{ $schedule->quantity }}" type="text" class="form-control"
                                        placeholder="" />
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>至急/普通</label>
                                    <input name="product_name" value="{{ $schedule->request }}" type="text"
                                        class="form-control" placeholder="" />
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>到着日指定</label>
                                    <input name="specify_arrival_date" value="{{ $schedule->specify_arrival_date }}"
                                        type="date" class="form-control" placeholder="" />
                                </div>
                            </div>
                        </div>
                    -->
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>商品画像</label>
                                    <div>
                                        <img src="{{ asset('storage/'.$schedule->img_path) }}">

                                        <img src="{{-- asset('storage/public/image/1698472327/unilab-logo3.jpg') --}}">

                                    </div>
                                </div>
                            </div>
                        </div>
 


        </form>
    </div>


@stop

@section('css')
    {{-- ページごとCSSの指定
    <link rel="stylesheet" href="/css/xxx.css">
    --}}

    <link rel="stylesheet" href="/css/fileinput.css">

@stop

@section('js')
    <script>
    $("#input_file").change(function (e) {
        const file = e.target.files[0];
        const reader = new FileReader();

        reader.addEventListener("load", function () {
            $("#image").attr("src", reader.result);
        }, false);

        if (file) {
            reader.readAsDataURL(file);
        }
    });
    </script>
@stop
