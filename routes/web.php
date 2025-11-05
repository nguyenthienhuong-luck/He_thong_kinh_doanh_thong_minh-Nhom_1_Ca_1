<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BankBranchController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\ChatbotController;
use App\Http\Controllers\WalletController;
use App\Http\Controllers\BudgetController;
use App\Http\Controllers\AnalysisController;

// Route cho màn hình Loading
Route::get('/loading', function () {
  return view('home.loading');
})->name('loading');
Route::get('/loading', function () {
  return view('home.loading');
})->name('loading');

// Route cho Home
Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/', function () {
  if (Auth::check()) {
    return redirect()->route('home.dashboard');
  } else {
    return redirect()->route('loading');
  }
});
Route::get('/', function () {
  if (Auth::check()) {
    return redirect()->route('home.dashboard');
  } else {
    return redirect()->route('loading');
  }
});

Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'handleRegister']);
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'handleLogin']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('checkLogin')->group(function () {
  Route::get('/currency', [AuthController::class, 'indexCurrency'])->name('home.currency');
  Route::post('/currency', [AuthController::class, 'updateCurrency'])->name('home.currency.update');

  // Route lien quan den HomeController
  Route::get('/budget', [HomeController::class, 'indexBudget'])->name('home.budget');
  Route::get('/account', [HomeController::class, 'indexAccount'])->name('home.account');
  Route::get('/transaction', [HomeController::class, 'indexTransaction'])->name('home.transaction');
  Route::get('/dashboard', [HomeController::class, 'indexDashboard'])->name('home.dashboard');

  // Route lien quan den AccountController
  Route::group(['prefix' => 'accounts', 'as' => 'accounts.'], function () {
    Route::get('', [AccountController::class, 'index'])->name('index');
    Route::get('profile', [AccountController::class, 'edit'])->name('edit');
    Route::put('profile/{id}', [AccountController::class, 'update'])->name('update');
    Route::post('createPaymentLink', [AccountController::class, 'createPaymentLink'])->name('createPaymentLink');
    Route::get('handlePaymentSuccess', [AccountController::class, 'handlePaymentSuccess'])->name('handlePaymentSuccess');
  });


  // Route lien quan den TransactionController
  Route::group(['prefix' => 'transactions', 'as' => 'transactions.'], function () {
    Route::post('store', [TransactionController::class, 'store'])->name('store');
    Route::put('update/{id}', [TransactionController::class, 'update'])->name('update');
    Route::delete('{id}', [TransactionController::class, 'destroy'])->name('destroy');
  });

  // Route lien quan den WalletController
  Route::group(['prefix' => 'wallets', 'as' => 'wallets.'], function () {
    Route::post('store', [WalletController::class, 'store'])->name('store');
    Route::put('update/{id}', [WalletController::class, 'update'])->name('update');
    Route::delete('{id}', [WalletController::class, 'destroy'])->name('destroy');
  });

  // Route lien quan den BudgetController
  Route::group(['prefix' => 'budgets', 'as' => 'budgets.'], function () {
    Route::post('store', [BudgetController::class, 'store'])->name('store');
    Route::put('update/{id}', [BudgetController::class, 'update'])->name('update');
    Route::delete('{id}', [BudgetController::class, 'destroy'])->name('destroy');
  });

  //Route cho tim kiem chi nhanh
  Route::get('/bank-branches', [BankBranchController::class, 'index'])->name('bank-branches.index');
  Route::post('/bank-branches', [BankBranchController::class, 'search'])->name('bank-branches.search');

  // Route lien quan den ChatbotController
  Route::middleware(['checkPremium'])->group(function () {
    Route::group(['prefix' => 'chat', 'as' => 'chat.'], function () {
    Route::post('create-transaction', [ChatbotController::class, 'createTransaction'])->name('createTransaction');
    Route::get('history', [ChatBotController::class, 'getChatHistory'])->name('history');
  });
});

  Route::middleware(['checkPermission'])->group(function () {
  Route::get('admin', [HomeController::class, 'indexAdmin'])->name('home.admin');
  });
Route::get('/analysis', [AnalysisController::class, 'index'])
    ->middleware('auth')
    ->name('analysis');
});