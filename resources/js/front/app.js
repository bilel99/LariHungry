import {getVille} from "../app";

require('../bootstrap');

$('document').ready(() => {
    /**
     * Ajax Get Ville
     */
    getVille();

});

//* Navbar Fixed
function navbarFixed() {
    let nav_offset_top = $('header').height() + 50;
    if ($('.header_area').length) {
        $(window).scroll(function () {
            var scroll = $(window).scrollTop();
            if (scroll >= nav_offset_top) {
                $(".header_area").addClass("navbar_fixed");
            } else {
                $(".header_area").removeClass("navbar_fixed");
            }
        });
    }
}

navbarFixed();
