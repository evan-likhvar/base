<?php

Route::get('/set-session-vars', 'DevController@setSessionVars')->name('setSessionVars');
Route::get('/change-session-vars', 'DevController@changeSessionVars')->name('changeSessionVars');
Route::get('/get-session-vars/{key?}', 'DevController@getSessionVars')->name('getSessionVars');


Route::get('/set-session-test', function () {
    session(['test2'=>162]);
});

Route::get('/get-session-test', function () {
    dd(session()->all());
});