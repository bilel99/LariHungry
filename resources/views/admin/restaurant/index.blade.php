@extends('admin.layout.app-admin')
@section('content')
    <h1>Restaurants</h1>

    <!-- float button -->
    <a href="{{ route('admin.restaurant.create') }}" class="float">
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
            <th>title</th>
            <th>ville</th>
            <th>adress</th>
            <th>create by</th>
            <th>created at</th>
            <th>actions</th>
        </tr>
        </thead>
        @foreach($restaurants as $row)
            <tr id="restaurant_{{ $row->id }}" data-id="{{ $row->id }}">
                <td>{{ $row->id }}</td>
                <td>{{ $row->title }}</td>
                <td>{{ $row->ville->libelle }}</td>
                <td>{{ $row->adress }}</td>
                <td>{{ $row->user->email }}</td>
                <td>{{ $row->getCreateddateAttribute() }}</td>
                <td>
                    <a class="btn-show" href="{{ route('admin.restaurant.show', $row->id) }}"><i
                                class="fas fa-book-reader"></i></a>
                    <a class="btn-edit" href="{{ route('admin.restaurant.edit', $row->id) }}"><i class="fas fa-edit"></i></a>
                    <form class="form-delete" method="post" action="{{ route('admin.restaurant.destroy', $row->id) }}">
                        @csrf
                        @method('DELETE')
                        <button class="btn-delete" type="submit"><i class="fas fa-trash-alt"></i></button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>

@endsection
