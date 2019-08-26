<?php

Auth::routes(['verify' => true]);
Auth::routes(['register' => false]);
Auth::routes();

Route::get('/', 'InstalacionController@index')->middleware('auth')->name('index');

Route::get('home', 'HomeController@index')->middleware('auth')->name('home');
Route::post('login', 'Auth\LoginController@login')->name('login');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');

Route::resource('afiliados', 'AfiliadoController')->middleware('auth');
Route::resource('disciplinas', 'DisciplinaController')->middleware('auth');
Route::resource('instalaciones', 'InstalacionController')->middleware('auth');

Route::group(['prefix' => 'instalaciones'], function(){
    Route::post('upload', 'InstalacionController@cargarImagenesInstalacion');
    Route::get('images/{id}', 'InstalacionController@obtenerImagenesInstalacion');
    Route::delete('images/{id}', 'InstalacionController@eliminarImagenInstalacion');
});


Route::group(['prefix' => 'sugerencias-chef', 'middleware' => ['auth']], function () {
    Route::get('/', 'OtrosController@indexSugerencia')->name('sugerencias.index');
    Route::post('cargarSugerencia', 'OtrosController@cargarSugerencia');
});

Route::group(['prefix' => 'sabor-gourmet', 'middleware' => ['auth']], function () {
    Route::get('/', 'OtrosController@indexSabor')->name('sabor.index');
    Route::post('cargarSabor', 'OtrosController@cargarSabor');
});

Route::group(['prefix' => 'pqrs', 'middleware' => ['auth']], function(){
    Route::get('/', 'OtrosController@indexPQRS')->name('pqrs.index');
    Route::get('obtenerMensajes', 'OtrosController@obtenerMensajesPqrs');
});

Route::group(['prefix' => 'eventos', 'middleware' => ['auth']], function(){
    Route::post('/', 'EventoController@store');
    Route::get('/', 'EventoController@index')->name('eventos.index');
    Route::get('shows', 'EventoController@shows');
    Route::get('create', 'EventoController@create');

    Route::put('{id}', 'EventoController@update');
    Route::delete('{id}', 'EventoController@destroy');

    Route::get('{id}', 'EventoController@show');
    Route::get('images/{id}', 'EventoController@obtenerImagenesInstalacion');
    Route::delete('images/{id}', 'EventoController@eliminarImagenEvento');
    Route::post('upload', 'EventoController@cargarImagenesEvento');
});


Route::group(['prefix' => 'tee-time', 'middleware' => ['auth']], function(){
    Route::get('/', function(){return view('administrador.tee-time.index');})->name('tee-time.index');
    Route::get('show/{id}', 'TeeTimeController@show')->name('tee-time.show');

    Route::post('escenarios', 'TeeTimeController@index');
    Route::delete('eliminarEscenario', 'TeeTimeController@eliminarEscenario');

    Route::post('reservacionesEscenarioFecha/{id}/{fecha}', 'TeeTimeController@reservacionesEscenarioFecha');
    Route::post('obtenerDiasEstado/{id}/{estado}', 'TeeTimeController@obtenerDiasEstado');
    Route::post('fechasProgramadasEscenario/{id}', 'TeeTimeController@fechasProgramadasEscenario');

    Route::post('registrarProgramacionEscenario', 'TeeTimeController@registrarProgramacionEscenario');
    Route::post('cambiarEstadoDiaProgramado', 'TeeTimeController@cambiarEstadoDiaProgramado');

    Route::delete('eliminarFechaDiaHoraProgramada', 'TeeTimeController@eliminarFechaDiaHoraProgramada');

    Route::post('registrarEscenario', 'TeeTimeController@registrarEscenario')->name('tee-time.registrarEscenario');
});


