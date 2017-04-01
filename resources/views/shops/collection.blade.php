@extends('layouts.app')

@section('title')
    @lang('shopCollection.shop-collection')
@endsection

@section('content')
    <link rel="stylesheet" type="text/css" href="{{ asset('user/css/category.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('user/css/shopCollection.css') }}">
    @include('layouts.title')
    @if ($collection)
        <div class="view-product">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                        <ol class="breadcrumb border-shadow-bottom">
                            <li>
                                <a href="{{ route('shop.show', $collection->shop->id) }}">
                                    @lang('shopCollection.again-shop')
                                </a>
                            </li>
                        </ol>
                    </div>
                    <div class="col-md-3 col-lg-3 col-sm-12 col-xs-12">      
                        <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12 border-shadow-bottom block-left-info-shop">
                            <div class="image-background">
                                <div class="block-info">
                                    <a href="{{ route('shop.show', $collection->shop->id) }}" class="name-shop">
                                        <img src="{{ asset($collection->shop->image) }}" class="image-avatar" width="100" height="100">
                                    </a>
                                    <div class="margin-top-10 text-align-center">
                                        <span>
                                            <h3>
                                                <a href="{{ route('shop.show', $collection->shop->id) }}" class="name-shop">
                                                    {{ $collection->shop->name }}
                                                </a>
                                            </h3>
                                        </span>
                                    </div>
                                </div>                            
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
                                <div class="margin-top-10">
                                    <h4>@lang('shopCollection.collection')</h4>
                                </div>
                                <div class="list-collection">
                                    @foreach ($collection->shop->collections as $key => $value)
                                        <a href="{{ route('shopCollection.show', $value->id) }}">
                                            <div class="item-collection" id="item-collection-{{ $value->id }}">
                                                {{ $value->name }}
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                                <div class="margin-top-20">
                                    <h4>@lang('shopCollection.price')</h4>
                                </div>
                                <div class="search">
                                    <div class="form-group">
                                        <label for="from">@lang('shopCollection.from')</label>
                                        <input type="number" class="form-control number" id="from" placeholder="@lang('shopCollection.from')">
                                    </div>
                                    <div class="form-group">
                                        <label for="to">@lang('shopCollection.to')</label>
                                        <input type="number" class="form-control number" id="to" placeholder="@lang('shopCollection.to')">
                                    </div>
                                    <button id="search-product" class="button btn-search-product">@lang('shopCollection.search')</button>
                                </div>
                            </div>  
                        </div>
                    </div>
                    <div class="col-md-9 col-lg-9 col-sm-12 col-xs-12">
                        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 padding-zero">              
                            <ul class="nav nav-tabs border-shadow-bottom">
                                <li class="active col-md-3 col-lg-3 col-sm-3 col-xs-3 text-align-center">
                                    <a href="#new">@lang('shopCollection.new')</a>
                                </li>
                                <li class="dropdown">
                                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                        @lang('shopCollection.arrange') <span class="caret"></span>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a href="#menu2">@lang('shopCollection.arrange-asc')</a></li>
                                        <li><a href="#menu2">@lang('shopCollection.arrange-desc')</a></li>
                                    </ul>
                                </li>
                            </ul>
                            <div class="tab-content border-shadow-bottom">
                                <div id="new" class="tab-pane fade in active">
                                    @foreach ($collection->products as $key => $product)
                                        <div class="col-md-3 padding-zero block-product-category">
                                            <div class="height-140p">
                                                <a href="{{ route('product.show', $product->id) }}" class="col-md-12 img-product">
                                                    @if (count($product->images) > 0)
                                                        <img src="{{ asset($product->images[0]->url) }}" class="image-product">   
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
                                                <input type="button" class="button btn-add-cart"  product-id="{{ $product->id }}" value="@lang('categories.addCart')">
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div id="menu2" class="tab-pane fade">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript" src="{{ asset('bower_components/bootstrap/js/tab.js') }}"></script>
        <script type="text/javascript" src="{{ asset('user/js/shopCollection.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/lang.js') }}"></script>
        <script src="{{ asset('js/addcart.js') }}"></script>
        <script type="text/javascript">
            var shopCollection = new shopCollection();
            var addCart = new addcart();
            $(function() {
                shopCollection.init({
                    imageUrl: '{{ asset($collection->shop->image) }}',
                    idItemCollection: '{{ $collection->id }}'
                });
                addCart.init('.btn-add-cart');
            });
        </script>
    @endif
@endsection
