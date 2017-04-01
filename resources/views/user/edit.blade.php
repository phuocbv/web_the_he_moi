@extends('layouts.auth.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">@lang('profile.profile')</div>
                <div class="panel-body">
                    {!! Form::open(['class' => 'form-horizontal']) !!}
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            {!! Form::label('email', Lang::get('profile.email'), ['class' => 'col-md-4 control-label']) !!}
                            <div class="col-md-6">
                                {!! Form::email('email', Auth::user()->email, ['class' => 'form-control', 'disabled' => 'true']) !!}
                                @if ($errors->has('email'))
                                    <span class='help-block'>
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif                                
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            {!! Form::label('name', Lang::get('profile.fullname'), ['class' => 'col-md-4 control-label']) !!}
                            <div class="col-md-6">
                                {!! Form::text('name', Auth::user()->name, [ 'class' => 'form-control', 'id' => 'name', 'users' => Auth::user()->id]) !!}
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                            {!! Form::label('phone', Lang::get('register.phone'), ['class' => 'col-md-4 control-label']) !!}

                            <div class="col-md-6">
                                {!! Form::number('phone', Auth::user()->phone, ['class' => 'form-control', 'id' => 'phone']) !!}

                                @if ($errors->has('phone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                {!! Form::label('avatar', Lang::get('profile.avatar'), ['class' => 'col-md-4 control-label']) !!}
                                <br>
                                @if (empty(Auth::user()->avatar))
                                    {{ Html::image('/images/avatar.png', 'Image Not Found', ['class' => 'img-circle', 'id' => 'avatar', 'width' => '200', 'height' => '200']) }}
                                @else
                                    {{ Html::image(Auth::user()->avatar, '', ['class' => 'img-circle', 'id' => 'avatar', 'width' => '200', 'height' => '200', 'default' => Auth::user()->avatar]) }}
                                @endif
                                <br><br>
                                <div class="col-md-6 col-md-offset-4">
                                    <input type="file" name="fileUpload" id="fileUpload">
                                </div>           
                        </div>
                        <div class="form-group col-md-6 col-md-offset-6" id="bound">
                            <div id="progress"></div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button class="btn btn-primary">@lang('profile.update')</button>
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script src="{{ asset('/js/firebase.js') }}"></script>
    <script src="{{ asset('/js/profile.js') }}"></script>
    <script>
        var f = new firebaseCustom();
        f.init({!! json_encode(Config::get('firebase')) !!});
        var profile = new profile();
        profile.init(f);
    </script>
@endsection
