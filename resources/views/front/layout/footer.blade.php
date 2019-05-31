<!-- Footer -->
<section id="footer">
    <div class="container">
        <div class="row text-center text-xs-center text-sm-left text-md-left">
            <div class="col-xs-12 col-sm-4 col-md-4">
                <h5>category 1</h5>
                <ul class="list-unstyled quick-links">
                    <li><a href=""><i class="fa fa-angle-double-right"></i>Home</a></li>
                    <li><a href=""><i class="fa fa-angle-double-right"></i>About</a></li>
                    <li><a href=""><i class="fa fa-angle-double-right"></i>FAQ</a></li>
                    <li><a href=""><i class="fa fa-angle-double-right"></i>Get Started</a></li>
                    <li><a href=""><i class="fa fa-angle-double-right"></i>Videos</a></li>
                </ul>
            </div>
            <div class="col-xs-12 col-sm-4 col-md-4">
                <h5>category 2</h5>
                <ul class="list-unstyled quick-links">
                    <li><a href=""><i class="fa fa-angle-double-right"></i>Home</a></li>
                    <li><a href=""><i class="fa fa-angle-double-right"></i>About</a></li>
                    <li><a href=""><i class="fa fa-angle-double-right"></i>FAQ</a></li>
                    <li><a href=""><i class="fa fa-angle-double-right"></i>Get Started</a></li>
                    <li><a href=""><i class="fa fa-angle-double-right"></i>Videos</a></li>
                </ul>
            </div>
            <div class="col-xs-12 col-sm-4 col-md-4">
                <h5>category 3</h5>
                <ul class="list-unstyled list-inline social text-center">
                    <li class="list-inline-item"><a href=""><i class="fab fa-facebook fa-2x"></i></a></li>
                    <li class="list-inline-item"><a href=""><i class="fab fa-twitter fa-2x"></i></a></li>
                    <li class="list-inline-item"><a href=""><i class="fab fa-instagram fa-2x"></i></a></li>
                    <li class="list-inline-item"><a href=""><i class="fab fa-google-plus fa-2x"></i></a></li>
                    <li class="list-inline-item"><a href="" target="_blank"><i class="far fa-envelope fa-2x"></i></a></li>
                </ul>

                <h5>Newsletter</h5>
                <form method="POST" action="{{ route('front.create.newsletter') }}">
                    @csrf
                    @method('POST')
                    <div class="form-group">
                        <label for="newsletter">click to enter by submit form</label>
                        <input type="text" class="form-control" name="newsletter" placeholder="john.doe@domain.com">
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 mt-2 mt-sm-2 text-center text-white">
                <p class="h6">&copy;copyright by
                    <a class="text-green ml-2" href="" target="_blank">Bilel Bekkouche</a>
                </p>
            </div>
            </hr>
        </div>
    </div>
</section>
