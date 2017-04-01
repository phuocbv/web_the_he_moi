<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ url('/') }}">@lang('header.home')</a>
            <a class="navbar-brand" href="{{ route('shop.index') }}">@lang('shop.list-shop')</a>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                @if (Auth::guest())
                    <li><a class="shop-name" href="{{ url('/login') }}">@lang('login.login')</a></li>
                    <li><a class="shop-name" href="{{ url('/register') }}">@lang('register.register')</a></li>
                @else
                <li><a href="{{ route('user.cart.index') }}">@lang('user.cart.title')</a></li>
                <li class="dropdown">
                    <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ route('users.edit', Auth::user()) }}"><i class="fa fa-btn fa-edit">
                            @lang('header.profile')</i></a></li>
                            @if (Auth::user()->shop)
                                <li><a href="{{ route('user.shop.show', Auth::user()->shop->id) }}">
                                    <i class="fa fa-btn fa-edit">
                                    @lang('header.manage_shop')</i></a>
                                </li>
                            @else
                                <li><a href="{{ route('user.shop.create') }}">
                                <i class="fa fa-btn fa-edit">
                                    @lang('header.create_shop')</i></a>
                                </li>
                            @endif
                            <li><a id="logout" href="{{ route('logout') }}"><i class="fa fa-btn fa-sign-out"></i> @lang('header.logout')</a> 
                                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                </li>
                @endif
            </ul>
        </div>   
    </div>
</nav>
