@extends('front.layout.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="top-page-contact"></div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <!-- Form -->
            <div class="col-sm-7 col-md-7 mx-auto">
                <div class="form-create-contact">
                    <div class="card card-signin my-5">
                        <div class="card-body">
                            <h5 class="card-title text-center">Contact-me</h5>

                            <form method="post" action="{{ route('front.contact.store') }}">
                                @csrf
                                @method('POST')
                                <div class="form-group">
                                    <label for="contact.name">name</label>
                                    <input type="text" class="form-control" name="name" placeholder="name"
                                           aria-describedby="contact.name contact.name.error" required="required">
                                    <small id="category.title" class="form-text text-muted">please, Add to name!</small>
                                    <small id="category.name.error" class="form-text text-danger">{{ $errors->first('name') }}</small>
                                </div>

                                <div class="form-group">
                                    <label for="contact.firstname">firstname</label>
                                    <input type="text" class="form-control" name="firstname" placeholder="firstname"
                                           aria-describedby="contact.firstname contact.firstname.error" required="required">
                                    <small id="category.firstname" class="form-text text-muted">please, Add to firstname!</small>
                                    <small id="category.firstname.error" class="form-text text-danger">{{ $errors->first('firstname') }}</small>
                                </div>

                                <div class="form-group">
                                    <label for="contact.email">email</label>
                                    <input type="email" class="form-control" name="email" placeholder="email"
                                           aria-describedby="contact.email contact.email.error" required="required">
                                    <small id="category.email" class="form-text text-muted">please, Add to email!</small>
                                    <small id="category.email.error" class="form-text text-danger">{{ $errors->first('email') }}</small>
                                </div>

                                <div class="form-group">
                                    <label for="contact.sujet">sujet</label>
                                    <input type="text" class="form-control" name="sujet" placeholder="sujet"
                                           aria-describedby="contact.sujet contact.sujet.error" required="required">
                                    <small id="category.sujet" class="form-text text-muted">please, Add to sujet!</small>
                                    <small id="category.sujet.error" class="form-text text-danger">{{ $errors->first('sujet') }}</small>
                                </div>

                                <div class="form-group">
                                    <label for="contact.number_phone">number phone</label>
                                    <input type="text" class="form-control" name="number_phone" placeholder="number_phone"
                                           aria-describedby="contact.number_phone contact.number_phone.error">
                                    <small id="category.number_phone" class="form-text text-muted">please, Add to number phone!</small>
                                    <small id="category.number_phone.error" class="form-text text-danger">{{ $errors->first('number_phone') }}</small>
                                </div>

                                <div class="form-group">
                                    <label for="contact.restaurant">restaurant</label>
                                    <input type="text" class="form-control" name="restaurant" placeholder="restaurant"
                                           aria-describedby="contact.restaurant contact.restaurant.error">
                                    <small id="category.restaurant" class="form-text text-muted">please, Add to restaurant!</small>
                                    <small id="category.restaurant.error" class="form-text text-danger">{{ $errors->first('restaurant') }}</small>
                                </div>

                                <div class="form-group">
                                    <label for="contact.text">text</label>
                                    <textarea class="form-control"
                                              name="text"
                                              aria-describedby="contact.text contact.text.error"
                                              required="required" cols="3">Text</textarea>
                                    <small id="category.text" class="form-text text-muted">please, Add to text!</small>
                                    <small id="category.text.error" class="form-text text-danger">{{ $errors->first('text') }}</small>
                                </div>

                                <div class="form-group">
                                    <div class="btn-submit">
                                        <button type="submit" class="form-control btn btn-success">Validate</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-5 col-md-5 mx-auto">
                <div class="form-create-contact">
                    <div class="card card-signin my-5">
                        <div class="card-body">
                            <h5 class="card-title text-center">Foire Au Questions</h5>

                            <form method="post" action="{{ route('front.faq.store') }}">
                                @csrf
                                @method('POST')
                                
                                <div class="form-group">
                                    <label for="faq.question">My Question</label>
                                    <input type="text" class="form-control" name="question" aria-describedby="faq.question faq.question.error" placeholder="My Question" required="required">
                                    <small id="faq.question" class="form-text text-muted">please, Add to question!</small>
                                    <small id="faq.question.error" class="form-text text-danger">{{ $errors->first('question') }}</small>
                                </div>

                                <div class="form-group">
                                    <div class="btn-submit">
                                        <button type="submit" class="form-control btn btn-success">Validate</button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-12 col-md-12 mx-auto">
                @include('front.partials.faq')
            </div>

        </div>
    </div>
@endsection