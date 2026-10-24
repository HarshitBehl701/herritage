<?php

use App\Http\Controllers\Client\ApplicationController;
use App\Http\Controllers\Client\PageController;
use App\Http\Controllers\SendMail;
use Illuminate\Support\Facades\Route;

Route::controller(ApplicationController::class)->group(function () {
    // Optimize Website
    Route::get("/optimize", 'optimize');
    // Generate Sitemap
    Route::get("/sitemap/{version}", 'sitemap');
})->middleware(['auth']);

Route::post("/send-query", [SendMail::class, 'submit'])->name('submit-query');

Route::controller(PageController::class)->group(function () {
    // Session + CSRF enabled
    Route::get('/', 'resolve');
    Route::get('/{segments}', 'resolve')
        ->whereIn('segments', ['contact', 'contact-us']);
});