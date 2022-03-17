<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\InventoryController;

/*
|--------------------------------------------------------------------------
| Tenant Routes
|--------------------------------------------------------------------------
|
| Here you can register the tenant routes for your application.
| These routes are loaded by the TenantRouteServiceProvider.
|
| Feel free to customize them however you want. Good luck!
|
*/

Route::middleware([
    'web',
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,
])->group(function () {
    Route::get('/', [CustomAuthController::class, 'login']);

    Route::get('/inventory/index', [InventoryController::class, 'index']);
    Route::get('/inventory/create', [InventoryController::class, 'create']);
    Route::post('/inventory/edit', [InventoryController::class, 'edit']);
    Route::post('/inventory/store', [InventoryController::class, 'store']);
});

Route::get('/nev', function () {
    return view('Nev');
});

Route::get('/deshboard', function () {
    return view('Deshboard');
});
