<?php

Route::get('/',             'BackController@index')             ->name('backend.index');
Route::get('/permission',   'BackPermissionController@index')   ->name('backend.permission.index');
Route::post('/permission',  'BackPermissionController@update')  ->name('backend.permission.update');

Route::name('backend')->resource('user',        'BackUserController',           ['except' => ['show','destroy']]);
Route::name('backend')->resource('role',        'BackRoleController',           ['except' => ['show','destroy']]);
Route::name('backend')->resource('language',    'BackLanguageController',       ['except' => ['show','destroy']]);

//api routes
Route::post('/toggle-dashboard-access', 'BackApiController@toggleDashboardAccessProperty');
Route::post('/toggle-user-active',      'BackApiController@toggleUserActiveProperty');
Route::post('/toggle-role-active',      'BackApiController@toggleRoleActiveProperty');
Route::post('/toggle-language-active',  'BackApiController@toggleLanguageActiveProperty');

