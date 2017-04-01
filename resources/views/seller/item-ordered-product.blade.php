<div class="reviene">
    @lang('seller.reviene'): {{ number_format(MyFuncs::getSumMoney($orderedProducts)) }} @lang('user.cart.vnd')
</div>
<table class="table table-striped table-bordered table-hover" id="dataTables-example">
    <thead>
        <tr>
            <th>@lang('order.id')</th>
            <th>@lang('order.product-name')</th>
            <th>@lang('order.price')</th>
            <th>@lang('order.discount')</th>
            <th>@lang('order.date')</th>
            <th>@lang('order.quantity')</th>
            <th>@lang('order.order')</th>
            <th>@lang('order.receiver')</th>
        </tr>
    </thead>
    <tbody id="list-ordered-product">
        @foreach ($orderedProducts as $key => $value)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>
                    <a href="">{{ $value->product->name }}</a>
                </td>
                <td>{{ number_format($value->product->price) }} @lang('user.cart.vnd')</td>
                <td>{{ number_format(MyFuncs::getDiscount($value->product->price, $value->product->discount)) }} @lang('user.cart.vnd')</td>
                <td>{{ $value->created_at }}</td>
                <td>{{ $value->quantity_item }}</td>
                <td>{{ $value->order->user->name }}</td>
                <td>{{ $value->order->receiver->name }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
