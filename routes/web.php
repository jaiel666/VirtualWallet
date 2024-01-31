<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\WalletController;
use Illuminate\Support\Facades\Route;

Route::get('/register', [RegistrationController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegistrationController::class, 'register']);
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login');


Route::post('/logout', [DashboardController::class, 'logout'])->name('logout');
Route::get('/', [DashboardController::class, 'mainpage'])->name('main_page');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


Route::middleware(['auth'])->group(function () {
    Route::get('/wallets', [WalletController::class, 'index'])->name('wallet.index');
    Route::get('/wallets/create', [WalletController::class, 'create'])->name('wallet.create');
    Route::post('/wallets', [WalletController::class, 'store'])->name('wallet.store');
    Route::get('/wallets/{wallet}/edit', [WalletController::class, 'edit'])->name('wallet.edit');
    Route::put('/wallets/{wallet}', [WalletController::class, 'update'])->name('wallet.update');
    Route::delete('/wallets/{wallet}', [WalletController::class, 'destroy'])->name('wallet.destroy');
});

Route::get('/transactions/send', [TransactionController::class, 'index'])->name('transactions.send');
Route::post('/transactions/send', [TransactionController::class, 'send']);

Route::get('/wallets/{accountName}/transactions', [WalletController::class, 'transactions'])->name('wallet.transactions');

Route::delete('/transactions/{transaction}', [WalletController::class, 'deleteTransaction'])->name('transaction.delete');

Route::post('/transactions/{id}/toggle-fraudulent', [TransactionController::class, 'toggleFraudulent'])->name('transaction.toggle-fraudulent');



