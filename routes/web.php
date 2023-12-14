<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
// use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProductController;

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

Route::get('/request-form', [ClientController::class, 'index'])->middleware(['auth', 'verified'])->name('request-form');

Route::get('/requests-form', function () {
    return Inertia::render('Client/Requests');
})->middleware(['auth', 'verified'])->name('requests.form');

Route::get('/payment-form', function () {
    return Inertia::render('Client/ToBePaid');
})->middleware(['auth', 'verified'])->name('payment.form');

Route::get('/dashboards', function () {
    $name = Auth::guard('registrar')->user()->name;
    return Inertia::render('Registrar/Dashboard', [
        "name" => $name
    ]);
})->name('dashboards');

Route::get('/TobeAppove', function () {
    $name = Auth::guard('registrar')->user()->name;
    return Inertia::render('Registrar/TobeApprove', [
        "name" => $name
    ]);
})->name('TobeApprove');

Route::get('/Processing', function () {
    $name = Auth::guard('registrar')->user()->name;
    return Inertia::render('Registrar/Processing', [
        "name" => $name
    ]);
})->name('Processing');

Route::get('/Ready', function () {
    $name = Auth::guard('registrar')->user()->name;
    return Inertia::render('Registrar/Ready', [
        "name" => $name
    ]);
})->name('Ready');

Route::get('/documents', function () {
    return Inertia::render('Registrar/Documents');
})->name('documents');

Route::get('/request-registrar', function () {
    $name = Auth::guard('registrar')->user()->name;
    return Inertia::render('Registrar/Request', [
        "name" => $name
    ]);
})->name('request');

Route::get('/document', function () {
    $name = Auth::guard('registrar')->user()->name;
    return Inertia::render('Registrar/Document', [
        "name" => $name
    ]);
})->name('document');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route::get("list", [ClientController::class,'list']);
// Route::post('/save',[DocumentTypeController::class,'create']);
// Route::get('/faqlist',[DocumentController::class, 'table']);
// Route::get('/posts', [PostController::class, 'index']);

// Route::get('/posts', [PostController::class, 'index']);

Route::post('/submit', [RequestController::class, 'submit'])->name('data.submit');
// Route::post('/save-data',[RequestController::class, 'saveData'])->name('data.save');

Route::post('/upload-data', [DocumentController::class,'upload'])->name('data.upload');
Route::get('/getDocTypes', [DocumentController::class, 'getAllDocTypes']);
Route::delete('/Delete/{id}', [DocumentController::class, 'destroy']);
Route::get('/get-product/{id}', [DocumentController::class, 'studno']);
Route::get('/getStudno', [DocumentController::class, 'getClient']);
Route::get('/getRequest', [RequestController::class, 'getAllRequest']);
Route::post('/deleteDocs',[DocumentController::class, 'deleteDocs']);
Route::get('/getDocRequest', [RequestController::class, 'getAllRequest']);
Route::get('/get-Request', [RequestController::class, 'getRequest']);
Route::get('/get-Timestamp', [RequestController::class, 'getTimestamp']);
Route::get('/get-Payment', [RequestController::class, 'getPayment']);

Route::post('/deleteRequest',[RequestController::class, 'deleteRequest']);

Route::get('/get-RequestDetails', [RequestController::class, 'getRequestDetails']);
Route::get('/get-Processing', [RequestController::class, 'getProcessing']);
Route::get('/get-Ready', [RequestController::class, 'getReady']);
Route::get('/get-Requests', [RequestController::class, 'getRequests']);

Route::post('/updateStatus', [RequestController::class, 'updateStatus']);
Route::post('/rejectStatus', [RequestController::class, 'rejectStatus']);
Route::post('/readyStatus', [RequestController::class, 'readyStatus']);
Route::post('/doneStatus', [RequestController::class, 'doneStatus']);

Route::get('/filter/{filters}/{student}', [RequestController::class, 'filter'])->name('filter');
Route::get('/request/search', [RequestController::class, 'search']);
Route::get('/approve/search', [RequestController::class, 'approveSearch']);
Route::get('/pending/search', [RequestController::class, 'pendingSearch']);
Route::get('/completed/search', [RequestController::class, 'completedSearch']);
Route::get('/process/search', [RequestController::class, 'processSearch']);

Route::get('/generate-barcode', [ProductController::class, 'index'])->name('generate.barcode');
 
Route::get('/getItemRequestDetails', [RequestController::class, 'getItemRequestDetails']);
Route::get('/getItemProcessing', [RequestController::class, 'getItemProcessing']);
Route::get('/getItemCompleted', [RequestController::class, 'getItemCompleted']);

Route::get('/fetchDoctypes', [RequestController::class, 'fetchDoctypes']);
Route::get('/line-Chart', [RequestController::class, 'lineChart']);


Route::get('/document/suggestions', [RequestController::class, 'suggestions'])->name('document.suggestions');
Route::post('/document/edit', [DocumentController::class, 'docEdit'])->name('document.edit');
require __DIR__ . '/auth.php';
