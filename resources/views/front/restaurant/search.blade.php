@extends('front.layout.app')
@section('content')
    <!--================Search Banner Section start =================-->
    @include('front.partials.search-engine')
    <!--================Search Section end =================-->

    <!--================List Restaurants start =================-->
    <div class="list-restaurants row col-12">
        <div class="offset-2 col-8 offset-2">
            @if(count($search) > 0)
                <h3 class="text-center text-muted">currently {{ count($search) }} results</h3>
            @endif
        </div>
        @forelse($search as $row)
            <div class="col-4">
                <a class="link-list-restaurant" href="{{ route('front.restaurant.show', $row->restaurant_id) }}">
                    <div class="card">
                        @if($row->path)
                            <img src="{{ asset('uploads/restaurants/' . $images[$loop->index]) }}" class="card-img"
                                 alt="Restaurant view" width="250" height="250">
                        @else
                            {{-- default image --}}
                            <img src="{{ asset('front/images/default-image-restaurant.jpg') }}" class="card-img"
                                 alt="default image" width="250" height="250">
                        @endif
                        <div class="card-img-overlay" style="z-index: 1">
                            <span class="badge badge-pill badge-primary">{{ $row->title }}</span>
                            <span class="badge badge-pill badge-primary">{{ $row->tag }}</span>
                        </div>
                        <div class="card-body">
                            <h4 class="card-title">{{ $row->restaurant_title }}</h4>
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
                                {{ $row->adress }}, {{ $row->libelle }} {{ $row->zipcode }}
                            </div>
                            <div class="stats">
                                <i class="fas fa-sort-numeric-up"></i> 10 /10
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        @empty
            <div class="offset-2 col-8 offset-2">
                <h3 class="text-center">Sorry I did not find anything...</h3>
            </div>
        @endforelse
    </div>
    <!--================List Restaurants end =================-->

    @include('front.partials.floating-btn-add-restaurant')

@endsection
