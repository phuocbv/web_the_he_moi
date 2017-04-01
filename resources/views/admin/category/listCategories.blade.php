<table class="table table-striped table-bordered table-hover" id="dataTables-example">
    <thead>
        <tr align="center">
            <th class="colum" width="10%">@lang('admin.label.index')</th>
            <th class="colum">@lang('admin.category', ['name' => 'Name'])</th>
            <th class="colum">@lang('admin.sort')</th>
            <th class="colum" width="10%">@lang('admin.label.edit')</th>
            <th class="colum" width="10%">@lang('admin.label.action')</th>
            <th class="colum">@lang('admin.parent_category')</th>
        </tr>
    </thead>
    <tbody class="listCategories">
        @foreach ($categories as $key => $category)
            <tr class="odd gradeX" align="center">
                <td>{!! $key + 1 !!}</td>
                <td class="name">{!! $category->name !!}</td>
                <td class="sort">{!! $category->sort !!}</td>
                <td class="center" width="10%">
                    <i class="fa fa-pencil fa-fw edit" data-id="{{ $category->id }}"></i>
                </td>
                <td class="center" width="10%">
                    <i class="fa fa-trash"></i>
                </td>
                @if ($category->parent)
                    <td width="10%" class="parent">
                        {{ $category->parent->name }}
                    </td>
                @else
                    <td></td>
                @endif
            </tr>
        @endforeach
    </tbody>
</table>
{{ $categories->links() }}
