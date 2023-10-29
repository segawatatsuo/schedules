@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>スケジュール</h1>
@stop

@section('content')
<div class="col-md-12">
    <div class="card card-primary">
        <div class="card-body p-0">
            <div id='calendar'></div>

            <script src="http://lookingfor.jp/schedules/js/app.js"></script>
            <script src="https://lookingfor.jp/schedules/js/app.js"></script>
            <script src="{{ mix('js/app.js') }}"></script>

        </div>
    </div>
</div>

@stop

@section('css')
    {{-- ページごとCSSの指定
    <link rel="stylesheet" href="/css/xxx.css">
    --}}
@stop

@section('js')

    



@stop