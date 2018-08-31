<?php

Route::get('/', 'FrontController@index')->name('site.home.page');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
