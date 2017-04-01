<div class="table-responsive cart_info">
    @if(count($cart))
        <table class="table table-condensed">
            <thead>
                    <tr class="cart_menu">
                        <td class="description">@lang('user.cart.item')</td>
                        <td class="price">@lang('user.cart.price')</td>
                        <td class="quantity">@lang('user.cart.quantity')</td>
                        <td class="total">@lang('user.cart.sum')</td>
                        <td></td>
                    </tr>
            </thead>
            <tbody>
                @foreach($cart as $item)
                    <tr>
                        <td class="cart_description">
                            <h4><a href="{{ route('product.show', $item->id) }}">{{ $item->name }}</a></h4>
                            <a href="{{ route('shop.show', $item->options['shop_id']) }}" class="btn btn-success" 
                            role="button">{{ $item->options['shop_name'] }}</a>
                        </td>
                        <td class="cart_price">
                            <p>
                                <span>
                                    {{ number_format($item->options['old_price']) }} @lang('user.cart.vnd')
                                </span>{{ number_format($item->price) }} @lang('user.cart.vnd')
                            </p>
                        </td>
                        <td class="cart_quantity">
                            <a class="cart_quantity_up" data-id="{{ $item->rowId }}" data-quantity="{{ $item->options['quantity'] }}" data-qty="{{ $item->qty }}" href=""> + </a>
                            <input class="cart_quantity_input" type="button" name="quantity" value="{{ $item->qty }}">
                            <a class="cart_quantity_down" data-id="{{ $item->rowId }}" href=""> - </a>
                        </td>
                        <td class="cart_total">
                            <p class="cart_total_price">{{ number_format($item->subtotal) }} @lang('user.cart.vnd')</p>
                        </td>
                        <td class="cart_delete">
                            <a class="cart_quantity_delete" data-id="{{ $item->rowId }}" href="">
                                <i class="fa fa-times"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div>
            <div class="total_area">
                <a class="btn btn-danger update" href="{{ route('user.cart.clear') }}">@lang('user.cart.clear-all')</a>
                <a class="btn btn-success check_out" href="{{ route('user.order.index') }}">@lang('user.cart.checkout')</a>
            </div><br>
            <h3 >@lang('user.cart.total'): <span> {{ Cart::subtotal(0) }} @lang('user.cart.vnd')</span></h3>
            <br>
        </div> 
    @else
        <p>@lang('user.cart.no-item')</p>
        <a href="{{ url('/') }}">@lang('user.cart.shopping')</a>
    @endif       
</div>
