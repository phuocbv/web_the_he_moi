@if ($category)
    <div class="modal-body">
        <div class="form-group">
            <label for="category-name">@lang('admin.category-name')</label>
            <input type="text" class="form-control" id="category-name"
                placeholder="@lang('admin.category-name')" value="{{ $category->name }}">
        </div>
        <div class="form-group">
            <label for="category-name">@lang('admin.category-soft')</label>
            <select class="form-control" id="sort">
                @foreach (config('view.soft') as $key => $value)
                    <option value="{{ $value }}" {{ $value == $category->sort ? 'selected' : '' }}>{{ $value }}</option>
                @endforeach
            </select>
        </div>
        @if ($category->parent_id)
            <div class="form-group">
                <label for="category-name">@lang('admin.category-parent')</label>
                <select class="form-control" id="parent_id">
                    @foreach ($rootCategories as $key => $value)
                        <option value="{{ $value->id }}" 
                            {{ $value->id == $category->parent_id ? 'selected' : '' }}
                                data-name="{{ $value->name }}">{{ $value->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        @endif
    </div>
@endif
