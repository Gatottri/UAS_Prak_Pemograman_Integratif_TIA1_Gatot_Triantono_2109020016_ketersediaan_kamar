<?php

use App\Http\Controllers\PatientController;

Route::get('/', [PatientController::class, 'index']);
