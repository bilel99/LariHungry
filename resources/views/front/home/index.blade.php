@extends('front.layout.app')
@section('content')

    <!-- Carousel -->
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="first-slide"
                     src="{{ asset('front/images/image-restaurant3.jpg') }}"
                     alt="First slide">
                <div class="container">
                    <div class="carousel-caption text-left">
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <img class="second-slide"
                     src="{{ asset('front/images/image-restaurant3.jpg') }}"
                     alt="Second slide">
                <div class="container">
                    <div class="carousel-caption">
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <img class="third-slide"
                     src="{{ asset('front/images/image-restaurant3.jpg') }}"
                     alt="Third slide">
                <div class="container">
                    <div class="carousel-caption text-right">
                    </div>
                </div>
            </div>
        </div>

        <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>


    <div class="list-restaurants row col-12">
        @foreach($restaurants as $key => $row)
            <div class="col-4">
                <a class="link-list-restaurant" href="">
                    <div class="card">
                        @if(count($row->medias) > 0)
                            <img src="{{ asset('uploads/restaurants/' . $images[$key]) }}" class="card-img"
                                 alt="Restaurant view" width="250">
                        @else
                            {{-- default image --}}
                            <img src="{{ asset('front/images/default-image-restaurant.jpg') }}" class="card-img"
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
        @endforeach
    </div>




@endsection
