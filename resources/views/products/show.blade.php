@extends('layouts.app')

@section('title')
    @lang('product.productDetail')
@endsection

@section('content')
    <link rel="stylesheet" type="text/css" href="{{ asset('user/css/productDetail.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('user/css/category.css') }}">
    @if ($product)
        <div class="view-product">
            <div class="container">
                <div class="row margin-top-20">
                    <div class="col-md-5 col-lg-5 col-sm-12 col-xs-12">
                        <div id="carousel-example-generic" class="carousel slide border-shadow-bottom" data-ride="carousel">
                            <ol class="carousel-indicators">
                                @foreach ($product->images as $key => $image)
                                    @if ($key == 0)
                                        <li data-target="#carousel-example-generic" data-slide-to="{{ $key }}" class="active"></li>
                                    @else
                                        <li data-target="#carousel-example-generic" data-slide-to="{{ $key }}"></li>
                                    @endif
                                @endforeach
                            </ol>
                            <div class="carousel-inner" role="listbox">
                                @foreach ($product->images as $key => $image)
                                    @if ($key == 0)
                                        <div class="item active">
                                            <img src="{{ asset($image->url) }}" class="img-product">
                                            <div class="carousel-caption"></div>
                                        </div>
                                    @else
                                        <div class="item">
                                            <img src="{{ asset($image->url) }}" class="img-product">
                                            <div class="carousel-caption"></div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                            <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                <span class="sr-only">@lang('product.previous')</span>
                            </a>
                            <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                <span class="sr-only">@lang('product.next')</span>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-7 col-lg-7 col-sm-12 col-xs-12">
                        <div class="block-info-product col-md-12 col-lg-12 col-sm-12 col-xs-12 border-shadow-bottom">
                            <div class="product-name">{{ $product->name }}</div>
                            <div class="block-price">
                                <div class="discount-price col-md-7 col-lg-7 col-sm-7 col-xs-7">
                                    <span>
                                        {{ number_format(MyFuncs::getDiscount($product->price, $product->discount), 0) }}
                                        <span class="currency">@lang('home.currency')</span>
                                    </span>
                                    <span class="discount" {{ $product->discount > 0 ? '' : 'hidden' }}>
                                        (-{{ number_format($product->discount, 0) }}@lang('home.percent'))
                                    </span>
                                </div>
                                <div class="product-price col-md-5 col-lg-5 col-sm-5 col-xs-5">
                                    <span {{ $product->discount > 0 ? '' : 'hidden' }}>
                                        @lang('product.root-price')
                                        {{ number_format($product->price, 0) }}
                                        @lang('home.currency')
                                    </span>
                                </div>
                            </div>
                            <div class="rate" id="rate-product-detail">
                                <input name="input-start" value="{{ $product->point_rate }}" class="rating input-start" readonly="true">
                            </div>
                            <div class="info-sell-product">
                                <span>@lang('product.count'): </span>
                                <span class="operator operator-minus">-</span>
                                <span class="number">1</span>
                                <span class="operator operator-add">+</span>
                                <span class="avarible-product"><span class="sum">{{ $product->quantity }}</span> @lang('product.availible')</span>
                            </div>
                            <div class="add-product-in-cart">
                                <input type="button" class="btn-add-cart-product-detail" data-id="{{ $product->id }}" value="@lang('categories.addCart')">
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 border-shadow-bottom security-shop">
                            <i class="fa fa-shield" aria-hidden="true"></i>
                            <span class="title">@lang('product.securityShop')</span>
                            <span class="receipt">@lang('product.moneyReceipt')</span>
                        </div>
                    </div>

                    <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 border-shadow-bottom view-shop">
                            <div class="col-md-1 col-lg-1 col-sm-1 col-xs-1 avatar-shop">
                                <a href="{{ route('shop.show', $product->shop->id) }}">
                                    <img src="{{ asset($product->shop->image) }}" width="50" height="50">
                                </a>
                            </div>
                            <div class="col-md-3 col-lg-3 col-sm-3 col-xs-3 row block-shop-info">
                                <a href="{{ route('shop.show', $product->shop->id) }}" class="shop-name">
                                    <span>{{ $product->shop->name }}</span>
                                </a>
                                <div class="view-follow-shop-info">
                                    <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6 row view">
                                        <a href="{{ route('shop.show', $product->shop->id) }}" class="btn-button button4">@lang('product.view')</a>
                                    </div>
                                    <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6 follow">
                                        @if (Auth::user())
                                            <button id="btn-follow" class="btn-button button4" data-follow={{ $followed }}>
                                                {{ $followed > 0 ? Lang::get('product.following') : Lang::get('product.follow') }}
                                            </button>
                                        @else
                                            <button id="btn-follow" class="btn-button button4">@lang('product.follow')</button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8 col-lg-8 col-sm-8 col-xs-8 row info-in-shop">
                                <div class="col-md-3 col-lg-3 col-sm-3 col-xs-3 block-info">
                                    <div class="text-align-center count">{{ count($product->shop->products) }}</div>
                                    <div class="text-align-center name">@lang('product.product')</div>
                                </div>
                                <div class="col-md-3 col-lg-3 col-sm-3 col-xs-3 block-info">
                                    <div id="number-follow" class="text-align-center count">{{ count($product->shop->follows) }}</div>
                                    <div class="text-align-center name">@lang('product.follow')</div>
                                </div>
                                <div class="col-md-3 col-lg-3 col-sm-3 col-xs-3 block-info">
                                    <div class="text-align-center count">{{ count($product->shop->likes) }}</div>
                                    <div class="text-align-center name">@lang('product.like')</div>
                                </div>
                                <div class="col-md-3 col-lg-3 col-sm-3 col-xs-3 block-info">
                                    <div class="text-align-center count">{{ count($product->shop->collections) }}</div>
                                    <div class="text-align-center name">@lang('product.collection')</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 margin-top-10">
                        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 border-shadow-bottom background-while padding-top-10">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#detail">@lang('product.productDetail')</a></li>
                                <li><a href="#vote">@lang('product.vote') (<span id="count-rate">{{ count($product->rates) }}</span>)</a></li>
                                <li><a href="#comment">@lang('product.comment')</a></li>
                            </ul>
                            <div class="tab-content">
                                <div id="detail" class="tab-pane fade in active">
                                    <h4>@lang('product.introductProduct') {{ $product->name }}</h4>
                                    <p class="margin-top-20"><h4>@lang('product.generalInformation')</h4></p>
                                    <p>@lang('product.productName'): {{ $product->name }}</p>
                                    <p>@lang('product.code'): {{ $product->code }}</p>
                                    <p>@lang('product.price'): {{ number_format($product->price, 0) }} @lang('home.currency')</p>
                                    <p>@lang('product.number'): {{ $product->quantity }}</p>
                                    <p>@lang('product.status'): {{ $product->status > 0 ? Lang::get('seller.on-sell') : Lang::get('seller.out-off') }}</p>
                                    <p class="margin-top-20"><h4>@lang('product.description')</h4></p>
                                    <p>{{ $product->description }}</p>
                                </div>
                                <div id="vote" class="tab-pane fade">
                                    @if (Auth::user())
                                        <h4>@lang('product.my-vote')</h4>
                                        <div id="rate-comment">
                                            <input id="input-rate" name="input-rate" class="rating rating-loading" data-min="0" data-max="5" data-step="1">
                                            <textarea id="content-comment" rows="3"></textarea>
                                            <button class="button btn-rate">@lang('product.vote')</button>
                                        </div>
                                    @else
                                        <div class="margin-top-20"><h4>@lang('product.make-sign-in')</h4></div>
                                    @endif
                                    <p class="margin-top-20"><h4>@lang('product.list-vote')</h4></p>
                                    <div id="list-rating" class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                                        @foreach ($product->rates as $key => $rate)
                                            <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 block-rate"> 
                                                <div class="col-md-1 col-lg-1 col-sm-1 col-xs-1 avatar">
                                                    <img src="{{ asset($rate->user->avatar) }}" width="50" height="50">
                                                </div>
                                                <div class="col-md-4 col-lg-4 col-sm-4 col-xs-4 row block-content">
                                                    <a href="javascript:void(0)" class="user-name">
                                                        <span>{{ $rate->user->name }}</span>
                                                    </a>
                                                    <div class="number-rate">
                                                        <input id="input-1" name="input-1" class="rating rating-loading" value="{{ $rate->number }}" readonly="true">
                                                    </div>
                                                    <div class="content-rate">{{ $rate->content }}</div>
                                                    <div class="date-rate">
                                                        <span>{{ $rate->created_at }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div id="comment" class="tab-pane fade">
                                    <div class="fb-comments" data-href="https://developers.facebook.com/apps/1635621576740376/dashboard/"
                                        data-width="100%" data-numposts="3" data-colorscheme="light"></div>
                                    <div id="fb-root"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                        <div class="col-md-12 view-category">
                            <h4><span class="title-category">@lang('product.similarProduct')</span></h4>
                            <h5 class="view-all">
                                <a href="">
                                    <span class="padding-right-5">@lang('product.viewAll')</span> 
                                    <span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span>
                                </a>
                            </h5>
                        </div>
                        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 padding-zero margin-top-10 cart">
                            @foreach ($similarProducts as $key => $value)
                                <div class="col-md-2 padding-zero block-product-category block-product-similar">
                                    <div class="height-140p">
                                        <a href="{{ route('product.show', $value->id) }}" class="col-md-12 img-product">
                                            @if (count($value->images) > 0)
                                                <img src="{{ asset($value->images[0]->url) }}" class="image">
                                            @endif  
                                        </a>
                                        <span class="ribbon" {{ $value->discount > 0 ? '' : 'hidden' }}>
                                            {{ $value->discount }}@lang('home.percent')
                                        </span>
                                    </div>
                                    <div class="text-align-center product-name">
                                        <a href="{{ route('product.show', $value->id) }}">{{ $value->name }}</a>
                                    </div>
                                    <div class="product-price">
                                        <span class="price" {{ $value->discount > 0 ? '' : 'hidden' }}>
                                            {{ number_format($value->price, 0) }} @lang('home.currency')
                                        </span>
                                    </div>
                                    <div class="discount-price">
                                        <span class="price">
                                            {{ number_format(MyFuncs::getDiscount($value->price, $value->discount), 0) }}
                                            @lang('home.currency')
                                        </span>
                                    </div>
                                    <div>
                                        <input name="input-start" value="{{ $value->point_rate }}" class="rating input-start" readonly="true">
                                        <input type="button" class="button btn-add-cart" product-id="{{ $value->id }}" value="@lang('categories.addCart')">
                                    </div>
                                    <div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <script type="text/javascript" src="{{ asset('bower_components/bootstrap/js/tab.js') }}"></script>
                    <script type="text/javascript" src="{{ asset('bower_components/jquery.easyPaginate/lib/jquery.easyPaginate.js') }}"></script>
                    <script type="text/javascript" src="{{ asset('js/follow.js') }}"></script>
                    <script type="text/javascript" src="{{ asset('user/js/product.js') }}"></script>
                    <script type="text/javascript" src="{{ asset('user/js/plugin.js') }}"></script>
                    <script type="text/javascript">
                        var product = new product();
                        var plugin = new plugin();
                        plugin.init({
                            facebookId: {{ config('plugin.facebook-id') }}
                        });
                        $(function() {
                            product.init({
                                idProduct: {{ $product->id }},
                                idShop: {{ $product->shop->id }},
                                idUser: {{ Auth::user() ? Auth::id() : 'null' }},
                                userName: '{{ Auth::user() ? Auth::user()->name : 'null' }}',
                                urlAvatar: '{{ Auth::user() ? Auth::user()->avatar : 'null' }}',
                                addCart: addCart,
                            });
                        });
                    </script>
                </div>
            </div>
        </div>
    @else
        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 border-shadow-bottom not-found-product">
            @lang('product.not-found-product')
        </div>
    @endif
@endsection

@section('script')
    <script src="{{ asset('js/addcart.js') }}"></script>
    <script>
        var addCart = new addcart();
        addCart.init('.btn-add-cart');
    </script>
@endsection
