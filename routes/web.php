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


use App\Accomodation;
use App\Post;
use App\User;
//Route::get('/', ['as' => 'index', 'uses' => 'HomeController@index']);
//Route::prefix('admin')->group(function () {
//    Route::get('/', function () {
//        return view('welcome');
//    });
//});
Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => [ 'localeSessionRedirect', 'localizationRedirect','localize' , "XSS_clean"]], function() {

    Route::get('/', ['as' => 'index', 'uses' => 'HomeController@index']);
    Route::post("ajax/state",['uses' => 'AJAXController@state', 'as' => 'AJAXState']);
    Route::group(['prefix' => "backend",'middleware' => ['auth', 'isVerified', "XSS_clean"]], function () {
        Route::get('profile', ['as' => 'profile', 'uses' => 'ProfileController@index']);
        Route::put("profile/{id}/update",'ProfileController@update');
        Route::resource('accommodation', 'AccommodationController');
        Route::resource('accommodation-unit', 'AccommodationUnitController');
        Route::get('dashboard', ['as' => 'dashboard', 'uses' => 'DashboardController@index']);
        Route::get('picture-upload', ['as' => 'upload', 'uses' => 'PictureUploadController@getUpload']);
        Route::post('picture-upload', ['as' => 'upload-post', 'uses' =>'PictureUploadController@postUpload']);
        Route::post('picture-upload/delete', ['as' => 'upload-remove', 'uses' =>'PictureUploadController@deleteUpload']);
//role:administrator

    Route::group(['middleware' => ['auth', 'isVerified', "XSS_clean", 'role:admin']], function () {

        Route::resource('roles', 'RoleController');
        Route::resource('permissions', 'PermissionController');
        Route::resource('users', 'UserController');
        Route::delete('users/{id}/permission/{pi}', ['uses' => 'UserController@permission_delete', 'as' => 'users.permission_delete']);
        Route::get('users/permission/create', ['uses' => 'UserController@permission_create', 'as' => 'users.permission_create']);
        Route::post('users/permission/store', ['uses' => 'UserController@permission_store', 'as' => 'users.permission_store']);
        Route::delete('users/{id}/role/{pi}', ['uses' => 'UserController@role_delete', 'as' => 'users.role_delete']);
        Route::get('users/role/create', ['uses' => 'UserController@role_create', 'as' => 'users.role_create']);
        Route::post('users/role/store', ['uses' => 'UserController@role_store', 'as' => 'users.role_store']);
        Route::resource('types', 'TypeController');
        Route::resource('categories', 'CategoryController');
        Route::resource('city', 'CityController');
        Route::resource('period', 'PeriodController');
        Route::resource('characteristics', 'CharacteristicsController');
        Route::resource('state', 'StateController');
        Route::resource('renting', 'RentingController');
        Route::resource('payment', 'PaymentController');
        Route::resource('distance', 'DistanceController');
        Route::resource('species', 'SpeciesController');
    });
});
    Route::get('email-verification/error', 'Auth\RegisterController@getVerificationError')->name('email-verification.error');
    Route::get('email-verification/check/{token}', 'Auth\RegisterController@getVerification')->name('email-verification.check');
    Auth::routes();
});





//Route::get('/read', function () {
//
//    $user=User::findOrFail(1);
//    $accomodation=Accomodation::findOrFail(1);
////    foreach ($user->accommodations as $accommodation)
////    {
//        var_dump($accomodation->city->name);
////    }
//});




