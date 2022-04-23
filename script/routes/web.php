<?php

use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\InitializeTenancyByPath;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|-----------------------------------------------------------------
| Todo
|-----------------------------------------------------------------
 */



// Alert after Order Expired
Route::get('cron/make-plan-expire', 'CronController@expireOrder')->name('alert.after.order.expired');
// Alert before Order Expired
Route::get('cron/alert-before-expire-plan', 'CronController@alertBeforeExpire')->name('alert.before.order.expired');

Route::group(['domain' => env('APP_URL')], function ($domain) {


    Route::get('/', 'HomeController@index');
    Route::get('/information', 'HomeController@information');
    Route::post('/subscribe', 'HomeController@subscribe')->name('newsletter');
    Auth::routes();
    Route::get('/home', 'HomeController@index');
    Route::post('register/step1','RegisterController@step1')->name('register.step1');
    Route::post('register/store/check','RegisterController@store_check')->name('register.store_check');
    Route::get('register/step2','RegisterController@index')->name('register.step2');
    Route::post('register/step2/store','RegisterController@step2')->name('register.step2.store');

    // Blog Routes
    Route::get('blogs','BlogController@index')->name('blog.index');
    Route::get('blog/{slug}','BlogController@show')->name('blog.show');

    Route::get('page/{slug}','BlogController@pageView');
    Route::get('templates/{slug}','BlogController@templates');

    Route::get('pricing','PricingController@index')->name('pricing.index');


    // Contact Routes
    Route::get('contact','ContactController@index')->name('contact.index');
    Route::post('sendmail','ContactController@sendMail')->name('sendMail');
    //login with google
    Route::get('/login/google', 'Auth\LoginController@redirectToGoogle')->name('login.google');
    Route::get('/login/google/callback', 'Auth\LoginController@handleGoogleCallback');
    //login with github
    Route::get('/login/github', 'Auth\LoginController@redirectToGithub')->name('login.github');
    Route::get('/login/github/callback', 'Auth\LoginController@handleGithubCallback');
    //login with facebook
    Route::get('/login/facebook', 'Auth\LoginController@redirectToFacebook')->name('login.facebook');
    Route::get('/login/facebook/callback', 'Auth\LoginController@handleFacebookCallback');
    // Language Swith
    Route::get('lang','LanguageController@lang')->name('lang.set');




    Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth', 'admin']], function () {
        Route::get('dashboard', 'DashboardController@index')->name('dashboard');

        Route::get('/dashboard/static','DashboardController@staticData');
        Route::get('/dashboard/perfomance/{period}','DashboardController@perfomance');
        Route::get('/dashboard/visitors/{days}','DashboardController@google_analytics');
        Route::get('/dashboard/order_statics/{month}','DashboardController@order_statics');


        Route::resource('plan', 'PlanController');
        Route::resource('payment_gateway', 'PaymentGatewayController');
        Route::resource('profile', 'ProfileController');
        Route::post('/order/status', 'OrderController@status')->name('order.status');
        Route::get('/order/plan-name/{id}', 'OrderController@orderByPlanName');
        Route::resource('order', 'OrderController');
        Route::resource('domain', 'DomainController');
        Route::post('domains/destroy', 'DomainController@destroy')->name('domains.destroys');
        Route::post('/customer/view-mail', 'CustomerController@viewMail')->name('customer.view-mail');
        Route::post('/customer/status', 'CustomerController@status')->name('customer.status');
        Route::resource('customer', 'CustomerController');
        Route::get('customers/login/{id}', 'CustomerController@login')->name('customer.login');
        Route::resource('customer/download-qrcode', 'CustomerController@downloadQr');
        Route::resource('report', 'OrderReportController');
        Route::resource('cvlanguage', 'CvlanguageController');
        Route::post('/tenant/status', 'TenantController@status')->name('tenant.status');
        Route::get('/tenant/config/{id}', 'TenantController@config')->name('tenant.config');

        Route::put('/tenant/profile/update/{id}', 'TenantController@updateProfile')->name('tenant.profile.update');
        Route::put('/tenant/config/{id}/update', 'TenantController@configUpdate')->name('tenant.config.update');
        Route::put('/tenant/domain/{id}/update', 'TenantController@domainUpdate')->name('tenant.domain.update');
        Route::post('/tenant/domain/create', 'TenantController@domainCreate')->name('tenant.domain.create');

        Route::post('/tenant/subdomain/update/{id}', 'TenantController@subdomainUpdate')->name('tenant.subdomain.update');
        Route::resource('tenant', 'TenantController');
        Route::resource('blog', 'BlogController');
        Route::resource('page', 'PageController');
        Route::resource('cron', 'CronController');
        Route::resource('benefit', 'BenefitController');
        Route::resource('template-image', 'TemplateImageController');
        Route::resource('template', 'TemplateController');
        Route::resource('cvtemplate', 'CvTemplateController');
        Route::resource('company', 'CompanyController');
        Route::resource('role', 'RoleController');
        Route::resource('vcard', 'VCardController');
        // using this route for multiple delete
        Route::post('roles/destroy', 'RoleController@destroy')->name('roles.destroy');
        // Admin Route
        Route::resource('admin', 'AdminController');
        // using this route for multiple delete
        Route::post('/admins/destroy', 'AdminController@destroy')->name('admins.destroy');

        //Route for theme settings
        Route::get('theme-settings', 'OptionController@settingsEdit')->name('theme-settings');
        Route::put('theme-settings-update', 'OptionController@settingsUpdate')->name('theme-settings.update');

        //Option route
        Route::get('option/seo-index', 'OptionController@seoIndex')->name('option.seo-index');
        Route::get('option/seo-edit/{id}', 'OptionController@seoEdit')->name('option.seo-edit');
        Route::put('option/seo-update/{id}', 'OptionController@seoUpdate')->name('option.seo-update');

        Route::get('option/other', 'OptionController@otherOption')->name('option.other');
        Route::post('option/other/update', 'OptionController@otherUpdate')->name('option.other.update');

        Route::get('option/config-dns', 'OptionController@configDns')->name('option.config-dns');
        Route::put('option/config-dns-update/{id}', 'OptionController@configDnsUpdate')->name('option.config-dns-update');

        // Language Route
        Route::resource('language', 'LanguageController');
        Route::post('language/set', 'LanguageController@lang_set')->name('language.set');
        Route::post('language/key_store', 'LanguageController@key_store')->name('key_store');

        Route::get('order-excel', 'OrderReportController@excel')->name('order.excel');
        Route::get('order-csv', 'OrderReportController@csv')->name('order.csv');
        Route::get('order-pdf', 'OrderReportController@pdf')->name('order.pdf');
        Route::get('report-invoice/{id}', 'OrderReportController@invoicePdf')->name('report.pdf');

        // Menu Route
        Route::resource('menu', 'MenuController');
        Route::post('/menus/destroy', 'MenuController@destroy')->name('menus.destroy');
        Route::post('menues/node', 'MenuController@MenuNodeStore')->name('menus.MenuNodeStore');

        Route::resource('env', 'SystemController');
    });

    Route::group(['prefix' => 'user', 'as' => 'user.', 'namespace' => 'User', 'middleware' => ['auth', 'user']], function () {
        Route::get('dashboard', 'DashboardController@index')->name('dashboard');
        Route::get('qrcode/change','DashboardController@qrcodeChange')->name('qrcodeChange');
        Route::get('download-qrcode', 'DashboardController@qrDownload');
        Route::get('download-vcard-qrcode', 'DashboardController@vcardDownload');
        Route::get('dashboard/stats', 'DashboardController@stats')->name('dashboard.stats');
        Route::get('/gateways/{id}', 'PlanController@gateways')->name('plan.gateways');
        Route::post('/deposit', 'PlanController@deposit')->name('plan.deposit');

        //Payment status route
        Route::get('payment/success', 'PlanController@success')->name('payment.success');
        Route::get('payment/failed', 'PlanController@failed')->name('payment.failed');
        Route::get('plan-invoice/{id}', 'PlanController@invoicePdf');
        Route::resource('plan', 'PlanController');
        Route::post('/sud-domain-create/{id}','DomainController@subdomainStore')->name('subdomain.store');
        Route::put('/subdomain-update/{id}','DomainController@subdomainUpdate')->name('subdomain.update');

        Route::post('/custom-domain-create/{id}','DomainController@customdomainStore')->name('custom-domain.store');
        Route::put('/custom-update/{id}','DomainController@customdomainUpdate')->name('custom-domain.update');

        Route::delete('/subdomain-delete/{id}','DomainController@destroy')->name('subdomain.destroy');
        Route::delete('/customdomain-delete/{id}','DomainController@destroyCustomdomain')->name('customdomain.destroy');
        Route::group(['middleware' => 'tenant'], function () {
            Route::resource('blog', 'BlogController');
            Route::resource('service', 'ServiceController');
            Route::resource('experience', 'ExperienceController');
            Route::resource('skill', 'SkillController');
            Route::resource('testimonial', 'TestimonialController');
            Route::resource('project', 'ProjectController');
            Route::resource('education', 'EducationController');
            Route::resource('workprocess', 'WorkProcessController');
            Route::resource('team', 'MyTeamController');
            Route::resource('profile', 'ProfileController');
            Route::post('/vcard/theme', 'VCardController@theme')->name('vcard.theme');

            Route::resource('vcard', 'VCardController');
            Route::resource('template', 'TemplateController');
            Route::resource('seo', 'SeoController');
            //site settings route
            Route::get('site/settings', 'UserOptionController@siteSettingIndex')->name('site.settings');
            Route::post('site/settings/update', 'UserOptionController@siteSettingUpdate')->name('site.settings.update');
            Route::post('site/settings/css-js', 'UserOptionController@script')->name('update.cssjs');

            Route::resource('settings', 'SettingsController');
            Route::get('/cv/builder', 'CvController@index')->name('cv.builder');
            Route::get('/cv/download/', 'CvController@download')->name('cv.download');
            Route::get('/cv/language', 'CvController@language')->name('cv.language');

            Route::get('cv/formtheme', 'CvController@formtheme')->name('cv.formtheme');

            Route::post('/cv/store', 'CvController@store')->name('cv.store');
            Route::post('/cv/reset', 'CvController@reset')->name('cv.reset');
            Route::post('/cv/ajaxstore', 'CvController@ajaxstore')->name('cv.ajaxstore');
            Route::get('/cv/fetch', 'CvController@fetch')->name('cv.fetch');
        });

    });

});



//**======================== Payment Gateway Route Group for merchant ====================**//

Route::group(['middleware' => ['auth', 'user']], function () {

    Route::get('/payment/paypal', '\App\Lib\Paypal@status');
    Route::post('/stripe/payment', '\App\Lib\Stripe@status')->name('stripe.payment');
    Route::get('/stripe/{from}', '\App\Lib\Stripe@view')->name('stripe.view');
    Route::get('/payment/mollie', '\App\Lib\Mollie@status');

    Route::post('/payment/paystack', '\App\Lib\Paystack@status');
    Route::get('/user/paystack/{from}', '\App\Lib\Paystack@view')->name('user.paystack.view');

    Route::get('/mercadopago/pay', '\App\Lib\Mercado@status')->name('user.mercadopago.status');

    Route::get('user/tap/view/{from}', '\App\Lib\Tap@view')->name('user.tap.view');
    Route::get('/payment/tap/', '\App\Lib\Tap@status')->name('user.tap.status');
    Route::post('/payment/tap/authorize', '\App\Lib\Tap@authorize')->name('user.tap.authorize');

    Route::get('/razorpay/payment/{from}', '\App\Lib\Razorpay@view')->name('razorpay.view');
    Route::post('user/razorpay/status', '\App\Lib\Razorpay@status');
    Route::get('/payment/flutterwave', '\App\Lib\Flutterwave@status');
    Route::get('/payment/thawani', '\App\Lib\Thawani@status');
    Route::get('/payment/instamojo', '\App\Lib\Instamojo@status');
    Route::get('/payment/toyyibpay', '\App\Lib\Toyyibpay@status');
    Route::get('/payment/hyperpay', '\App\Lib\Hyperpay@status');
    Route::get('/merchant/razorpay/payment', '\App\Lib\Hyperpay@view');

    Route::get('/manual/payment', '\App\Lib\CustomGetway@status');

    Route::get('user/payu/payment/', '\App\Lib\Payu@view')->name('user.payu.view');
    Route::post('user/payu/status', '\App\Lib\Payu@status')->name('user.payu.status');
});


Route::group([
    'prefix'     => '/profile/{tenant}',
    'middleware' => [InitializeTenancyByPath::class,'domain'],
], function () {

    Route::get('/','ProfileController@indexPath');

    Route::get('/my-cv', 'HomeController@cv');


    Route::get('/about', 'DataControProfileControllerller@about');
    Route::get('/portfolio', 'ProfileController@portfolio');
    Route::get('/getportfolio', 'ProfileController@getportfolio');


    Route::get('/blog', 'TenantBlog@blog');
    Route::get('/bloglist','TenantBlog@blogs');
    Route::get('/blog/{slug}/{id}', 'TenantBlog@show');
    //ajax request data

    Route::get('/information', 'ProfileController@information');
    Route::get('/about-me-info', 'ProfileController@aboutMeInfo');
    Route::post('/contact-mail', 'ProfileController@sendMailByContact')->middleware('throttle:2,1');
    Route::get('/download-vcard', 'User\VCardController@download');
    Route::get('/my-vcard', 'HomeController@vcard')->name('user.vcard');

});


Route::group([['domain' => '{subdomain}.' . env('APP_PROTOCOLESS_URL')], 'middleware' => [
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,
    'domain',
    'subdomain'
]], function () {

    Route::get('/','ProfileController@index');

    Route::get('/my-cv', 'HomeController@cv');


    Route::get('/about', 'DataControProfileControllerller@about');
    Route::get('/portfolio', 'ProfileController@portfolio');
    Route::get('/getportfolio', 'ProfileController@getportfolio');


    Route::get('/blog', 'TenantBlog@blog');
    Route::get('/bloglist','TenantBlog@blogs');
    Route::get('/blog/{slug}/{id}', 'TenantBlog@show');
    //ajax request data

    Route::get('/information', 'ProfileController@information');
    Route::get('/about-me-info', 'ProfileController@aboutMeInfo');
    Route::post('/contact-mail', 'ProfileController@sendMailByContact')->middleware('throttle:2,1');
    Route::get('/download-vcard', 'User\VCardController@download');
    Route::get('/my-vcard', 'HomeController@vcard')->name('user.vcard');

});


Route::group(['domain' => '{domain}','middleware'=>[
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,
    'domain',
    'customdomain'
    ]], function()
{

    Route::get('/','ProfileController@index');

    Route::get('/my-cv', 'HomeController@cv');

    Route::get('/about', 'DataControProfileControllerller@about');
    Route::get('/portfolio', 'ProfileController@portfolio');
    Route::get('/getportfolio', 'ProfileController@getportfolio');


    Route::get('/blog', 'TenantBlog@blog');
    Route::get('/bloglist','TenantBlog@blogs');
    Route::get('/blog/{slug}/{id}', 'TenantBlog@show');
    //ajax request data

    Route::get('/information', 'ProfileController@information');
    Route::get('/about-me-info', 'ProfileController@aboutMeInfo');
    Route::post('/contact-mail', 'ProfileController@sendMailByContact')->middleware('throttle:2,1');;
    Route::get('/download-vcard', 'User\VCardController@download');
    Route::get('/my-vcard', 'HomeController@vcard')->name('user.vcard');

 });
