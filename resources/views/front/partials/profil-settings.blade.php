<div class="profil-menu">
    <div class="fading-side-menu" data-spy="affix" data-offset-top="350">
        <h5>Settings</h5>
        <hr class="no-margin">
        <ul class="list-unstyled quick-links">
            <li>
                <a href="">
                    <span class="fa fa-angle-double-right text-primary"></span>My favorite restaurants
                    <i class="fas fa-heart"></i>
                </a>
            </li>
            <li>
                <a href="">
                    <span class="fa fa-angle-double-right text-primary"></span>My comments
                    <i class="fas fa-comments"></i>
                </a>
            </li>
            <li>
                <a href="">
                    <span class="fa fa-angle-double-right text-primary"></span>My posts
                    <i class="fas fa-utensils"></i>
                </a>
            </li>

            <!-- edit password -->
            <li>
                <a href="{{ route('front.edit.password', Auth::user()->id) }}" id="profil-edit-password">
                    <span class="fa fa-angle-double-right text-primary"></span>Change password
                    <i class="fas fa-key"></i>
                </a>
            </li>

            <!-- edit account -->
            <li>
                <a href="{{ route('front.profil', Auth::user()->id) }}" id="profil-edit-account">
                    <span class="fa fa-angle-double-right text-primary"></span>Edit my account
                    <i class="fas fa-user-edit"></i>
                </a>
            </li>

            <!-- delete account -->
            <li>
                <form id="form-user-delete" action="" method="post">
                    @csrf
                    @method('DELETE')
                    <a href="{{ route('front.delete.user', Auth::user()->id) }}" id="delete-account">
                        <span class="fa fa-angle-double-right text-primary"></span>Deleted account
                        <i class="fas fa-trash-alt"></i>
                    </a>
                </form>
            </li>
        </ul>
    </div>
</div>