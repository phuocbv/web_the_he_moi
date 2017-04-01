@extends('layouts.user.app')

@section('content')
    <h3 align="center">@lang('user.name_shop')</h3>

    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            {!! Form::open(['route'=>'user.shop.store']) !!}
                @include('admin.shared.error')

                <div class="form-group">
                    {!! Form::label('name', Lang::get('user.label.name')) !!}
                    {!! Form::text('name', null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('address', Lang::get('user.label.address')) !!}
                    {!! Form::text('address', null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('category_id', Lang::get('user.label.category')) !!}
                    <select class="form-control" name="category_id">
                        <option value="0">@lang('admin.message.holder', ['name' => 'Category'])</option>
                        @foreach ($categories as $category)
                            <option value="{!! $category->id !!}">{!! $category->name !!}</option>
                        @endforeach
                    </select>
                </div>

                 <div class="form-group">
                    {!! Form::label('description', Lang::get('user.label.description')) !!}
                    {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::submit( Lang::get('user.create_shop'), ['class'=>'btn btn-primary']) !!}
                </div>

            {!! Form::close() !!}
        </div>
    </div>
@endsection
