@foreach($collections as $key => $collection)
    <tr class="odd">
        <td class="colum">{!! ($page == null ? 0 : ($page - 1) ) * config('view.panigate-10') + $key + 1 !!}</td>
        <td class="colum name"><a href="{{ route('user.collection.show', $collection) }}" id="collection-{{ $collection->id }}" class="name">
            {!! $collection->name !!}</a></td>
        <td class="colum">{{ count($collection->products) }}</td>
        <td class="colum"><i class="fa fa-pencil fa-fw" id="edit-collection" data-id="{{ $collection->id }}"
            data-toggle="modal" data-target="#editCollection"></i></td>
        <td class="colum"><i class="fa fa-trash-o fa-fw" id="delete-collection" data-id="{{ $collection->id }}"></i></td>
    </tr>
@endforeach
