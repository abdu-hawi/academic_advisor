<?php

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Route;

Route::group(['prefix'=>'admin','namespace'=>'Admin'],function (){

    Config::set('auth.defines','admin');

    Route::get('login','AdminAuth@login')->name('admin.login');
    Route::post('login','AdminAuth@doLogin')->name('admin.doLogin');
    Route::get('forgotPassword','AdminAuth@forgotPassword')->name('admin.forgotPassword');
    Route::post('forgotPassword','AdminAuth@forgotPasswordPost')->name('admin.recoverPassword');
    Route::get('reset/password/{token}','AdminAuth@resetPassword');
    Route::post('reset/password/{token}','AdminAuth@resetNewPassword');

    Route::group(['middleware'=>'admin:admin'],function(){

        Route::get('logout','AdminAuth@logout');
        Route::get('/',function (){
            return view('admin.home');
        });
        Route::resource('links','LinksController')->except('show');
        Route::resource('faq','FAQController')->except('show','edit');
        Route::resource('courses','CourseController');
        Route::resource('interests','InterestController');
        Route::delete('interests/all/{interests}','InterestController@delete_interests');
//        Route::resource('advisors','AdvisorController');
        Route::resource('chatter','ChatBotController');
        Route::resource('students','StudentController')->except('create','store','destroy');
        Route::get('plans/{id}/edit/{name}','PlaneController@edit');
        Route::put('plans/{plan}','PlaneController@update');
        Route::resource('exams','ExamController');
        Route::resource('advisors','AdvisorController');
    });

});


