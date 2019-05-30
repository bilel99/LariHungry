@extends('admin.layout.app-admin')
@section('content')
    <h1>Demande de contact</h1>

    <table class="table table-bordered table-dark">
        <thead>
        <tr>
            <th>ID</th>
            <th>name</th>
            <th>email</th>
            <th>sujet</th>
            <th>done</th>
            <th>created</th>
            <th>actions</th>
        </tr>
        </thead>
        @foreach($contact as $row)
            <tr id="contact_{{ $row->id }}" data-id="{{ $row->id }}">
                <td>{{ $row->id }}</td>
                <td>{{ $row->name }}</td>
                <td>{{ $row->email }}</td>
                <td>{{ $row->sujet }}</td>
                <td>
                    <form class="form-edit" method="post" action="{{ route('admin.contact.changeStatus', $row->id) }}">
                        @csrf
                        @method('PUT')
                        <button class="btn-edit" type="submit">
                            {!! $row->done === 1 ? '<i class="fas fa-toggle-on"></i>' : '<i class="fas fa-toggle-off"></i>' !!}
                        </button>
                    </form>
                </td>
                <td>{{ $row->getCreateddateAttribute() }}</td>
                <td>
                    <a class="btn-show" href="{{ route('admin.contact.show', $row->id) }}"><i
                                class="fas fa-book-reader"></i></a>

                    <form class="form-delete" method="post" action="{{ route('admin.contact.destroy', $row->id) }}">
                        @csrf
                        @method('DELETE')
                        <button class="btn-delete" type="submit"><i class="fas fa-trash-alt"></i></button>
                    </form>

                </td>
            </tr>
        @endforeach
    </table>

@endsection
