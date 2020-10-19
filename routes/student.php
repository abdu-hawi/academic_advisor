<?php

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Route;

Route::group(['prefix'=>'student','namespace'=>'Student'],function (){
    Config::set('auth.defines','student');


    Route::get('login','StudentAuthController@login');
    Route::post('login','StudentAuthController@doLogin');

//    Route::get('forgotPassword','StudentAuthController@forgotPassword');
//    Route::post('forgotPassword','StudentAuthController@forgotPasswordPost');

    Route::get('register','StudentAuthController@registerPage');
    Route::post('register','StudentAuthController@registerPost');

    Route::get('verify/{token}','StudentAuthController@verify');
    Route::post('reSendVerify','StudentAuthController@reSendVerify');

//    Route::get('reset/password/{token}',function ($token){
//        return view('advisor.auth.reset_password',['token'=>$token]);
//    });
//    Route::post('reset/password','StudentAuthController@resetPassword');


    Route::group(['middleware'=>'student:student'],function(){
        Route::get('logout','StudentAuthController@logout');

        Route::get('register/{id}','StudentAuthController@registerContinueGet');
        Route::post('register/{id}','StudentAuthController@registerContinuePost');

        Route::post('plans/init/{id}','PlaneController@plane');
        Route::get('plans/edit/{id}','PlaneController@plane_edit');
        Route::get('plans/edit/id/{id}','PlaneController@edit');
        Route::post('plans/show/{id}','PlaneController@show');
        Route::get('plans/senior/edit/{id}','PlaneController@planeSeniorEdit');

        Route::resource('plans','PlaneController')->except('show');
        Route::post('planeSave/{id}','PlaneController@plane');
        Route::get('links',function (){
            return view('student.link.home',['links'=>\App\Model\Admin\Link::query()->get()]);
        });

        Route::get('messages','MessagesController@index');
        Route::post('messages','MessagesController@store');
        Route::get('msg/{id}','MessagesController@getMsg');
        Route::get('isRead','MessagesController@isRead');

        Route::resource('profile','ProfileController')->except('show','create','store','destroy');

        Route::get('advisor','AdvisorController@index');

        Route::get('exams','ExamController@index');

        Route::get('notifications','AnnouncementController@index');
        Route::get('notifications/{id}','AnnouncementController@show');

        Route::get('faq','FAQController@index');

        Route::post('chatbot','ChatBotController@chatter');

        Route::get('/',function (){
            return view('student.home');
        });
    });


});
