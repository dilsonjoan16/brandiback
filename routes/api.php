<?php

use App\Http\Controllers\AreaCursoController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\ModalidadCursoController;
use App\Http\Controllers\TipoCursoController;
use App\Http\Controllers\MailController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => 'api','prefix' => 'auth'], function ($router) {

    // RUTAS USUARIO
    Route::post('login', 'App\Http\Controllers\AuthController@login');
    Route::post('logout', 'App\Http\Controllers\AuthController@logout');
    Route::post('refresh', 'App\Http\Controllers\AuthController@refresh');
    Route::post('me', 'App\Http\Controllers\AuthController@me');
    Route::post('register', 'App\Http\Controllers\AuthController@register');
    Route::post('recovery', [MailController::class, 'sendEmail']);
    Route::get('perfil/{id}', [AuthController::class, 'perfil']);
    Route::put('usuario/modificar/{id}', [AuthController::class, 'modificar']);

    // RUTAS DE MODALIDADES DE CURSOS
    Route::get('modalidad/cursos', [ModalidadCursoController::class, 'index']);
    Route::get('modalidad/cursos/ver/{id}', [ModalidadCursoController::class, 'show']);
    Route::post('modalidad/cursos/crear', [ModalidadCursoController::class, 'store']);
    Route::put('modalidad/cursos/modificar/{id}', [ModalidadCursoController::class, 'update']);
    Route::delete('modalidad/cursos/eliminar/{id}', [ModalidadCursoController::class, 'destroy']);

     // RUTAS DE TIPOS DE CURSOS
     Route::get('tipo/cursos', [TipoCursoController::class, 'index']);
     Route::get('tipo/cursos/ver/{id}', [TipoCursoController::class, 'show']);
     Route::post('tipo/cursos/crear', [TipoCursoController::class, 'store']);
     Route::put('tipo/cursos/modificar/{id}', [TipoCursoController::class, 'update']);
     Route::delete('tipo/cursos/eliminar/{id}', [TipoCursoController::class, 'destroy']);

      // RUTAS DE AREAS DE CURSOS
    Route::get('area/cursos', [AreaCursoController::class, 'index']);
    Route::get('area/cursos/ver/{id}', [AreaCursoController::class, 'show']);
    Route::post('area/cursos/crear', [AreaCursoController::class, 'store']);
    Route::put('area/cursos/modificar/{id}', [AreaCursoController::class, 'update']);
    Route::delete('area/cursos/eliminar/{id}', [AreaCursoController::class, 'destroy']);

     // RUTAS DE CURSOS
     Route::get('cursos', [CursoController::class, 'index']);
     Route::get('cursos/ver/{id}', [CursoController::class, 'show']);
     Route::post('cursos/crear', [CursoController::class, 'store']);
     Route::put('cursos/modificar/{id}', [CursoController::class, 'update']);
     Route::delete('cursos/eliminar/{id}', [CursoController::class, 'destroy']);

});
