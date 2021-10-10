<?php

use App\Models\Buyer;
use Illuminate\Http\Request;
use App\Http\Controllers\Buyer\BuyerController;
use App\Http\Controllers\Category\CategoryController;
use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\Seller\SellerController;
use App\Http\Controllers\Transaction\TransactionController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;

/*
| Buyer
*/

Route::resource('buyers', BuyerController::class)->only(['index','show']);

Route::resource('category', CategoryController::class)->except(['create','edit']);

Route::resource('product', ProductController::class)->only(['index','show']);

Route::resource('seller', SellerController::class)->only(['index','show']);

Route::resource('transaction', TransactionController::class)->only(['index','show']);

Route::resource('users', UserController::class)->except(['create', 'edit']);
