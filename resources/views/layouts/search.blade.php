<div class='container'>
    <div class="head-top col-md-12 col-sm-12 col-xs-12 row">
        <div class="col-md-8 col-sm-8 col-xs-8 row">
            <a href="{{ route('home') }}" class="img-responsive">
                <img src="{{ asset('images/logo.png') }}">
            </a>
        </div>
        <div class="col-md-4 col-sm-4 col-xs-4">
            {!! Form::open(['route' => 'searchProduct', 'class' => 'header-search col-md-12 col-sm-12 col-xs-12', 'method' => 'get']) !!}
                <div class="input-group">
                    {!! Form::text('search', null, ['class' => 'form-control search', 'placeholder' => 'Search']) !!}
                    <div class="input-group-btn">
                        <button class="btn btn-default" type="submit">
                            <i class="glyphicon glyphicon-search"></i>
                        </button>
                    </div>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
