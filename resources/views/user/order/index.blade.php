@extends('layouts.app')

@section('title')
    @lang('user.order.title')
@endsection

@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/order.css') }}">
@endsection

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h1 class="text-primary">@lang('user.order.title')</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            {!! Form::open(['url' => route('user.order.store'), 'data-parsley-validate', 'id' => 'payment-form']) !!}

                <div class="form-group" id="name-group">
                    {!! Form::label('name', Lang::get('user.order.name')) !!}
                    {!! Form::text('name', Auth::user()->name, [
                        'class' => 'form-control',
                        'required' => 'required',
                        'data-parsley-required-message' => Lang::get('user.order.required', ['name' => 'Name']),
                        'data-parsley-trigger' => 'change focusout',
                        'data-parsley-minlength' => '2',
                        'data-parsley-maxlength' => '32',
                        'data-parsley-class-handler' => '#name-group'
                    ]) !!}
                </div>

                <div class="form-group" id="address-group">
                    {!! Form::label('address', Lang::get('user.order.address')) !!}
                    {!! Form::text('address', null, [
                        'class' => 'form-control',
                        'required' => 'required',
                        'data-parsley-required-message' => Lang::get('user.order.required', ['name' => 'Address']),
                        'data-parsley-trigger' => 'change focusout',
                        'data-parsley-minlength' => '2',
                        'data-parsley-maxlength' => '32',
                        'data-parsley-class-handler' => '#address-group'
                    ]) !!}
                </div>

                <div class="form-group" id="phone-group">
                    {!! Form::label('phone', Lang::get('user.order.phone')) !!}
                    {!! Form::text('phone', Auth::user()->phone, [
                        'class' => 'form-control',
                        'required' => 'required',
                        'data-parsley-required-message' => Lang::get('user.order.required', ['name' => 'Phone']),
                        'data-parsley-trigger' => 'change focusout',
                        'data-parsley-minlength' => '9',
                        'data-parsley-maxlength' => '12',
                        'data-parsley-type' => 'number',
                        'data-parsley-class-handler' => '#phone-group'
                    ]) !!}
                </div>

                <div class="form-group" id="email-group">
                    {!! Form::label('email', Lang::get('user.order.email')) !!}
                    {!! Form::email('email', Auth::user()->email, [
                        'class' => 'form-control',
                        'placeholder' => 'email@example.com',
                        'required' => 'required',
                        'data-parsley-required-message' => Lang::get('user.order.required', ['name' => 'Email']),
                        'data-parsley-trigger' => 'change focusout',
                        'data-parsley-class-handler' => '#email-group'
                    ]) !!}
                </div>

                <div class="form-group">
                    <table class="table table-condensed">
                        <thead>
                            <tr class="cart_menu">
                                <td class="description"><b>@lang('user.cart.item')</b></td>
                                <td class="price">@lang('user.cart.price')</td>
                                <td class="quantity">@lang('user.cart.quantity')</td>
                                <td class="total">@lang('user.cart.sum')</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cart as $item)
                                <tr>
                                    <td class="cart_description">
                                        <a href="{{ route('product.show', $item->id) }}">{{ $item->name }}</a>
                                        <a href="{{ route('shop.show', $item->options['shop_id']) }}" class="btn btn-success" 
                                        role="button">{{ $item->options['shop_name'] }}</a>
                                    </td>
                                    <td class="cart_price">
                                        <p>
                                            <span>
                                                {{ number_format($item->options['old_price']) }}
                                            </span>{{ number_format($item->price) }} @lang('user.cart.vnd')
                                        </p>
                                    </td>
                                    <td class="cart_quantity">
                                        <input class="cart_quantity_input" type="button" name="quantity" value="{{ $item->qty }}">
                                    </td>
                                    <td class="cart_total">
                                        <p class="cart_total_price">{{ number_format($item->subtotal) }} @lang('user.cart.vnd')</p>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="form-group" id="cc-group">
                    {!! Form::label(null, Lang::get('user.order.card-number')) !!}
                    {!! Form::text(null, null, [
                        'class' => 'form-control',
                        'required' => 'required',
                        'data-stripe' => 'number',
                        'data-parsley-type' => 'number',
                        'maxlength' => '16',
                        'data-parsley-trigger' => 'change focusout',
                        'data-parsley-class-handler' => '#cc-group'
                    ]) !!}
                </div>

                <div class="form-group" id="ccv-group">
                    {!! Form::label(null, Lang::get('user.order.code')) !!}
                    {!! Form::text(null, null, [
                        'class' => 'form-control',
                        'required' => 'required',
                        'data-stripe' => 'cvc',
                        'data-parsley-type' => 'number',
                        'data-parsley-trigger' => 'change focusout',
                        'maxlength' => '4',
                        'data-parsley-class-handler' => '#ccv-group'
                    ]) !!}
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group" id="exp-m-group">
                            {!! Form::label(null, Lang::get('user.order.ex-month')) !!}
                            {!! Form::selectMonth(null, null, [
                                'class' => 'form-control',
                                'required' => 'required',
                                'data-stripe'  => 'exp-month'
                            ], '%m') !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group" id="exp-y-group">
                            {!! Form::label(null, Lang::get('user.order.ex-year')) !!}
                            {!! Form::selectYear(null, date('Y'), date('Y') + 10, null, [
                                'class' => 'form-control',
                                'required' => 'required',
                                'data-stripe' => 'exp-year'
                            ]) !!}
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <h3>@lang('user.order.total') {{ Cart::instance(Auth::user()->id)->subtotal(0) }} 
                        <span>
                            {!! Form::submit(Lang::get('user.order.title'), ['class' => 'btn btn-primary btn-order', 'id' => 'submitBtn', 'style' => 'margin-bottom: 10px;']) !!}
                        </span>
                    </h3>
                </div>

                <div class="row">
                  <div class="col-md-12">
                      <span class="payment-errors"></span>
                  </div>
                </div>

            {!! Form::close() !!}
        </div>

        {{-- Show $request errors after back-end validation --}}
        <div class="col-md-6 col-md-offset-3">
            @if($errors->all())
                <div class="alert alert-danger fade in">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4>@lang('user.order.error')</h4>
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('/js/parsleyconfig.js') }}"></script>
    <script src="{{ asset('/bower_components/parsleyjs/dist/parsley.js') }}"></script>
    <script src="{{ asset('/bower_components/stripe.js/index') }}"></script>
    <script src="{{ asset('/js/order.js') }}"></script>
    <script> 
        var order = new order();
        order.init({!! json_encode(Config::get('stripe.public_key')) !!});
    </script>
@endsection
