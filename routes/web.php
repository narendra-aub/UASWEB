<?php

use Illuminate\Support\Facades\Route;

use App\Http\Livewire\Auth\ForgotPassword;
use App\Http\Livewire\Auth\ResetPassword;
use App\Http\Livewire\Auth\SignUp;
use App\Http\Livewire\Auth\Login;
use App\Http\Livewire\Dashboard;
use App\Http\Livewire\SearchStock;
use App\Http\Livewire\EditPemasok;
use App\Http\Livewire\Billing;
use App\Http\Livewire\Profile;
use App\Http\Livewire\Tables;
use App\Http\Livewire\StaticSignIn;
use App\Http\Livewire\StaticSignUp;
use App\Http\Livewire\Rtl;

use App\Http\Livewire\Component\AddStock;
use App\Http\Livewire\Component\AddPemasok;
use App\Http\Livewire\Component\EditStock;
use App\Http\Livewire\Component\UserManagement;

use Illuminate\Http\Request;

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

Route::get('/', function() {
    return redirect('/login');
});

Route::get('/sign-up', SignUp::class)->name('sign-up');
Route::get('/login', Login::class)->name('login');

Route::get('/login/forgot-password', ForgotPassword::class)->name('forgot-password');

Route::get('/reset-password/{id}',ResetPassword::class)->name('reset-password')->middleware('signed');

// Route::get('/gudang', [App\Http\Controllers\GudangController::class, 'index'])->name('gudang');


// Route::get('/mahasiswa/create', [App\Http\Controllers\MahasiswaController::class, 'create']);
Route::delete('dashboard/{id}', [Dashboard::class, 'destroy'])->name('dashboard');
Route::delete('addpemasok/{id}', [addpemasok::class, 'destroy'])->name('addpemasok');
// Route::get('dashboard/{id}/edit', [EditStock::class, 'edit']);

Route::get('dashboard/edit/{id_stock}', [EditStock::class, 'edit'])->name('edit');

Route::get('dashboard/editpemasok/{id_pemasok}', [EditPemasok::class, 'edit'])->name('edit');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', Dashboard::class)->name('dashboard');
    Route::get('/dashboard/create', AddStock::class)->name('AddStock');
    Route::get('/dashboard/addpemasok', AddPemasok::class)->name('AddPemasok');
    Route::post('/dashboard', [Dashboard::class, 'store'])->name('dashboard');
    Route::post('/addpemasok', [AddPemasok::class, 'masok'])->name('AddPemasok');
    Route::patch('dashboard/{id}', [Dashboard::class, 'update']);
    Route::patch('editpemasok/{id}', [EditPemasok::class, 'update']);
    Route::get('searchstock/search', [Dashboard::class, 'searchstock'])->name('search');
    // Route::delete('dashboard/{id}', [Dashboard::class, 'destroy'])->name('dashboard');


    // Route::get('/dashboard', [App\Http\Controllers\GudangController::class, 'index'])->name('dashboard');
    Route::get('/billing', Billing::class)->name('billing');
    Route::get('/profile', Profile::class)->name('profile');
    Route::get('/tables', Tables::class)->name('tables');
    Route::get('/static-sign-in', StaticSignIn::class)->name('sign-in');
    Route::get('/static-sign-up', StaticSignUp::class)->name('static-sign-up');
    Route::get('/rtl', Rtl::class)->name('rtl');
    Route::get('/laravel-user-profile', AddStock::class)->name('AddStock');
    Route::get('/tambah-pemasok', AddPemasok::class)->name('AddPemasok');
});

