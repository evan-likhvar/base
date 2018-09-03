<?php

Route::get('/', 'FrontController@index')->name('site.home.page');

Route::get('/home', 'FrontUserHomeController@index')->name('home')->middleware('auth');
