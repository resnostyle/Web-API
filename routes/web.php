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

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/invites/{invite}', 'InvitesController@show');
Route::post('/invites', 'InvitesController@store');

Route::get('/mailable', function () {
    $user = App\User::find(3);

    //Mail::to($user->email)->send(new App\Mail\UserRegistered($user));

    return new App\Mail\UserRegistered($user);
});