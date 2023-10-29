@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>スケジュール</h1>
@stop

@section('js')

<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.9/index.global.min.js'></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {

            initialView: 'dayGridMonth',
            //initialView: 'timeGridWeek',1週間ごとの細かい表示の場合
            locale: 'ja',
            height: 'auto',
            firstDay: 1, //0(日曜日)〜6(土曜日)
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



            eventSources: [ // ←★追記 Laravelのコントローラーを指定
                {
                    url: '/get_events',
                },
            ],
            eventSourceFailure() { // ←★追記
                console.error('エラーが発生しました。');
            },
            eventMouseEnter(info) { // ←★追記
                $(info.el).popover({
                    title: info.event.title,
                    content: info.event.extendedProps.description,
                    trigger: 'hover',
                    placement: 'top',
                    container: 'body',
                    html: true
                });
            }

        });
        calendar.render();
    });
</script>



@stop
@section('content')
<div class="col-md-12">
    <div class="card card-primary">
        <div class="card-body p-0">
            <div id='calendar'></div>
            <!--
            <script src="http://lookingfor.jp/schedules/js/app.js"></script>
            <script src="https://lookingfor.jp/schedules/js/app.js"></script>
            <script src="{{ mix('js/app.js') }}"></script>
            -->


        </div>
    </div>
</div>

@stop

@section('css')
<style>
    .fc-col-header-cell-cushion,
    .fc-daygrid-day-number,
    .fc-daygrid-day-top {
        color: #333;
    }
    .fc-day-sat {
        background-color: #f2f7fc;
    }
    .fc-day-sun {
        background-color: #ffebf5;
    }
</style>
@stop