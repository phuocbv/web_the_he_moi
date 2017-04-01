<div>
    <div class="row list-product-{{ $name }}" id="list-product">
        @foreach ($products as $key => $product)
            <div class="col-xs-3 col-sm-3 col-md-3 col-ls-3 block-product {{ $name }}">
                <div class="col-xs-12 col-sm-12 col-md-12 col-ls-12 border-shadow-right-bottom block-product-shop">
                    <a href="{{ route('product.show', $product) }}">
                        <div class="image-product">
                            @if (count($product->images) > 0)
                                <img src="{{ $product->images[0]->url }}" class="image">
                            @endif
                        </div>
                    </a>                        
                    <div class="caption">
                        <div class="product-name-shop"><a href="{{ route('product.show', $product) }}"><h4>{{ $product->name }}</h4></a></div>
                        <div class="price-and-number">
                            <span>{{ number_format($product->price, 0) }} @lang('home.currency')</span>
                            <span class="product-in-stock">@lang('shop.stock-remain') {{ $product->quantity }}</span>
                        </div>                                    
                        <div class="buy-and-comment">
                            <span>@lang('shop.sell') {{ $product->orderDetails->sum('quantity_item') }}</span>
                            <span class="comment">@lang('shop.vote') {{ count($product->rates) }}</span>
                        </div>
                    </div>                        
                    <div class="option">
                        @if (isset($remove))
                            <button class="btn btn-danger" product-id={{ $product->id }} collection-id={{ $collection->id }}>@lang('user.collection.remove')</button>
                        @else
                            <button class="btn btn-success" product-id={{ $product->id }} collection-id={{ $collection->id }}>@lang('user.collection.add')</button>  
                        @endif
                    </div>
                </div>
            </div>            
        @endforeach
    </div>
</div>
