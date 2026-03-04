<?php

use App\Http\Controllers\SmtpController;
use Illuminate\Support\Facades\Route;

Route::post('/send-mail', [SmtpController::class, 'enviar']);
Route::get('/', [SmtpController::class, 'enviar2']);
