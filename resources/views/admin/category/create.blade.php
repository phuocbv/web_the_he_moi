@extends('layouts.admin.app')

@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-lg-offset-1">
                <h3 class="page-header">
                    @lang('admin.add')
                    @lang('admin.lb_category')
                </h3>
            </div>

            <div class="col-lg-7 col-lg-offset-1">
                {!! Form::open(['route' => 'admin.category.store']) !!}
                    @include('admin.shared.error')
                    @include('admin.shared.flash')

                    <div class="form-group">
                        {!! Form::label('name', Lang::get('admin.category', ['name' => 'Name'])) !!}
                        {!! Form::text('name', null, [
                            'class' => 'form-control',
                            'placeholder' => Lang::get('admin.message.enter', ['name' => 'Name'])
                        ])!!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('parent_id', Lang::get('admin.category', ['name' => 'Parent'])) !!}
                        <select class="form-control" name="parent_id">
                            <option value="0">@lang('admin.message.holder', ['name' => 'Category'])</option>
                            {!! cateParent($parents) !!} 
                        </select>
                    </div>

                    <div class="form-group">
                        {!! Form::label('sort', Lang::get('admin.sort')) !!}
                        {!! Form::text('sort', null, [
                            'class' => 'form-control',
                            'placeholder' => Lang::get('admin.message.enter', ['name' => 'Sort'])
                        ])!!}
                    </div>

                    <div class="form-group">
                        {!! Form::submit(Lang::get('admin.button.add', ['name' => 'Category']),
                            ['class' => 'btn btn-primary']) !!}
                    </div>

                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@stop
