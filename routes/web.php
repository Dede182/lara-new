<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
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
    return view('Test');
});
Route::get('contacts/export/', [ContactController::class, 'export'])->name('contact.export');
Route::get('contacts/import/', [ContactController::class, 'import'])->name('contact.import');
Route::post('/contact/bulk/',[ContactController::class,'bulk'])->name('contact.bulk');
Route::resource('contact', ContactController::class);
