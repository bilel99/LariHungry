@extends('admin.layout.app-admin')
@section('content')
    <h1>Tag</h1>

    <!-- float button -->
    <a href="{{ route('admin.tag.create') }}" class="float">
        <i class="fas fa-plus my-float"></i>
    </a>
    <div class="label-container">
        <div class="label-text">Create</div>
        <i class="fa fa-play label-arrow"></i>
    </div>

    <table class="table table-bordered table-dark">
        <thead>
        <tr>
            <th>ID</th>
            <th>Tag</th>
            <th>created</th>
            <th>actions</th>
        </tr>
        </thead>
        @foreach($tag as $row)
            <tr id="tag_{{ $row->id }}" data-id="{{ $row->id }}">
                <td>{{ $row->id }}</td>
                <td>{{ $row->tag }}</td>
                <td>{{ $row->getCreateddateAttribute() }}</td>
                <td>
                    <a href="{{ route('admin.tag.edit', $row->id) }}"><i class="fas fa-edit"></i></a>
                    <form class="form-delete" method="post" action="{{ route('admin.tag.destroy', $row->id) }}">
                        @csrf
                        @method('DELETE')
                        <button class="btn-delete" type="submit"><i class="fas fa-trash-alt"></i></button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>

@endsection
