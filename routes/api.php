<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\admin\AdminController as AdminAdminController;
use App\Http\Controllers\Course\admin\CourseController as CourseAdminController;
use App\Http\Controllers\Department\admin\DepartmentController as DepartmentAdminController;
use App\Http\Controllers\Organization\admin\OrganizationController as AdminOrganizationController;
use App\Http\Controllers\Sessions\Admin\AdminSessionController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix("/admin")->group(function () {
    Route::post("/login", [AdminSessionController::class, "generateToken"]);
    Route::post("/logout", [AdminSessionController::class, "logout"]);
    Route::middleware('auth:sanctum')->prefix("/admins")->group(function () {
        Route::get("/", [AdminAdminController::class, "index"]);
        Route::get("/{id}", [AdminAdminController::class, "show"])->where('id', '[0-9]+');
    });
    Route::prefix("/orgs")->group(function () {
        Route::get("/", [AdminOrganizationController::class, "index"]);
    });
    Route::prefix("/courses")->group(function () {
        Route::get("/", [CourseAdminController::class, "index"]);
        Route::get("/{id}", [CourseAdminController::class, "show"])->where('id', '[0-9]+');
    });
    Route::prefix("/departments")->group(function () {
        Route::get("/", [DepartmentAdminController::class, "index"]);
        Route::get("/{id}", [DepartmentAdminController::class, "show"])->where('id', '[0-9]+');
    });
});
