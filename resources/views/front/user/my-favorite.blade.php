@extends('front.layout.app')
@section('content')
    <div class="container">
        <div class="row">

            <div class="col-sm-5 col-md-5">
                @include('front.partials.profil-settings')
            </div>

            <!-- table -->
            <div class="col-sm-7 col-md-7 mx-auto">
                @if(count($fav) > 0)
                    <table class="table table-striped table-borderless table-dark table-responsive">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">user</th>
                            <th scope="col">restaurant</th>
                            <th scope="col">Favorite</th>
                            <th scope="col">created at</th>
                            <th scope="col">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($fav as $row)
                            <tr>
                                <th>{{ $row->id }}</th>
                                <th>{{ $row->user->name .' '. $row->user->firstname }}</th>
                                <th>{{ $row->restaurant->title }}</th>
                                <th>{{ $row->fav == true ? 'Favorite' : 'Not Favorite' }}</th>
                                <th>{{ $row->getCreateddateAttribute() }}</th>
                                <th>
                                    <a class="btn-show"
                                       href="{{ route('front.restaurant.show', $row->restaurant->id) }}">
                                        <i class="far fa-eye"></i>
                                    </a>
                                    @if(Auth::user()->id === $row->user_id)
                                        <form class="form-delete"
                                              action="{{ route('front.fav.destroy', $row->id) }}"
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
                        @endforeach
                        </tbody>
                    </table>
                @else
                    <span>Not favorite existing!</span>
                @endif
            </div>
        </div>
    </div>
@endsection
