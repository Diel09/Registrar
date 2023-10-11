<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('login');
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/request-form', function () {
    return Inertia::render('Client/Request');
})->middleware(['auth', 'verified'])->name('request.form');

Route::get('/requests-form', function () {
    return Inertia::render('Client/Requests');
})->middleware(['auth', 'verified'])->name('requests.form');

Route::get('/dashboards', function () {
    return Inertia::render('Registrar/Dashboard');
})->name('dashboards');

Route::get('/registrar', function () {
    return Inertia::render('Registrar/TobeApprove');
})->name('registrar');

Route::get('/documents', function () {
    return Inertia::render('Registrar/Documents');
})->name('documents');

Route::get('/request-registrar', function () {
    return Inertia::render('Registrar/Request');
})->name('request');

Route::get('/document', function () {
    return Inertia::render('Registrar/Document');
})->name('document');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



require __DIR__ . '/auth.php';
