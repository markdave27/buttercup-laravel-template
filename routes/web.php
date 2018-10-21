<?php

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

Route::get('/', function () {
    //return view('welcome');
    return redirect()->route('customers.index');
});

Route::resource('datatables', 'DatatablesController');
Route::get('datatables-server-side', array( 'as' =>  'datatables-server-side', 'uses' => 'DatatablesController@serverSide' ));

Route::group(array('prefix' => 'admin', 'middleware' => 'guest'), function()
{
    Route::group(['namespace' => 'Admin'], function()
    {
        Route::resource('customers', 'CustomerController');
        Route::get('customers-server-side', ['as' =>  'customers-server-side', 'uses' => 'CustomerController@serverSide']);
    });
});

Route::get('/', ['as' => 'front.home', 'uses' => 'FrontEnd\FrontEndBaseController@getHome']);

Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => 'auth'], function()
{
    Route::get('/', ['as' => 'admin.dashboard', 'uses' => 'AdminBaseController@getDashboard']);
    Route::get('/blank', ['as' => 'admin.blank', 'uses' => 'AdminBaseController@getBlank']);

    Route::resource('log-types', 'LogTypeController');
    Route::get('log-types-server-side', ['as' =>  'log-types-server-side', 'uses' => 'LogTypeController@serverSide']);

    Route::resource('users', 'UserController');
    Route::get('/users', array( 'as' =>  'users.index', 'uses' => 'UserController@index' ));
    Route::get('/users/create', array( 'as' =>  'users.create', 'uses' => 'UserController@create' ));
    Route::put('/users/{user}', array( 'as' =>  'users.update', 'uses' => 'UserController@update' ));
    Route::patch('/users/{user}', array( 'as' =>  'users.update', 'uses' => 'UserController@update' ));
    Route::delete('/users/{user}', array( 'as' =>  'users.destroy', 'uses' => 'UserController@destroy' ));
    Route::get('/users/{user}/edit', array( 'as' =>  'users.edit', 'uses' => 'UserController@edit' ));
    Route::get('users-server-side', array( 'as' =>  'users-server-side', 'uses' => 'UserController@serverSide' ));

    Route::resource('logs', 'LogController');
    Route::get('logs-server-side', array( 'as' =>  'logs-server-side', 'uses' => 'LogController@serverSide' ));

    Route::resource('user-types', 'UserTypeController');
    Route::get('user-types-server-side', [ 'as' =>  'user-types-server-side', 'uses' => 'UserTypeController@serverSide' ]);

    Route::resource('customer-categories', 'CustomerCategoryController');
});

Route::group(['namespace' => 'Auth', 'prefix' => 'admin', 'middleware' => 'auth'], function()
{
    Route::post('/users/create', array( 'as' =>  'users.store', 'uses' => 'RegisterController@register' ));
});
//Auth::routes();

Route::group(['middleware' => ['web']], function() {

    // Login Routes...
    Route::get('dashboard', ['as' => 'dashboard', 'uses' => 'Auth\LoginController@showLoginForm']);
    Route::get('login', ['as' => 'login', 'uses' => 'Auth\LoginController@showLoginForm']);
    Route::post('login', ['as' => 'login.post', 'uses' => 'Auth\LoginController@login']);
    Route::get('logout', ['as' => 'logout', 'uses' => 'Auth\LoginController@logout']);

    // Registration Routes...
//    Route::get('register', ['as' => 'register', 'uses' => 'Auth\RegisterController@showRegistrationForm']);
//    Route::post('register', ['as' => 'register.post', 'uses' => 'Auth\RegisterController@register']);

    // Password Reset Routes...
    Route::get('password/reset', ['as' => 'password.reset', 'uses' => 'Auth\ForgotPasswordController@showLinkRequestForm']);
    Route::post('password/email', ['as' => 'password.email', 'uses' => 'Auth\ForgotPasswordController@sendResetLinkEmail']);
    Route::get('password/reset/{token}', ['as' => 'password.reset.token', 'uses' => 'Auth\ResetPasswordController@showResetForm']);
    Route::post('password/reset', ['as' => 'password.reset.post', 'uses' => 'Auth\ResetPasswordController@reset']);

    // registration activation routes
    Route::get('activation/key/{activation_key}', ['as' => 'activation_key', 'uses' => 'Auth\ActivationKeyController@activateKey']);
    Route::get('activation/resend', ['as' =>  'activation_key_resend', 'uses' => 'Auth\ActivationKeyController@showKeyResendForm']);
    Route::post('activation/resend', ['as' =>  'activation_key_resend.post', 'uses' => 'Auth\ActivationKeyController@resendKey']);

    // forgot_username
    Route::get('username/reminder', ['as' =>  'username_reminder', 'uses' => 'Auth\ForgotUsernameController@showForgotUsernameForm']);
    Route::post('username/reminder', ['as' =>  'username_reminder.post', 'uses' => 'Auth\ForgotUsernameController@sendUsernameReminder']);
});
