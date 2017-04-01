@extends('layouts.seller.app')

@section('title')
    @lang('collection.my-collection')
@endsection

@section('content')
<link rel="stylesheet" href="{{ asset('user/css/collection.css') }}">
<div class="container">
    <div class="speace50"></div>
    <div class="row margin-top-20">
        <ol class="breadcrumb border-shadow-bottom">
            <li>
                <a href="{{ route('user.user.myShop') }}">
                    @lang('seller.my-shop')
                </a>
            </li>
        </ol>
    </div>
    <div class="row">
        <input type="button" class="button btn-add-product" value="@lang('collection.add-collection')"
            data-toggle="modal" data-target="#addCollection">
    </div>   
    <div class="row">
        @if (count($collections))
            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                    <tr align="center">
                        <th class="colum" width="10%">@lang('user.index')</th>
                        <th class="colum">@lang('user.label.name')</th>
                        <th class="colum">@lang('user.collection.total-product')</th>
                        <th class="colum" width="10%">@lang('user.edit')</th>
                        <th class="colum" width="10%">@lang('user.delete')</th>
                    </tr>
                </thead>
                <tbody class="item-collection">
                    @include('seller-chanel.itemCollection')
                </tbody>
            </table>
            <div class="paginate"></div>
        @else
            @lang('collection.have-not-collection')
        @endif
    </div>

    <div class="modal fade" id="addCollection" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form>
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">@lang('collection.add-collection')</h4>
                    </div>
                    <div class="modal-body">     
                        <div class="form-group">
                            <label for="name">@lang('collection.collection-name')</label>
                            {!! Form::input('text', 'name', null, 
                                ['class' => 'form-control', 'placeholder' => Lang::get('collection.collection-name'), 'id' => 'nameCollection']) !!}
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-default" data-dismiss="modal">@lang('collection.close')</button>
                        <button type="button" class="btn btn-primary" id="btn-add" data-type="add">@lang('collection.add-collection')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editCollection" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">@lang('collection.edit-collection')</h4>
                </div>
                <div class="modal-body">     
                    <div class="form-group">
                        <label for="name">@lang('collection.collection-name')</label>
                        {!! Form::input('text', 'name', null, 
                            ['class' => 'form-control', 'placeholder' => Lang::get('collection.collection-name'), 'id' => 'nameCollectionEdit']) !!}
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">@lang('collection.close')</button>
                    <button type="button" class="btn btn-primary" id="btn-edit">@lang('collection.edit-collection')</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('bower_components/blockUI/jquery.blockUI.js') }}"></script>
<script src="{!! asset('seller/js/collection.js') !!}"></script>
<script type="text/javascript">
    var collection = new collection;
    collection.init({
        items: {{ count($sum) }},
        itemsOnPage: {{ config('view.panigate-10') }},
        imageAwait: '{{ asset('images/load.gif') }}',
    });
</script>
@stop
