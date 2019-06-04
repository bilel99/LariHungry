/*-------------------------------------------------------------------------------
	  featured slider
	-------------------------------------------------------------------------------*/
if ($('.featured-carousel').length) {
    $('.featured-carousel').owlCarousel({
        loop: false,
        margin: 30,
        items: 1,
        nav: true,
        dots: false,
        responsiveClass: true,
        slideSpeed: 300,
        paginationSpeed: 500,
        navText: ["<div class='left-arrow'><i class='ti-angle-left'></i></div>", "<div class='right-arrow'><i class='ti-angle-right'></i></div>"],
        responsive: {
            768: {
                items: 2
            },
            1100: {
                items: 3
            }
        }
    })
}

/*-------------------------------------------------------------------------------
  featured slider
-------------------------------------------------------------------------------*/
if ($('.hero-carousel').length) {
    $('.hero-carousel').owlCarousel({
        loop: false,
        margin: 30,
        items: 1,
        nav: false,
        dots: true,
        responsiveClass: true,
        slideSpeed: 300,
        paginationSpeed: 500
    })
}
