@extends('layouts.auth.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">@lang('login.login')</div>
                        @if ($message = Session::get('success'))
                            <div class="alert alert-success">
                                <p>{{ $message }}</p>
                            </div>
                        @endif

                        @if ($message = Session::get('warning'))
                            <div class="alert alert-warning">
                                <p>{{ $message }}</p>
                            </div>
                        @endif
                    <div class="panel-body">
                        {!! Form::open([
                            'url' => '/login',
                            'method' => 'post',
                            'class' => 'form-horizontal'
                        ]) !!}
                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                {!! Form::label('email', Lang::get('register.email'), ['class' => 'col-md-4 control-label']) !!}
                                <div class="col-md-6">
                                    {!! Form::email('email', null, ['class' => 'form-control']) !!}
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                {!! Form::label('password', Lang::get('register.password'), ['class' => 'col-md-4 control-label']) !!}
                                <div class="col-md-6">
                                    {!! Form::password('password', ['class' => 'form-control']) !!}
                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <div class="checkbox">
                                        <label>
                                            {!! Form::checkbox('remember', null) !!}@lang('login.remember-me')
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    {!! Form::submit(Lang::get('login.login'), ['class' => 'btn btn-primary']) !!}
                                    <a class="btn btn-link" href="{{ url('/password/reset') }}">@lang('login.forgot-your-password')</a>
                                </div>
                            </div>
                        {!! Form::close() !!}
                        <div class="form-group col-md-offset-4">
                            <a class="btn btn-primary" href="{{ route('provider.redirect', ['provider' => 'facebook']) }}">@lang('social.login.facebook')</a>
                            <a class="btn btn-danger" href="{{ route('provider.redirect', ['provider' => 'google']) }}">@lang('social.login.google')</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
