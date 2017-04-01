@extends('layouts.user.app')

@section('content')
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
        <div class='col-lg-12'>
            <h3 align="center">@lang('user.manage', ['name' => 'Collection'])</h3>
        </div>

        <div class="col-md-6 col-md-offset-3">
            {!! Form::open(['route' => 'user.collection.store']) !!}
                @include('admin.shared.error')

                <div class="form-group">
                    {!! Form::label('name', Lang::get('user.label.name')) !!}
                    {!! Form::text('name', null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::submit(Lang::get('user.save'), ['class' => 'btn btn-primary']) !!}
                </div>

            {!! Form::close() !!}
        </div>

    <div class="col-lg-12">
        @include('admin.shared.flash')
    </div>
    
    <div>
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
                <tbody>
                    @foreach($collections as $key => $collection)
                        <tr>
                            <td class="colum">{!! $key + 1 !!}</td>
                            <td class="colum"><a href="{{ route('user.collection.show', $collection) }}" id="collection-{{ $collection->id }}">{!! $collection->name !!}</a></td>
                            <td class="colum">{{ count($collection->products) }}</td>
                            <td class="colum"><i class="fa fa-pencil fa-fw"></i>
                                <a href="javascript:void(0)" data-toggle="modal" data-target=".bs-example-modal-lg" data-id="{{ $collection->id }}" data-name="" class="update">
                                    @lang('user.edit')
                                </a>
                            </td>
                            <td class="colum"><i class="fa fa-trash-o fa-fw"></i>
                                <a href="javascript:void(0)" 
                                    data-id="{!! $collection->id !!}" 
                                    value="{!! $collection->id !!}" 
                                    class="delete">
                                    @lang('user.delete')
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif 
    </div>

    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <h3 align="center">@lang('user.title_edit', ['name' => 'Collection'])</h3>
            <div class="form-group edit-collection">
                {!! Form::label('name', Lang::get('user.label.name')) !!}
                {!! Form::text('name', null, ['class' => 'form-control', 'id' => 'nameCollection']) !!}
            </div>

            <div class="form-group edit-collection">
                {!! Form::submit(Lang::get('user.update'), ['class' => 'btn btn-primary', 'id' => 'btnUpdateCollection']) !!}
            </div>
            </div>
        </div>
    </div>
  </div>
</div>
<script src="{{ asset('/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script type="text/javascript" src="{!! asset('js/collection.js') !!}"></script>
<script src="{{ asset('/js/dttable.js') }}"></script>
<script type="text/javascript">
    var dttable = new dttable();
    dttable.init('#dataTables-example');
    var collection = new collection;
    collection.init(dttable.getTable());
</script>
@stop
