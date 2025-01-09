<?php

use BitPixel\SpringCms\Http\Controllers\Admin\FileUploadController;
use BitPixel\SpringCms\Http\Controllers\Admin\GitHubController;
use BitPixel\SpringCms\Http\Controllers\Admin\InstallController;
use BitPixel\SpringCms\Http\Controllers\Admin\Auth\LoginController;
use BitPixel\SpringCms\Http\Controllers\Admin\Auth\AdminProfileSettings;
use BitPixel\SpringCms\Http\Controllers\Admin\UsersController;
use BitPixel\SpringCms\Http\Controllers\Admin\UsersRoleController;
use BitPixel\SpringCms\Http\Controllers\Admin\RiverPagesController;
use BitPixel\SpringCms\Http\Controllers\Admin\DashboardController;
use BitPixel\SpringCms\Http\Controllers\Admin\Settings\AppearanceController;
use BitPixel\SpringCms\Http\Controllers\Admin\Settings\SiteBackupController;
use BitPixel\SpringCms\Http\Controllers\Admin\Settings\CodeSnippetsController;
use BitPixel\SpringCms\Http\Controllers\Admin\Settings\SliderController;
use BitPixel\SpringCms\Http\Controllers\Admin\Settings\BannersController;
use BitPixel\SpringCms\Http\Controllers\Admin\Settings\SettingsController;

use BitPixel\SpringCms\Http\Controllers\Admin\DataTypeController;
use BitPixel\SpringCms\Http\Controllers\Admin\DataEntryController;
use BitPixel\SpringCms\Http\Controllers\Admin\ContactFormController;
use BitPixel\SpringCms\Http\Controllers\Admin\ContactFormFieldController;
use BitPixel\SpringCms\Http\Controllers\Site\ContactFormSubmissionController;
use BitPixel\SpringCms\Http\Controllers\Admin\MenuController;
use BitPixel\SpringCms\Http\Controllers\Admin\BlogController;
use BitPixel\SpringCms\Http\Controllers\Admin\BlogCategoryController;
use BitPixel\SpringCms\Http\Controllers\Admin\CommentController;
use BitPixel\SpringCms\Http\Controllers\Admin\CodeGeneratorController;
use BitPixel\SpringCms\Http\Controllers\Admin\FaqController;
use BitPixel\SpringCms\Http\Controllers\Admin\TagController;
use BitPixel\SpringCms\Http\Controllers\Admin\TestimonialController;
use BitPixel\SpringCms\Http\Controllers\Admin\ServiceController;
use BitPixel\SpringCms\Http\Controllers\Admin\ServiceCategoryController;
use BitPixel\SpringCms\Http\Controllers\Admin\NewsletterSubmissionsController;
use BitPixel\SpringCms\Http\Controllers\Admin\TemplateAssetsController;



use BitPixel\SpringCms\Http\Controllers\Admin\TemplatePageController;
use BitPixel\SpringCms\Http\Controllers\Customer\Auth\LoginController as AuthLoginController;

Route::group([
    // 'prefix' => 'install',
    'middleware' => ['web', 'river.redirectIfInstalled'],
], function () {
    Route::get('install', [InstallController::class, 'index'])->name('install.index');
    Route::get('install/check-requirements', [InstallController::class, 'checkRequirements'])->name('install.checkRequirements');
    Route::get('install/database', [InstallController::class, 'database'])->name('install.database');
    Route::post('install/database', [InstallController::class, 'saveDatabase'])->name('install.saveDatabase');
    Route::post('install/test-db', [InstallController::class, 'testDatabaseConnection'])->name('install.testDatabaseConnection');
    Route::get('install/admin', [InstallController::class, 'createAdmin'])->name('install.createAdmin');
    Route::post('install/admin', [InstallController::class, 'storeAdmin'])->name('install.storeAdmin');
});

//auth
Route::group([
    'prefix' => 'admin',
    'middleware' => ['web', 'river.checkIfInstalled', 'river.guest:admins'],
    'namespace' => 'BitPixel\SpringCms\Http\Controllers',
    'as' => 'river.'
], function () {
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('admin.login');
    Route::post('login', [LoginController::class, 'login'])->name('admin.login.post');
});


Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'river.auth:admins']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});

Route::group([
    'prefix' => 'admin',
    'middleware' => ['web', 'river.checkIfInstalled', 'river.auth:admins' /*'river.checkrole'*/],
    'namespace' => 'BitPixel\SpringCms\Http\Controllers',
    'as' => 'river.'
], function () {

    //users crudF
    Route::resource('users', UsersController::class);


    Route::resource('users-role', UsersRoleController::class);
    Route::resource('pages', RiverPagesController::class);

    Route::get('dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    Route::post('logout', [LoginController::class, 'logout'])->name('admin.logout');
    Route::get('admin-settings', [AdminProfileSettings::class, 'index'])->name('admin-settings');
    Route::post('admin-settings-update/{id}', [AdminProfileSettings::class, 'update'])->name('admin-update');
    Route::post('admin-password-update/{id}', [AdminProfileSettings::class, 'update_password'])->name('admin-password-update');



    //    Route::get('payment-method', 'Admin\PaymentController@index')->name('payment.index');

    //settings route:
    //    Route::get('settings', 'Admin\SettingsController@showSettings')->name('settings.index');
    Route::get('storefront', [AppearanceController::class, 'storeFront'])->name('store.front');
    Route::get('store-social-links', [AppearanceController::class, 'storeSocialLinks'])->name('store-social-links');

    Route::get('store-global-css', [AppearanceController::class, 'storeGlobalCss'])->name('store-global-css');
    Route::get('store-global-js', [AppearanceController::class, 'storeGlobalJs'])->name('store-global-js');

    Route::get('store-email-setting', [AppearanceController::class, 'storeEmailSettings'])->name('store-email-setting');

    Route::post('update/settings', [SettingsController::class, 'updateSettings'])->name('store-settings');
    Route::resource('sliders', SliderController::class);

    Route::resource('banners', BannersController::class);

    Route::get('site-backup', [SiteBackupController::class, 'index'])->name('site-backup');
    Route::get('site-backup-store', [SiteBackupController::class, 'backup_store'])->name('site-backup-store');
    Route::post('site-backup/restore', [SiteBackupController::class, 'restore'])->name('backup.restore');
    Route::get('code-snippets', [CodeSnippetsController::class, 'index'])->name('code-snippets');



    //Newsletter Submissions
    Route::resource('newslatter-submissions', NewsletterSubmissionsController::class);

    //template manager
    Route::post('template-pages/preview', [TemplatePageController::class, 'preview']);
    Route::resource('template-pages', TemplatePageController::class)->except(['create', 'show']);
    Route::get('assets', [TemplatePageController::class, 'assets'])->name('templates.assets');
    Route::get('CacheView', [TemplatePageController::class, 'CacheView'])->name('CacheView');


    Route::delete('template-pages-version-delete/{filename}', [TemplatePageController::class, 'allVersionDelete'])->name('template-pages-version-delete');
    Route::delete('template-pages-delete-version/{id}', [TemplatePageController::class, 'VersionDelete'])->name('template-pages-delete-version');
    // Route::post('template-pages-edit','Admin\TemplatePageController');

    //template Assets
    Route::resource('template-assets', TemplateAssetsController::class)->except(['show']);
    Route::get('assets-CacheView', [TemplateAssetsController::class, 'CacheView'])->name('assets-cache-view');



    //    Route::get('pages/{id}', 'Admin\TemplatePageController@editPage')->name('templates.pages.edit');

    Route::post('datatypes/store-fields', [DataTypeController::class, 'storeFields'])->name('datatypes.store-fields');
    Route::put('datatypes/update-fields', [DataTypeController::class, 'updateFields'])->name('datatypes.update-fields');
    Route::post('datatypes/field-meta', [DataTypeController::class, 'fieldMeta'])->name('datatypes.field-meta');
    Route::get('datatypes/export', [DataTypeController::class, 'export'])->name('datatypes.export');
    Route::get('download', [DataTypeController::class, 'download'])->name('download.page');
    Route::get('download-item/{id}/{file}', [DataTypeController::class, 'downloadItem'])->name('download.item');
    Route::get('datatypes/import', [DataTypeController::class, 'import'])->name('datatypes.import');
    Route::post('datatypes/import', [DataTypeController::class, 'importPost'])->name('datatypes.postimport');
    Route::resource('datatypes', DataTypeController::class);

    //data entry routes
    Route::get('data-entries/{slug}', [DataEntryController::class, 'index'])->name('data-entries.index');
    Route::get('data-entries/{slug}/create', [DataEntryController::class, 'create'])->name('data-entries.create');
    Route::post('data-entries/{slug}', [DataEntryController::class, 'store'])->name('data-entries.store');
    // Route::get('data-entries/{slug}/show/{id}', 'Admin\DataEntryController@show')->name('data-entries.show');
    Route::get('data-entries/{slug}/edit/{id}', [DataEntryController::class, 'edit'])->name('data-entries.edit');
    Route::get('data-entries/{slug}/destroy/{id}', [DataEntryController::class, 'destroy'])->name('data-entries.destroy');
    Route::put('data-entries/{slug}/update/{id}', [DataEntryController::class, 'update'])->name('data-entries.update');

    // Route::get('data-entries/show/{slug}', 'Admin\DataEntryController@show')->name('data-entries.show');


    Route::get('file', [CodeGeneratorController::class, 'index']);


    Route::view('file-manager', 'river::admin.filemanager')->name('file-manager');
    Route::get('tiny-file-manager', function () {
        ob_start();
        include(public_path('river/admin/tinyfilemanager.php'));
        $output = ob_get_clean();

        // Return the output as a response
        return response($output)
            ->header('X-Frame-Options', 'ALLOW-FROM *');
        //        return response($output);
        //      return response()->file(public_path('river/tinyfilemanager.php'));
        //      require(public_path('river/tinyfilemanager.php'));
    })->name('tinyfilemanager');

    // Route::get('contact-form', 'Admin\ContactFormController@index')->name('contact_form');
    // Route::post('contact-form/store', 'Admin\ContactFormController@store')->name('contact-form.store');
    // Route::delete('contact-form/destroy/{id}', 'Admin\ContactFormController@destroy')->name('contact-form.destroy');
    // Route::get('contact-form/update/{id}', 'Admin\ContactFormController@update')->name('contact-form.update');
    // Route::put('contact-form/update-store/{id}', 'Admin\ContactFormController@update_store')->name('contact-form.update-store');

    // Route::get('contact-form-field', 'Admin\ContactFormFieldController@index')->name('Contact-Form-Field');
    // Route::post('contact-form-field/store', 'Admin\ContactFormFieldController@store')->name('Contact-Form-Field.store');

    Route::resource('contact-form', ContactFormController::class);
    Route::post('contact-form/store-fields', [ContactFormController::class, 'storeFields'])->name('contact-form.store-fields');
    Route::put('contact-form/update-fields', [ContactFormController::class, 'updateFields'])->name('contact-form.update-fields');
    Route::post('contact-form/field-meta', [ContactFormController::class, 'fieldMeta'])->name('contact-form.field-meta');

    Route::get('Contact', [ContactFormSubmissionController::class, 'ContactFormData'])->name('Contact-form');
    Route::DELETE('Contact-delete/{id}', [ContactFormSubmissionController::class, 'destroy'])->name('contact-delete');
    // Route::delete('contact-form/destroy/{id}', 'Admin\ContactFormController@destroy')->name('contact-form.destroy');



    Route::resource('faq', FaqController::class);

    Route::post('uploads', [FileUploadController::class, 'file_upload'])->name('file-upload');


    //Menu
    Route::resource('menu', MenuController::class);
    Route::post('menu-field/{id}', [MenuController::class, 'menu_item_create'])->name('menu-field');
    Route::post('menu-store-field', [MenuController::class, 'storeFields'])->name('store-fields');
    Route::put('menu-update-field', [MenuController::class, 'updateFields'])->name('menu_update-fields');

    //Blog
    Route::resource('blog', BlogController::class);
    //BlogCategory
    Route::resource('blog-category', BlogCategoryController::class);
    //BlogComments
    Route::resource('comments', CommentController::class);
    Route::post('comments-approve/approves', [CommentController::class, 'approve'])->name('comments-approve.approves');
    Route::post('comments-pending/pending', [CommentController::class, 'pending'])->name('comments-pending.pending');



    Route::resource('tag', TagController::class);

    Route::resource('testimonial', TestimonialController::class);

    //service
    Route::resource('service', ServiceController::class);
    Route::resource('service-category', ServiceCategoryController::class);

    Route::view('configuration',  'river::admin.configuration')->name('configuration');
    Route::get('update-package', [GitHubController::class, 'cloneGitHubRepo'])->name('update-package');
    Route::get('clear-cache', [GitHubController::class, 'ClearCache'])->name('clear-cache');
});
