<?php

use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });



Route::group(['middleware' => 'sales_auth'], function () {
    Route::get('/sales-dashboard','backend\SalesController@index');
    Route::get('/profile_sales','backend\SalesController@profile_sales');
    Route::get('/change_password_sales','backend\SalesController@change_password_sales');
    Route::post('/changePasswordactionSales','backend\SalesController@changePasswordactionSales');
    Route::get('/leads_list_seals','backend\SalesController@leads_list');
    Route::get('/add_lead_sales','backend\SalesController@add_lead');
    Route::post('/add_lead_action_sales','backend\SalesController@add_lead_action_sales');
    Route::post('/updated_lead_action_sales','backend\SalesController@updated_lead_action');
    Route::get('/get_sales_branches_sales/{id}','backend\SalesController@get_sales_branches_sales');
    Route::get('/delete_lead_sales/{lead_id}','backend\SalesController@delete_lead_sales');
    Route::get('/edit_view_lead_sales/{lead_id}','backend\SalesController@edit_view_lead');
    Route::get('/sendToCibilSeals/{lead_id}','backend\SalesController@sendToCibilSeals');
    Route::get('/sendToLogin/{lead_id}','backend\SalesController@sendToLogin');
    //Cibil Department
    Route::get('/leads_list_cibil','backend\SalesController@leads_list_cibil');
    Route::get('/edit_view_lead_cibil/{lead_id}','backend\SalesController@edit_view_lead_cibil');
    Route::post('/updated_cibil_action','backend\SalesController@updated_cibil_action');

    //Login Department
    Route::get('/leads_list_login','backend\SalesController@leads_list_login');
    Route::get('/login_edit/{lead_id}','backend\SalesController@login_edit');
    Route::post('/updated_login_action','backend\SalesController@updated_login_action');

    //Credit Department
    Route::get('/leads_list_credit','backend\SalesController@leads_list_credit');
    Route::get('/creditLogin/{lead_id}','backend\SalesController@creditLogin');
    Route::post('/updated_creadit_action','backend\SalesController@updated_creadit_action');


});

Route::group(['middleware' => 'telecaller_auth'], function () {

    Route::get('/telecaller-dashboard','backend\TelecallerController@index');
    Route::get('/profile_telecaller','backend\TelecallerController@profile_telecaller');
    Route::get('/change_password_telecaller','backend\TelecallerController@change_password_telecaller');
    Route::post('/changePasswordactiontele','backend\TelecallerController@changePasswordactiontele');
    Route::get('/leads_list','backend\TelecallerController@leads_list');
    Route::get('/add_lead','backend\TelecallerController@add_lead');
    Route::post('/add_lead_action','backend\TelecallerController@add_lead_action');
    Route::post('/updated_lead_action','backend\TelecallerController@updated_lead_action');
    Route::get('/get_sales_branches/{id}','backend\TelecallerController@get_sales_branches');
    Route::get('/delete_lead/{lead_id}','backend\TelecallerController@delete_lead');
    Route::get('/edit_view_lead/{lead_id}','backend\TelecallerController@edit_view_lead');
    Route::get('/sendToCibil/{lead_id}','backend\TelecallerController@sendToCibil');


});

Route::group(['middleware' => 'check_auth'], function () {
    Route::get('/dashboard','backend\AdminController@index');
    Route::get('/change_password','backend\AdminController@change_password');
    Route::post('/changePasswordaction','backend\AdminController@changePasswordaction');
    Route::get('/profile','backend\AdminController@profile');
    Route::get('/users','backend\AdminController@users');
    Route::get('/add_user','backend\AdminController@add_user');
    Route::post('/add_user_action','backend\AdminController@add_user_action');
    Route::get('/view_users/{user_id}','backend\AdminController@view_users');
    Route::get('/delete_users/{user_id}','backend\AdminController@delete_users');
    Route::get('/status_change_user/{user_id}/{status}','backend\AdminController@status_change_user');
    Route::get('edit_view_users/{user_id}','backend\AdminController@edit_view_users');
    Route::post('/update','backend\AdminController@update');
    Route::get('/admin_setting','backend\AdminController@admin_setting');
    Route::get('/lead_list_admin','backend\AdminController@lead_list_admin');    
    Route::post('/admin_setting_update','backend\AdminController@admin_setting_update');
 });
//login controoler
Route::get('/admin','backend\LoginController@index');
Route::post('/auth-check','backend\LoginController@auth_check');
Route::get('/logout','backend\LoginController@logout');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
