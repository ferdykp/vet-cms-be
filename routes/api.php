<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Api\HomeController;
use App\Http\Controllers\Api\NavigationController;
use App\Http\Controllers\Api\PageController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\ResourceController;
use App\Http\Controllers\Api\SettingController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')
    ->middleware(['throttle:public-api', 'security.headers'])
    ->group(function () {
        Route::get('/home', [HomeController::class, 'index']);

        Route::get('/posts', [PostController::class, 'index']);
        Route::get('/posts/{slug}', [PostController::class, 'show']);

        Route::get('/categories', [CategoryController::class, 'index']);
        Route::get('/categories/{slug}', [CategoryController::class, 'show']);

        Route::get('/profile', [ProfileController::class, 'show']);

        Route::get('/resources', [ResourceController::class, 'index']);
        Route::get('/resources/{slug}', [ResourceController::class, 'show']);

        Route::get('/pages/{slug}', [PageController::class, 'show']);
        Route::get('/navigation', [NavigationController::class, 'index']);
        Route::get('/settings', [SettingController::class, 'index']);

        Route::post('/contact', [ContactController::class, 'store'])
            ->middleware('throttle:contact-form');
    });
