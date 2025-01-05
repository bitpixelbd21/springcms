<?php


use Illuminate\Support\Facades\Route;
use BitPixel\SpringCms\Http\Controllers\Site\HomeController;
use BitPixel\SpringCms\Http\Controllers\Site\PageController;
use BitPixel\SpringCms\Http\Controllers\Site\BlogController;
use BitPixel\SpringCms\Http\Controllers\Site\ServiceController;
use BitPixel\SpringCms\Http\Controllers\Site\ContactFormSubmissionController;



//auth
// Route::group([
//     'middleware' => ['web', 'river.guest:customers'],
//     'namespace' => 'BitPixel\SpringCms\Http\Controllers',
//     'as' => 'riversite.'
// ], function () {
//     Route::get('login', 'Customer\Auth\LoginController@showLoginForm')->name('login');
//     Route::post('login', 'Customer\Auth\LoginController@customerLogin')->name('login.post');
//     Route::get('register', 'Customer\Auth\RegisterController@showRegistrationForm')->name('register');
//     Route::post('register', 'Customer\Auth\RegisterController@registerCustomer')->name('register');

//     if (river_settings('social_login') == 1) {
//         //facebook login
//         Route::get('login/facebook', 'Customer\Auth\FacebookController@redirectToProvider');
//         Route::get('login/facebook/callback', 'Customer\Auth\FacebookController@handleProviderCallback');
//         //Google login
//         Route::get('login/google', 'Customer\Auth\GoogleController@redirectToProvider');
//         Route::get('login/google/callback', 'Customer\Auth\GoogleController@handleProviderCallback');
//     }
// });

// Route::group([
//     'middleware' => ['web', 'river.auth:customers'], 'namespace' => 'BitPixel\SpringCms\Http\Controllers', 'as' => 'riversite.'
// ], function () {
//     Route::get('user-dashboard', 'Customer\UserDashboardController@showDashboard')->name('customer.dashboard');
//     Route::get('edit-profile', 'Customer\UserDashboardController@editProfile')->name('customer.editProfile');
//     Route::post('update-profile', 'Customer\UserDashboardController@updateProfile')->name('update.profile');
//     Route::get('change-password', 'Customer\UserDashboardController@updatePasswordPage')->name('update.passwordPage');
//     Route::post('change-password', 'Customer\UserDashboardController@updatePassword')->name('update.password');
//     Route::post('/logout', 'Customer\Auth\LoginController@logout')->name('logout');
// });

Route::group([
    'middleware' => ['web', 'river.checkIfInstalled'],
    'namespace' => 'BitPixel\SpringCms\Http\Controllers',
    'as' => 'riversite.'
], function () {
    Route::get('/', [HomeController::class, 'index'])->name('homepage');
    Route::get('/page/{slug}', [PageController::class, 'pageShow'])->name('page.show');
    Route::get('/blogs', [BlogController::class, 'index'])->name('all-blogs');
    Route::get('/blog/{slug}', [BlogController::class, 'single_blog'])->name('single-blog');

    Route::get('/blogs/category/{slug}', [BlogController::class, 'category_blog'])->name('category-blog');
    Route::get('/blogs/tag/{slug}', [BlogController::class, 'tags_blog'])->name('tags-blog');

    Route::get('/blog-search', [BlogController::class, 'blog_search'])->name('blog-search');

    Route::get('/services/{slug}', [ServiceController::class, 'service'])->name('service');
    Route::get('{any?}', [PageController::class, 'catchAll'])->where('any', '^((?!upd|super|install).)*$'); //ignore /upd & /super path

    Route::post('/contact-form-submission/{slug}', [ContactFormSubmissionController::class , 'store'])->name('contact-form-submission');
    Route::post('/contact-form-store', [ContactFormSubmissionController::class, 'store_data' ])->name('contact-form.store');

    Route::get('single-data-entries/show/{slug}', [HomeController::class, 'single_entries_show'])->name('data-entries-show');
});
