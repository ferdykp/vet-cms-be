<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CertificationController;
use App\Http\Controllers\Admin\ContactMessageController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EducationController;
use App\Http\Controllers\Admin\ExperienceController;
use App\Http\Controllers\Admin\MediaController;
use App\Http\Controllers\Admin\MembershipController;
use App\Http\Controllers\Admin\NavigationController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\PublicationController;
use App\Http\Controllers\Admin\ResourceController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SpeakingEventController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Auth\AdminAuthController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/admin');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware(['guest', 'security.headers'])->group(function () {
        Route::get('/login', [AdminAuthController::class, 'showLogin'])
            ->name('login');

        Route::post('/login', [AdminAuthController::class, 'login'])
            ->middleware('throttle:admin-login')
            ->name('login.attempt');
    });

    Route::middleware([
        'auth',
        'active',
        'role:admin',
        'nocache',
        'security.headers',
    ])->group(function () {
        Route::get('/', fn() => redirect()->route('admin.dashboard'));

        Route::post('/logout', [AdminAuthController::class, 'logout'])
            ->name('logout');

        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');

        // Journal / Posts
        Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
        Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
        Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
        Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
        Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.update');
        Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');

        Route::post('/posts/{post}/duplicate', [PostController::class, 'duplicate'])
            ->name('posts.duplicate');
        Route::patch('/posts/{post}/publish', [PostController::class, 'publish'])
            ->name('posts.publish');
        Route::patch('/posts/{post}/unpublish', [PostController::class, 'unpublish'])
            ->name('posts.unpublish');

        // Taxonomy
        Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
        Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
        Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
        Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');

        Route::get('/tags', [TagController::class, 'index'])->name('tags.index');
        Route::post('/tags', [TagController::class, 'store'])->name('tags.store');
        Route::put('/tags/{tag}', [TagController::class, 'update'])->name('tags.update');
        Route::delete('/tags/{tag}', [TagController::class, 'destroy'])->name('tags.destroy');

        // Media Library
        Route::get('/media', [MediaController::class, 'index'])->name('media.index');
        Route::post('/media', [MediaController::class, 'store'])
            ->middleware('throttle:media-upload')
            ->name('media.store');
        Route::put('/media/{media}', [MediaController::class, 'update'])->name('media.update');
        Route::delete('/media/{media}', [MediaController::class, 'destroy'])->name('media.destroy');

        // Professional Profile
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

        Route::post('/profile/educations', [EducationController::class, 'store'])->name('educations.store');
        Route::put('/profile/educations/{education}', [EducationController::class, 'update'])->name('educations.update');
        Route::delete('/profile/educations/{education}', [EducationController::class, 'destroy'])->name('educations.destroy');

        Route::post('/profile/experiences', [ExperienceController::class, 'store'])->name('experiences.store');
        Route::put('/profile/experiences/{experience}', [ExperienceController::class, 'update'])->name('experiences.update');
        Route::delete('/profile/experiences/{experience}', [ExperienceController::class, 'destroy'])->name('experiences.destroy');

        Route::post('/profile/certifications', [CertificationController::class, 'store'])->name('certifications.store');
        Route::put('/profile/certifications/{certification}', [CertificationController::class, 'update'])->name('certifications.update');
        Route::delete('/profile/certifications/{certification}', [CertificationController::class, 'destroy'])->name('certifications.destroy');

        Route::post('/profile/publications', [PublicationController::class, 'store'])->name('publications.store');
        Route::put('/profile/publications/{publication}', [PublicationController::class, 'update'])->name('publications.update');
        Route::delete('/profile/publications/{publication}', [PublicationController::class, 'destroy'])->name('publications.destroy');

        Route::post('/profile/speaking-events', [SpeakingEventController::class, 'store'])->name('speaking-events.store');
        Route::put('/profile/speaking-events/{speakingEvent}', [SpeakingEventController::class, 'update'])->name('speaking-events.update');
        Route::delete('/profile/speaking-events/{speakingEvent}', [SpeakingEventController::class, 'destroy'])->name('speaking-events.destroy');

        Route::post('/profile/memberships', [MembershipController::class, 'store'])->name('memberships.store');
        Route::put('/profile/memberships/{membership}', [MembershipController::class, 'update'])->name('memberships.update');
        Route::delete('/profile/memberships/{membership}', [MembershipController::class, 'destroy'])->name('memberships.destroy');

        // Resources
        Route::get('/resources', [ResourceController::class, 'index'])->name('resources.index');
        Route::get('/resources/create', [ResourceController::class, 'create'])->name('resources.create');
        Route::post('/resources', [ResourceController::class, 'store'])->name('resources.store');
        Route::get('/resources/{resource}/edit', [ResourceController::class, 'edit'])->name('resources.edit');
        Route::put('/resources/{resource}', [ResourceController::class, 'update'])->name('resources.update');
        Route::delete('/resources/{resource}', [ResourceController::class, 'destroy'])->name('resources.destroy');

        // Pages
        Route::get('/pages', [PageController::class, 'index'])->name('pages.index');
        Route::get('/pages/create', [PageController::class, 'create'])->name('pages.create');
        Route::post('/pages', [PageController::class, 'store'])->name('pages.store');
        Route::get('/pages/{page}/edit', [PageController::class, 'edit'])->name('pages.edit');
        Route::put('/pages/{page}', [PageController::class, 'update'])->name('pages.update');
        Route::delete('/pages/{page}', [PageController::class, 'destroy'])->name('pages.destroy');

        // Navigation
        Route::get('/navigation', [NavigationController::class, 'index'])->name('navigation.index');
        Route::post('/navigation', [NavigationController::class, 'store'])->name('navigation.store');
        Route::put('/navigation/{navigation}', [NavigationController::class, 'update'])->name('navigation.update');
        Route::patch('/navigation/reorder', [NavigationController::class, 'reorder'])->name('navigation.reorder');
        Route::delete('/navigation/{navigation}', [NavigationController::class, 'destroy'])->name('navigation.destroy');

        // Settings
        Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
        Route::put('/settings', [SettingController::class, 'update'])->name('settings.update');

        // Contact inbox
        Route::get('/messages', [ContactMessageController::class, 'index'])->name('messages.index');
        Route::get('/messages/{contactMessage}', [ContactMessageController::class, 'show'])->name('messages.show');
        Route::patch('/messages/{contactMessage}/unread', [ContactMessageController::class, 'markUnread'])->name('messages.unread');
        Route::delete('/messages/{contactMessage}', [ContactMessageController::class, 'destroy'])->name('messages.destroy');
    });
});
