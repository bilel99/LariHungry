@extends('admin.layout.app-admin')
@section('content')
    <h1>Categories</h1>

    <!-- float button -->
    <a href="{{ route('admin.categories.create') }}" class="float">
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
            <th>category</th>
            <th>created</th>
            <th>actions</th>
        </tr>
        </thead>
        @foreach($categories as $row)
            <tr id="categories_{{ $row->id }}" data-id="{{ $row->id }}">
                <td>{{ $row->id }}</td>
                <td>{{ $row->title }}</td>
                <td>{{ $row->getCreateddateAttribute() }}</td>
                <td>
                    <a href="{{ route('admin.categories.edit', $row->id) }}"><i class="fas fa-edit"></i></a>
                    <form class="form-delete" method="post" action="{{ route('admin.categories.destroy', $row->id) }}">
                        @csrf
                        @method('DELETE')
                        <button class="btn-delete" type="submit"><i class="fas fa-trash-alt"></i></button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>

@endsection
