@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>出荷済み</h1>
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
                出荷登録
            </h3>
        </div>

        <form method="POST" action="{{ route('update') }}">
            @csrf

            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <div><label>注文日：</label>{{ $schedule->order_day }}</div>
                                    <div><label>管理番号：</label>{{ $schedule->management_number }}</div>
                                    <div><label>生地番号：</label>{{ $schedule->material }}</div>
                                    <div><label>商品名：</label>{{ $schedule->product_name }}</div>
                                    <div><label>数量：</label>{{ $schedule->quantity }}</div>
                                    <div><label>至急/普通：</label>{{ $schedule->request }}</div>
                                    <div><label>到着日指定：</label>{{ $schedule->specify_arrival_date }}</div>
                                    <div><label>出荷日：</label>{{ $schedule->ship_date }}</div>
                                    <div><label>配送状況：</label>{{ $schedule->delivery_status }}</div>
                                    <div><label>運送会社：</label>{{ $schedule->shipping_company }}</div>
                                    <div><label>伝票番号：</label>{{ $schedule->slip_number }}</div>
                                </div>
                            </div>
                        </div>



                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>商品画像</label>
                                    <div>
                                        <img src="{{ asset('storage/' . $schedule->img_path) }}">
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
        $("#input_file").change(function(e) {
            const file = e.target.files[0];
            const reader = new FileReader();

            reader.addEventListener("load", function() {
                $("#image").attr("src", reader.result);
            }, false);

            if (file) {
                reader.readAsDataURL(file);
            }
        });
    </script>
@stop
