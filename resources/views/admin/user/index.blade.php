@extends("layouts.admin.app")

@section('title')
    @lang('admin.user.manage')
@endsection

@section("content")
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="page-header">
                    @lang('admin.list', ['name' => 'User'])
                </h3>
            </div>

            <div class="col-lg-12">
                @include('admin.shared.flash')
            </div>

            @if (count($users))
                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                        <tr align="center">
                            <th class="colum" width="5%">@lang('admin.label.index')</th>
                            <th class="colum">@lang('admin.user.name')</th>
                            <th class="colum">@lang('admin.user.email')</th>
                            <th class="colum">@lang('admin.user.phone')</th>
                            <th class="colum">@lang('admin.user.avatar')</th>
                            <th class="colum">@lang('admin.user.active')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $key => $user)
                            <tr class="odd gradeX" align="center">
                                <td>{!! $key + 1 !!}</td>
                                <td><a href="#">{!! $user->name !!}</a></td>
                                <td>{!! $user->email !!}</td>
                                <td>{!! $user->phone !!}</td>
                                @if (empty($user->avatar))
                                    <td>{!! Html::image(Lang::get('admin.user.default-avatar'), Lang::get('admin.user.none'), 
                                            ['width' => '100px', 'height' => '100px']) !!}</td>
                                @else
                                    <td>{!! Html::image($user->avatar, Lang::get('admin.user.none'), 
                                            ['width' => '100px', 'height' => '100px']) !!}</td>
                                @endif
                                @if($user->id != Auth::user()->id)
                                    <td class="center">
                                        {!! Form::open(['method' => 'PATCH', 'route' => ['admin.users.update', $user] ]) !!}
                                            @if ($user->is_active)
                                                {!! Form::submit(Lang::get('admin.user.actived'), ['class' => 'btn btn-default']) !!}
                                            @else
                                                {!! Form::submit(Lang::get('admin.user.active'), ['class' => 'btn btn-primary']) !!}
                                            @endif
                                        {!! Form::close() !!}
                                    </td>
                                @else
                                    <td></td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <h4 align="center">@lang('admin.message.empty_data', ['name' => 'Category'])</h4>
            @endif
        </div>
    </div>
</div>
@stop

@section('script')
    <script src="{{ asset('/bower_components/sweetalert2/dist/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('/js/users.js') }}"></script>
    <script src="{{ asset('/js/dttable.js') }}"></script>
    <script src="{{ asset('/js/category.js') }}"></script>
    <script>
        var users = new users();
        users.init();
        var dttable = new dttable();
        dttable.init('#dataTables-example');
    </script>
@stop
