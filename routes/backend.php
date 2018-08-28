<?php

Route::get('/', 'BackController@index')->name('backend.index');

Route::name('backend')->resource('user',                'BackUserController',           ['only' => ['index']]);
Route::name('backend')->resource('role',                'BackRoleController',           ['only' => ['index']]);
Route::name('backend')->resource('permission',          'BackPermissionController',     ['only' => ['index','update']]);
Route::name('backend')->resource('language',            'BackLanguageController',       ['only' => ['index']]);
Route::name('backend')->resource('user',      'BackUserController',['except' => ['show']]);



















//api routes
Route::post('/toggle-dashboard-access', 'BackApiController@toggleDashboardAccessProperty');
Route::post('/toggle-user-active',      'BackApiController@toggleUserActiveProperty');
Route::post('/toggle-role-active',      'BackApiController@toggleRoleActiveProperty');
Route::post('/toggle-language-active',  'BackApiController@toggleLanguageActiveProperty');

