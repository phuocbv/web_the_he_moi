<div class="col-md-12" id="product-over">
    <h3><i>@lang('user.collection.product-in')</i></h3>
    @include('user.collection.product', ['products' => $collection->products,
        'remove' => 0, 'name' => 'over'])        
</div>

<div class="col-md-12" id="product-under">            
    <h3><i>@lang('user.collection.product-out')</i></h3>
    @include('user.collection.product', ['products' => $shop->products, 'name' => 'under'])    
</div>
