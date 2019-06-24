@extends('front.layout.app')
@section('content')
    <!--================Blog Area =================-->
    <section class="blog_area single-post-area section-margin">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 posts-list">
                    <div class="single-post">
                        <div class="feature-img">
                            <div class="owl-carousel owl-theme hero-carousel">
                                @forelse($images as $row)
                                    <div class="hero-carousel-item">
                                        <img class="img-fluid" src="{{ asset('uploads/restaurants/' . $row) }}"
                                             alt="Image restaurant">
                                    </div>
                                @empty
                                    <div class="hero-carousel-item">
                                        <img class="img-fluid"
                                             src="{{ asset('front/images/default-image-restaurant.jpg') }}"
                                             alt="Image restaurant">
                                    </div>
                                @endforelse
                            </div>
                        </div>
                        <div class="blog_details">
                            <h2>{{ $restaurant->title }}</h2>
                            <ul class="blog-info-link mt-3 mb-4">
                                <li><span><i class="fas fa-user-astronaut"></i> Validate
                                        by {{ $restaurant->user->name .' '. $restaurant->user->firstname }}</span></li>
                                <li>
                                    <span><i class="fas fa-map-marked-alt"></i>City: {{ $restaurant->ville->libelle }} - Address: {{ $restaurant->adress }}</span>
                                </li>
                                <li><span><i class="fas fa-comments"></i> {{ count($comments) }} Comments</span></li>
                                <li>
                                    <span class="text-info">
                                        @if($fav === null)
                                            add to my favorite
                                        @else
                                            {{ $fav->fav == false ? 'add to my favorite' : 'Remove to my favorite' }}
                                        @endif
                                    </span>
                                    <form class="form-add-to-fav" method="post"
                                          action="{{ route('front.restaurant.add-my-fav', $restaurant->id) }}">
                                        @csrf
                                        @method('POST')
                                        <button type="submit" class="btn-add-to-fav">
                                            @if($fav === null)
                                                <i class="far fa-heart"></i>
                                            @else
                                                @if($fav->fav == false)
                                                    <i class="far fa-heart"></i>
                                                @else
                                                    <i class="fas fa-heart"></i>
                                                @endif
                                            @endif
                                        </button>
                                    </form>
                                </li>
                                <li>
                                    <i class="fas fa-star-half-alt"></i>
                                    <span>Rate</span>
                                    {{ $avgNotes }} /5
                                </li>
                            </ul>

                            @if($rating == null)
                                <div class="rating-bloc">
                                    <span class="title-rating-star">You have not rated yet, get started</span>
                                    <div class="rating float-right" data-rate-value=6></div>
                                    <form id="form-rating-star" method="post"
                                          action="{{ route('front.restaurant.add-rating', $restaurant->id) }}">
                                        @csrf
                                        @method('POST')
                                        <div class="form-group">
                                            <input type="hidden" id="rating_star_value" name="notes"
                                                   class="form-control">
                                        </div>
                                    </form>
                                </div>
                            @endif

                            <p class="excert">
                                {{ $restaurant->description }}
                            </p>

                            <div class="quote-wrapper">
                                <div class="quotes">
                                    Paragraphe important à rajouter en BDD table - restaurant
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="comments-area">
                        <h4>{{ count($comments) }} Comments</h4>

                        @forelse($comments as $row)
                            <div class="comment-list">
                                <div class="single-comment justify-content-between d-flex">
                                    <div class="user justify-content-between d-flex">
                                        <div class="thumb">
                                            @if(Auth::user()->media_id == null)
                                                <img src="{{ asset('front/images/default-image-restaurant.jpg') }}"
                                                     alt="default - avatar">
                                            @else
                                                <img src="{{ asset('uploads/user/'.$avatar) }}"
                                                     alt="avatar - user">
                                            @endif
                                        </div>
                                        <div class="desc">
                                            <p class="comment">
                                                {{ $row->comment }}
                                            </p>

                                            <div class="d-flex justify-content-between">
                                                <div class="d-flex align-items-center">
                                                    <h5>
                                                        <a href="#">{{ Auth::user()->name . ' ' . Auth::user()->firstname }}</a>
                                                    </h5>
                                                    <p class="date">{{ $row->getCreateddateAttribute() }}</p>
                                                </div>

                                                <div class="d-flex align-items-center actions-comment">
                                                    @if($row->user_id == Auth::user()->id)
                                                        <div class="reply-btn">
                                                            @include('front.modals.edit-comment')
                                                            <a href="#" data-toggle="modal"
                                                               data-target="#editCommentModal{{ $row->id }}"
                                                               class="btn-reply text-uppercase"><i
                                                                        class="fas fa-pencil-alt"></i></a>

                                                            <form class="form-delete" method="post"
                                                                  action="{{ route('front.comment.destroy', $row->id) }}">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-delete"><i
                                                                            class="far fa-trash-alt"></i></button>
                                                            </form>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="comment-list">
                                <p>Aucun commentaires pour l'instant !</p>
                            </div>
                        @endforelse

                    </div>
                    <div class="comment-form">
                        <h4>Leave a Reply</h4>
                        <form class="form-contact comment_form" method="post"
                              action="{{ route('front.restaurant.post-comment', $restaurant->id) }}" id="commentForm">
                            @csrf
                            @method('POST')
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <textarea
                                                class="form-control w-100"
                                                name="comment"
                                                id="comment"
                                                cols="30"
                                                rows="9"
                                                placeholder="Write Comment"
                                                required="required"
                                                aria-describedby="restaurant.comment restaurant.comment.error">
                                        </textarea>
                                        <small id="restaurant.comment"
                                               class="form-text text-muted">
                                            Your comment!
                                        </small>

                                        <small id="restaurant.comment.error"
                                               class="form-text text-danger">
                                            {{ $errors->first('comment') }}
                                        </small>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="button button-contactForm">Send Message</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="blog_right_sidebar">
                        <aside class="single_sidebar_widget post_category_widget">
                            <h4 class="widget_title">Category</h4>
                            <ul class="list cat-list">
                                @forelse($restaurant->categories as $row)
                                    <li>
                                        <a href="#" class="d-flex">
                                            <p>{{ $row->title }}</p>
                                        </a>
                                    </li>
                                @empty
                                    <li>
                                        <p class="d-flex">Empty!</p>
                                    </li>
                                @endforelse
                            </ul>
                        </aside>

                        <aside class="single_sidebar_widget popular_post_widget">
                            <h3 class="widget_title">Restaurant similaire</h3>
                            <div class="media post_item">
                                <i class="fas fa-hamburger fa fa-2x"></i>
                                {{-- <img src="{{ asset('front/images/image-profil-picture.jpg') }}" alt="restaurant"> --}}
                                <div class="media-body">
                                    <a href="single-blog.html">
                                        <h3>From life was you fish...</h3>
                                    </a>
                                    <p>January 12, 2019</p>
                                </div>
                            </div>
                        </aside>
                        <aside class="single_sidebar_widget tag_cloud_widget">
                            <h4 class="widget_title">Tag Clouds</h4>
                            <ul class="list">
                                @forelse($restaurant->tags as $row)
                                    <li>
                                        <a href="#">{{ $row->tag }}</a>
                                    </li>
                                @empty
                                    <li>
                                        <p>Empty!</p>
                                    </li>
                                @endforelse
                            </ul>
                        </aside>
                        <aside class="single_sidebar_widget actions_cloud_widget">
                            <h4 class="widget_title">Your actions</h4>
                            <form method="post" action="">
                                @csrf
                                @method("DELETE")
                                <a href="" class="btn btn-primary">Edited</a>
                                <button type="submit" class="btn btn-danger">Deleted</button>
                            </form>

                        </aside>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================Blog Area =================-->

@endsection
