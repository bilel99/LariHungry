@extends('front.layout.app')
@section('content')

    <!--================Hero Banner Section start =================-->
    <section class="hero-banner hero-banner-sm">
        <div class="hero-wrapper">
            <div class="hero-left">
                <h1 class="hero-title">Contact Us</h1>
                <p>From set together our divided own saw divided the form god <br class="d-none d-xl-block"> seas moveth
                    you will fifth under replenish end</p>
                <ul class="hero-info d-none d-md-block">
                    <li>
                        <i class="fas fa-shipping-fast fa-2x"></i>
                        <h4>Fast Service</h4>
                    </li>
                    <li>
                        <i class="fas fa-hamburger fa-2x"></i>
                        <h4>Fresh Food</h4>
                    </li>
                    <li>
                        <i class="fas fa-question fa-2x"></i>
                        <h4>24/7 Support</h4>
                    </li>
                </ul>
            </div>
            <div class="hero-right">
                <div class="owl-carousel owl-theme w-100 hero-carousel">
                    <div class="hero-carousel-item">
                        <img class="img-fluid" src="{{ asset('front/images/contact-support.png') }}" alt="Contact Us">
                    </div>
                </div>
            </div>
            <ul class="social-icons d-none d-lg-block">
                <li><a href=""><i class="fab fa-facebook fa-2x"></i></a></li>
                <li><a href=""><i class="fab fa-twitter fa-2x"></i></a></li>
                <li><a href=""><i class="fab fa-instagram fa-2x"></i></a></li>
                <li><a href=""><i class="fab fa-google-plus fa-2x"></i></a></li>
                <li><a href="" target="_blank"><i class="far fa-envelope fa-2x"></i></a></li>
            </ul>
        </div>
    </section>
    <!--================Hero Banner Section end =================-->

    <!-- ================ contact section start ================= -->
    <section class="section-margin">
        <div class="container">
            <div class="d-none d-sm-block mb-5 pb-4">
                <div id="map" style="height: 480px;"></div>
                <script>
                    function initMap() {
                        var uluru = {lat: -25.363, lng: 131.044};
                        var grayStyles = [
                            {
                                featureType: "all",
                                stylers: [
                                    {saturation: -90},
                                    {lightness: 50}
                                ]
                            },
                            {elementType: 'labels.text.fill', stylers: [{color: '#A3A3A3'}]}
                        ];
                        var map = new google.maps.Map(document.getElementById('map'), {
                            center: {lat: -31.197, lng: 150.744},
                            zoom: 9,
                            styles: grayStyles,
                            scrollwheel: false
                        });
                    }

                </script>
                <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDpfS1oRGreGSBU5HHjMmQ3o5NLw7VdJ6I&callback=initMap"></script>

            </div>


            <div class="row">
                <div class="col-12">
                    <h2 class="contact-title">Get in Touch</h2>
                </div>

                <div class="col-lg-8">
                    <form method="post" action="{{ route('front.contact.store') }}">
                        @csrf
                        @method('POST')
                        <div class="form-group">
                            <label for="contact.name">name</label>
                            <input type="text" class="form-control" name="name" placeholder="name"
                                   aria-describedby="contact.name contact.name.error" required="required">
                            <small id="category.title" class="form-text text-muted">please, Add to name!</small>
                            <small id="category.name.error"
                                   class="form-text text-danger">{{ $errors->first('name') }}</small>
                        </div>

                        <div class="form-group">
                            <label for="contact.firstname">firstname</label>
                            <input type="text" class="form-control" name="firstname" placeholder="firstname"
                                   aria-describedby="contact.firstname contact.firstname.error"
                                   required="required">
                            <small id="category.firstname" class="form-text text-muted">please, Add to
                                firstname!
                            </small>
                            <small id="category.firstname.error"
                                   class="form-text text-danger">{{ $errors->first('firstname') }}</small>
                        </div>

                        <div class="form-group">
                            <label for="contact.email">email</label>
                            <input type="email" class="form-control" name="email" placeholder="email"
                                   aria-describedby="contact.email contact.email.error" required="required">
                            <small id="category.email" class="form-text text-muted">please, Add to email!
                            </small>
                            <small id="category.email.error"
                                   class="form-text text-danger">{{ $errors->first('email') }}</small>
                        </div>

                        <div class="form-group">
                            <label for="contact.sujet">sujet</label>
                            <input type="text" class="form-control" name="sujet" placeholder="sujet"
                                   aria-describedby="contact.sujet contact.sujet.error" required="required">
                            <small id="category.sujet" class="form-text text-muted">please, Add to sujet!
                            </small>
                            <small id="category.sujet.error"
                                   class="form-text text-danger">{{ $errors->first('sujet') }}</small>
                        </div>

                        <div class="form-group">
                            <label for="contact.number_phone">number phone</label>
                            <input type="text" class="form-control" name="number_phone"
                                   placeholder="number_phone"
                                   aria-describedby="contact.number_phone contact.number_phone.error">
                            <small id="category.number_phone" class="form-text text-muted">please, Add to number
                                phone!
                            </small>
                            <small id="category.number_phone.error"
                                   class="form-text text-danger">{{ $errors->first('number_phone') }}</small>
                        </div>

                        <div class="form-group">
                            <label for="contact.restaurant">restaurant</label>
                            <input type="text" class="form-control" name="restaurant" placeholder="restaurant"
                                   aria-describedby="contact.restaurant contact.restaurant.error">
                            <small id="category.restaurant" class="form-text text-muted">please, Add to
                                restaurant!
                            </small>
                            <small id="category.restaurant.error"
                                   class="form-text text-danger">{{ $errors->first('restaurant') }}</small>
                        </div>

                        <div class="form-group">
                            <label for="contact.text">text</label>
                            <textarea class="form-control"
                                      name="text"
                                      aria-describedby="contact.text contact.text.error"
                                      required="required" cols="3">Text</textarea>
                            <small id="category.text" class="form-text text-muted">please, Add to text!</small>
                            <small id="category.text.error"
                                   class="form-text text-danger">{{ $errors->first('text') }}</small>
                        </div>

                        <div class="form-group mt-3">
                            <button type="submit" class="button button-contactForm">Send Message</button>
                        </div>
                    </form>
                </div>

                <div class="col-lg-4">
                    <div class="media contact-info">
                        <span class="contact-info__icon"><i class="ti-home"></i></span>
                        <div class="media-body">
                            <h3>Buttonwood, California.</h3>
                            <p>Rosemead, CA 91770</p>
                        </div>
                    </div>
                    <div class="media contact-info">
                        <span class="contact-info__icon"><i class="ti-tablet"></i></span>
                        <div class="media-body">
                            <h3><a href="tel:454545654">00 (440) 9865 562</a></h3>
                            <p>Mon to Fri 9am to 6pm</p>
                        </div>
                    </div>
                    <div class="media contact-info">
                        <span class="contact-info__icon"><i class="ti-email"></i></span>
                        <div class="media-body">
                            <h3><a href="mailto:support@colorlib.com">support@colorlib.com</a></h3>
                            <p>Send us your query anytime!</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="large-space"></div>
            <!-- ================ FAQ section start ================= -->
            <div class="row">
                <div class="col-12">
                    <h2 class="contact-title">FAQ, Where is the Questions?</h2>
                </div>
                <div class="col-lg-4">
                    <form method="post" action="{{ route('front.faq.store') }}">
                        @csrf
                        @method('POST')
                        <div class="form-group">
                            <input type="text" class="form-control" name="question"
                                   aria-describedby="faq.question faq.question.error"
                                   placeholder="Where is your question?"
                                   required="required">
                            <small id="faq.question" class="form-text text-muted">please, Add to question!
                            </small>
                            <small id="faq.question.error"
                                   class="form-text text-danger">{{ $errors->first('question') }}</small>
                        </div>

                        <div class="form-group mt-3">
                            <button type="submit" class="button button-contactForm">Send Message</button>
                        </div>
                    </form>
                </div>
                <div class="col-lg-8">
                    @include('front.partials.faq')
                </div>
            </div>
            <!-- ================ FAQ section end ================= -->

        </div>
    </section>
    <!-- ================ contact section end ================= -->

@endsection
