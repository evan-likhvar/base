<?php

Route::get('/', 'BackController@index')->name('backend.index');

Route::resource('user',      'BackUserController',['except' => ['show']]);
