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

    Route::get('/login', [CustomAuthController::class, 'index']);
    Route::get('/registration', [CustomAuthController::class, 'registration']);
    Route::post('/custom-login', [CustomAuthController::class, 'customLogin']);
    Route::post('/custom-registration', [CustomAuthController::class, 'customRegistration']);

    Route::get('/', function () {
        return 'This is your multi-tenant application. The id of the current tenant is ' . tenant('id');
    });
    Route::get('/login', function () {
        return view('login');
    });
    Route::get('/nav', function () {
        return view('nav');
    });
    Route::get('/inventoryreport', function () {
        return view('inventoryreport');
    });
    Route::get('/inventoryreportcustomize', function () {
        return view('inventoryreportcustomize');
    });

    Route::get('/stock', function () {
        return view('stock');
    });

    Route::get('/editstock', function () {
        return view('editstock');
    });

    Route::get('/createstock', function () {
        return view('createstock');
    });

    Route::get('/product', function () {
        return view('product');
    });

    Route::get('/editproduct', function () {
        return view('editproduct');
    });

    Route::get('/createproduct', function () {
        return view('createproduct');
    });

    Route::get('/', [CustomAuthController::class, 'login']);

    Route::get('/inventory/index', [InventoryController::class, 'index']);
    Route::get('/inventory/create', [InventoryController::class, 'create']);
    Route::post('/inventory/edit', [InventoryController::class, 'edit']);
    Route::post('/inventory/store', [InventoryController::class, 'store']);

    Route::get('/dashboard', function () {
        return view('dashboard');
    });
});

Route::get('/nev', function () {
    return view('Nev');
});

Route::get('/deshboard', function () {
    return view('Deshboard');
});
