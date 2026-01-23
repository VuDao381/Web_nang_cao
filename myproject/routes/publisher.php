<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublisherController;

Route::resource('publishers',PublisherController::class);   