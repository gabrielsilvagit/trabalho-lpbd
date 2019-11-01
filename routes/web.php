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
    Route::get("/home", "HomeController@index")->name("home");
    Route::get("users", "UserController@index")->name("user.index");
    Route::get("users/{user}", "UserController@show")->name("show.user");
    Route::get("/users/edit/{user}", "UserController@edit")->name("user.edit");
    Route::put('users/{user}','UserController@update')->name("user.update");
    Route::delete('users/{user}','UserController@destroy')->name("user.delete");
    Route::post("/logout", "UserController@logout")->name("user.logout");

    Route::get("services", "ServiceController@index")->name("service.index");
    Route::get("services/create", "ServiceController@create")->name("service.create");
    Route::post("services/save", "ServiceController@store")->name("service.store");
    Route::get("services/{service}", "ServiceController@show")->name("service.show");
    Route::get("services/edit/{service}", "ServiceController@edit")->name("service.edit");
    Route::put("services/{service}", "ServiceController@update")->name("service.update");
    Route::delete("services/{service}", "ServiceController@destroy")->name("service.delete");

    Route::post("services/{service}/hire", "ServiceController@hire")->name("service.hire");
    Route::post("services/{service}/cancel/{user}", "ServiceController@cancel")->name("service.cancel");

});

