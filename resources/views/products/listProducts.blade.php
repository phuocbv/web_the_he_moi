@foreach ($products as $key => $product)
    <div class="col-md-3 padding-zero block-product-category">
        <div class="height-140p">
            <a href="{{ route('product.show', $product->id) }}" class="col-md-12 img-product">
                @if (count($product->images) > 0)
                    <img src="{{ asset($product->images[0]->url) }}" class="img-product-category">
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
        <div class="cart">
            <div class="rating-container rating-md rating-animate rating-disabled">
                <div class="clear-rating " title="Clear">
                    <i class="glyphicon glyphicon-minus-sign"></i>
                </div>
                <div class="rating">
                    <span class="empty-stars">
                        <span class="star"><i class="glyphicon glyphicon-star-empty"></i></span>
                        <span class="star"><i class="glyphicon glyphicon-star-empty"></i></span>
                        <span class="star"><i class="glyphicon glyphicon-star-empty"></i></span>
                        <span class="star"><i class="glyphicon glyphicon-star-empty"></i></span>
                        <span class="star"><i class="glyphicon glyphicon-star-empty"></i></span>
                    </span>
                    <span class="filled-stars" style="width: {{ $product->point_rate * 20 }}%">
                        <span class="star"><i class="glyphicon glyphicon-star"></i></span>
                        <span class="star"><i class="glyphicon glyphicon-star"></i></span>
                        <span class="star"><i class="glyphicon glyphicon-star"></i></span>
                        <span class="star"><i class="glyphicon glyphicon-star"></i></span>
                        <span class="star"><i class="glyphicon glyphicon-star"></i></span>
                    </span>
                </div>
                <div class="caption">
                    <span class="label label-success"></span>
                </div>
                <input name="input-start" value="{{ $product->point_rate }}" class="rating input-start hide" readonly="true">
            </div>
            <input type="button" class="button btn-add-cart" product-id="{{ $product->id }}" value="@lang('categories.addCart')">
        </div>
    </div>
@endforeach
