@extends('front.layout.app')
@section('content')
    <!--================Search Banner Section start =================-->
    @include('front.partials.search-engine')
    <!--================Search Section end =================-->

    <!--================List Restaurants start =================-->
    @include('front.partials.list_restaurants')
    <!--================List Restaurants end =================-->

    <!--================ Btn add =================-->
    @include('front.partials.floating-btn-add-restaurant')

@endsection
