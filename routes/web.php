<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\ClientContactController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DealController;
use App\Http\Controllers\GoogleAuthController;
use App\Http\Controllers\HostingDetailController;
use App\Http\Controllers\SerivceLevelController;
use App\Http\Controllers\TechnologyController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WebsiteController;
use App\Http\Controllers\WhoisController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function(){
    return view('user.index');
});

Route::middleware('auth')->group(function(){

Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('dashboard/showTransaction', [DashboardController::class, 'showTransaction']);
Route::get('dashboard/showDealWon', [DashboardController::class, 'showDealWon']);
Route::get('dashboard/showAllDeals', [DashboardController::class, 'showAllDeals']);
Route::get('dashboard/showClients', [DashboardController::class, 'showClients']);

Route::prefix('/clients')->group(function(){
    Route::get('/create', [ClientController::class, 'create'])->name('client.create');
    Route::post('/', [ClientController::class, 'store'])->name('client.store');
    Route::get('/', [ClientController::class, 'index'])->name('client.index');
    Route::get('/exportsClients', [ClientController::class, 'exportClients']);
    Route::get('/{id}', [ClientController::class, 'show'])->name('client.show');
    Route::get('/edit/{id}', [ClientController::class, 'edit'])->name('client.edit');
    Route::patch('/{id}', [ClientController::class, 'update'])->name('client.update');
    Route::delete('/delete', [ClientController::class, 'destroy'])->name('client.destroy');
});

Route::prefix('deals')->group(function(){
    Route::get('/create', [DealController::class, 'create'])->name('deal.create');
    Route::post('/', [DealController::class, 'store'])->name('deal.store');
    Route::get('/', [DealController::class, 'index'])->name('deal.index');
    Route::get('/{id}', [DealController::class, 'show'])->name('deal.show');
    Route::get('/edit/{id}', [DealController::class, 'edit'])->name('deal.edit');
    Route::patch('/{id}', [DealController::class, 'update'])->name('deal.update');
    Route::delete('/delete', [DealController::class, 'destroy'])->name('deal.destroy');
});

Route::prefix('transactions')->group(function(){
    Route::get('/create', [TransactionController::class, 'create'])->name('transaction.create');
    Route::post('/', [TransactionController::class, 'store'])->name('transaction.store');
    Route::get('/', [TransactionController::class, 'index'])->name('transaction.index');
    Route::get('/{id}', [TransactionController::class, 'show'])->name('transaction.show');
    Route::get('/edit/{id}', [TransactionController::class, 'edit'])->name('transaction.edit');
    Route::patch('/{id}', [TransactionController::class, 'update'])->name('transaction.update');
    Route::delete('/delete', [TransactionController::class, 'destroy'])->name('transaction.destroy');
});

Route::prefix('websites')->group(function(){
    Route::get('/create', [WebsiteController::class, 'create'])->name('website.create');
    Route::post('/', [WebsiteController::class, 'store'])->name('website.store');
    Route::get('/', [WebsiteController::class, 'index'])->name('website.index');
    Route::get('/{id}', [WebsiteController::class, 'show'])->name('website.show');
    Route::get('/edit/{id}', [WebsiteController::class, 'edit'])->name('website.edit');
    Route::patch('/{id}', [WebsiteController::class, 'update'])->name('website.update');
    Route::delete('/delete', [WebsiteController::class, 'destroy'])->name('website.destroy');
});

Route::prefix('clientContacts')->group(function(){
    Route::get('/create', [ClientContactController::class, 'create'])->name('clientContact.create');
    Route::post('/', [ClientContactController::class, 'store'])->name('clientContact.store');
    Route::get('/', [ClientContactController::class, 'index'])->name('clientContact.index');
    Route::get('/{id}', [ClientContactController::class, 'show'])->name('clientContact.show');
    Route::get('/edit/{id}', [ClientContactController::class, 'edit'])->name('clientContact.edit');
    Route::patch('/{id}', [ClientContactController::class, 'update'])->name('clientContact.update');
    Route::delete('/delete', [ClientContactController::class, 'destroy'])->name('clientContact.destroy');
});

Route::prefix('hostingDetails')->group(function(){
    Route::get('/create', [HostingDetailController::class, 'create'])->name('hostingDetail.create');
    Route::post('/', [HostingDetailController::class, 'store'])->name('hostingDetail.store');
    Route::get('/', [HostingDetailController::class, 'index'])->name('hostingDetail.index');
    Route::get('/server/{id}', [HostingDetailController::class, 'server'])->name('hostingDetail.server');
    Route::get('/{id}', [HostingDetailController::class, 'show'])->name('hostingDetail.show');
    Route::get('/edit/{id}', [HostingDetailController::class, 'edit'])->name('hostingDetail.edit');
    Route::patch('/{id}', [HostingDetailController::class, 'update'])->name('hostingDetail.update');
    Route::delete('/delete', [HostingDetailController::class, 'destroy'])->name('hostingDetail.destroy');
});

Route::prefix('serviceLevels')->group(function(){
    Route::get('/create', [SerivceLevelController::class, 'create'])->name('serviceLevel.create');
    Route::post('/', [SerivceLevelController::class, 'store'])->name('serviceLevel.store');
    Route::get('/', [SerivceLevelController::class, 'index'])->name('serviceLevel.index');
    Route::get('/{id}', [SerivceLevelController::class, 'show'])->name('serviceLevel.show');
    Route::get('/edit/{id}', [SerivceLevelController::class, 'edit'])->name('serviceLevel.edit');
    Route::patch('/{id}', [SerivceLevelController::class, 'update'])->name('serviceLevel.update');
    Route::delete('/delete', [SerivceLevelController::class, 'destroy'])->name('serviceLevel.destroy');
});

Route::prefix('technologies')->group(function(){
    Route::get('/create', [TechnologyController::class, 'create'])->name('technology.create');
    Route::post('/', [TechnologyController::class, 'store'])->name('technology.store');
    Route::get('/', [TechnologyController::class, 'index'])->name('technology.index');
    Route::get('/{id}', [TechnologyController::class, 'show'])->name('technology.show');
    Route::get('/edit/{id}', [TechnologyController::class, 'edit'])->name('technology.edit');
    Route::patch('/{id}', [TechnologyController::class, 'update'])->name('technology.update');
    Route::delete('/delete', [TechnologyController::class, 'destroy'])->name('technology.destroy');
});

Route::prefix('activities')->group(function(){
    Route::get('/create', [ActivityController::class, 'create'])->name('activity.create');
    Route::post('/', [ActivityController::class, 'store'])->name('activity.store');
    Route::get('/', [ActivityController::class, 'index'])->name('activity.index');
    Route::get('/{id}', [ActivityController::class, 'show'])->name('activity.show');
    Route::get('/edit/{id}', [ActivityController::class, 'edit'])->name('activity.edit');
    Route::patch('/{id}', [ActivityController::class, 'update'])->name('activity.update');
    Route::delete('/delete', [ActivityController::class, 'destroy'])->name('activity.destroy');
});

Route::get('/whois/{domain}', [WhoisController::class, 'getWhois'])->name('whois.index');

Route::get('create_token', [UserController::class, 'create_token'])->name('user.create_token');

Route::post('/personal_access_tokens', [UserController::class, 'store_token'])->name('user.store_token');

Route::post('/logout', [UserController::class, 'destroy'])->name('user.destroy');

});

Route::post('/login', [UserController::class, 'authenticate'])->name('user.authenticate');
Route::get('/login', [UserController::class, 'index'])->name('user.index');

Route::get('auth/google', [GoogleAuthController::class, 'redirect'])->name('google-auth');
Route::get('auth/google/call-back', [GoogleAuthController::class, 'callbackGoogle']);

// Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
