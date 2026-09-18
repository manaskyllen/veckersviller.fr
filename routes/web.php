<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])
    ->name('home');

Route::get('/actualites', [PostController::class, 'index'])
    ->name('posts.index');

Route::get('/actualites/{post:slug}', [PostController::class, 'show'])
    ->name('posts.show');

Route::get('/documents', [DocumentController::class, 'index'])
    ->name('documents.index');

Route::get('/nous-contacter', [ContactController::class, 'index'])
    ->name('contact');

Route::post('/contact', [ContactController::class, 'store'])
    ->name('contact.store');

Route::view('/mentions-legales', 'pages.legal')
    ->name('legal');

Route::view('/donnees-personnelles', 'pages.privacy')
    ->name('privacy');

Route::view('/accessibilite', 'pages.accessibility')
    ->name('accessibility');
