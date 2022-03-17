<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\ProductController;

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

    Route::get('/product/list', [ProductController::class, 'list'], );
    Route::get('/product/create', [ProductController::class, 'createForm']);
    Route::post('/product/create', [ProductController::class, 'create']);
    Route::get('/product/update/{id}', [ProductController::class, 'updateForm']);
    Route::post('/product/update/{id}', [ProductController::class, 'update']);
    Route::get('/product/delete/{id}', [ProductController::class, 'delete']);

    Route::get('/', function () {
        return 'This is your multi-tenant application. The id of the current tenant is ' . tenant('id');
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

    Route::get('/', [CustomAuthController::class, 'login']);

    Route::get('/inventory/index', [InventoryController::class, 'index']);
    Route::get('/inventory/create', [InventoryController::class, 'create']);
    Route::post('/inventory/edit', [InventoryController::class, 'edit']);
    Route::post('/inventory/store', [InventoryController::class, 'store']);

    Route::get('/dashboard', [InventoryController::class, 'dashboard'], );
});

Route::get('/nev', function () {
    return view('Nev');
});

Route::get('/deshboard', function () {
    return view('Deshboard');
});
