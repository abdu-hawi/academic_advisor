<?php

use App\Model\Admin\Link;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Route;

Route::group(['prefix'=>'advisor','namespace'=>'Advisor'],function (){
    Config::set('auth.defines','advisor');

    Route::get('login','AdvisorAuthController@login');
    Route::post('login','AdvisorAuthController@doLogin');

    Route::get('forgotPassword','AdvisorAuthController@forgotPassword');
    Route::post('forgotPassword','AdvisorAuthController@forgotPasswordPost');

    Route::get('register','AdvisorAuthController@registerPage');
    Route::post('register','AdvisorAuthController@registerPost');

    Route::get('verify/{token}','AdvisorAuthController@verify');
    Route::post('reSendVerify','AdvisorAuthController@reSendVerify');

    Route::get('reset/password/{token}',function ($token){
        return view('advisor.auth.reset_password',['token'=>$token]);
    });
    Route::post('reset/password','AdvisorAuthController@resetPassword');

    Route::group(['middleware'=>'advisor:advisor'],function(){
        Route::get('logout','AdvisorAuthController@logout');
        Route::get('/',function (){
            return view('advisor.home');
        });
        Route::resource('profile','ProfileController')->except('show','create','store','destroy');

        Route::resource('students','StudentController')->except('create','store','destroy');

        Route::resource('exams','ExamController');

        Route::get('plans/{id}/edit/{name}','PlaneController@edit');
        Route::put('plans/{plan}','PlaneController@update');
        Route::get('links',function (){
            return view('advisor.link.home',['links'=>Link::query()->get()]);
        });

        Route::get('messages','MessagesController@index');
        Route::get('msg_unread','MessagesController@msg_unread');
        Route::get('isRead/{id}','MessagesController@isRead');
        Route::get('get_all_msg_student/{id}','MessagesController@getAllMsgStudent');
        Route::post('messages/{id}','MessagesController@store');
        Route::get('msg/{id}','MessagesController@getMsg');

        Route::resource('announcements','AnnouncementController');

        Route::resource('faq','FAQController')->except('show','edit');

        Route::resource('chatter','ChatBotController');

    });
});
