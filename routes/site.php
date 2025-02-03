<?php

use BitPixel\SpringCms\Http\Controllers\Site\Api\BlogApiController;
use Illuminate\Support\Facades\Route;
use BitPixel\SpringCms\Http\Controllers\Site\HomeController;
use BitPixel\SpringCms\Http\Controllers\Site\PageController;
use BitPixel\SpringCms\Http\Controllers\Site\BlogController;
use BitPixel\SpringCms\Http\Controllers\Site\ServiceController;
use BitPixel\SpringCms\Http\Controllers\Site\ContactFormSubmissionController;
use BitPixel\SpringCms\Http\Controllers\Site\Api\HomeApiController;

Route::group([
    'middleware' => ['river.access_token'],
    'prefix' => 'api',
], function () {
    Route::get('/homedata', [HomeApiController::class, 'index']);
    Route::get('/blogs', [BlogApiController::class, 'index']);
});

Route::group([
    'middleware' => ['web', 'river.checkIfInstalled'],
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

