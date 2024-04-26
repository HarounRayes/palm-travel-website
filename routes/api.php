<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['middleware' => 'language_api'], function () {

    Route::get('/home/data', 'Api\HomeController@getHomeData');

    Route::get('/sliders', 'Api\HomeController@get_sliders');
    Route::get('/services', 'Api\HomeController@get_services');
    Route::get('/partners', 'Api\HomeController@get_partners');
    Route::get('/home-countries', 'Api\HomeController@get_home_countries');
    Route::get('/home-video', 'Api\HomeController@get_home_video');
    Route::post('/set-newsletter', 'Api\HomeController@set_newsletter')->name('set-newsletter');
    Route::post('/set-enquiry', 'Api\HomeController@set_enquiry')->name('set-enquiry');

    Route::prefix('auth')->group(function () {
        Route::post('/login', 'Api\AuthController@login');
        Route::post('/register', 'Api\AuthController@register');
        Route::post('/refresh_token', 'Api\AuthController@refresh');
        Route::post('/device_token', 'Api\AuthController@saveDeviceToken')->middleware('auth:api');
        Route::post('/logout', 'Api\AuthController@logout')->middleware('auth:api');
        Route::get('/user-info', 'Api\AuthController@info')->middleware('auth:api');
        Route::post('/verify', 'Api\AuthController@verify')->middleware('auth:api');
        Route::get('/re-send-code', 'Api\AuthController@re_send')->middleware('auth:api');
        Route::post('/password/forgot', 'Api\AuthController@forgotPassword');
        Route::post('/password/reset', 'Api\AuthController@changePasswordPassword')->middleware('auth:api');
        Route::post('/password/change', 'Api\AuthController@changePassword');
        Route::post('/update/phone', 'Api\AuthController@phone_update');

        Route::get('/favorites', 'Api\AuthController@get_favourites')->middleware('auth:api');
        Route::get('/enquiries', 'Api\AuthController@get_enquiries')->middleware('auth:api');
        Route::get('/delete/favorite/{id}', 'Api\AuthController@delete_favorite')->middleware('auth:api');
        Route::get('/delete/enquiry/{id}', 'Api\AuthController@delete_enquiry')->middleware('auth:api');
    });

    Route::get('/countries/countries', 'Api\CountryController@get_countries');
    Route::get('/countries/months', 'Api\CountryController@get_months');

    Route::prefix('countries')->group(function () {
        Route::get('/', 'Api\CountryController@index');
        Route::get('/{id}', 'Api\CountryController@view');
    });

    Route::prefix('blogs')->group(function () {
        Route::get('/', 'Api\BlogController@index');
        Route::get('/general-information', 'BlogController@info');
        Route::get('/{id}', 'Api\BlogController@view');
        Route::post('/{id}/comment', 'Api\BlogController@add_comment')->name('add_comment');
    });

    Route::prefix('packages')->group(function () {
        Route::get('/', 'Api\PackageController@index');
        Route::get('/view', 'Api\PackageController@view');
        Route::post('/send-enquiry', 'Api\PackageController@sendEnquiry');
    });

    Route::prefix('activities')->group(function () {
        Route::get('/', 'Api\ActivityController@index');
        Route::get('/view', 'Api\ActivityController@view');
        Route::get('/steps', 'Api\ActivityController@get_steps');
        Route::get('/categories', 'Api\ActivityController@get_categories');
        Route::get('/types', 'Api\ActivityController@get_types');
        Route::get('/countries', 'Api\ActivityController@get_countries');
        Route::get('/cities', 'Api\ActivityController@get_cities_of_country');
    });

    Route::prefix('visa')->group(function () {
        Route::prefix('uae')->group(function () {
            Route::get('/types', 'Api\VisaUaeController@get_types');
            Route::get('/countries', 'Api\VisaUaeController@get_countries');
            Route::get('/nationalities', 'Api\VisaUaeController@get_nationalities');
            Route::get('/get-visa-requirements', 'Api\VisaUaeController@get_nationality_requirments');
            Route::get('/get-visa-form', 'Api\VisaUaeController@get_visa_form');
            Route::post('/form-save', 'Api\VisaUaeController@uaeApplicationSave');
        });
    });

    Route::prefix('static-data')->group(function () {
        Route::get('/general-info', 'Api\StaticController@general_info');
    });
});


