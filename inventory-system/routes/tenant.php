<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\MailListController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReportController;

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

    Route::get('/product/list', [ProductController::class, 'list'],);
    Route::get('/product/create', [ProductController::class, 'createForm']);
    Route::post('/product/create', [ProductController::class, 'create']);
    Route::get('/product/update/{id}', [ProductController::class, 'updateForm']);
    Route::post('/product/update/{id}', [ProductController::class, 'update']);
    Route::get('/product/delete/{id}', [ProductController::class, 'delete']);

    Route::get('/inventory/list', [InventoryController::class, 'list'], );
    Route::get('/inventory/create', [InventoryController::class, 'createForm']);
    Route::post('/inventory/create', [InventoryController::class, 'create']);
    Route::get('/inventory/update/{id}', [InventoryController::class, 'updateForm']);
    Route::post('/inventory/update/{id}', [InventoryController::class, 'update']);
    Route::get('/inventory/delete/{id}', [InventoryController::class, 'delete']);
    Route::get('/mail/list', [MailListController::class, 'index'],);

    Route::get('/report/list', [ReportController::class, 'index'],);
    Route::post('/report/create', [ReportController::class, 'store']);
    Route::get('/report/delete/{id}', [ReportController::class, 'destroy']);

    Route::get('/invreport/list', [ReportController::class, 'list']);
    Route::get('/invreport/export', [ReportController::class, 'export']);

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

    Route::get('/', [CustomAuthController::class, 'login']);

    Route::get('/dashboard', [InventoryController::class, 'dashboard'], );
});

Route::get('/nev', function () {
    return view('Nev');
});

Route::get('/deshboard', function () {
    return view('Deshboard');
});
