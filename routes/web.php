<?php

Auth::routes(['verify' => true]);
Auth::routes(['register' => false]);
Auth::routes();

Route::get('/', 'InstalacionController@index');

Route::get('home', 'HomeController@index')->name('home');
Route::post('login', 'Auth\LoginController@login')->name('login');

Route::resource('afiliados', 'AfiliadoController');
Route::resource('disciplinas', 'DisciplinaController');
Route::resource('instalaciones', 'InstalacionController');

Route::group(['prefix' => 'instalaciones'], function(){
    Route::post('upload', 'InstalacionController@cargarImagenesInstalacion');
    Route::get('images/{id}', 'InstalacionController@obtenerImagenesInstalacion');
    Route::delete('images/{id}', 'InstalacionController@eliminarImagenInstalacion');
});

Route::group(['prefix' => 'eventos'], function(){
    Route::get('/', 'EventoController@index')->name('eventos.index');
    Route::get('shows', 'EventoController@shows');
});


Route::group(['prefix' => 'tee-time'], function(){
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


