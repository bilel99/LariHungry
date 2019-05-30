@extends('front.layout.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="top-page-contact"></div>
        </div>
    </div>

    <div class="container">
        <div class="row">

            <div class="col-sm-5 col-md-5">
                @include('front.partials.profil-settings')
            </div>

            <!-- Form -->
            <div class="col-sm-7 col-md-7 mx-auto">
                <div class="form-edit-account">
                    <div class="card card-signin my-5">
                        <div class="card-body">
                            <h5 class="card-title text-center">Edit
                                account {{ Auth::user()->name .' '. Auth::user()->firstname }}</h5>

                            <form method="post" action="{{ route('front.update.account', Auth::user()->id) }}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="form-group">
                                    <label for="user.name">Name</label>
                                    <input type="text"
                                           class="form-control"
                                           name="name"
                                           value="{{ Auth::user()->name }}"
                                           placeholder="Name"
                                           aria-describedby="user.name user.name.error"
                                           required="required">
                                    <small id="user.name" class="form-text text-muted">please, Add to name!</small>
                                    <small id="user.name.error"
                                           class="form-text text-danger">{{ $errors->first('name') }}</small>
                                </div>

                                <div class="form-group">
                                    <label for="user.firstname">Firstname</label>
                                    <input type="text"
                                           class="form-control"
                                           name="firstname"
                                           value="{{ Auth::user()->firstname }}"
                                           placeholder="Firstname"
                                           aria-describedby="user.firstname user.firstname.error"
                                           required="required">
                                    <small id="user.firstname" class="form-text text-muted">please, Add to firstname!</small>
                                    <small id="user.firstname.error"
                                           class="form-text text-danger">{{ $errors->first('firstname') }}</small>
                                </div>

                                <div class="form-group">
                                    <label for="user.email">Email</label>
                                    <input type="email"
                                           class="form-control"
                                           name="email"
                                           value="{{ Auth::user()->email }}"
                                           placeholder="Email"
                                           aria-describedby="user.email user.email.error"
                                           required="required">
                                    <small id="user.email" class="form-text text-muted">please, Add to email!</small>
                                    <small id="user.email.error"
                                           class="form-text text-danger">{{ $errors->first('email') }}</small>
                                </div>

                                <div class="form-group">
                                    <label for="user.media">Media file</label>
                                    <input type="file"
                                           class="form-control"
                                           name="media"
                                           placeholder="Media"
                                           aria-describedby="user.media user.media.error">
                                    <small id="user.media" class="form-text text-muted">please, Add to media!</small>
                                    <small id="user.media.error"
                                           class="form-text text-danger">{{ $errors->first('media') }}</small>
                                </div>


                                <button class="btn btn-lg btn-primary btn-block text-uppercase"
                                        type="submit">Validate
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection