@extends('layouts.seller.app')

@section('title')
    @lang('seller.product-in-shop')
@endsection

@section('content')
    <link rel="stylesheet" href="{{ asset('user/css/listProducts.css') }}">
    <div class="speace20 margin-top-50"></div>
    <div class="container">
        <div class="row">
            <ol class="breadcrumb border-shadow-bottom">
                <li>
                    <a href="{{ route('user.user.myShop') }}">
                        @lang('seller.my-shop')
                    </a>
                </li>
            </ol>
        </div>
    </div>
    @if ($shop)
        <div class="container">
            <div class="col-xs-12 col-sm-12 col-md-12 col-ls-12 row-item row">
                <div class="col-xs-12 col-sm-12 col-md-6 col-ls-6">
                    <h4>{{ count($shop->products) }} @lang('shop.product')</h4>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 col-ls-12 row-item row">
                <input type="button" class="button btn-add-product" value="Add Product" data-toggle="modal" data-target="#addProduct">
            </div>
            <div>
                <div class="row" id="list-product">
                    @foreach ($shop->products as $key => $product)
                        <div class="col-xs-3 col-sm-3 col-md-3 col-ls-3 block-product">
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
                                    <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                    <span class="glyphicon glyphicon-trash" aria-hidden="true" data-id="{{ $product->id }}"></span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="modal fade" id="addProduct" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form>
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">@lang('shop.add-product')</h4>
                        </div>
                        <div class="modal-body">
                            
                            <div class="form-group">
                                <label for="category">@lang('product.category')</label>
                                <select class="form-control" name="category" id="category">
                                    <option value="0">@lang('shop.chosen-category')</option>
                                    @foreach ($shop->category->categories as $key => $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="collection">@lang('product.collection')</label>
                                <select class="form-control" name="collection" id="collection">
                                    <option value="0">@lang('shop.chosen-collection')</option>
                                    @foreach ($shop->collections as $key => $collection)
                                        <option value="{{ $collection->id }}">{{ $collection->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="name">@lang('product.productName')</label>
                                {!! Form::input('text', 'name', null, 
                                    ['class' => 'form-control', 'placeholder' => Lang::get('product.productName'), 'id' => 'name']) !!}
                            </div>
                            <div class="form-group">
                                <label for="price">@lang('product.price') (@lang('home.currency'))</label>
                                {!! Form::input('number', 'price', null, 
                                    ['class' => 'form-control number', 'placeholder' => Lang::get('product.price'), 'id' => 'price']) !!}
                            </div>
                            <div class="form-group">
                                <label for="code">@lang('product.code')</label>
                                {!! Form::input('text', 'code', null,
                                    ['class' => 'form-control', 'placeholder' => Lang::get('product.code'), 'id' => 'code']) !!}

                            </div>
                            <div class="form-group">
                                <label for="quantity">@lang('product.quantity')</label>
                                {!! Form::input('number', 'quantity', null,
                                    ['class' => 'form-control number', 'placeholder' => 'Quantity', 'id' => 'quantity']) !!}
                            </div>
                            <div class="form-group">
                                <label for="discount">@lang('product.discount') (@lang('product.persent'))</label>
                                {!! Form::input('number', 'discount', null,
                                    ['class' => 'form-control number', 'placeholder' => 'Discount', 'id' => 'discount']) !!}
                            </div>
                            <div class="form-group">
                                <label for="status">@lang('product.status')</label>
                                <select class="form-control" name="status" id="status">
                                    @foreach (config('view.status') as $key => $value)
                                        <option value="{{ $key }}" {{ $key == 0 ? 'selected' : '' }}>@lang('seller.' . $value)</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label for="description">@lang('product.description')</label>
                                <textarea class="form-control" rows="3" name="description" id="description"></textarea>
                            </div>
                             <div class="form-group" id="filed-image">
                                <label for="file">@lang('shop.image')</label>
                                <input type="file" id="file" name="file">
                                <input type="hidden" id="array-image" value="">
                              </div>
                            <div id="display-image-list" class="form-group">
                            </div>
                            
                        </div>
                        <div class="modal-footer">
                            <button type="reset" class="btn btn-default" data-dismiss="modal">@lang('shop.close')</button>
                            <button type="button" class="btn btn-primary" id="btn-add-edit" data-type="add">@lang('shop.add-product')</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <script type="text/javascript" src="{{ asset('bower_components/jquery.easyPaginate/lib/jquery.easyPaginate.js') }}"></script>
        <script type="text/javascript" src="{{ asset('bower_components/firebase/firebase.js') }}"></script>
        <script type="text/javascript" src="{{ asset('user/js/uploadImage.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/lang.js') }}"></script>
        <script type="text/javascript" src="{{ asset('user/js/myProducts.js') }}"></script>
        <script type="text/javascript">
            var uploadImage = new uploadImage();
            uploadImage.init({!! json_encode(Config::get('firebase')) !!});
            var myProducts = new myProducts();
            myProducts.init({
                shopId: {{ $shop->id }},
                uploadImage: uploadImage
            });
        </script>
    @endif
@endsection
