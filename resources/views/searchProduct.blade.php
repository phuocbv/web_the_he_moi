@extends('layouts.app')

@section('title')
    @lang('categories.search')
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
                    </ol>
                </div>
                <div class="col-md-3 col-lg-3 col-sm-12 col-xs-12">
                    <div><h3>@lang('categories.search')</h3></div>
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
                            <h3>@lang('categories.filter')</h3>
                        </div>
                        <div class="search">
                            <input type="button" value="@lang('categories.search')" class="button btn-search-product">
                        </div>
                    </div>
                </div>
                <div class="col-md-9 col-lg-9 col-sm-12 col-xs-12">
                    <div class="shop-sort-by-options col-md-12 col-lg-12 col-sm-12 col-xs-12 border-shadow-bottom"></div>
                    @if ($products)
                        @include('itemProducts')
                        <div class="paginate"></div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript" src="{{ asset('user/js/search.js') }}"></script>
    <script type="text/javascript" src="{{ asset('user/js/url.js') }}"></script>
    <script src="{{ asset('js/addcart.js') }}"></script>
    <script>
        var addCart = new addcart();
        var search = new search();
        var url = new url();
        addCart.init();
        search.init({
            items: {{ $sum }},
            itemsOnPage: {{ config('view.panigate-24') }},
            addCart: addCart,
            url: url,
        });
    </script>
@endsection
