@extends('admin.layout.app-admin')
@section('content')
    <h1>Users</h1>

    <table class="table table-bordered table-dark">
        <thead>
        <tr>
            <th>ID</th>
            <th>name</th>
            <th>email</th>
            <th>roles</th>
            <th>created</th>
            <th>actions</th>
        </tr>
        </thead>
        @foreach($user as $row)
            <tr id="user_{{ $row->id }}" data-id="{{ $row->id }}">
                <td>{{ $row->id }}</td>
                <td>{{ $row->name }}</td>
                <td>{{ $row->email }}</td>
                <td>
                    @if($row->id !== Auth::user()->id)
                        <form class="form-edit" method="post"
                              action="{{ route('admin.user.changeOwner', $row->id) }}">
                            @csrf
                            @method('PUT')

                            <button class="btn-edit" type="submit">
                                @if(unserialize($row->roles)[0] === 'ROLE_ADMIN')
                                    <i class="fas fa-crown"></i>
                                @else
                                    <i class="fas fa-user"></i>
                                @endif
                            </button>
                        </form>
                    @else
                        <i class="fas fa-crown"></i>
                    @endif
                </td>
                <td>{{ $row->getCreateddateAttribute() }}</td>
                <td>
                    <a href="{{ route('admin.user.show', $row->id) }}"><i class="fas fa-book-reader"></i></a>
                </td>
            </tr>
        @endforeach
    </table>

@endsection
