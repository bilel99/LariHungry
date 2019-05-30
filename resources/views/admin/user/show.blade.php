@extends('admin.layout.app-admin')
@section('content')
    <div class="card mb-3 {{ $user->is_active === 1 ? 'border-success' : 'border-danger' }}">
        <div class="row no-gutters">
            <div class="col-md-4">
                <img src="{{ asset('front/images/default-image-restaurant.jpg') }}" class="card-img" alt="user avatar">
            </div>
            <div class="col-md-8">
                <div class="card-body {{ $user->is_active === 1 ? 'text-success' : 'text-danger' }}">
                    @if($user->id !== Auth::user()->id)
                        <form class="form-edit" method="post"
                              action="{{ route('admin.user.changeStatus', $user->id) }}">
                            @csrf
                            @method('PUT')
                            <button class="btn-edit" type="submit">
                                <span class="badge {{ $user->is_active === 1 ? 'badge-success' : 'badge-danger' }}">{{ $user->getIsActive() }}</span>
                            </button>
                        </form>
                    @else
                        <span class="badge {{ $user->is_active === 1 ? 'badge-success' : 'badge-danger' }}">{{ $user->getIsActive() }}</span>
                    @endif

                    @if($user->id !== Auth::user()->id)
                        <form class="form-edit" method="post" action="{{ route('admin.user.changeOwner', $user->id) }}">
                            @csrf
                            @method('PUT')
                            <button class="btn-edit-float-right" type="submit">
                                <span class="badge {{ $user->getRole() === 'ROLE_ADMIN' ? 'badge-success' : 'badge-primary' }}">{{ $user->getRole() }}</span>
                            </button>
                        </form>
                    @else
                        <span class="float-right badge {{ $user->getRole() === 'ROLE_ADMIN' ? 'badge-success' : 'badge-primary' }}">{{ $user->getRole() }}</span>
                    @endif
                    <h5 class="card-title">{{ $user->name . ' ' . $user->firstname }} </h5>
                    <p class="card-text">{{ $user->email }}</p>
                    <p class="card-text">
                        <small class="text-muted">Créer le {{ $user->getCreateddateAttribute() }}</small>
                    </p>
                    <div class="action-deleted">
                        <form method="post" action="{{ route('admin.user.delete', $user->id) }}">
                            @csrf
                            @method('DELETE')
                            <button class="col-md-12 btn btn-danger">Deleted User</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection