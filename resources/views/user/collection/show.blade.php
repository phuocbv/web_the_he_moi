@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="{{ asset('user/css/listProducts.css') }}">
    <link rel="stylesheet" href="{{ asset('css/shop.css') }}">
    <div class="speace20 margin-top-50"></div>
    <div class="container">
        <div class="row">
            <ol class="breadcrumb border-shadow-bottom">
                <li>
                    <a href="{{ route('user.user.myShop') }}">
                        @lang('seller.my-shop')
                    </a> / {{ $collection->name }}
                </li>
            </ol>
        </div>
    </div>

    <div class="container">
        <div class="col-md-8">
            <h3>@lang('user.collection.collection-title') {{ $collection->name }}</h3>
        </div>
        
        <div id="collection">
            @include('user.collection.collection', [
                'collection' => $collection,
                'shop' => $shop
            ])
        </div>
    </div>

    <script type="text/javascript" src="{{ asset('bower_components/jquery.easyPaginate/lib/jquery.easyPaginate.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/user/js/collection.js') }}"></script>
    <script>
        var collection = new collection();
        collection.init();
    </script>
@endsection
