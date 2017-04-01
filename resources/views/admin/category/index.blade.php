@extends("layouts.admin.app")

@section("title")
    @lang('admin.manage_category')
@endsection

@section("content")
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="page-header">
                    @lang('admin.list', ['name' => 'Category'])
                </h3>
            </div>

            <div class="col-lg-12">
                @include('admin.shared.flash')
            </div>

            @if (count($categories))
                <div class="listCategories">
                    @include('admin.category.listCategories')
                </div>
            @else
                <h4 align="center">@lang('admin.message.empty_data', ['name' => 'Category'])</h4>
            @endif
        </div>
    </div>
</div>

<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">@lang('admin.edit-category')</h4>
            </div>
            <div class="modal-form"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">@lang('admin.close')</button>
                <button type="button" class="btn btn-primary" id="btnEdit">@lang('admin.save')</button>
            </div>
        </div>
    </div>
</div>
@stop

@section('script')
    <script src="{{ asset('bower_components/blockUI/jquery.blockUI.js') }}"></script>
    <script src="{{ asset('admin/js/category.js') }}"></script>
    <script>
        var category = new category();
        category.init({
            imageAwait: '{{ asset('/images/load.gif') }}'
        });
    </script>
@endsection
