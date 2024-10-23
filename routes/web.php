<?php 

use Hammadj\HelpIcons\Http\Controllers\HelpController;
use Illuminate\Support\Facades\Route;

Route::get('/help', [HelpController::class, 'index']);
Route::get('/help/create', [HelpController::class, 'create']);
Route::post('/help/clear-cache/{formId}', [HelpController::class, 'clearCache']);
