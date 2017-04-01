@extends('layouts.app')

@section('title')
    @lang('shop.shop')
@endsection

@section('content')
    <link rel="stylesheet" type="text/css" href="{{ asset('user/css/category.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('user/css/shop.css') }}">
    @if ($shop)
        <div class="view-product">
            <div class="container">
                <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 margin-top-20 border-shadow-bottom block-info-detail-shop">
                    <div class="col-md-4 col-lg-4 col-sm-4 col-xs-4 row avatar-shop">
                        <div class="block-in">
                            <div class="col-md-3 col-lg-3 col-sm-4 col-xs-4">
                                <img class="img-avatar" src="{{ asset($shop->image) }}" width="70" height="70">
                            </div>
                            <div class="col-md-9 col-lg-9 col-sm-4 col-xs-4">
                                <span><h3>{{ $shop->name }}</h3></span>
                            </div>
                            <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                                <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6">
                                    @if (Auth::user())
                                        <button id="btn-follow" class="btn-button button4" data-follow={{ $followed }}>
                                            {{ $followed > 0 ? Lang::get('product.following-full') : Lang::get('product.follow') }}
                                        </button>
                                    @else
                                        <button id="btn-follow" class="btn-button button4">@lang('product.follow')</button>
                                    @endif
                                </div>
                                <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6">
                                    @if (Auth::user())
                                        <button id="btn-like" class="btn-button button4" data-like={{ $liked }}>
                                            {{ $liked > 0 ? Lang::get('shop.liked') : Lang::get('shop.like') }}
                                        </button>
                                    @else
                                        <button id="btn-like" class="btn-button button4">@lang('shop.like')</button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8 col-lg-8 col-sm-8 col-xs-8">
                        <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6 block-info-in-shop">
                            <span>@lang('shop.count-product') {{ count($shop->products) }}</span>
                        </div>
                        <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6 block-info-in-shop">
                            <span>@lang('shop.follow') <span id="number-follow">{{ count($shop->follows) }}</span></span>
                        </div>
                        <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6 block-info-in-shop">
                            <span>@lang('shop.like') <span id="number-like">{{ count($shop->likes) }}</span></span>
                        </div>
                        <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6 block-info-in-shop">
                            <span>@lang('shop.collection') {{ count($shop->collections) }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 margin-top-20 padding-zero"> 
                    <ul class="nav nav-tabs border-shadow-bottom block-title-tab">
                        <li class="active"><a href="#shop">@lang('shop.shop')</a></li>
                        <li><a href="#all-product">@lang('shop.all-product')</a></li>
                        @if (count($shop->collections) > 0)
                            <li class="dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                    @lang('shop.category-shop') <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu">
                                    @foreach ($shop->collections as $key => $collection)
                                        <li>
                                            <a href="{{ route('shopCollection.show', $collection->id) }}">
                                                {{ $collection->name }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        @endif
                    </ul>
                    <div class="tab-content border-shadow-bottom block-detail-tab">
                        <div id="shop" class="tab-pane fade in active">
                            @foreach ($shop->collections as $key => $collection)
                                <div class="col-md-12 view-category">
                                    <h4>
                                        <span class="title-category">
                                            <a href="{{ route('shopCollection.show', $collection->id) }}">
                                                {{ $collection->name }}
                                            </a>
                                        </span>
                                    </h4>
                                    <h5 class="view-all">
                                        <a href="{{ route('shopCollection.show', $collection->id) }}">
                                            <span class="padding-right-5">@lang('shop.view-all')</span> 
                                            <span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span>
                                        </a>
                                    </h5>
                                </div>

                                <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 padding-zero margin-top-10">
                                    @foreach ($collection->products as $key => $product)
                                        <div class="col-md-2 padding-zero block-product-category background-while">
                                            <div class="height-140p">
                                                <a href="{{ route('product.show', $product->id) }}" class="col-md-12 img-product">
                                                    @if (count($product->images) > 0)
                                                        <img src="{{ asset($product->images[0]->url) }}" class="image-product-all">   
                                                    @endif 
                                                </a>
                                                <span class="ribbon" {{ $product->discount > 0 ? '' : 'hidden' }}>
                                                    {{ $product->discount }}@lang('home.percent')
                                                </span>
                                            </div>
                                            <div class="text-align-center product-name">
                                                <a href="{{ route('product.show', $product->id) }}">{{ $product->name }}</a>
                                            </div>
                                            <div class="product-price">
                                                <span class="price" {{ $product->discount > 0 ? '' : 'hidden' }}>
                                                    {{ number_format($product->price, 0) }} @lang('home.currency')
                                                </span>
                                            </div>
                                            <div class="discount-price">
                                                <span class="price">
                                                    {{ number_format(MyFuncs::getDiscount($product->price, $product->discount), 0) }}
                                                    @lang('home.currency')
                                                </span>
                                            </div>
                                            <div class="cart">
                                                <input name="input-start" value="{{ $product->point_rate }}" class="rating input-start" readonly="true">
                                                <input type="button" class="button btn-add-cart" product-id="{{ $product->id }}" value="@lang('categories.addCart')">
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endforeach
                        </div>

                        <div id="all-product" class="tab-pane fade">
                            <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 padding-zero margin-top-10" id="list-product">
                                @foreach ($shop->products as $key => $product)
                                    <div class="col-md-2 padding-zero block-product-category background-while block-product-category-all">
                                        <div class="height-140p">
                                            <a href="{{ route('product.show', $product->id) }}" class="col-md-12 img-product">
                                                @if (count($product->images) > 0)
                                                    <img src="{{ asset($product->images[0]->url) }}" class="image-product-all">   
                                                @endif
                                            </a>
                                            <span class="ribbon" {{ $product->discount > 0 ? '' : 'hidden' }}>
                                                {{ $product->discount }}@lang('home.percent')
                                            </span>
                                        </div>
                                        <div class="text-align-center product-name">
                                            <a href="{{ route('product.show', $product->id) }}">{{ $product->name }}</a>
                                        </div>
                                        <div class="product-price">
                                            <span class="price" {{ $product->discount > 0 ? '' : 'hidden' }}>
                                                {{ number_format($product->price, 0) }} @lang('home.currency')
                                            </span>
                                        </div>
                                        <div class="discount-price">
                                            <span class="price">
                                                {{ number_format(MyFuncs::getDiscount($product->price, $product->discount), 0) }}
                                                @lang('home.currency')
                                            </span>
                                        </div>
                                        <div class="cart">
                                            <input name="input-start" value="{{ $product->point_rate }}" class="rating input-start" readonly="true">
                                            <input type="button" class="button btn-add-cart" product-id="{{ $product->id }}" value="@lang('categories.addCart')">
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>    
            </div>
        </div>
        <script type="text/javascript" src="{{ asset('bower_components/jquery.easyPaginate/lib/jquery.easyPaginate.js') }}"></script>
        <script type="text/javascript" src="{{ asset('bower_components/bootstrap/js/tab.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/follow.js') }}"></script>
        <script type="text/javascript" src="{{ asset('user/js/shop.js') }}"></script>
        <script type="text/javascript">
            var shop = new shop();
            $(function() {
                shop.init({
                    avatar: '{{ asset($shop->image) }}',
                    idShop: {{ $shop->id }},
                    idUser: {{ Auth::user() ? Auth::id() : 'null' }},
                });
            });
        </script>
    @else
        @lang('shop.not-found-shop')
    @endif
@endsection

@section('script')
    <script src="{{ asset('js/addcart.js') }}"></script>
    <script>
        var addCart = new addcart();
        addCart.init('.btn-add-cart');
    </script>
@endsection
