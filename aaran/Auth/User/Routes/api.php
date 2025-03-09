<?php

use Illuminate\Support\Facades\Route;

//Core
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::apiResource('users', UserController::class);
    Route::apiResource('roles', RoleController::class);
    Route::apiResource('permissions', PermissionController::class);
});
