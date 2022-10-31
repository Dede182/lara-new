<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\ContactDupliacteController;
use App\Http\Controllers\ContactDuplicateController;
use App\Http\Controllers\SendController;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Route::middleware(['auth','verified'])->group(function(){
    Route::resource('contact',ContactController::class);
    Route::get('contacts/export/', [ContactController::class, 'export'])->name('contact.export');
    Route::post('contacts/import/', [ContactController::class, 'import'])->name('contact.import');
    Route::post('/contact/bulk/',[ContactController::class,'bulk'])->name('contact.bulk');
    Route::get('/contacts/duplicate/{contact}',[ContactDuplicateController::class,'duplicate'])->name('contact.duplicate');
    Route::post('/contact/bulkDuplicate',[ContactDuplicateController::class,'bulkDuplicate'])->name('contact.bulkDuplicate');
    Route::post('/contact/send',[SendController::class,'send'])->name('contact.send');
    Route::get('noti',[SendController::class,'noti'])->name('noti');
    Route::get('noti/{id}/accept/{contact}',[SendController::class,'accept'])->name('noti.accept');
    Route::get('noti/{id}',[SendController::class,'reject'])->name('noti.reject');
    Route::post('/noti/multiple',[SendController::class,'sendMultiple'])->name('noti.multiple');
});


require __DIR__.'/auth.php';
