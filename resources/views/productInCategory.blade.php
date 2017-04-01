@extends('layouts.app')

@section('title')
    @lang('categories.category')
@endsection

@section('content')
    <link rel="stylesheet" type="text/css" href="{{ asset('user/css/category.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('user/css/menu.css') }}">
    @include('layouts.title')
    <div class="view-product">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                    <ol class="breadcrumb border-shadow-bottom">
                        <li><a href="{{ route('home') }}">@lang('user.home')</a></li>
                        @if ($categoryShow != null)
                            @if ($categoryShow->parent_id != null)
                                <li>
                                    <a href="{{ route('category.show', $categoryShow->parent->id) }}">
                                        {{ $categoryShow->parent->name }}
                                    </a>
                                </li>
                            @endif
                            <li><a href="{{ route('category.show', $categoryShow->id) }}">{{ $categoryShow->name }}</a></li>
                        @endif
                    </ol>
                </div>
                <div class="col-md-3 col-lg-3 col-sm-12 col-xs-12">
                    <div><h3>@lang('order.search')</h3></div>
                    <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12 margin-top-20">
                        <aside class="sidebar">
                            <nav class="sidebar-nav">
                                <ul class="metismenu">
                                    @foreach ($categories as $key => $category)
                                        <li>
                                            <a href="{{ route('category.show', $category->id) }}" aria-expanded="false" class="title" id="category_{{ $category->id }}">
                                                {{ $category->name }} <span class="fa arrow"></span>
                                            </a>
                                            <ul aria-expanded="false">
                                                @foreach ($category->categories as $key => $value)
                                                    <li><a href="{{ route('category.show', $value->id) }}" id="sub_category_{{ $value->id }}">{{ $value->name }}</a></li>
                                                @endforeach
                                            </ul>
                                        </li>
                                    @endforeach
                                </ul>
                            </nav>
                        </aside>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12 margin-top-20">
                        <div class="speace20"></div>
                        <div class="title-filter">
                            <h3>@lang('user.filter')</h3>
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
                            <button id="search-by-price" type="button" class="button btn-search-product">@lang('order.search')</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-9 col-lg-9 col-sm-12 col-xs-12">
                    <div class="shop-sort-by-options col-md-12 col-lg-12 col-sm-12 col-xs-12 border-shadow-bottom"></div>
                    <span class="list-product-in-category">
                        @include('listProducts')
                    </span>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="{{ asset('user/js/category.js') }}"></script>
@endsection

@section('script')
    <script src="{{ asset('js/addcart.js') }}"></script>
    <script>
        var addCart = new addcart();
        var category = new category();
        addCart.init('.btn-add-cart');
        category.init({
            parent_id: {{ ($categoryShow->parent_id) == null ? 'null' : $categoryShow->parent_id }},
            category_id: {{ $categoryShow->id }},
            addCart: addCart,
        });
    </script>
@endsection
