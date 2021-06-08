<?php

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


$tip = "{tip}";
Route::group([
    "middleware" => [
        "apiauth:api",
    ],
    "prefix" => "$tip",
], function () {

    Route::match([
        'get',
        'post',
    ], "companies", [\App\Http\Controllers\CompanyController::class, 'companies']);

    Route::match([
        'get',
        'post',
    ], "company/detail/{company_id}", [\App\Http\Controllers\CompanyController::class, 'company']);

    Route::match([
        'get',
        'post',
    ], "company/package/{company_id}", [\App\Http\Controllers\CompanyController::class, 'company_package']);

    Route::match([
        'get',
        'post',
    ], "company/create", [\App\Http\Controllers\CompanyController::class, 'create']);

    Route::match([
        'get',
        'post',
    ], "company/subscription/create", [\App\Http\Controllers\CompanyPackageController::class, 'create']);



});
