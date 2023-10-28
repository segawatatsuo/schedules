{{-- vendor/jeroennoten/laravel-adminlte/resources/views/page.blade.php --}}
@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>未出荷一覧</h1>
@stop

@section('content')
    {{-- コンテンツ --}}

    <div>

        <table class="table table-striped">

            <thead>
                <tr>
                    <th>注文日</th>
                    <th>管理番号</th>
                    <th>生地番号</th>
                    <th>商品名</th>
                    <th>数量</th>
                    <th>要望</th>
                    <th>到着指定</th>
                    <th>出荷日</th>
                    <th>配送状況</th>
                    <th>運送会社</th>
                    <th>伝票番号</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($schedules as $product)
                    <tr class="jqeach-list">
                        <td>{{ $product->order_day }}</td>
                        <td><a href="{{ route('shipping.show', $product->id) }}">{{ $product->management_number }}</a></td>
                        <td>{{ $product->material }}</td>
                        <td>{{ $product->product_name }}</td>
                        <td>{{ $product->quantity }}</td>
                        <td class="request">{{ $product->request }}</td>
                        <td>{{ $product->specify_arrival_date }}</td>

                        <td>{{ $product->ship_date }}</td>
                        <td>{{ $product->delivery_status }}</td>
                        <td>{{ $product->shipping_company }}</td>
                        <td>{{ $product->slip_number }}</td>

                        <td>
                        </td>
                        <td>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>

    {{ $schedules->links() }}

@stop

@section('css')
    {{-- ページごとCSSの指定
    <link rel="stylesheet" href="/css/xxx.css">
    --}}
@stop

@section('js')
    <script>
        if ($('.jqeach-list > td').length) {
            $('.jqeach-list > td').each(function() {
                if ($(this).text().indexOf('至急') != -1) {
                    $(this).css('background', 'orange');
                }
            });
        }
    </script>
@stop
