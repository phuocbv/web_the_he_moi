@extends('layouts.app')

@section('title')
    @lang('user.bill.title')
@endsection

@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/bill.css') }}">
@endsection

@section('content')
    <div class="container">
        <div class="container-fluid">
            <div class="col-md-8 col-md-offset-2">
                <div class="bill-title"><h3>@lang('user.bill.detail')</h3></div>
                <div class="bill-info">
                    <table>
                        <tbody>
                            <tr>
                                <td class="sub-title">@lang('user.bill.title')</td>
                                <td>@lang('user.bill.prefix'){{ $order->id }}</td>
                            </tr>

                            <tr>
                                <td class="sub-title">@lang('user.bill.date')</td>
                                <td>{{ $order->created_at }}</td>
                            </tr>

                            <tr>
                                <td class="sub-title">@lang('user.bill.status')</td>
                                <td>{{ Lang::get('user.bill.state')[$order->status] }}</td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="bill-sub-title"><h4>@lang('user.bill.summary')</h4></div>
                </div>

                <div class="bill-info">
                    <table>
                        <tbody>
                            <tr>
                                <td class="sub-title">@lang('user.bill.payment')</td>
                                <td>@lang('user.bill.payment-value')</td>
                            </tr>

                            <tr>
                                <td class="sub-title">@lang('user.bill.ship')</td>
                                <td>@lang('user.bill.ship-value')</td>
                            </tr>

                            <tr>
                                <td class="sub-title">@lang('user.bill.amount')</td>
                                <td>{{ number_format($order->total_price) }} @lang('user.cart.vnd')</td>
                            </tr>

                            <tr>
                                <td class="sub-title">@lang('user.bill.discount')</td>
                                <td>@lang('user.bill.zero')</td>
                            </tr>

                            <tr>
                                <td class="sub-title">@lang('user.bill.ship-fee')</td>
                                <td>@lang('user.bill.zero')</td>
                            </tr>

                            <tr>
                                <td class="sub-title">@lang('user.bill.total')</td>
                                <td>{{ number_format($order->total_price) }} @lang('user.cart.vnd')</td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="bill-sub-title"><h4>@lang('user.bill.customer-info')</h4></div>
                </div>

                <div class="bill-info">
                    <table>
                        <tbody>
                            <tr>
                                <td class="sub-title">@lang('user.bill.order-people')</td>
                                <td>{{ $order->user->name }}</td>
                            </tr>

                            <tr>
                                <td class="sub-title">@lang('user.bill.receiver-people')</td>
                                <td>{{ $order->receiver->name }}</td>
                            </tr>

                            <tr>
                                <td class="sub-title">@lang('user.order.address')</td>
                                <td>{{ $order->receiver->address }}</td>
                            </tr>

                            <tr>
                                <td class="sub-title">@lang('user.order.phone')</td>
                                <td>{{ $order->receiver->phone }}</td>
                            </tr>

                            <tr>
                                <td class="sub-title">@lang('user.order.email')</td>
                                <td>{{ $order->receiver->email }}</td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="bill-sub-title"><h4>@lang('user.bill.product-info')</h4></div>
                </div>

                <div width="100%">
                    <table class="table table-condensed">
                        <thead>
                            <tr class="cart_menu">
                                <td class="description">@lang('user.order.product')</td>
                                <td class="price">@lang('user.cart.price')</td>
                                <td class="quantity">@lang('user.cart.quantity')</td>
                                <td class="total">@lang('user.cart.sum')</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order->orderDetails as $key => $orderDetail)
                                <tr>
                                    <td class="cart_description">
                                        <a href="{{ route('product.show', $orderDetail->product->id) }}">{{ $orderDetail->product->name }}</a><br>
                                        <a href="{{ route('shop.show', $orderDetail->product->shop_id) }}" 
                                        class="btn btn-success" role="button">
                                            {{ $orderDetail->product->shop->name }}
                                        </a>
                                    </td>
                                    <td class="cart_price">
                                        <p>{{ number_format($orderDetail->price) }} @lang('user.cart.vnd')
                                        </p>
                                    </td>
                                    <td class="cart_quantity">
                                        <input class="cart_quantity_input" type="button" name="quantity" value="{{ $orderDetail->quantity_item }}">
                                    </td>
                                    <td class="cart_total">
                                        <p class="cart_total_price">{{ number_format($orderDetail->price * $orderDetail->quantity_item) }} @lang('user.cart.vnd')</p>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
