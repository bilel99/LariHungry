@extends('admin.layout.app-admin')
@section('content')
    <h1>Create tag</h1>
    <div class="card mb-5 border-primary">
        <div class="row no-gutters">
            <div class="offset-2 col-8 offset-2">
                <div class="card-body">
                    <form method="post" action="{{ route('admin.tag.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="tag.title">Tag</label>
                            <input type="text" class="form-control" name="tag" aria-describedby="tag tag.error"
                                   placeholder="tag" required>
                            <small id="tag" class="form-text text-muted">please, Add to tag!</small>
                            @if($errors->any())
                                <small id="tag.error" class="form-text text-danger">
                                    @foreach($errors->all() as $error)
                                        {{ $error }}
                                    @endforeach
                                </small>
                            @endif
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
