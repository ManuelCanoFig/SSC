<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('inicio');
});

Route::get('/inserta', function () {
    return view('get');
});

Route::get('/SSC', function () {
    return view('SSC');
});

Route::get('/Reporte',function(){
	return view('Reporte');
});


