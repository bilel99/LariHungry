@extends('front.layout.app')
@section('content')
    <div class="container">
        <div class="row">

            <div class="col-sm-5 col-md-5">
                @include('front.partials.profil-settings')
            </div>

            <!-- table -->
            <div class="col-sm-7 col-md-7 mx-auto">
                @if(count($comments) > 0)
                    <table class="table table-striped table-borderless table-dark table-responsive">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">comment</th>
                            <th scope="col">user</th>
                            <th scope="col">restaurant</th>
                            <th scope="col">created at</th>
                            <th scope="col">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($comments as $row)
                            <tr>
                                <th>{{ $row->id }}</th>
                                <th>{{ mb_strimwidth($row->comment, 0, 15, '...') }}</th>
                                <th>{{ $row->user->name.' '.$row->user->firstname }}</th>
                                <th>{{ $row->getCreateddateAttribute() }}</th>
                                <th>
                                    @include('front.modals.show-comment')
                                    <a class="btn-show" href="" data-toggle="modal"
                                       data-target="#showCommentModal{{ $row->id }}">
                                        <i class="far fa-eye"></i>
                                    </a>
                                    @if($row->user_id === Auth::user()->id)
                                        <form class="form-delete"
                                              action="{{ route('front.comment.destroy', $row->id) }}"
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
                            <span>Not created comment!</span>
                        @endforelse
                        </tbody>
                    </table>
                @else
                    <span>Not created comment!</span>
                @endif
            </div>
        </div>
    </div>
@endsection
