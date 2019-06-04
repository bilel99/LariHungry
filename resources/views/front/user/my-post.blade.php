@extends('front.layout.app')
@section('content')
    <div class="container">
        <div class="row">

            <div class="col-sm-5 col-md-5">
                @include('front.partials.profil-settings')
            </div>

            <!-- table -->
            <div class="col-sm-7 col-md-7 mx-auto">
                <table class="table table-striped table-borderless table-dark">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">name</th>
                        <th scope="col">Ville - Address</th>
                        <th scope="col">Category</th>
                        <th scope="col">price</th>
                        <th scope="col">created at</th>
                        <th scope="col">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($restaurants as $row)
                        <tr>
                            <th>{{ $row->id }}</th>
                            <th>{{ $row->title }}</th>
                            <th>{{ $row->ville->libelle . ' - ' . $row->adress }}</th>
                            <th>{{ $row->categories[0]->title }}</th>
                            <th>{{ $row->price }}</th>
                            <th>{{ $row->getCreateddateAttribute() }}</th>
                            <th>
                                <a class="btn-show" href="{{ route('front.restaurant.show', $row->id) }}">
                                    <i class="far fa-eye"></i>
                                </a>
                                <a class="btn-edit" href="{{ route('front.restaurant.edit', $row->id) }}">
                                    <i class="fas fa-pencil-alt"></i>
                                </a>
                                @if($row->user_id === Auth::user()->id)
                                    <form class="form-delete" action="{{ route('front.restaurant.destroy', $row->id) }}"
                                          method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn-delete btn-to-link" type="submit">
                                            <i class="far fa-trash-alt"></i>
                                        </button>
                                    </form>
                                @endif
                            </th>
                        </tr>
                    @empty
                        <span>Not created post!</span>
                    @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
@endsection
