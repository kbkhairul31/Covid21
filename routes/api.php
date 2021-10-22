<?php

use App\Models\Buyer;
use Illuminate\Http\Request;
use App\Http\Controllers\Buyer\BuyerController;
use App\Http\Controllers\Buyer\BuyerProductController;
use App\Http\Controllers\Buyer\BuyerTransactionController;
use App\Http\Controllers\Category\CategoryController;
use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\Seller\SellerController;
use App\Http\Controllers\Transaction\TransactionCategoryController;
use App\Http\Controllers\Transaction\TransactionController;
use App\Http\Controllers\Transaction\TransactionSellerController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;

/*
| Buyer
*/

Route::resource('buyers', BuyerController::class)->only(['index','show']);
Route::resource('buyers.products', BuyerProductController::class)->only(['index']);
Route::resource('buyers.transactions', BuyerTransactionController::class)->only(['index']);

Route::resource('category', CategoryController::class)->except(['create','edit']);

Route::resource('product', ProductController::class)->only(['index','show']);

Route::resource('seller', SellerController::class)->only(['index','show']);

Route::resource('transactions', TransactionController::class)->only(['index','show']);
Route::resource('transactions.categories', TransactionCategoryController::class)->only(['index','show']);
Route::resource('transactions.sellers', TransactionSellerController::class)->only(['index','show']);


Route::resource('users', UserController::class)->except(['create', 'edit']);
