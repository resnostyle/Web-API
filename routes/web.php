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

Route::get('/', ['middleware' => 'guest', function () {
    return view('welcome');
}]);

Auth::routes();

Route::get('/news', 'NewsController@index')->name('news');

// -- Invites -- //
Route::get('/invites/{invite}', 'InvitesController@show');
Route::post('/invites', 'InvitesController@store')->name('free_invites');
// ------------- //

// -- Releases -- //
Route::get('/browse/{category}/{subcat?}', 'CategoryController@show')->name('browse');
// -------------- //

// -- User -- //
Route::get('/profile/{user?}','UserController@show')->name('profile');
// Kind of a nasty hack, violates restful, but you can only have trailing optional values.
Route::get('/profile/edit/{user?}', 'UserController@edit');
Route::patch('/profile/{user?}', 'UserController@store');
// ---------- //

// Test email sending.
Route::get('/mailable', function () {
    $user = App\User::find(3);

    //Mail::to($user->email)->send(new App\Mail\UserRegistered($user));

    return new App\Mail\UserRegistered($user);
});