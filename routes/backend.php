<?php

Route::get('/', 'BackController@index')->name('backend.index');

Route::name('backend')->resource('user',      'BackUserController',['except' => ['show']]);
