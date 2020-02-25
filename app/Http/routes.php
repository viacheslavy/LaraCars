<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
use Illuminate\Http\Request;
Route::any('/payment_success', function(Request $request){
    $test = $request->get('x_response_reason_text');
    if($request->get('x_response_code') == 1){ return redirect('/')->withMessage("La transaction a été approuvée"); }
    else{ return redirect('/')->withError("La transaction a été refusée"); }
});

/*Route::get('payment/{id}', [ 'as' => 'get.payment', 'uses' => 'CarsFEController@getPayment', ]);
Route::post('car/reserve/{id}', [ 'as' => 'get.car.reserve', 'uses' => 'CarsFEController@postCarReserve', ]);*/

Route::get('solddetails', 'MailController@CarSoldDetails');
Route::get('payment/{id}', [ 'as' => 'get.payment', 'uses' => 'CarsFEController@getPayment', ]);

Route::post('car/reserve', [ 'as' => 'get.car.reserve', 'uses' => 'CarsFEController@postCarReserve', ]);
Route::post('car/reserve/userDetails', 'CarsFEController@postPaymentUser');

Route::get('/cars', [
    'as' => 'get.index',
    'uses' => 'CarsFEController@index'
]);
Route::get('/paytest', 'CarsFEController@postPay');
Route::get('/expired', [
    'as' => 'get.expired',
    'uses' => 'CarsController@getExpired'
]);
Route::post('/send_contact', [
    'as'    => 'post.send_contact',
    'uses'  => 'MailController@postSendContact'
]);

Route::post('/sendMail', [
    'as'    => 'post.send.mail',
    'uses'  => 'MailController@postSendMail'
]);

Route::get('/', [
    'as' => 'get.home',
    'uses' => 'HomeController@home'
]);

Route::get('/getMakes/{id}', [
    'as' => 'get.getMakes',
    'uses' => 'CarsFEController@getMakesJson'
]);

Route::get('/presentation', [
    'as' => 'get.presentation',
    'uses' => 'HomeController@presentation'
]);

Route::get('/etape', [
    'as' => 'get.etape',
    'uses' => 'HomeController@etape'
]);

Route::get('/faq', [
    'as' => 'get.faq',
    'uses' => 'HomeController@faq'
]);

Route::get('/guarantee', [
    'as' => 'get.guarantee',
    'uses' => 'HomeController@guarantee'
]);

Route::get('/testimonials', [
    'as' => 'get.testimonials',
    'uses' => 'HomeController@testimonials'
]);

Route::get('/videotestimonials', [
    'as' => 'get.video.testimonials',
    'uses' => 'HomeController@videoTestimonials'
]);

Route::get('/contact', [
    'as' => 'get.contact',
    'uses' => 'HomeController@contact'
]);

Route::get('/product/{id}', [
    'as'    => 'get.product',
    'uses'  => 'CarsFEController@getProduct'
]);

Route::get('/cropperJS', [
    'as' => 'get.cropper',
    'uses' => 'HomeController@cropper'
]);

Route::get('/search', [
    'as'    => 'get.search',
    'uses'  => 'CarsFEController@getSearch'
]);

Route::post('uploadImages', [
    'as'    => 'post.upload.images',
    'uses'  => 'CarsController@postUploadImages'
]);

Route::post('uploadNewImages', [
    'as'    => 'post.uploadNewCar.images',
    'uses'  => 'CarsController@uploadNewImages'
]);

Route::get('legals', [
    'as'    => 'get.legals',
    'uses'  => 'HomeController@getLegals'
]);

Route::post('addCustomer', [
    'as'    => 'post.add.customer',
    'uses'  => 'CustomerController@postAddCustomer'
]);

Route::get('smallSearch', [
    'as'    => 'get.small.search',
    'uses'  => 'CarsFEController@getSmallSearch'
]);

Route::get('captcha', [
    'as'    => 'get.captcha',
    'uses'  => 'HomeController@getCaptcha'
]);

Route::auth();

Route::group(['middleware' => ['auth', 'admin'], 'prefix' => 'cpanel'], function() {

    Route::controllers([
        '/price' =>  'CarsController',
        '/orders' => 'OrdersController',
    ]);

    Route::get('gatewayclassiccars', [
        'as' => 'get.gatewayclassiccars',
        'uses'  => 'AdminController@getGatewayClassiccars'
    ]);

    Route::get('gatewayclassiccars/filters', [
        'as' => 'post.gatewayclassiccars',
        'uses' => 'AdminController@filterSites'
    ]);

    Route::post('gatewayclassiccars/details', [
        'as' => 'get.gatewayclassiccars.detailsPost',
        'uses' => 'CarsController@postGatewayclassicCarsDetails'
    ]);

    Route::get('gatewayclassiccars/details', [
        'as' => 'get.gatewayclassiccars.details',
        'uses' => 'CarsController@getGatewayclassicCarsDetails'
    ]);

    Route::get('contact', [
        'as'    => 'get.contacts',
        'uses'  => 'AdminController@getContact'
    ]);

    Route::get('delete_contact/{id}', [
        'as'    => 'get.delete_contact',
        'uses'  => 'AdminController@deleteContact'
    ]);

    Route::get('contact_export', [
        'as'    => 'get.contact_export',
        'uses'  => 'AdminController@contactExport'
    ]);

    Route::get('/', [
        'as'    => 'get.admin',
        'uses'  => 'CarsController@addCarsIndex'
    ]);

    Route::get('users', [
            'as'    => 'get.users',
            'uses'  => 'UserController@getAddUser'
    ]);

    Route::get('/deleteUserAdmin/{id}', [
        'as'    => 'get.deleteUserAdmin',
        'uses'  => 'UserController@deleteUserAdmin'
    ]);

    Route::get('/editUserAdmin/{id}', [
        'as'    => 'get.editUserAdmin',
        'uses'  => 'UserController@editUserAdmin'
    ]);

    Route::get('/createAdminUser', [
        'as'    => 'get.createAdminUser',
        'uses'  => 'UserController@createAdminUser'
    ]);

    Route::post('/newAdminUser', [
        'as'    => 'post.newAdminUser',
        'uses'  => 'UserController@newAdminUser'
    ]);

    Route::post('/editUserAdmin/{id}', [
        'as'    => 'post.editUserAdmin',
        'uses'  => 'UserController@updateAdminUser'
    ]);

    Route::get('admins', [
            'as'    => 'get.admins',
            'uses'  => 'AdminController@getAdmins'
    ]);

    Route::get('/getCreateAdmin', [
        'as'    => 'get.getCreateAdmin',
        'uses'  => 'AdminController@getCreateAdmin'
    ]);

    Route::post('/newAdmin', [
        'as'    => 'post.newAdmin',
        'uses'  => 'AdminController@newAdmin'
    ]);

    Route::get('/editAdmin/{id}', [
        'as'    => 'get.editAdmin',
        'uses'  => 'AdminController@editAdmin'
    ]);

    Route::post('/editAdmin/{id}', [
        'as'    => 'post.editAdmin',
        'uses'  => 'AdminController@updateAdmin'
    ]);

    Route::get('/deleteAdmin/{id}', [
        'as'    => 'get.deleteAdmin',
        'uses'  => 'AdminController@deleteAdmin'
    ]);

    Route::group(['prefix' => 'cars'], function () {

        Route::get('add', [
            'as'    => 'get.add.cars',
            'uses'  => 'CarsController@addCarsIndex'
        ]);

        Route::get('newcar', [
            'as'    => 'get.newcar.cars',
            'uses'  => 'CarsController@createCar'
        ]);

        Route::get('make', [
            'as'    => 'get.make.cars',
            'uses'  => 'CarsController@makeCarsIndex'
        ]);

        Route::get('newmakes', [
            'as'    => 'get.newmakes.cars',
            'uses'  => 'CarsController@newMakeCarsIndex'
        ]);

        Route::get('editmakes/{id}', [
            'as'    => 'get.editmakes.cars',
            'uses'  => 'CarsController@editMakeCarsIndex'
        ]);

        Route::get('deleteMake/{id}', [
            'as'    => 'get.deleteMake.cars',
            'uses'  => 'CarsController@deleteMakeCarsIndex'
        ]);

        Route::post('createmakes', [
            'as'    => 'post.createmakes.cars',
            'uses'  => 'CarsController@createmakesCarsIndex'
        ]);

        Route::post('updatemakes', [
            'as'    => 'post.updatemakes.cars',
            'uses'  => 'CarsController@updatemakesCarsIndex'
        ]);

        Route::get('model', [
            'as'    => 'get.model.cars',
            'uses'  => 'CarsController@modelCarsIndex'
        ]);

        Route::get('newmodel', [
            'as'    => 'get.newmodel.cars',
            'uses'  => 'CarsController@newModelCarsIndex'
        ]);

        Route::post('createModel', [
            'as'    => 'post.createModel.cars',
            'uses'  => 'CarsController@createModelCarsIndex'
        ]);

        Route::get('editmodel/{id}', [
            'as'    => 'get.editmodel.cars',
            'uses'  => 'CarsController@editModelCarsIndex'
        ]);

        Route::post('updatemodel', [
            'as'    => 'post.updatemodel.cars',
            'uses'  => 'CarsController@updatemodelCarsIndex'
        ]);

        Route::get('deleteModel/{id}', [
            'as'    => 'get.deleteModel.cars',
            'uses'  => 'CarsController@deleteModelCarsIndex'
        ]);

        Route::get('testMethod', 'CarsController@getListingCars');

        Route::post('details', [
            'as'    => 'get.car.detailsPost',
            'uses'  => 'CarsController@postCarDetails'
        ]);

        Route::get('details', [
            'as'    => 'get.car.details',
            'uses'  => 'CarsController@getCarDetails'
        ]);

        Route::get('filterSites', [
            'as'    => 'post.filter.sites',
            'uses'  => 'CarsController@filterSites'
        ]);

        Route::post('addListing', [
            'as'    => 'post.add.listing',
            'uses'  => 'CarsController@postAddListing'
        ]);
        
        Route::post('deleteListing', [
            'as'    => 'post.delete.listing',
            'uses'  => 'CarsController@postDeleteListing'
        ]);

        Route::post('addListingAlias', [
            'as'    => 'post.add.listingalias',
            'uses'  => 'CarsController@postAddListingAlias'
        ]);

        Route::get('view-cars', [
            'as'    => 'get.view.cars',
            'uses'  => 'CarsController@getViewCars'
        ]);

        Route::get('edit/{id}', [
            'as'    => 'get.edit.car',
            'uses'  => 'CarsController@getEditCar'
        ]);

        Route::post('editCar', [
            'as'    => 'post.edit.car',
            'uses'  => 'CarsController@postEditCar'
        ]);

        Route::get('delete/{id}', [
            'as'    => 'get.delete.car',
            'uses'  => 'CarsController@getDeleteCar'
        ]);

        Route::post('saveCroppedImage', [
            'as'    => 'post.save.cropped.image',
            'uses'  => 'CarsController@postSaveCroppedImage'
        ]);

        Route::post('exportXML', [
            'as'    => 'post.export.xml',
            'uses'  => 'CarsController@postExportXML'
        ]);

        Route::post('editGlobalPercentage', [
            'as'    => 'post.edit.percentage',
            'uses'  => 'GlobalPercentageSettingsController@postEditPercentage'
        ]);

        Route::post('addGlobalPercentage', [
            'as'    => 'post.add.percentage',
            'uses'  => 'GlobalPercentageSettingsController@postAddPercentage'
        ]);

        Route::post('globalPercentage', [
            'as'    => 'post.global.percentage',
            'uses'  => 'GlobalPercentageSettingsController@postGlobalPercentage'
        ]);

        Route::post('rangePercentage', [
            'as'    => 'post.range.percentage',
            'uses'  => 'GlobalPercentageSettingsController@postRangePercentage'
        ]);

        Route::post('bulkAddListings', [
            'as'    => 'post.bulk.add.listings',
            'uses'  => 'CarsController@postBulkAddListings'
        ]);

        Route::post('bulkAddListings_alias', [
            'as'    => 'post.bulk.add.listings_alias',
            'uses'  => 'CarsController@postBulkAddListingsAlias'
        ]);

        Route::post('postGlobalRate', [
            'as'    => 'post.global.rate',
            'uses'  => 'GlobalPercentageSettingsController@postGlobalRate'
        ]);

        Route::get('deletePriceRange/{id}', [
            'as'    => 'get.delete.price.range',
            'uses'  => 'GlobalPercentageSettingsController@getDeletePriceRange'
        ]);

        Route::post('postSavePriceMarkup', [
            'as'    => 'post.save.price.markup',
            'uses'  => 'CarsController@postSavePriceMarkup'
        ]);

        Route::post('postBulkAction', [
            'as'    => 'post.bulk.action',
            'uses'  => 'CarsController@postBulkAction'
        ]);

        Route::post('postDeleteAllCars', [
            'as'    => 'post.delete.all.cars',
            'uses'  => 'CarsController@postDeleteAllCars'
        ]);

        Route::post('postAddAllCars', [
            'as'    => 'post.add.all.cars',
            'uses'  => 'CarsController@postAddAllCars'
        ]);

        Route::post('postAddNewListing', [
            'as'    => 'post.add.new.listing',
            'uses'  => 'CarsController@postAddNewListing'
        ]);

        Route::get('searchBack', [
            'as'    => 'get.back.search',
            'uses'  => 'CarsController@filterCars'
        ]);

        Route::post('applyFeaturedImage', [
            'as'    => 'post.apply.featured.image',
            'uses'  => 'CarsController@postApplyFeaturedImage'
        ]);

        Route::post('postDeleteImage', [
            'as'    => 'post.delete.image',
            'uses'  => 'CarsController@postDeleteImage'
        ]);

        Route::get('image/{id}', [
            'as'    => 'get.image',
            'uses'  => 'CarsController@getImage'
        ]);

        Route::get('jewel', [
            'as'    => 'get.jewel.cars',
            'uses'  => 'CarsController@getJewelCars'
        ]);

        Route::post('jewel', [
            'as'    => 'post.jewel.cars',
            'uses'  => 'CarsController@postJewelCars'
        ]);

        Route::get('deleteImages/{id}', [
            'as'    => 'get.deleteImages',
            'uses'  => 'CarsController@deleteImages'
        ]);

        Route::post('deleteCheckedImage', [
            'as'    => 'post.deleteCheckedImage',
            'uses'  => 'CarsController@deleteCheckedImage'
        ]);

        Route::get('changeEditCar/{id}/{key}', [
            'as'    => 'get.changeEditCar',
            'uses'  => 'CarsController@changeEditCar'
        ]);

    });

    Route::group(['prefix' => 'CRM'], function () {

        Route::get('customers', [
            'as'    => 'get.customers',
            'uses'  => 'CrmController@getCustomers'
        ]);

        Route::get('edit/{id}', [
            'as'    => 'get.edit.user',
            'uses'  => 'CrmController@getEdit'
        ]);

        Route::post('editUser', [
            'as'    => 'post.edit.user',
            'uses'  => 'UserController@postUpdateUser'
        ]);

        Route::get('deleteUser/{id}', [
            'as'    => 'get.delete.user',
            'uses'  => 'UserController@getDeleteUser'
        ]);

        Route::post('sendEmail', [
            'as'    => 'post.send.email',
            'uses'  => 'CrmController@postSendEmail'
        ]);

        Route::get('deleteEmail/{id}', [
            'as'    => 'get.delete.email',
            'uses'  => 'CrmController@getDeleteEmail'
        ]);

        Route::get('groups', [
            'as'    => 'get.customers.groups',
            'uses'  => 'CrmController@getCustomersGroups'
        ]);

        Route::get('createGroup', [
            'as'    => 'get.create.group',
            'uses'  => 'CrmController@getCreateGroup'
        ]);

        Route::post('postCreateGroup', [
            'as'    => 'post.create.group',
            'uses'  => 'CrmController@postCreateGroup'
        ]);

        Route::get('deleteGroup/{id}', [
            'as'    => 'get.delete.group',
            'uses'  => 'CrmController@getDeleteGroup'
        ]);

        Route::get('filterGroup', [
            'as'    => 'get.filter.customers.group',
            'uses'  => 'CrmController@getFilterGroup'
        ]);

        Route::post('postBulkGroupUsers', [
            'as'    => 'post.bulk.group.users',
            'uses'  => 'CrmController@postBulkGroupUsers'
        ]);

    });

    Route::group(['prefix' => 'notifications'], function () {

        Route::get('/', [
            'as'    => 'get.notifications',
            'uses'  => 'NotificationController@getNotifications'
        ]);

        Route::get('new', [
            'as'    => 'get.notifications.new',
            'uses'  => 'NotificationController@getNewNotification'
        ]);


        Route::post('newNotification', [
            'as'    => 'post.create.notification',
            'uses'  => 'NotificationController@postCreateNotification'
        ]);

        Route::get('delete/{id}', [
            'as'    => 'get.delete.notification',
            'uses'  => 'NotificationController@getDeleteNotification'
        ]);

        Route::get('edit/{id}', [
            'as'    => 'get.edit.notification',
            'uses'  => 'NotificationController@getEditNotification'
        ]);

        Route::post('editNotification', [
            'as'    => 'post.edit.notification',
            'uses'  => 'NotificationController@postEditNotification'
        ]);


    });
});