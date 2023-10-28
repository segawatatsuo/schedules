@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>スケジュール</h1>
@stop

@section('content')
<div class="col-md-12">
    <div class="card card-primary">
        <div class="card-body p-0">
            <div id="app">
                <div class="m-auto w-100 m-5 p-5">
                    <div id='calendar'></div>
                </div>
            </div>
    
            <link href='{{ asset('fullcalendar-6.1.9/lib/main.css') }}' rel='stylesheet' />
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
    <script> console.log('ページごとJSの記述'); </script>
    <script src="{{ mix('js/app.js') }}"></script>

    <script src='{{ asset('fullcalendar-6.1.9/lib/main.js') }}'></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                locale: 'ja',
                height: 'auto',
                firstDay: 1,
                headerToolbar: {
                    left: "dayGridMonth,listMonth",
                    center: "title",
                    right: "today prev,next"
                },
                buttonText: {
                    today: '今月',
                    month: '月',
                    list: 'リスト'
                },
                noEventsContent: 'スケジュールはありません',
             });
             calendar.render();
        });
    </script>

@stop