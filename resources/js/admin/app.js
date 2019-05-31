import {getVille} from "../app";

require('../bootstrap');

$(document).ready(function () {

    /**
     * redirect link to href url
     * sidebar
     */
    $('.list-group-item').click(function (e) {
        e.preventDefault();
        let url = $(this).attr('href');
        window.location.href = url;
    });

    /**
     * Toggle sidebar
     * Open / Close sidebar
     * Call method
     */
    toggleSidebar();

    /**
     * Open and close
     * toggle slide
     * edit category / {id}
     */
    toggleEditCategory();

    /**
     * Ajax Get Ville
     */
    getVille();

});

/**
 * Page = Admin, Dashboard
 * Open / Close sidebar
 * data-sidebar is boolean
 * 1 => Open
 * 0 => Close
 * Default is Close sidebar (data-sidebar = 0)
 */
let toggleSidebar = function () {
    $('#toggle-sidebar').on('click', function (e) {
        e.preventDefault();
        let sidebar = $('.custom-sidebar');
        let dataSidebar = sidebar.attr('data-sidebar');

        if (dataSidebar === '0') {
            // Sidebar is Close
            $('#icon-toggle-sidebar').removeClass('fas fa-bars');
            $('#icon-toggle-sidebar').addClass('fas fa-arrow-left');
            sidebar.show();
            sidebar.animate({left: '0'}, 600);
            sidebar.attr('data-sidebar', '1');
        } else {
            // Sidebar is Open
            $('#icon-toggle-sidebar').removeClass('fas fa-arrow-left');
            $('#icon-toggle-sidebar').addClass('fas fa-bars');
            sidebar.animate({left: '-100%'}, 600);
            sidebar.attr('data-sidebar', '0');
        }
    });
};

/**
 * Hide navbar is scroll down
 * Show navbar is scroll up
 */
let hideOnScrollNavBar = function () {
    let new_scroll_position = 0;
    let last_scroll_position;
    let navbar = document.getElementById("navbar");

    window.addEventListener('scroll', function (e) {
        last_scroll_position = window.scrollY;
        // Scrolling down
        if (new_scroll_position < last_scroll_position && last_scroll_position > 80) {
            navbar.classList.remove("slideDown");
            navbar.classList.add("slideUp");
            // Scrolling up
        } else if (new_scroll_position > last_scroll_position) {
            navbar.classList.remove("slideUp");
            navbar.classList.add("slideDown");
        }
        new_scroll_position = last_scroll_position;
    });
};

/**
 * slideToggle
 * Open / Close
 * Edit Category
 */
let toggleEditCategory = function () {
    $('.edit-category').on('click', function (e) {
        e.preventDefault();
        let row = $(this).parents('tr');
        let id = row.data('id');
        // open and close elements
        $('.form-edit-category-' + id).slideToggle();
        // Add attribute name in input_title
        $('.category_title_' + id).attr('name', 'category_title_' + id);
    });
};
