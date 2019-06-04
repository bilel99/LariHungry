@extends('admin.layout.app-admin')
@section('content')
    <h1>Newsletters</h1>

    <table class="table table-bordered table-dark">
        <thead>
        <tr>
            <th>#</th>
            <th>email</th>
            <th>status</th>
            <th>created at</th>
            <th>actions</th>
        </tr>
        </thead>
        @foreach($newsletters as $row)
            <tr>
                <td>{{ $row->id }}</td>
                <td>{{ $row->email }}</td>
                <td>
                    <form method="post" action="{{ route('admin.newsletters.change-status', $row->id) }}">
                        @csrf
                        @method('PUT')
                        @if($row->status === 0)
                            <button class="btn-to-link" type="submit">
                                <i class="fas fa-toggle-off"></i>
                            </button>
                        @else
                            <button class="btn-to-link" type="submit">
                                <i class="fas fa-toggle-on"></i>
                            </button>
                        @endif
                        {{ '('.$row->getStatus().')' }}
                    </form>
                </td>
                <td>{{ $row->getCreateddateAttribute() }}</td>
                <td>
                    <form class="form-delete" method="post" action="{{ route('admin.delete-newsletter', $row->id) }}">
                        @csrf
                        @method('DELETE')
                        <button class="btn-delete" type="submit"><i class="fas fa-trash-alt"></i></button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
@endsection
