<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use Livewire\Volt\Volt;
use App\Http\Controllers\ModuleController;
/*Volt is an elegantly crafted functional API for Livewire that supports 
single-file components, allowing a component's PHP logic and Blade templates 
to coexist in the same file.
*/
Route::view('/', 'welcome');


Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

/****Module Routes************************* */
Route::get(
    'list/{module_name?}',
    [ModuleController::class, 'index']
)->name('module.list');

Route::get(
    'create/{module_name?}',
    [ModuleController::class, 'create']
)->name('module.create');

Route::post(
    'store/{module_name?}',
    [ModuleController::class, 'store']
)->name('module.store');

Route::get('edit/{module_name}/{value_code}', [ModuleController::class, 'edit'])
->name('module.edit');

Route::put('update/{module_name}/{value_code}', [ModuleController::class, 'update'])
->name('module.update');

/********************************************* */
Route::view('customers/list', 'customers.index')
    ->middleware(['auth', 'verified'])
    ->name('customers.index');//Lets look at the customer listing
Route::view('customers/create', 'customers.create')
    ->middleware(['auth', 'verified'])
    ->name('customers.create');
Volt::route('customers/{customer}/edit', 'customers.edit-customer')
    ->middleware(['auth'])
    ->name('customers.edit');
Route::view('invoices/list', 'invoices.index')
    ->middleware(['auth', 'verified'])
    ->name('invoices.index');
Route::view('invoices/create', 'invoices.create')
    ->middleware(['auth', 'verified'])
    ->name('invoices.create');
Volt::route('invoices/{invoice}/edit', 'invoices.edit-invoice')
    ->middleware(['auth'])
    ->name('invoices.edit');


require __DIR__.'/auth.php';
