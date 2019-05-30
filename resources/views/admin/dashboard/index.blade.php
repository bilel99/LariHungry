@extends('admin.layout.app-admin')
@section('content')

    <h1>Dashboard</h1>

    <ul class="ds-btn">
        <li>
            <a class="btn btn-lg btn-primary" href="{{ route('admin.user') }}">
                <i class="fas fa-users fa fa-2x"></i>
                <span>User<br>
                                <small>Actuellement {{ $nbr_user }} membres</small>
                            </span>
            </a>
        </li>
        <li>
            <a class="btn btn-lg btn-success" href="{{ route('admin.restaurant.index') }}">
                <i class="fas fa-utensils fa fa-2x"></i>
                <span>Restaurants<br>
                                <small>Actuellement 766 Restaurants</small>
                            </span>
            </a>
        </li>
        <li>
            <a class="btn btn-lg btn-danger" href="#">
                <i class="fas fa-comments fa fa-2x"></i>
                <span>Commentaires<br>
                                <small>Actuellement 876 commentaires</small>
                            </span>
            </a>
        </li>
        <li>
            <a class="btn btn-lg btn-info" href="{{ route('admin.contact') }}">
                <i class="fas fa-envelope-open-text fa fa-2x"></i>
                <span>Contact<br>
                                <small>Actuellement {{ $nbr_contact }} demande de contacts</small>
                            </span>
            </a>
        </li>
    </ul>
@endsection
