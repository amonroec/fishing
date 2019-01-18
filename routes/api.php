<?php

use Illuminate\Http\Request;

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

Route::group(['middleware' => 'auth:api'], function () {
    Route::post('logout', 'Auth\LoginController@logout');

    Route::get('/user', function (Request $request) {

        //return $request->user();
    		//Route::get('/user', 'UsersController@fetchUser');
    		
    		return redirect()->action(
				    'UsersController@fetchUser', ['user' => $request->user()]
				);
    });
    //Route::get('/user', 'UsersController@fetchUser');

    Route::patch('settings/profile', 'Settings\ProfileController@update');
    Route::patch('settings/password', 'Settings\PasswordController@update');

    // Routes for MarketController
    Route::post('/submitMarketRequest', 'MarketController@submitMarketRequest');

    //Routes for ContactController (contact us requests)
    Route::post('/submitContactRequest', 'ContactController@submitContactRequest');

    //Routes for CustomersController
    Route::post('/addNewCustomer', 'CustomersController@addNewCustomer');
    Route::get('/getCustomers', 'CustomersController@getCustomers');
    Route::post('/saveCustomer', 'CustomersController@saveCustomer');
    Route::post('/getCompanies', 'CustomersController@getCompanies');

    // Routes for Cart
    Route::post('/addToCart', 'CartsController@create');
    Route::post('/removeCartItem', 'CartsController@removeCartItem');
    Route::get('/getCart/{id}', 'CartsController@getCart');

    //Routes for Orders
    Route::post('/orderCart', 'OrdersController@orderCart');
    Route::post('/getOrders', 'OrdersController@getOrders');
    Route::post('/getOrder', 'OrdersController@getOrder');
    Route::post('/confirmOrderPayment', 'OrdersController@confirmOrderPayment');
    Route::post('/getMyOrders', 'OrdersController@getMyOrders');
    Route::post('/getInvoice', 'OrdersController@getInvoice');

    //Routes for Forms
    Route::post('/getForms', 'OrdersController@getFormsTable');
    Route::post('/getForm', 'OrdersController@getForm');
    Route::post('/submitForReview', 'OrdersController@submitForReview');
    Route::post('/submitRejection', 'OrdersController@submitRejection');
    Route::post('/getOrderSummary', 'OrdersController@getOrderSummary');

    //Routes for Invoice Table
    Route::post('/getInvoiceNumber', 'InvoiceController@getInvoiceNumber');
    Route::post('/submitInvoice', 'InvoiceController@submitInvoice');

    // Submit to Customer
    Route::post('/submitToCustomer', 'OrdersController@submitToCustomer');


});

Route::group(['middleware' => 'guest:api'], function () {
    Route::post('login', 'Auth\LoginController@login');
    Route::post('register', 'Auth\RegisterController@register');
    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset');

    Route::post('/guestConfirmOrderPayment', 'OrdersController@confirmOrderPayment');

    Route::post('/guestOrderCart', 'OrdersController@orderCart');

    Route::post('/getGuestOrderSummary', 'OrdersController@getOrderSummary');

    Route::post('oauth/{driver}', 'Auth\OAuthController@redirectToProvider');
    Route::get('oauth/{driver}/callback', 'Auth\OAuthController@handleProviderCallback')->name('oauth.callback');
});
