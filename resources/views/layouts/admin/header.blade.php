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
            <a class="navbar-brand" href="{{ url('/admin/users') }}">@lang('admin.users')</a>
            <a class="navbar-brand" href="{{ url('/admin/category') }}">@lang('admin.categories')</a>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ route('users.edit', Auth::user()) }}"><i class="fa fa-btn fa-edit">
                             @lang('header.profile')</i></a></li>
                            <li><a id="logout" href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i> @lang('header.logout')</a> 
                                <form id="logout-form" action="{{ url('/logout') }}" method="POST">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                </li>
            </ul>
        </div>   
    </div>
</nav>
