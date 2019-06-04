<!--================Search Banner Section start =================-->
<section class="hero-banner">
    <div class="hero-wrapper">
        <form method="post" action="{{ route('front.search.restaurant') }}">
            @csrf
            <div class="hero-left">
                <h1 class="hero-title">Your search <br> Restaurant?</h1>
                <div class="d-sm-flex flex-wrap">
                    <div class="col-6">
                        <div class="row">
                            <div class="form-group">
                                <label for="min_price">Beetween price (-)</label>
                                <input type="number" name="min_price" class="form-control"
                                       placeholder="Your price beetween">
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="row">
                            <div class="form-group">
                                <label for="max_price">Beetween price (+)</label>
                                <input type="number" name="max_price" class="form-control"
                                       placeholder="Your price beetween">
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="button button-hero button-shadow">Search</button>
                </div>
            </div>
            <div class="hero-right">
                <div class="form-group">
                    <label for="title">Name</label>
                    <input type="text" class="form-control" name="title" placeholder="Your search by Name">
                </div>
                <div class="form-group">
                    <label for="ville">City</label>
                    <input type="text" class="form-control" name="ville" placeholder="Your search by City">
                </div>
                <div class="form-group">
                    <label for="category">Category</label>
                    <select name="category" class="form-control">
                        @foreach($pluckCat as $key => $row)
                            <option value="{{ $key }}">{{ $row }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </form>
    </div>
</section>
<!--================Search Section end =================-->
