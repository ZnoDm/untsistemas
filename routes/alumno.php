<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Alumno\PracticaController;
use App\Http\Controllers\Alumno\TesisController;

Route::resource('practica', PracticaController::class)->names('practica');
Route::get('practica/progreso/{id}', [PracticaController::class,'progreso'])->name('practica.progreso');
Route::post('practica/informefinal', [PracticaController::class,'informefinal'])->name('practica.informefinal');


Route::resource('tesis', TesisController::class)->names('tesis');
Route::get('tesis/informefinal/{id}', [TesisController::class,'informefinal'])->name('tesis.informefinal');
Route::get('tesis/revisar/{id}', [TesisController::class,'revisar'])->name('tesis.revisar');
Route::post('tesis/send_informefinal', [TesisController::class,'send_informefinal'])->name('tesis.send_informefinal');

