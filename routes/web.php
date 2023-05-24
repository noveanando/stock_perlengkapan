<?php

//admin
Route::prefix('auth')->group(function () {
    Route::get('/', '\App\Http\Controllers\AuthController@auth');
    Route::get('login', '\App\Http\Controllers\AuthController@login')->name('login');
    Route::post('login', '\App\Http\Controllers\AuthController@postLogin')->name('post-login');
    Route::get('resets-password', '\App\Http\Controllers\AuthController@sendEmailPassword')->name('send-email-pass');
    Route::post('password/email', '\App\Http\Controllers\Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::get('password/reset/{token}', '\App\Http\Controllers\AuthController@resetPassword')->name('password.reset');
    Route::post('password/reset', '\App\Http\Controllers\Auth\ResetPasswordController@reset')->name('post.password.reset');
    Route::get('logout', '\App\Http\Controllers\AuthController@logout')->name('logout');
});

Route::group(['namespace' => 'Admin'], function () {
    Route::post('get-data', 'DatatableController@getData')->name('get-data');
});

Route::middleware(['auth.admin'])->namespace('Admin')->group(function () {
    Route::get('/', '\App\Http\Controllers\AuthController@homeAdmin')->name('admin');
    Route::get('dashboard', 'MasterController@dashboard')->name('dashboard');
    Route::get('log', 'LogController@log')->name('log');
    Route::post('get-modal-media/{type}', 'MediaController@getModalMedia')->name('get-modal-media');

    Route::prefix('setting')->group(function () {
        Route::get('description-site', 'MasterController@descSite')->name('desc-site');
        Route::get('multi-lang', 'MasterController@multiLang')->name('multi-lang');
        Route::get('general', 'MainController@setGeneral')->name('set-general');
        Route::post('save/{type}', 'MasterController@descSiteSave')->name('desc-site-save');
        Route::post('save-multi-lang', 'MasterController@multiLangSave')->name('multi-lang-save');

        Route::get('profil', 'MasterController@profil')->name('profil');
        Route::post('profil/save', 'MasterController@profilSave')->name('profil-save');
        Route::post('change-password', 'MasterController@changePassword')->name('change-password');

        Route::prefix('handle-image')->group(function () {
            Route::get('/', 'HandleImageController@handleImage')->name('handle-image');
            Route::get('entry/{id?}', 'HandleImageController@getDataFirst')->name('handle-image-entry');
            Route::post('save/{id}', 'HandleImageController@saveData')->name('handle-image-save');
            Route::post('delete/{id}', 'HandleImageController@deleteData')->name('handle-image-delete');
        });
    });

    Route::prefix('role')->group(function () {
        Route::get('/', 'RoleController@role')->name('role');
        Route::get('entry/{id?}', 'RoleController@getDataFirst')->name('role-entry');
        Route::post('save/{id}', 'RoleController@saveData')->name('role-save');
        Route::post('delete/{id}', 'RoleController@deleteData')->name('role-delete');
    });

    Route::prefix('library')->group(function () {
        Route::get('image', 'MediaController@mediaLibrary')->name('image');
        Route::get('video', 'MediaController@mediaLibrary')->name('video');
        Route::get('file', 'MediaController@mediaLibrary')->name('application');
        Route::get('audio', 'MediaController@mediaLibrary')->name('audio');
        Route::post('save/{type}/{trigger?}', 'MediaController@mediaLibrarySave')->name('media-library-save');
        Route::post('delete/{type}/{id}', 'MediaController@mediaDelete')->name('media-library-delete');
    });

    Route::prefix('account')->group(function () {
        Route::get('/', 'AccountController@account')->name('account');
        Route::get('entry/{id?}', 'AccountController@getDataFirst')->name('account-entry');
        Route::post('save/{id}', 'AccountController@saveData')->name('account-save');
        Route::post('delete/{id}', 'AccountController@deleteData')->name('account-delete');
        Route::post('multi-delete', 'AccountController@deleteMulti')->name('account-multi-delete');
        Route::get('autocomplete', 'AccountController@autocomplete')->name('account-autocomplete');
        Route::get('reset/{id}', 'AccountController@reset')->name('account-reset');
    });

    Route::prefix('location')->group(function () {
        Route::get('/', 'LocationController@location')->name('location');
        Route::get('entry/{id?}', 'LocationController@getDataFirst')->name('location-entry');
        Route::post('save/{id}', 'LocationController@saveData')->name('location-save');
        Route::post('delete/{id}', 'LocationController@deleteData')->name('location-delete');
        Route::get('autocomplete', 'LocationController@autocomplete')->name('location-autocomplete');
    });

    Route::prefix('asset_data')->group(function () {
        Route::get('/', 'AssetController@asset_data')->name('asset_data');
        Route::get('entry/{id?}', 'AssetController@getDataFirst')->name('asset_data-entry');
        Route::post('save/{id}', 'AssetController@saveData')->name('asset_data-save');
        Route::post('delete/{id}', 'AssetController@deleteData')->name('asset_data-delete');
        Route::post('add-history/{id}/{status}', 'AssetController@addHistory')->name('asset_data-history');
        Route::get('export-excel', 'AssetController@exportExcel')->name('asset_data-excel');
        Route::get('qrcode', 'AssetController@qrcode')->name('asset_data-qrcode');
        Route::get('search-asset', 'AssetController@searchAsset')->name('asset_data-search-asset');
    });

    Route::prefix('category')->group(function () {
        Route::get('/', 'CategoryController@category')->name('category');
        Route::get('entry/{id?}', 'CategoryController@getDataFirst')->name('category-entry');
        Route::post('save/{id}', 'CategoryController@saveData')->name('category-save');
        Route::post('delete/{id}', 'CategoryController@deleteData')->name('category-delete');
        Route::get('autocomplete', 'CategoryController@autocomplete')->name('category-autocomplete');
    });

    Route::prefix('company')->group(function () {
        Route::get('/', 'CompanyController@company')->name('company');
        Route::get('entry/{id?}', 'CompanyController@getDataFirst')->name('company-entry');
        Route::post('save/{id}', 'CompanyController@saveData')->name('company-save');
        Route::post('delete/{id}', 'CompanyController@deleteData')->name('company-delete');
        Route::get('autocomplete', 'CompanyController@autocomplete')->name('company-autocomplete');
    });

    Route::prefix('asset_status')->group(function () {
        Route::get('/', 'AssetStatusController@asset_status')->name('asset_status');
        Route::get('entry/{id?}', 'AssetStatusController@getDataFirst')->name('asset_status-entry');
        Route::post('save/{id}', 'AssetStatusController@saveData')->name('asset_status-save');
        Route::post('delete/{id}', 'AssetStatusController@deleteData')->name('asset_status-delete');
        Route::get('autocomplete', 'AssetStatusController@autocomplete')->name('asset_status-autocomplete');
    });

    Route::prefix('penggunaan')->group(function () {
        Route::get('/', 'PenggunaanController@penggunaan')->name('penggunaan');
        Route::get('entry/{id?}', 'PenggunaanController@getDataFirst')->name('penggunaan-entry');
        Route::post('save/{id}', 'PenggunaanController@saveData')->name('penggunaan-save');
        Route::post('delete/{id}', 'PenggunaanController@deleteData')->name('penggunaan-delete');
        Route::get('autocomplete', 'PenggunaanController@autocomplete')->name('penggunaan-autocomplete');
    });
});
