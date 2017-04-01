@extends('layouts.app')

@section('title')
    @lang('shop.list-shop')
@endsection

@section('content')
    <link rel="stylesheet" type="text/css" href="{{ asset('user/css/listShop.css') }}">
    <div class="view-product">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 margin-top-20">
                    <ol class="breadcrumb border-shadow-bottom">
                        <li><a href="javascript:void(0)">@lang('shop.list-shop')</a></li>
                    </ol>
                </div>
                <div id="list-shop">
                    @foreach ($shops as $key => $shop)
                        <div class="col-md-3">
                            <div class="col-sm-6 col-md-12 border-shadow-right-bottom block-product-shop">
                                <a href="{{ route('shop.show', $shop->id) }}">
                                    <img class="img-shop" src="{{ asset($shop->image) }}">
                                </a>
                                <div class="caption">
                                    <div class="product-name-shop">
                                        <a href="{{ route('shop.show', $shop->id) }}"><h4>{{ $shop->name }}</h4></a>
                                    </div>
                                    <div class="price-and-number">
                                        <span class="number-product">@lang('shop.product') {{ count($shop->products) }}</span>
                                        <span class="product-in-stock">@lang('shop.follow') {{ count($shop->follows) }}</span>
                                    </div>
                                    <div class="buy-and-comment">
                                        <span>@lang('shop.like') {{ count($shop->likes) }}</span>
                                        <span class="comment">@lang('shop.collection') {{ count($shop->collections) }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                    {{ $shops->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
