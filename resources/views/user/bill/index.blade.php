@extends('layouts.app')

@section('title')
    @lang('user.bill.title')
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('/bower_components/datatables.net-dt/css/jquery.dataTables.min.css') }}">
@endsection

@section('content')
    <div class="container">
        <div class="container-fluid">
            <div class="panel-heading"><h3>@lang('user.bill.title')</h3></div>
            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                    <tr>
                        <th>@lang('user.bill.id')</th>
                        <th>@lang('user.bill.title')</th>
                        <th>@lang('user.bill.date')</th>
                        <th>@lang('user.bill.total')</th>
                        <th>@lang('user.bill.status')</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $key => $order)
                        <tr>
                            <td><a href="{{ route('user.bill.show', $order->id) }}">@lang('user.bill.prefix'){{ $order->id }}</a></td>
                            <td><a href="{{ route('user.bill.show', $order->id) }}">@lang('user.bill.number-order') {{ $order->id }}</a></td>
                            <td>{{ $order->created_at }}</td>
                            <td>{{ number_format($order->total_price) }} @lang('user.cart.vnd')</td>
                            <td>{{ Lang::get('user.bill.state')[$order->status] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('/js/dttable.js') }}"></script>
    <script>
        var dttable = new dttable();
        dttable.init('#dataTables-example');
    </script>
@endsection
