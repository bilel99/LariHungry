@extends('front.layout.app')
@section('content')
    <!--================Hero Banner Section start =================-->
    <section class="hero-banner">
        <div class="hero-wrapper">
            <div class="hero-left">
                <h1 class="hero-title">Foods the <br> most precious things</h1>
                <div class="d-sm-flex flex-wrap">
                    <a class="button button-hero button-shadow" href="#">Link</a>
                </div>
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
                <div class="owl-carousel owl-theme hero-carousel">
                    <div class="hero-carousel-item">
                        <img class="img-fluid" src="{{ asset('front/images/contact-support.png') }}" alt="Image 1">
                    </div>
                    <div class="hero-carousel-item">
                        <img class="img-fluid" src="{{ asset('front/images/contact-support.png') }}" alt="Image 2">
                    </div>
                    <div class="hero-carousel-item">
                        <img class="img-fluid" src="{{ asset('front/images/contact-support.png') }}" alt="Image 3">
                    </div>
                    <div class="hero-carousel-item">
                        <img class="img-fluid" src="{{ asset('front/images/contact-support.png') }}" alt="Image 4">
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

    <!--================About Section start =================-->
    <section class="about section-margin pb-xl-70">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-xl-6 mb-5 mb-md-0 pb-5 pb-md-0">
                    <div class="img-styleBox">
                        <div class="styleBox-border">
                            <img class="styleBox-img1 img-fluid" src="{{ asset('front/images/about-img1.png') }}"
                                 alt="About image 1">
                        </div>
                        <img class="styleBox-img2 img-fluid" src="{{ asset('front/images/about-img2.png') }}"
                             alt="About image 2">
                    </div>
                </div>
                <div class="col-md-6 pl-md-5 pl-xl-0 offset-xl-1 col-xl-5">
                    <div class="section-intro mb-lg-4">
                        <h4 class="intro-title">About Us</h4>
                        <h2>We speak the good food language</h2>
                    </div>
                    <p>Living first us creepeth she'd earth second be sixth hath likeness greater image said sixth was
                        without male place fowl evening an grass form living fish and rule lesser for blessed can't saw
                        third one signs moving stars light divided was two you him appear midst cattle for they are
                        gathering.</p>
                    <a class="button button-shadow mt-2 mt-lg-4" href="#">Learn More</a>
                </div>
            </div>
        </div>
    </section>
    <!--================About Section End =================-->

    <!--================List Restaurants start ============-->
    <section class="section-margin">
        <div class="container">
            <div class="row">
                <div class="col-md-6 pl-md-5 pl-xl-0 offset-xl-1 col-xl-5">
                    <div class="section-intro mb-lg-4">
                        <h4 class="intro-title">List of restaurants</h4>
                    </div>
                </div>
                <div class="list-restaurants row col-12">
                    @forelse($restaurants as $key => $row)
                        <div class="col-4">
                            <a class="link-list-restaurant" href="{{ route('front.restaurant.show', $row->id) }}">
                                <div class="card">
                                    @if(count($row->medias) > 0)
                                        <img src="{{ asset('uploads/restaurants/' . $images[$key]) }}" class="card-img"
                                             alt="Restaurant view" width="250" height="250">
                                    @else
                                        {{-- default image --}}
                                        <img src="{{ asset('front/images/default-image-restaurant.jpg') }}"
                                             class="card-img"
                                             alt="default image" width="250" height="250">
                                    @endif
                                    <div class="card-img-overlay" style="z-index: 1">
                                        @foreach($row->categories as $c)
                                            @if($c !== null)
                                                <span class="badge badge-pill badge-primary">{{ $c->title }}</span>
                                            @endif
                                        @endforeach

                                        @foreach($row->tags as $t)
                                            @if($t !== null)
                                                <span class="badge badge-pill badge-primary">{{ $t->tag }}</span>
                                            @endif
                                        @endforeach
                                    </div>
                                    <div class="card-body">
                                        <h4 class="card-title">{{ $row->title }}</h4>
                                        <small class="text-muted cat">
                                            <i class="fas fa-euro-sign"></i> {{ $row->price }} prix moy.
                                            <i class="fas fa-grip-lines-vertical"></i>
                                            <i class="fas fa-people-carry"></i> 21 avis
                                        </small>
                                        <p class="card-text">{{ mb_strimwidth($row->description, 0, 50, '...') }}</p>
                                    </div>
                                    <div class="card-footer text-muted d-flex justify-content-between bg-transparent border-top-0">
                                        <div class="views">
                                            <i class="fas fa-map-marker-alt"></i>
                                            {{ $row->adress }}, {{ $row->ville->libelle }} {{ $row->ville->zipcode }}
                                        </div>
                                        <div class="stats">
                                            <i class="fas fa-sort-numeric-up"></i> 10 /10
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @empty
                        <p>No restaurant at the moment!</p>
                    @endforelse
                </div>
            </div>
        </div>
    </section>
    <!--===================List Restaurants End=================-->

    <!--================Food menu section start =================-->
    <section class="section-margin">
        <div class="container">
            <div class="section-intro mb-75px">
                <h4 class="intro-title">The Best Restaurant of the moment</h4>
                <h2>Delicious food</h2>
            </div>
            <div class="row">

                <div class="col-lg-6">
                    <div class="media align-items-center food-card">
                        <i class="mr-3 mr-sm-4 fas fa-hamburger fa fa-2x"></i>
                        <div class="media-body">
                            <div class="d-flex justify-content-between food-card-title">
                                <h4>Roasted Marrow</h4>
                                <h3 class="price-tag">$32</h3>
                            </div>
                            <p>Whales and darkness moving form cattle</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="media align-items-center food-card">
                        <i class="mr-3 mr-sm-4 fas fa-hamburger fa fa-2x"></i>
                        <div class="media-body">
                            <div class="d-flex justify-content-between food-card-title">
                                <h4>Roasted Marrow</h4>
                                <h3 class="price-tag">$32</h3>
                            </div>
                            <p>Whales and darkness moving form cattle</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="media align-items-center food-card">
                        <i class="mr-3 mr-sm-4 fas fa-hamburger fa fa-2x"></i>
                        <div class="media-body">
                            <div class="d-flex justify-content-between food-card-title">
                                <h4>Roasted Marrow</h4>
                                <h3 class="price-tag">$32</h3>
                            </div>
                            <p>Whales and darkness moving form cattle</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="media align-items-center food-card">
                        <i class="mr-3 mr-sm-4 fas fa-hamburger fa fa-2x"></i>
                        <div class="media-body">
                            <div class="d-flex justify-content-between food-card-title">
                                <h4>Roasted Marrow</h4>
                                <h3 class="price-tag">$32</h3>
                            </div>
                            <p>Whales and darkness moving form cattle</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!--================Food menu section end =================-->

    <a href="{{ route('front.restaurant.create') }}" class="float">
        <i class="fas fa-plus my-float"></i>
    </a>
    <div class="label-container">
        <div class="label-text">Ajouter un restaurant</div>
        <i class="fa fa-play label-arrow"></i>
    </div>

@endsection
