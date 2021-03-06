<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/**
 * ROUTE GLOBAL
 * AUTH ROUTE
 */
Route::get('laravel', function () {
    return view('welcome');
});
Auth::routes();

/************************************************************************************#
 *  FRONT ROUTE
 ************************************************************************************/
/**
 * Route except (login) => Home page contact Faq etc...
 */
Route::get('/', 'Front\HomeController@index')->name('front.home');

Route::get('/contact', 'Front\HomeController@contact')->name('front.contact');
Route::post('/create-contact', 'Front\HomeController@createContact')->name('front.contact.store');

Route::post('/create-faq', 'Front\HomeController@createFaq')->name('front.faq.store');

Route::post('/create-newsletter', 'Front\HomeController@createNewsletter')->name('front.create.newsletter');

/**
 * Route In Log
 */
Route::middleware(['auth_redirect_to_home'])->namespace('Front')->name('front.')->group(function () {
    /**
     * Front / User - Route
     */
    Route::get('/profil/{user}', 'UserController@index')->name('profil');
    Route::put('/update-account/{user}', 'UserController@update')->name('update.account');
    Route::get('/edit-password/{user}', 'UserController@editPassword')->name('edit.password');
    Route::put('/update-password/{user}', 'UserController@updatePassword')->name('update.password');
    Route::get('/profil/my-post/{user}', 'UserController@myPost')->name('profil.mypost');
    Route::delete('/delete-user/{user}', 'UserController@destroy')->name('delete.user');

    /**
     * Search Module
     */
    Route::post('/search-restaurant', 'RestaurantsController@search')->name('search.restaurant');

    /**
     * Restaurant - Route
     */
    Route::resource('/restaurant', 'RestaurantsController');
    Route::post('/restaurant-add-fav/{restaurant}', 'RestaurantsController@addMyFav')->name('restaurant.add-my-fav');
    Route::post('/restaurant-choice-rating/{restaurant}', 'RestaurantsController@addRating')->name('restaurant.add-rating');
    Route::post('/restaurant-post-comment/{restaurant}', 'RestaurantsController@postComment')->name('restaurant.post-comment');

    /**
     * Comments - Route
     */
    Route::resource('/comment', 'CommentsController')->except(['create', 'store', 'show', 'edit']);

    /**
     * Favorite - Route
     */
    Route::get('/favorite', 'FavoriteController@index')->name('fav.index');
    Route::delete('/delete-favorite/{fav}', 'FavoriteController@destroy')->name('fav.destroy');
});

/************************************************************************************#
 *  ADMIN ROUTE
 ************************************************************************************/
Route::middleware(['auth'])->namespace('Admin')->prefix('admin')->name('admin.')->group(function () {

    /**
     * DASHBOARD ADMIN ROUTE
     */
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard')->middleware('can:authorize');
    Route::get('/newsletters', 'DashboardController@newsletters')->name('newsletters')->middleware('can:authorize');
    Route::put('/newsletters-change-status/{newsletters}', 'DashboardController@changeStatusNewsletter')->name('newsletters.change-status')->middleware('can:authorize');
    Route::delete('/newsletter/{newsletters}', 'DashboardController@deleteNewsletter')->name('delete-newsletter')->middleware('can:authorize');

    /**
     * USER ADMIN ROUTE
     */
    Route::get('/user', 'UserController@index')->name('user')->middleware('can:authorize');
    Route::get('/user/{user}', 'UserController@show')->name('user.show')->middleware('can:authorize');
    Route::put('/user/changeOwner/{user}', 'UserController@changeOwner')->name('user.changeOwner')->middleware('can:authorize');
    Route::put('/user/changeStatus/{user}', 'UserController@changeStatus')->name('user.changeStatus')->middleware('can:authorize');
    Route::delete('/user/delete/{user}', 'UserController@destroy')->name('user.delete')->middleware('can:authorize');

    /**
     * CONTACT ADMIN ROUTE
     */
    Route::get('/contact', 'ContactController@index')->name('contact')->middleware('can:authorize');
    Route::get('/contact/{contact}', 'ContactController@show')->name('contact.show')->middleware('can:authorize');
    Route::put('/contact/changeStatus/{contact}', 'ContactController@changeStatus')->name('contact.changeStatus')->middleware('can:authorize');
    Route::delete('/contact/destroy/{contact}', 'ContactController@destroy')->name('contact.destroy')->middleware('can:authorize');

    /**
     * CATEGORIES ADMIN ROUTE RESOURCE (GET, POST, PUT, DELETE)
     */
    Route::resource('/categories', 'CategoriesController')->except(['show'])->middleware('can:authorize');

    /**
     * TAG ADMIN ROUTE RESOURCE (GET, POST, PUT, DELETE)
     */
    Route::resource('/tag', 'TagController')->except(['show'])->middleware('can:authorize');

    /**
     * RESTAURANT ROUTE RESOURCE (GET, POST, PUT, DELETE)
     */
    Route::resource('/restaurant', 'RestaurantsController')->middleware('can:authorize');
    Route::get('/restaurant/getVille/{cp}', 'RestaurantsController@getVille')->name('restaurant.getVille')->middleware('can:authorize');
});
