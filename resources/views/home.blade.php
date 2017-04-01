@extends('layouts.app')

@section('title')
    @lang('categories.home')
@endsection

@section('content')
    <div class="container">
        @include('layouts.categories')
    </div>
     <div class="view-product">
        <div class="container">
            @foreach ($categories as $key => $category)
                <div class="col-md-12 view-category">
                    <h4>
                        <span class="badge">{{ config('category.' . ($key + 1)) }}</span>
                        <span class="title-category"><a href="{{ route('category.show', $category->id) }}">{{ $category->name }}</a></span>
                    </h4>
                    <h5 class="view-all">
                        <a href="{{ route('category.show', $category->id) }}">
                            <span class="padding-right-5">@lang('user.view-detail')</span>
                            <span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span>
                        </a>
                    </h5>
                </div>
                <div class="col-md-12 row padding-top-10">
                    <div class="col-md-4 row">
                        @foreach ($category->categories as $key => $value)
                            <div class="col-md-4 padding-zero block-sub-category">
                                <a href="{{ route('category.show', $value->id) }}" class="col-md-12">
                                    <img src="{{ $value->image }}" width="75" height="75">
                                    <div>{{ $value->name }}</div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                    <div class="col-md-8 cart">
                        @foreach ($category->productsThrough as $key => $product)
                            <div class="col-md-3 padding-zero block-product-home">
                                <div class="height-120p">
                                    <a href="{{ route('product.show', $product->id) }}" class="col-md-12 img-product">
                                        @if (count($product->images) > 0)
                                            <img src="{{ $product->images[0]->url }}" class="image-product">
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
                                <div>
                                    <input name="input-start" value="{{ $product->point_rate }}" class="rating input-start" readonly="true">
                                    <input type="button" product-id="{{ $product->id }}" class="button btn-add-cart" value="@lang('categories.addCart')">
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <script type="text/javascript" src="{{ asset('user/js/home.js') }}"></script>
@endsection

@section('script')
    <script src="{{ asset('js/addcart.js') }}"></script>
    <script>
        var addCart = new addcart();
        addCart.init('.btn-add-cart');
    </script>
@endsection
