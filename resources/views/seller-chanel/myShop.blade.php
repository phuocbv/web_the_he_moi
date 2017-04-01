@extends('layouts.seller.app')

@section('title')
    @lang('seller.my-shop')
@endsection

@section('content')
    <div class="container">
        <div class="col-xs-12 col-sm-12 col-md-12 col-ls-12 row-item row introduct-shop">
            <div><h3>@lang('shop.title_shop')</h3></div>
            <div class="margin-top-30"><h4>@lang('shop.please_choose')</h4></div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 col-ls-12 row-item row margin-top-50">
            <div class="col-xs-12 col-sm-12 col-md-3 col-ls-3">
                <a href="{!! route('user.user.myCollection') !!}">
                    <div class="block-categoty-shop one"></div>
                </a>
                <a href="{!! route('user.user.myCollection') !!}">
                    <div class="name-category-shop"><h4>@lang('shop.collection')</h4></div>
                </a>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-3 col-ls-3">
                <a href="{{ route('user.user.myProducts') }}">
                    <div class="block-categoty-shop two"></div>
                </a>
                <a href="{{ route('user.user.myProducts') }}">
                    <div class="name-category-shop"><h4>@lang('shop.product')</h4></div>
                </a>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-3 col-ls-3">
                <a href="{{ route('user.user.orderedProduct') }}">
                    <div class="block-categoty-shop three"></div>
                </a>
                <a href="{{ route('user.user.orderedProduct') }}">
                    <div class="name-category-shop"><h4>@lang('shop.order')</h4></div>
                </a>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-3 col-ls-3" >
                <a href="">
                    <div class="block-categoty-shop four"></div>
                </a>
                <a href="">
                    <div class="name-category-shop"><h4>@lang('shop.view_shop')</h4></div>
                </a>
            </div>
        </div>
    </div>
@stop
