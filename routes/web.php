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

Route::middleware("guest")->group(function(){
    Route::get("login", "UserController@loginIndex")->name("login");
    Route::post("login/validate", "UserController@loginPost")->name("login.post");
    Route::get("register", "UserController@create")->name("user.register.create");
    Route::post("register/save", "UserController@store")->name("user.register.post");
});


Route::middleware("auth")->group(function(){
    Route::get("/", "HomeController@index")->name("home");
    Route::get("user/{user}", "UserController@show")->name("show.user");
    Route::get("/user/edit/{user}", "UserController@edit")->name("user.edit");
    Route::patch('user/{user}','UserController@update')->name("user.edit.post");
    Route::delete('user/{user}','UserController@destroy')->name("user.delete");
    Route::post("/logout", "UserController@logout")->name("user.logout");

    Route::get("services", "ServiceController@index")->name("service.index");
    Route::get("service", "ServiceController@create")->name("service.create");
    Route::post("service/save", "ServiceController@store")->name("service.store");
    Route::get("service/{service}", "ServiceController@show")->name("service.show");
    Route::get("service/edit/{service}", "ServiceController@edit")->name("service.edit");
    Route::patch("service/{service}", "ServiceController@update")->name("service.update");

    Route::post("service/{service}/hire", "ServiceController@hire")->name("service.hire");
});

