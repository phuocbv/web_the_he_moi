@extends('layouts.seller.app')

@section('title')
    @lang('order.title')
@endsection

@section('content')
    <link rel="stylesheet" href="{{ asset('/bower_components/datatables.net-dt/css/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('user/css/manageOrder.css') }}">
    <div class="speace50"></div>
    <div class="view-product">
        <div class="container">
            <div class="row margin-top-20">
                <ol class="breadcrumb border-shadow-bottom">
                    <li>
                        <a href="{{ route('user.user.myShop') }}">
                            @lang('seller.my-shop')
                        </a>
                    </li>
                </ol>
            </div>
            <div class="container-fluid">
                <h3>@lang('order.list-ordered-product')</h3>
                <div class="margin-top-20">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-ls-12 row block-filter-date">
                        <div class="col-xs-2 col-sm-2 col-md-2 col-ls-2 date-from">
                            @lang('order.date-from')
                        </div>
                        <div class="col-xs-4 col-sm-4 col-md-4 col-ls-4">
                            <div class="form-group">
                                <div class="input-group date datepicker" id="from">
                                    <input type="text" class="form-control"/>
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-2 col-sm-2 col-md-2 col-ls-2 date-to">
                            @lang('order.date-to')
                        </div>
                        <div class="col-xs-4 col-sm-4 col-md-4 col-ls-4">
                            <div class="form-group">
                                <div class="input-group date datepicker" id="to">
                                    <input type="text" class="form-control"/>
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-ls-12 row block-search">
                        <button id="btn-search-order" type="button" class="button btn-search-order">@lang('order.search')</button>
                    </div>
                    <div id="table-display-ordered-product">
                        @include('seller.item-ordered-product')
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('bower_components/bootstrap-datepicker/dist/locales/bootstrap-datepicker.vi.min.js') }}"></script>
    <script src="{{ asset('js/lang.js') }}"></script>
    <script src="{{ asset('user/js/managerOrder.js') }}"></script>
    <script>
        var manageOrder = new manageOrder();
        $(function () {
            manageOrder.init();
        });
    </script>
</script>
@endsection
