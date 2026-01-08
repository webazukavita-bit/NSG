<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\CRMController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MasterController;
use App\Http\Controllers\SupportController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TrainingController;
use Illuminate\Support\Facades\Auth;

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();    

Route::get('/', [HomeController::class, 'index']);
Route::get('/home', [HomeController::class, 'index'])->name('home');

// Route::get('/privacy', [HomeController::class, 'static_content'])->name('privacy-policy');
// Route::get('/terms', [HomeController::class, 'static_content'])->name('terms');
// Route::get('/about-us', [HomeController::class, 'static_content'])->name('about-us');
Route::get('/about-us', [HomeController::class, 'aboutUs'])->name('about-us');
Route::get('/our-services', [HomeController::class, 'ourServices'])->name('our-services');
Route::get('service-details', [HomeController::class, 'serviceDetails'])->name('service-details');
Route::get('/shop', [HomeController::class, 'shop'])->name('shop');
Route::get('/shop-details', [HomeController::class, 'shopDetails'])->name('shop-details');
Route::get('/our-projects', [HomeController::class, 'ourProjects'])->name('our-projects');

Route::get('/contact-us', [HomeController::class, 'contactUs'])->name('contact-us');
Route::post('/contact-submit', [HomeController::class, 'contactSubmit'])->name('contact.submit');
Route::get('/faq', [HomeController::class, 'faq'])->name('faq');
Route::get('/Articales', [HomeController::class, 'blogs'])->name('blogs');
Route::get('/blog-details/{slug}', [HomeController::class, 'blogDetails'])->name('blog-details');
Route::get('/blog-details', [HomeController::class, 'blogDetail'])->name('blog-details');
// Route::post('/calculate', [SolarCalculatorController::class, 'calculate'])->name('calculate');
// Route::post('/save-calculation', [SolarCalculatorController::class, 'saveCalculation'])->name('save-calculation');



Route::middleware(['permission'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    Route::prefix('users')->group(function () {
        Route::get('/clients', [AdminController::class, 'clients'])->name('clients');
        Route::get('/client-add', [AdminController::class, 'clientAdd'])->name('client-add');
        Route::post('/client-add', [AdminController::class, 'clientStore'])->name('client-store');
        Route::get('/client-edit/{id}', [AdminController::class, 'clientEdit'])->name('client-edit');
        Route::post('/client-edit/{id}', [AdminController::class, 'clientUpdate'])->name('client-update');
        Route::get('/client-delete/{id}', [AdminController::class, 'clientDelete'])->name('client-delete');
        Route::post('/client-chnage-password', [AdminController::class, 'clientChnagePassword'])->name('client-chnage-password');

        Route::get('/employees', [AdminController::class, 'employees'])->name('employees');
        Route::get('/employee-add', [AdminController::class, 'employeeAdd'])->name('employee-add');
        Route::post('/employee-add', [AdminController::class, 'employeeStore'])->name('employee-store');
        Route::get('/employee-edit/{id}', [AdminController::class, 'employeeEdit'])->name('employee-edit');
        Route::post('/employee-edit/{id}', [AdminController::class, 'employeeUpdate'])->name('employee-update');
        Route::get('/employee-delete/{id}', [AdminController::class, 'employeeDelete'])->name('employee-delete');
        Route::post('/employee-chnage-password', [AdminController::class, 'employeeChnagePassword'])->name('employee-chnage-password');
    });
    
    Route::prefix('crm')->group(function () {
        Route::match(['get', 'post'], '/leads', [CRMController::class, 'leads'])->name('leads');
        Route::get('/lead-add', [CRMController::class, 'leadAdd'])->name('lead-add');
        Route::post('/lead-add', [CRMController::class, 'leadStore'])->name('lead-store');
        Route::get('/lead-edit/{id}', [CRMController::class, 'leadEdit'])->name('lead-edit');
        Route::post('/lead-edit/{id}', [CRMController::class, 'leadUpdate'])->name('lead-update');
        Route::get('/lead-delete/{id}', [CRMController::class, 'leadDelete'])->name('lead-delete');
        Route::get('/lead-follow-up/{id}', [CRMController::class, 'leadFollowUp'])->name('lead-follow-up');
        Route::get('/lead-follow-up-reply/{id}', [CRMController::class, 'leadFollowUpReply'])->name('lead-follow-up-reply');
        Route::post('lead-assign-employee', [CRMController::class, 'assignEmployeeLead'])->name('lead-assign-employee');
        Route::get('/take-lead/{id}', [CRMController::class, 'takeLead'])->name('take-lead');

        Route::get('/contact-us', [CRMController::class, 'contactUs'])->name('crm-contact-us');
        Route::get('/contact-us-delete/{id}', [CRMController::class, 'contactUsDelete'])->name('crm-contact-us-delete');
        Route::post('/add-quotation', [CRMController::class,'storeQuotation'])->name('add-quotation');
        Route::get('/data-form',[CRMController::class,'addData'])->name('data-form');
        Route::post('/data-form',[CRMController::class,'storeData'])->name('data-store');


    });

    Route::prefix('payment')->group(function () {
        Route::match(['get', 'post'], '/fund-transfers', [AdminController::class, 'fundTransfers'])->name('fund-transfers');
        Route::get('/fund-send', [AdminController::class, 'fundSend'])->name('fund-send');
        Route::post('/fund-send', [AdminController::class, 'fundSendStore'])->name('fund-send-store');
        Route::match(['get', 'post'], '/fund-requests', [AdminController::class, 'fundRequests'])->name('fund-requests');
        Route::get('/fund-add', [AdminController::class, 'fundAdd'])->name('fund-add');
        Route::post('/fund-add', [AdminController::class, 'fundAddStore'])->name('fund-add-store');
        Route::get('/fund-request-update/{type}/{id}', [AdminController::class, 'fundRequestUpdate'])->name('fund-request-update');
        Route::match(['get', 'post'], '/available-balance', [AdminController::class, 'availableBalance'])->name('available-balance');
        Route::match(['get', 'post'], '/main-ledger', [AdminController::class, 'mainLedger'])->name('main-ledger');
        Route::match(['get', 'post'], '/points-ledger', [AdminController::class, 'pointsLedger'])->name('points-ledger');


        Route::match(['get', 'post'], '/withdraw-requests', [AdminController::class, 'withdrawRequests'])->name('withdraw-requests');
        Route::get('/withdraw-add', [AdminController::class, 'withdrawAdd'])->name('withdraw-add');
        Route::post('/withdraw-add', [AdminController::class, 'withdrawAddStore'])->name('withdraw-add-store');
        Route::get('/withdraw-request-update/{type}/{id}', [AdminController::class, 'withdrawRequestUpdate'])->name('withdraw-request-update');
       

          

    });

    Route::prefix('setting')->group(function () {
        Route::get('/app-config', [MasterController::class, 'appConfig'])->name('app-config');
        Route::get('/app-config-image', [MasterController::class, 'appConfigImage'])->name('app-config-image');
        Route::post('/update-config', [MasterController::class, 'updateConfig'])->name('update-config');

        Route::get('/whatsapp-templates', [MasterController::class, 'whatsappTemplate'])->name('whatsapp-templates');
        Route::get('/whatsapp-template-add', [MasterController::class, 'whatsappTemplateAdd'])->name('whatsapp-template-add');
        Route::post('/whatsapp-template-add', [MasterController::class, 'whatsappTemplateStore'])->name('whatsapp-template-store');
        Route::get('/whatsapp-template-edit/{id}', [MasterController::class, 'whatsappTemplateEdit'])->name('whatsapp-template-edit');
        Route::post('/whatsapp-template-edit/{id}', [MasterController::class, 'whatsappTemplateUpdate'])->name('whatsapp-template-update');
        Route::get('/whatsapp-template-delete/{id}', [MasterController::class, 'whatsappTemplateDelete'])->name('whatsapp-template-delete');
   
        Route::match(['get','post'],'acm',[MasterController::class,'acm'])->name('acm');
        Route::match(['get','post'],'acm-save',[MasterController::class,'acmSave'])->name('acm-save');

        Route::get('/static-content', [MasterController::class, 'staticContent'])->name('static-content');
        Route::get('/static-content/{id}', [MasterController::class, 'staticContentEdit'])->name('static-content-edit');
        Route::post('/static-content/{id}', [MasterController::class, 'staticContentUpdate'])->name('static-content-update');
        Route::get('/static-content-status/{id}', [MasterController::class, 'staticContentStatus'])->name('static-content-status');
    });

    Route::prefix('blogs')->group(function () {
        Route::get('/categories', [BlogController::class, 'categories'])->name('blog-categories');
        Route::get('/category-add', [BlogController::class, 'categoryAdd'])->name('blog-category-add');
        Route::post('/category-add', [BlogController::class, 'categoryStore'])->name('blog-category-store');
        Route::get('/category-edit/{id}', [BlogController::class, 'categoryEdit'])->name('blog-category-edit');
        Route::post('/category-edit/{id}', [BlogController::class, 'categoryUpdate'])->name('blog-category-update');
        Route::get('/category-delete/{id}', [BlogController::class, 'categoryDelete'])->name('blog-category-delete');

        Route::match(['get', 'post'], '/', [BlogController::class, 'blogs'])->name('blogs');
        Route::get('/blog-add', [BlogController::class, 'blogAdd'])->name('blog-add');
        Route::post('/blog-add', [BlogController::class, 'blogStore'])->name('blog-store');
        Route::get('/blog-edit/{id}', [BlogController::class, 'blogEdit'])->name('blog-edit');
        Route::post('/blog-edit/{id}', [BlogController::class, 'blogUpdate'])->name('blog-update');
        Route::get('/blog-delete/{id}', [BlogController::class, 'blogDelete'])->name('blog-delete');
    });


    Route::prefix('support')->group(function () {
        Route::match(['get', 'post'], '/open-tickets', [SupportController::class, 'tickets'])->name('tickets');
        Route::match(['get', 'post'], '/closed-tickets', [SupportController::class, 'tickets'])->name('closed-tickets');
        Route::get('/ticket-add', [SupportController::class, 'ticketAdd'])->name('ticket-add');
        Route::post('/ticket-add', [SupportController::class, 'ticketStore'])->name('ticket-store');
        Route::post('ticket-assign-employee', [SupportController::class, 'assignEmployeeTicket'])->name('ticket-assign-employee');
        Route::get('ticket-reply/{id}', [SupportController::class, 'replyTicket'])->name('ticket-reply');
        Route::post('ticket-reply/{id}', [SupportController::class, 'storeReplyTicket'])->name('ticket-reply-store');
        Route::get('ticket-status/{id}', [SupportController::class, 'statusTicket'])->name('ticket-status');
        Route::get('/ticket-delete/{id}', [SupportController::class, 'ticketDelete'])->name('ticket-delete');
    });



    Route::prefix('master')->group(function () {
        Route::get('/roles', [MasterController::class, 'roles'])->name('roles');
        Route::get('/role-add', [MasterController::class, 'roleAdd'])->name('role-add');
        Route::post('/role-add', [MasterController::class, 'roleStore'])->name('role-store');
        Route::get('/role-edit/{id}', [MasterController::class, 'roleEdit'])->name('role-edit');
        Route::post('/role-edit/{id}', [MasterController::class, 'roleUpdate'])->name('role-update');
        Route::get('/role-delete/{id}', [MasterController::class, 'roleDelete'])->name('role-delete');

        Route::match(['get', 'post'], '/countries', [MasterController::class, 'countries'])->name('countries');
        Route::get('/country-add', [MasterController::class, 'countryAdd'])->name('country-add');
        Route::post('/country-add', [MasterController::class, 'countryStore'])->name('country-store');
        Route::get('/country-edit/{id}', [MasterController::class, 'countryEdit'])->name('country-edit');
        Route::post('/country-edit/{id}', [MasterController::class, 'countryUpdate'])->name('country-update');
        Route::get('/country-delete/{id}', [MasterController::class, 'countryDelete'])->name('country-delete');
        
        Route::match(['get', 'post'], '/states', [MasterController::class, 'states'])->name('states');
        Route::get('/state-add', [MasterController::class, 'stateAdd'])->name('state-add');
        Route::post('/state-add', [MasterController::class, 'stateStore'])->name('state-store');
        Route::get('/state-edit/{id}', [MasterController::class, 'stateEdit'])->name('state-edit');
        Route::post('/state-edit/{id}', [MasterController::class, 'stateUpdate'])->name('state-update');
        Route::get('/state-delete/{id}', [MasterController::class, 'stateDelete'])->name('state-delete');
        
        Route::match(['get', 'post'], '/cities', [MasterController::class, 'cities'])->name('cities');
        Route::get('/city-add', [MasterController::class, 'cityAdd'])->name('city-add');
        Route::post('/city-add', [MasterController::class, 'cityStore'])->name('city-store');
        Route::get('/city-edit/{id}', [MasterController::class, 'cityEdit'])->name('city-edit');
        Route::post('/city-edit/{id}', [MasterController::class, 'cityUpdate'])->name('city-update');
        Route::get('/city-delete/{id}', [MasterController::class, 'cityDelete'])->name('city-delete');
                
        Route::get('/banners', [MasterController::class, 'banners'])->name('banners');
        Route::get('/banner-add', [MasterController::class, 'bannerAdd'])->name('banner-add');
        Route::post('/banner-add', [MasterController::class, 'bannerStore'])->name('banner-store');
        Route::get('/banner-edit/{id}', [MasterController::class, 'bannerEdit'])->name('banner-edit');
        Route::post('/banner-edit/{id}', [MasterController::class, 'bannerUpdate'])->name('banner-update');
        Route::get('/banner-delete/{id}', [MasterController::class, 'bannerDelete'])->name('banner-delete');


        Route::get('/client-reviews', [MasterController::class, 'clientReviews'])->name('client-reviews');
        Route::get('/client-review-add', [MasterController::class, 'reviewAdd'])->name('review-add');
        Route::post('/client-review-add', [MasterController::class, 'reviewStore'])->name('review-store');
        Route::get('/client-review-edit/{id}', [MasterController::class, 'reviewEdit'])->name('review-edit');
        Route::post('/client-review-edit/{id}', [MasterController::class, 'reviewUpdate'])->name('review-update');
        Route::get('/client-review-delete/{id}', [MasterController::class, 'reviewDelete'])->name('review-delete');


    });


    Route::prefix('training')->group(function () {
        Route::get('/categories', [TrainingController::class, 'Categories'])->name('training-categories');
        Route::get('/category-add', [TrainingController::class, 'CategoryAdd'])->name('training-category-add');
        Route::post('/category-add', [TrainingController::class, 'categoryStore'])->name('training-category-store');
        Route::get('/category-edit/{id}', [TrainingController::class, 'categoryEdit'])->name('training-category-edit');
        Route::post('/category-edit/{id}', [TrainingController::class, 'categoryUpdate'])->name('training-category-update');
        Route::get('/category-delete/{id}', [TrainingController::class, 'categoryDelete'])->name('training-category-delete');

        Route::match(['get', 'post'], 'sessions', [TrainingController::class, 'training'])->name('trainings');
        Route::get('/sessions-add', [TrainingController::class, 'trainingAdd'])->name('training-add');
        Route::post('/sessions-add', [TrainingController::class, 'trainingStore'])->name('training-store');
        Route::get('/sessions-edit/{id}', [TrainingController::class, 'trainingEdit'])->name('training-edit');
        Route::post('/sessions-edit/{id}', [TrainingController::class, 'trainingUpdate'])->name('training-update');
        Route::get('/sessions-delete/{id}', [TrainingController::class, 'trainingDelete'])->name('training-delete');
        Route::get('/sessions-view/{id}', [TrainingController::class, 'trainingView'])->name('training-view');
    });

    Route::prefix('product')->group(function () {
        Route::get('/categories', [ProductController::class, 'categories'])->name('product-categories');
        Route::get('/category-add', [ProductController::class, 'categoryAdd'])->name('product-category-add');
        Route::post('/category-add', [ProductController::class, 'categoryStore'])->name('product-category-store');
        Route::get('/category-edit/{id}', [ProductController::class, 'categoryEdit'])->name('product-category-edit');
        Route::post('/category-edit/{id}', [ProductController::class, 'categoryUpdate'])->name('product-category-update');
        Route::get('/category-delete/{id}', [ProductController::class, 'categoryDelete'])->name('product-category-delete');

        Route::match(['get', 'post'], '/', [ProductController::class, 'products'])->name('products');
        Route::get('/products-add', [ProductController::class, 'productAdd'])->name('product-add');
        Route::post('/products-add', [ProductController::class, 'productStore'])->name('product-store');
        Route::get('/products-edit/{id}', [ProductController::class, 'productEdit'])->name('product-edit');
        Route::post('/products-edit/{id}', [ProductController::class, 'productUpdate'])->name('product-update');
        Route::get('/products-delete/{id}', [ProductController::class, 'productDelete'])->name('product-delete');
        Route::get('/products-view/{id}', [ProductController::class, 'productView'])->name('product-view');


        Route::get('/brands', [ProductController::class, 'brands'])->name('brands');
        Route::get('/brands-add', [ProductController::class, 'brandAdd'])->name('brand-add');
        Route::post('/brands-add', [ProductController::class, 'brandStore'])->name('brand-store');
        Route::get('/brands-edit/{id}', [ProductController::class, 'brandEdit'])->name('brand-edit');
        Route::post('/brands-edit/{id}', [ProductController::class, 'brandUpdate'])->name('brand-update');
        Route::get('/brands-delete/{id}', [ProductController::class, 'brandDelete'])->name('brand-delete');

        Route::get('/orderes', [ProductController::class, 'orderes'])->name('orderes');
        Route::get('/order-add', [ProductController::class, 'orderAdd'])->name('ordere-add'); 
        Route::get('/order-delete/{id}', [ProductController::class, 'orderDelete'])->name('order-delete');
        Route::get('/show-invoice/{id}', [ProductController::class, 'showInvoice'])->name('show-invoice');
        Route::post('/order-status-update', [ProductController::class, 'orderStatusUpdate'])->name('order-status-update');
        Route::post('/payment-update', [ProductController::class, 'paymentUpdate'])->name('payment-update');


        Route::get('/variation-type', [ProductController::class, 'variationType'])->name('variation-type');
        Route::get('/variation-type-add', [ProductController::class, 'variationTypeAdd'])->name('variation-type-add');
        Route::post('/variation-type-add', [ProductController::class, 'variationTypeStore'])->name('variation-type-store');
        Route::get('/variation-type-edit/{id}', [ProductController::class, 'variationTypeEdit'])->name('variation-type-edit');
        Route::post('/variation-type-edit/{id}', [ProductController::class, 'variationTypeUpdate'])->name('variation-type-update');
        Route::get('/variation-type-delete/{id}', [ProductController::class, 'variationTypeDelete'])->name('variation-type-delete');

        Route::get('/variation-value', [ProductController::class, 'variationValue'])->name('variation-value');
        Route::get('/variation-value-add', [ProductController::class, 'variationValueAdd'])->name('variation-value-add');
        Route::post('/variation-value-add', [ProductController::class, 'variationValueStore'])->name('variation-value-store');
        Route::get('/variation-value-edit/{id}', [ProductController::class, 'variationValueEdit'])->name('variation-value-edit');
        Route::post('/variation-value-edit/{id}', [ProductController::class, 'variationValueUpdate'])->name('variation-value-update');
        Route::get('/variation-value-delete/{id}', [ProductController::class, 'variationValueDelete'])->name('variation-value-delete');
        Route::get('/get-variation-value/{id}', [ProductController::class, 'getVariationValue'])->name('get-variation-value');

         
        Route::match(['get', 'post'], '/variant', [ProductController::class, 'variant'])->name('variant');
        Route::get('/variant-add', [ProductController::class, 'variantAdd'])->name('variant-add');
        Route::post('/variant-add', [ProductController::class, 'variantStore'])->name('variant-store');
        Route::get('/variant-edit/{id}', [ProductController::class, 'variantEdit'])->name('variant-edit');
        Route::post('/variant-edit/{id}', [ProductController::class, 'variantUpdate'])->name('variant-update');
        Route::get('/variation-delete/{id}', [ProductController::class, 'variationDelete'])->name('variant-delete');
        Route::get('category-products', [ProductController::class, 'getProductsByCategory'])->name('category-products');

        Route::get('product-details', [ProductController::class, 'getProductDetails'])->name('product-details');



});


    Route::prefix('booking')->group(function () {
    Route::get('/categories', [OrderController::class, 'categories'])->name('booking-categories');
    Route::get('/sub-categories/{slug?}/{id}',[OrderController::class,'subCategories'])->name('booking-sub-category');
    Route::get('/products/{slug}',[OrderController::class,'bookingDetails'])->name('booking-details');

});

    Route::prefix('logs')->group(function () {
        Route::match(['get', 'post'], '/notifications', [AdminController::class, 'notifications'])->name('user-notifications');
        Route::match(['get', 'post'], '/activity-log', [AdminController::class, 'activityLog'])->name('user-activity-log');
        Route::match(['get', 'post'], '/login-activity', [AdminController::class, 'loginActivity'])->name('user-login-activity');
    });

});

Route::get('/profile', [UserController::class, 'profile'])->name('profile');
Route::post('/profile', [UserController::class, 'profileUpdate'])->name('profile-update');
Route::post('/profile-image', [UserController::class, 'profileUploadImage'])->name('profile-upload-image');
Route::get('/session/{id}', [UserController::class, 'destroySession'])->name('session-destroy');
Route::get('/security', [UserController::class, 'security'])->name('security');
Route::get('/login-activity', [UserController::class, 'loginActivity'])->name('login-activity');
Route::get('/activity-log', [UserController::class, 'activityLog'])->name('activity-log');
Route::match(['get', 'post'], '/notifications', [UserController::class, 'notifications'])->name('notifications');
Route::get('/notifications/mark-all', [UserController::class, 'markAllRead'])->name('notifications.markAll');
Route::post('/fcm/token', [UserController::class, 'updateToken']);
Route::get('/fcm/send', [UserController::class, 'sendNotification']);

Route::get('/find-user-name', [Controller::class, 'find_user_name'])->name('find-user-name');
Route::get('/chnage-mode', [Controller::class, 'activateThemeMode'])->name('chnage-mode');
Route::get('states/{country_id}', [Controller::class, 'getStates'])->name('get-states');
Route::get('cities/{state_id}', [Controller::class, 'getCities'])->name('get-cities');

