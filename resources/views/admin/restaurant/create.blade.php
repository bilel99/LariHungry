@extends('admin.layout.app-admin')
@section('content')
    <h1>Create restaurant</h1>
    <div class="card mb-5 border-primary">
        <div class="card-header bg-light">Create Restaurant</div>
        <div class="row no-gutters">
            <div class="offset-2 col-8 offset-2">
                <div class="card-body">
                    <form method="post" action="{{ route('admin.restaurant.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="restaurant.title">Title</label>
                            <input type="text"
                                   class="form-control"
                                   name="title"
                                   aria-describedby="restaurant.title restaurant.title.error"
                                   placeholder="title"
                                   value="{{ old('title') }}"
                                   required="required">
                            <small id="restaurant.title"
                                   class="form-text text-muted">
                                please, Add to title!
                            </small>

                            <small id="restaurant.title.error"
                                   class="form-text text-danger">
                                {{ $errors->first('title') }}
                            </small>
                        </div>

                        <div class="form-group">
                            <label for="restaurant.description">Description</label>
                            <textarea name="description"
                                      id="editor"
                                      class="form-control"
                                      cols="30"
                                      aria-describedby="restaurant.description restaurant.description.error"
                                      placeholder="description"
                                      rows="10"
                                      required="required">{{ old('description') }} Please enter the description </textarea>
                            <small id="restaurant.description"
                                   class="form-text text-muted">
                                please, Add to description!
                            </small>

                            <small id="restaurant.description.error"
                                   class="form-text text-danger">
                                {{ $errors->first('description') }}
                            </small>
                        </div>

                        <div class="form-group">
                            <label for="restaurant.adress">Adress</label>
                            <input type="text"
                                   class="form-control"
                                   name="adress"
                                   aria-describedby="restaurant.adress restaurant.adress.error"
                                   value="{{ old('adress') }}"
                                   placeholder="adress"
                                   required="required">
                            <small id="restaurant.adress"
                                   class="form-text text-muted">
                                please, Add to adress!
                            </small>

                            <small id="restaurant.adress.error"
                                   class="form-text text-danger">
                                {{ $errors->first('adress') }}
                            </small>
                        </div>

                        <div class="form-group">
                            <label for="restaurant.cp">Code post</label>
                            <input type="number"
                                   name="cp"
                                   id="cp"
                                   class="form-control"
                                   aria-describedby="restaurant.cp"
                                   value="{{ old('cp') }}"
                                   placeholder="code post"
                                   required="required">
                            <small id="restaurant.cp"
                                   class="form-text text-muted">
                                Please enter the code post!
                            </small>
                            <input type="hidden"
                                   class="form-control"
                                   id="url_getVille"
                                   value="{{ route('admin.restaurant.getVille', ':CP') }}">
                        </div>

                        <div class="form-group">
                            <label for="restaurant.ville">Ville</label>
                            <input type="text"
                                   name="ville"
                                   id="ville"
                                   value="{{ old('ville') }}"
                                   class="form-control"
                                   placeholder="ville"
                                   disabled>
                        </div>

                        <div class="form-group">
                            <label for="restaurant.category">Category</label>
                            <select name="restaurant.category"
                                    class="form-control"
                                    aria-describedby="restaurant.category restaurant.category.error">
                                @foreach($categories as $key => $row)
                                    <option value="{{ $key }}">{{ $row }}</option>
                                @endforeach
                            </select>
                            <small id="restaurant.category"
                                   class="form-text text-muted">
                                please, Add to category!
                            </small>

                            <small id="restaurant.category.error"
                                   class="form-text text-danger">
                                {{ $errors->first('restaurant_category') }}
                            </small>
                        </div>

                        <div class="form-group">
                            <label for="restaurant.tag">Tag</label>
                            <select name="restaurant.tag[]"
                                    class="form-control"
                                    multiple="multiple"
                                    aria-describedby="restaurant.tag restaurant.tag.error">
                                @foreach($tag as $key => $row)
                                    <option value="{{ $key }}">{{ $row }}</option>
                                @endforeach
                            </select>
                            <small id="restaurant.tag"
                                   class="form-text text-muted">
                                please, Add to tag!
                            </small>

                            <small id="restaurant.tag.error"
                                   class="form-text text-danger">
                                {{ $errors->first('restaurant_tag') }}
                            </small>
                        </div>

                        <div class="form-group">
                            <label for="restaurant.price">Price</label>
                            <input type="text"
                                   class="form-control"
                                   name="price"
                                   aria-describedby="restaurant.price restaurant.price.error"
                                   value="{{ old('price') }}"
                                   placeholder="price"
                                   required="required">
                            <small id="restaurant.price"
                                   class="form-text text-muted">
                                please, Add to price!
                            </small>

                            <small id="restaurant.price.error"
                                   class="form-text text-danger">
                                {{ $errors->first('price') }}
                            </small>
                        </div>

                        <div class="form-group">
                            <label for="restaurant.media">Media</label>
                            <input type="file"
                                   class="form-control"
                                   name="restaurant.media[]"
                                   multiple="multiple"
                                   aria-describedby="restaurant.media restaurant.media.error">
                            <small id="restaurant.media"
                                   class="form-text text-muted">
                                please, Add to file media!
                            </small>

                            <small id="restaurant.media.error"
                                   class="form-text text-danger">
                                {{ $errors->first('restaurant_media') }}
                            </small>
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
@endsection
