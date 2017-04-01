<link rel="stylesheet" type="text/css" href="{{ asset('bower_components/bootstrap-star-rating/css/star-rating.css') }}">
<div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 padding-zero margin-top-20 cart" id="list-product">
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
            <div>
                <input name="input-start" value="{{ $product->point_rate }}" class="rating input-start" readonly="true">
                <input type="button" class="button btn-add-cart" product-id="{{ $product->id }}" value="@lang('categories.addCart')">
            </div>
        </div>
    @endforeach
</div>
{{ $products->links() }}
<script type="text/javascript" src="{{ asset('bower_components/bootstrap-star-rating/js/star-rating.js') }}"></script>
