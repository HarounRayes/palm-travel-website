<?php


use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;


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


Auth::routes();


Route::get('/clear-cache-admin', function () {
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('route:clear');
    Artisan::call('optimize:clear');
    // Artisan::call('config:cache');
 
    return "Cache cleared successfully";
 });

// Admin routes
Route::prefix('admin')->group(function () {

    // Ajax routes
    Route::post('/cityOfCountry', 'Backend\AjaxController@getCityOfCountry');
    Route::post('/hotelOfCountry', 'Backend\AjaxController@gethotelOfCountry');
    Route::post('/inclusions', 'Backend\AjaxController@addinclusion');
    Route::post('/exclusions', 'Backend\AjaxController@addexclusion');
    Route::post('/labels', 'Backend\AjaxController@addlabel');
    Route::post('/days', 'Backend\AjaxController@addday');
    Route::post('/transfers', 'Backend\AjaxController@addtransfer');
    Route::post('/tours-of-package', 'Backend\AjaxController@addtourtoday');
    Route::post('/admin-hotels', 'Backend\AjaxController@addhotel');
    Route::post('/tourofcity', 'Backend\AjaxController@gettourofcity');
    Route::post('/flights', 'Backend\AjaxController@addflight');
    Route::post('/segment', 'Backend\AjaxController@addsegmenttoflight');
    Route::post('/hotelsegments', 'Backend\AjaxController@addsegmenttofhotel');
    Route::post('/hotelpricing', 'Backend\AjaxController@addpricingofhotel');

    Route::post('/type-to-home', 'Backend\AjaxController@addtypetohome');
    Route::post('/activity-tour-to-home', 'Backend\AjaxController@addActivityTourToHome');
    Route::post('/country-to-home', 'Backend\AjaxController@addcountrytohome');
    Route::post('/main-country-to-home', 'Backend\AjaxController@addMainCountryToHome');
    Route::post('/nationalitiesOfCountry', 'Backend\AjaxController@getNationalitiesOfCountry');
    Route::post('/activitycityOfCountry', 'Backend\AjaxController@getActivityCityOfCountry');
    Route::post('/activitycategory', 'Backend\AjaxController@addTourCategory');
    Route::post('/activitystatus', 'Backend\AjaxController@updateGlobalStatus');
    Route::post('/activePackage', 'Backend\AjaxController@updatePackageStatus');
    Route::post('/featurePackage', 'Backend\AjaxController@updatePackageFeatured');
    Route::post('/outbound-visa-status', 'Backend\AjaxController@updateGlobalStatus');
    Route::post('/uae-visa-status', 'Backend\AjaxController@updateGlobalStatus');
    Route::post('/accepted-enquiry', 'Backend\AjaxController@acceptedEnquiry');

    Route::post('/visa-type-to-home', 'Backend\AjaxController@addVisaTypeToHome');
    Route::post('/visa-nationality-to-home', 'Backend\AjaxController@addVisaNationalityToHome');

    Route::post('/nationality-type', 'Backend\AjaxController@nationalityType');

    Route::post('/enquiries/accepted-enquiry', 'Backend\AjaxController@acceptedEnquiry');


    Route::get('/', 'Users\Admin\AdminController@index')->name('admin.dashboard');

    Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');

    Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
    Route::get('/register', 'Auth\AdminRegisterController@showRegisterForm')->name('admin.register');
    Route::post('/register', 'Auth\AdminRegisterController@register')->name('admin.register.submit');
    Route::name('admin.')->group(function () {
        Route::group(['middleware' => 'auth:admin'], function () {
            Route::get('blogs/information', 'Backend\BlogController@showInfoForm')->name('blogs.info')->middleware(["permission:blogs.info"]);
            Route::patch('blogs/information', 'Backend\BlogController@saveInfo')->name('blogs.info.save')->middleware(["permission:blogs.info"]);

            Route::get('/order', 'Backend\CountryController@showOrderForm')->name('countries.order')->middleware(["permission:countries.order"]);
            Route::patch('/order', 'Backend\CountryController@saveOrder')->name('countries.order.save')->middleware(["permission:countries.order"]);

            Route::get('/services/order', 'Backend\ServiceController@showOrderForm')->name('services.order');
            Route::patch('/services/order', 'Backend\ServiceController@saveOrder')->name('services.order.save');

            Route::get('packages/information', 'Backend\GeneralInformationController@showPackagesInfoForm')->name('packages.info');
            Route::patch('packages/information', 'Backend\GeneralInformationController@savePackagesInfo')->name('packages.info.save');

            Route::resource('countries', Backend\CountryController::class)->middleware(["check_country_permission"]);

            Route::resource('cities', Backend\CityController::class)->middleware(["check_normal_permission:cities"]);
            Route::resource('users', Backend\AdminController::class)->middleware(['check_user_permission:admins']);
            Route::resource('pages', Backend\PageController::class)->only(['edit', 'update'])->middleware(['check_edit_permission:pages']);
            Route::resource('tours', Backend\TourController::class)->middleware(["check_normal_permission:tours"]);
            Route::resource('blogs', Backend\BlogController::class)->middleware(["check_blog_permission"]);;
            Route::resource('roles', Backend\RoleController::class)->middleware(['check_user_permission:roles']);
            Route::resource('blogs.sliders', Backend\BlogSliderController::class)->middleware(["permission:blogs.slider"]);
            Route::resource('blogs.comments', Backend\CommentController::class)->middleware(["permission:blogs.comment"]);
            Route::resource('hotels', Backend\HotelController::class)->middleware(["check_normal_permission:hotels"]);
            Route::get('packages/order/{country}', 'Backend\PackageController@showOrderForm')->name('packages.order')->middleware(['permission:packages.order']);
            Route::patch('packages/order', 'Backend\PackageController@saveOrder')->name('packages.order.save')->middleware(['permission:packages.order']);
            Route::resource('packages', Backend\PackageController::class)->middleware(['check_package_permission']);
            Route::resource('packages.sliders', Backend\PackageSliderController::class)->middleware(['permission:packages.slider']);
            Route::resource('sliders', Backend\SliderController::class)->middleware(["check_normal_permission:sliders"]);;
            Route::resource('settings', Backend\SiteSettingController::class)->only(['index', 'edit', 'update'])->middleware(['check_edit_permission:setting']);
            Route::resource('models', Backend\GlobalModelController::class)->only(['update'])->middleware(['role:super-admin']);
            Route::resource('enquiries', Backend\EnquiryController::class)->except('create', 'store', 'edit', 'update');
            Route::resource('partners', Backend\PartnerController::class)->middleware(["check_normal_permission:partners"]);
            Route::resource('services', Backend\ServiceController::class)->middleware(["check_normal_permission:services"]);
            Route::resource('newsletter', Backend\NewsletterController::class)->only(['index']);

            Route::get('home-images', 'Backend\GeneralInformationController@showInfoForm')->name('home.info');
            Route::patch('home-images', 'Backend\GeneralInformationController@saveInfo')->name('home.info.save');

            Route::get('orders', 'Backend\EnquiryController@index_order')->name('orders.index');
            Route::get('orders/{id}', 'Backend\EnquiryController@show')->name('orders.show');

            Route::prefix('visa')->group(function () {
                Route::get('information', 'Backend\VisaOutboundController@showInfoForm')->name('visa.info')->middleware(["permission:visa.info"]);
                Route::patch('information', 'Backend\VisaOutboundController@saveInfo')->name('visa.info.save')->middleware(["permission:visa.info"]);
                Route::get('uae/information', 'Backend\VisaUaeController@showInfoForm')->name('visa.uae.info')->middleware(["permission:visa.info"]);
                Route::patch('uae/information', 'Backend\VisaUaeController@saveInfo')->name('visa.uae.info.save')->middleware(["permission:visa.info"]);

                Route::get('uaes/application', 'Backend\VisaUaeApplicationController@index')->name('visa.uae.application.index');
                Route::get('uaes/application/{id}', 'Backend\VisaUaeApplicationController@view')->name('visa.uae.application.view');

                Route::get('outbounds/application', 'Backend\VisaOutboundApplicationController@index')->name('visa.outbound.application.index');
                Route::get('outbounds/application/{id}', 'Backend\VisaOutboundApplicationController@view')->name('visa.outbound.application.view');


                Route::resource('visacountries', Backend\VisaCountryController::class)->middleware(["check_normal_permission:visa.countries"]);
                Route::resource('nationalities', Backend\VisaNationalityController::class)->middleware(["check_normal_permission:visa.nationalities"]);
                Route::resource('uaeNationalities', Backend\VisaUaeNationalityController::class)->middleware(["check_normal_permission:visa.uae.nationalities"]);
                Route::resource('types', Backend\VisaTypeController::class)->middleware(["check_normal_permission:visa.types"]);
                Route::resource('uaeTypes', Backend\VisaUaeTypeController::class)->middleware(["check_normal_permission:visa.uaeTypes"]);
                Route::resource('uaeRequirements', Backend\VisaUaeRequirementController::class)->middleware(["check_normal_permission:visa.uaeRequirements"]);
                Route::resource('outbounds', Backend\VisaOutboundController::class)->middleware(["check_normal_permission:visa.outbounds"]);

                Route::get('uaes/configuration', 'Backend\VisaUaeController@showConfigForm')->name('uaes.config');
                Route::patch('uaes/configuration', 'Backend\VisaUaeController@saveConfig')->name('uaes.config.save');
                Route::resource('uaes', Backend\VisaUaeController::class)->middleware(["check_normal_permission:visa.uae"]);

                Route::get('/uae/application/{id}/transaction', 'Backend\TransactionController@index_uae_visa')->name('uaes.transaction');
            });
            Route::prefix('activity')->group(function () {
                Route::get('information', 'Backend\ActivityTourController@showInfoForm')->name('activity.info')->middleware(["permission:activities.info"]);
                Route::patch('information', 'Backend\ActivityTourController@saveInfo')->name('activity.info.save')->middleware(["permission:activities.info"]);

                Route::resource('activitycountries', Backend\ActivityCountryController::class)->middleware(["check_activity_country_permission"]);
                Route::resource('activitycities', Backend\ActivityCityController::class)->middleware(["check_normal_permission:activities.cities"]);
                Route::resource('activitycategories', Backend\ActivityCategoryController::class)->middleware(["check_normal_permission:activities.categories"]);
                Route::resource('activitytours', Backend\ActivityTourController::class)->middleware(["check_normal_permission:activities.tours"]);
                Route::resource('steps', Backend\ActivityStepController::class)->middleware(["check_normal_permission:activities.steps"]);
                Route::resource('images', Backend\ActivityTourImageController::class);

                Route::get('orders', 'Backend\ActivityOrderController@index')->name('activity.order.index');
                Route::get('enquiries', 'Backend\ActivityOrderController@index_enquiry')->name('activity.enquiry.index');
                Route::get('orders/{id}', 'Backend\ActivityOrderController@view')->name('activity.order.view');
                Route::get('enquiries/{id}', 'Backend\ActivityOrderController@view_enquiry')->name('activity.enquiry.view');

                Route::get('/{id}/transaction', 'Backend\TransactionController@index_activity')->name('activities.transaction');
            });
//                    Route::patch('/restore', "Backend\CountryController@restore")->name('countries.restore');
//                    Route::patch('cities/{id}/restore', "Backend\CityController@restorecity")->name('cities.restore');
        });
    });

});


Route::get('setlocale/{locale}', function ($lang) {
    \Session::put('locale', $lang);
    return redirect()->back();
})->name('setlocale');


Route::group(['middleware' => 'language'], function () {
    Route::post('/view-activity', 'Frontend\ActivityController@viewActivity')->name('view-activity');
    Route::post('/get-city-of-country', 'Frontend\ActivityController@getCityOfCountry')->name('get-city-of-country');
    Route::post('/delete-activity-from-card', 'Frontend\ActivityController@deleteActivityFromCardNew')->name('delete-activity-from-card');
    Route::post('/add-activity-to-card', 'Frontend\ActivityController@addActivityToCard')->name('add-activity-to-card');
    Route::post('/add-activity-to-card-new', 'Frontend\ActivityController@addActivityToCardNew')->name('add-activity-to-card-new');
    Route::post('/add-activity-child', 'Frontend\ActivityController@addActivityChildren')->name('add-activity-child');
    Route::post('/set-person-activity-card', 'Frontend\ActivityController@setPersonActivityCard')->name('set-person-activity-card');

    Route::post('/add-favorite', 'Frontend\AjaxController@addToFavorite')->name('add-favorite');
    Route::post('/delete-from-favorite', 'Frontend\AjaxController@DeleteFromFavorite')->name('delete-from-favorite');
    Route::post('/delete-favorite', 'Frontend\AjaxController@DeleteFavorite')->name('delete-favorite');
    Route::post('/open-favorite', 'Frontend\AjaxController@viewFavorite')->name('open-favorite');

    Route::post('/enquiry-header', 'Frontend\AjaxController@enquiryHeader');
    Route::post('/enquiry', 'Frontend\AjaxController@enquiry');
    Route::post('/send-enquiry-header', 'Frontend\MailController@sendEnquiryHeader')->name('send-enquiry-header');
    Route::post('/send-enquiry', 'Frontend\MailController@sendEnquiry')->name('send-enquiry');
    Route::post('view-enquiry-details', 'Frontend\AjaxController@viewEnquiryDetails')->name('view-enquiry-details');

    Route::post('view-favorite', 'Frontend\AjaxController@viewFavorite')->name('view-favorite');

    Route::post('/cost', 'Frontend\AjaxController@cost')->name('cost');
    Route::post('/add-child', 'Frontend\AjaxController@addChild')->name('add-child');
    Route::post('/add-room', 'Frontend\AjaxController@addRoom')->name('add-room');
    Route::post('/delete-order', 'Frontend\AjaxController@deleteOrder')->name('delete-order');
    Route::post('/delete-enquiry', 'Frontend\AjaxController@deleteEnquiry')->name('delete-enquiry');
    Route::post('/add-tour-child', 'Frontend\AjaxController@addTourChild')->name('add-tour-child');
    Route::post('/tour-cost', 'Frontend\AjaxController@tourCost')->name('tour-cost');
    Route::post('/add-day-tour', 'Frontend\AjaxController@addDayTour')->name('add-day-tour');
    Route::post('/add-tour-type', 'Frontend\AjaxController@addTourType')->name('add-tour-type');
    Route::post('/add-tour-all', 'Frontend\AjaxController@addTourAll')->name('add-tour-all');
    Route::post('/add-tour-bus', 'Frontend\AjaxController@addTourBus')->name('add-tour-bus');
    Route::post('/add-tour', 'Frontend\AjaxController@addTour')->name('add-tour');

    Route::post('/delete-all-tours', 'Frontend\AjaxController@deleteAllTours')->name('delete-all-tours');
    Route::post('/view-day-tour', 'Frontend\AjaxController@viewDayTour')->name('view-day-tour');
    Route::post('/view-session-tour', 'Frontend\AjaxController@viewSessionTour')->name('view-session-tour');
    Route::post('/delete-one-tour', 'Frontend\AjaxController@deleteOneTour')->name('delete-one-tour');
    Route::post('/add-tour-child-bus', 'Frontend\AjaxController@addTourChildBus')->name('add-tour-child-bus');
    Route::post('/tour-bus-cost', 'Frontend\AjaxController@tourBusCost')->name('tour-bus-cost');

    Route::post('/visa-cost', 'Frontend\AjaxController@visaCost')->name('visa-cost');
    Route::post('/set-visa-type', 'Frontend\AjaxController@setVisaType')->name('set-visa-type');

    Route::post('/visa-type-uae', 'Frontend\VisaController@visaTypeUae')->name('visa-type-uae');
    Route::post('/visa-type-outbound', 'Frontend\VisaController@visaTypeOutbound')->name('visa-type-outbound');
    Route::post('/set-uae-nationality', 'Frontend\VisaController@setUaeNationality')->name('set-uae-nationality');
    Route::post('/set-nationality', 'Frontend\VisaController@setNationality')->name('set-nationality');
    Route::post('/add-email', 'Frontend\VisaController@addEmail')->name('add-email');
    Route::post('/login-modal', 'Frontend\AjaxController@loginModal')->name('login-modal');

    Route::get('/home', 'Frontend\HomeController@index')->name('home');
    Route::get('/', 'Frontend\HomeController@index')->name('/');
    Route::get('/packages-all', 'Frontend\HomeController@countries')->name('packages.countries');
    Route::get('/packages', 'Frontend\HomeController@search')->name('packages');
    Route::get('/package/{symbol}/{hotel}', 'Frontend\HomeController@details')->name('details');

    Route::get('/blogs', 'Frontend\PageController@blogs')->name('blogs');
    Route::get('/blog/{symbol}', 'Frontend\PageController@blog')->name('blog');
    Route::get('/about', 'Frontend\PageController@about')->name('about');
    Route::get('/contact', 'Frontend\PageController@contact')->name('contact');
    Route::post('/contact', 'Frontend\MailController@sendContact')->name('send-contact');
    Route::get('/support', 'Frontend\PageController@support')->name('support');
    Route::get('/sitemap', 'Frontend\PageController@sitemap')->name('sitemap');
    Route::get('/terms', 'Frontend\PageController@terms')->name('terms');
    Route::get('/policy', 'Frontend\PageController@policy')->name('policy');
    Route::post('/comment/{blog}', 'Frontend\CommentController@add')->name('comment');
    Route::post('/newsletter', 'Frontend\HomeController@addNewsletter')->name('newsletter.save');


// Member routes
    Route::prefix('member')->group(function () {

        Route::get('/login', 'Auth\MemberController@showRegisterForm')->name('member.login');
        Route::post('/login', 'Auth\MemberController@login')->name('member.login.submit');
        Route::post('/register', 'Auth\MemberController@register')->name('member.register.submit');
        Route::get('logout', 'Auth\MemberController@logout')->name('member.logout');
        Route::get('/account', 'Users\Member\MemberController@account')->name('member.account');
        Route::get('/account/cart', 'Users\Member\MemberController@cart')->name('member.cart');
//        Route::get('/', 'Users\Member\MemberController@account')->name('member.account')->middleware('auth');
        Route::get('/change-password', 'Users\Member\MemberController@changePassword')->name('member.change-password');
        Route::post('/change-password', 'Users\Member\MemberController@savePassword')->name('member.change-password.save');

        Route::get('/password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('member.password.request');
        Route::post('/password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('member.password.email');
        Route::get('/password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('member.password.reset');
        Route::post('/password/reset', 'Auth\ResetPasswordController@reset')->name('member.password.update');
    });
    Route::prefix('activity')->group(function () {
        Route::get('/', 'Frontend\ActivityController@index')->name('activity.index');
        Route::get('/search', 'Frontend\ActivityController@search')->name('activity.search');
        Route::get('/card', 'Frontend\ActivityController@activityCard')->name('activity.card');
        Route::post('/card', 'Frontend\ActivityController@saveCardNew')->name('activity.card');

        Route::prefix('checkout')->group(function () {
            Route::get('/success', 'StripePaymentController@activity_success')->name('stripe.activity.success');
            Route::get('/cancel', 'StripePaymentController@activity_cancel')->name('stripe.activity.cancel');
            Route::get('/failed', 'StripePaymentController@activity_failed')->name('stripe.activity.failed');
        });
    });
    Route::prefix('visa')->group(function () {
        Route::prefix('uae')->group(function () {
            Route::get('/', 'Frontend\VisaUaeController@index')->name('visa.uae');
            Route::get('/search', 'Frontend\VisaUaeController@search')->name('visa.uae.search');
            // Route::group(['middleware' => 'auth:member'], function () {
            Route::post('/application', 'Frontend\VisaUaeController@uaeApplication')->name('visa.uae.application');
            Route::post('/application/add', 'Frontend\VisaUaeController@uaeApplicationSave')->name('visa.uae.application.save');
            Route::get('/applicant/{reference_id}', 'Frontend\VisaUaeController@applicant')->name('visa.uae.applicant');
            // });
            Route::prefix('checkout')->group(function () {
                Route::get('/success', 'StripePaymentController@visa_uae_success')->name('stripe.visa.uae.success');
                Route::get('/cancel', 'StripePaymentController@visa_uae_cancel')->name('stripe.visa.uae.cancel');
                Route::get('/failed', 'StripePaymentController@visa_uae_failed')->name('stripe.visa.uae.failed');
            });
        });
    });
    Route::prefix('facebook')->group(function () {
        Route::get('/redirect', 'Auth\SocialAuthFacebookController@redirect')->name('facebook.login');
        Route::get('/callback', 'Auth\SocialAuthFacebookController@handleProviderCallback');
    });

    Route::prefix('packages')->group(function () {
        Route::prefix('checkout')->group(function () {
            Route::get('/success', 'StripePaymentController@package_success')->name('stripe.package.success');
            Route::get('/cancel', 'StripePaymentController@package_cancel')->name('stripe.package.cancel');
            Route::get('/failed', 'StripePaymentController@package_failed')->name('stripe.package.failed');
        });
    });
    Route::post('/order', 'Frontend\PackageController@add_order')->name('order.save');
});

