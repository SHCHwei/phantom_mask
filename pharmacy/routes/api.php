<?php

use App\Http\Controllers\MaskController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PharmacyController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::post('/searchByOpeningHours', [PharmacyController::class, 'searchByOpeningHours']);
Route::post('/getMasks', [MaskController::class, 'getMasks']);
Route::post('/priceAndKind', [MaskController::class, 'priceAndKind']);
Route::post('/topBuyer', [UserController::class, 'topBuyer']);
Route::post('/statisticsByDate', [OrderController::class, 'statisticsByDate']);
Route::post('/keywordSearch', [PharmacyController::class, 'keywordSearch']);
Route::post('/buyMask', [OrderController::class, 'buyMask']);
