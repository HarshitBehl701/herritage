<?php

use App\Http\Controllers\Client\PageController;
use Illuminate\Support\Facades\Route;

Route::get('/{segments?}', [PageController::class,'resolve'])->where('segments', '.*');