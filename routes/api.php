<?php

use App\Http\Controllers\NasabahController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get("/bankdoa", [NasabahController::class, "index"]);
Route::get("/bankdoa/{id}", [NasabahController::class, "show"]);
Route::post("/bankdoa", [NasabahController::class, "store"]);
Route::any("/bankdoa/{id}/nabung", [NasabahController::class, "nabung"]);
Route::any("/bankdoa/{id}/ambil", [NasabahController::class, "ambil"]);
