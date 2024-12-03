<?php

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
    Route::get('/', 'Site\HomeController@index')->name('homepage');
    Route::get('/page/{slug}', 'Site\PageController@pageShow')->name('page.show');
    Route::get('/blogs', 'Site\BlogController@index')->name('all-blogs');
    Route::get('/single-blog/{slug}', 'Site\BlogController@single_blog')->name('single-blog');

    Route::get('/blogs/category/{slug}', 'Site\BlogController@category_blog')->name('category-blog');
    Route::get('/blogs/tag/{slug}', 'Site\BlogController@tags_blog')->name('tags-blog');

    Route::get('/blog-search', 'Site\BlogController@blog_search')->name('blog-search');

    Route::get('/services/{slug}', 'Site\ServiceController@service')->name('service');
    Route::get('{any?}', 'Site\PageController@catchAll')->where('any', '^((?!upd|super|install).)*$'); //ignore /upd & /super path

    Route::post('/contact-form-submission/{slug}', [ContactFormSubmissionController::class , 'store'])->name('contact-form-submission');
    Route::post('/contact-form-store', [ContactFormSubmissionController::class, 'store_data' ])->name('contact-form.store');

    Route::get('single-data-entries/show/{slug}', 'Site\HomeController@single_entries_show')->name('data-entries-show');
});


//dd(config('river.enable_ecommerce')p);
// E-commerce related routes
// if (config('river.enable_ecommerce')) {
//     Route::group([
//         'prefix' => '',
//         /*'middleware' => ['web', 'river.auth:admins'],*/
//         'namespace' => 'BitPixel\SpringCms\Http\Controllers',
//         'as' => 'river.site.'
//     ], function () {
//         Route::get('shop', 'Admin\DataEntryController@index')->name('shop');
//         Route::get('checkout', 'Admin\DataEntryController@index')->name('checkout');
//     });
// }
