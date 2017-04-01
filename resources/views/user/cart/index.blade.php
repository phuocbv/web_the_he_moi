@extends('layouts.app')

@section('title')
    @lang('user.cart.title')
@endsection

@section('content')
<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li class="active"><h3>@lang('user.cart.title')</h3></li>
            </ol>
        </div>
        <div id="cart">
            @include('user.cart.cart')
        </div>
    </div>
</section>
@endsection

@section('script')
    <script src="{{ asset('js/cart.js') }}"></script>
    <script>
        var cart = new cart();
        cart.init();
    </script>
@endsection
