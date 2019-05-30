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
                                Password {{ Auth::user()->name .' '. Auth::user()->firstname }}</h5>

                            <form method="post" action="{{ route('front.update.password', Auth::user()->id) }}">
                                @csrf
                                @method('PUT')

                                <div class="form-group">
                                    <label for="user.name">Password</label>
                                    <input type="password"
                                           class="form-control"
                                           name="password"
                                           placeholder="Password"
                                           aria-describedby="user.password user.password.error"
                                           required="required">
                                    <small id="user.password" class="form-text text-muted">please, Add to password!
                                    </small>
                                    <small id="user.password.error"
                                           class="form-text text-danger">{{ $errors->first('password') }}</small>
                                </div>

                                <div class="form-group">
                                    <label for="user.firstname">Password confirmation</label>
                                    <input type="password"
                                           class="form-control"
                                           name="password_confirmation"
                                           placeholder="Password confirmation"
                                           aria-describedby="user.password_confirmation user.password_confirmation.error"
                                           required="required">
                                    <small id="user.password_confirmation" class="form-text text-muted">please, Add to
                                        password confirmation!
                                    </small>
                                    <small id="user.password_confirmation.error"
                                           class="form-text text-danger">{{ $errors->first('password_confirmation') }}</small>
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