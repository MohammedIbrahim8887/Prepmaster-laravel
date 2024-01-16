<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\admin\AdminController as AdminAdminController;
use App\Http\Controllers\Course\admin\CourseController as CourseAdminController;
use App\Http\Controllers\Department\admin\DepartmentController as DepartmentAdminController;
use App\Http\Controllers\AdminRole\admin\AdminRoleController as AdminRoleAdminController;
use App\Http\Controllers\Permission\admin\PermissionController as PermissionAdminController;
use App\Http\Controllers\Promotion\admin\PromotionController as PromotionAdminController;
use App\Http\Controllers\Question\admin\QuestionController as QuestionAdminController;
use App\Http\Controllers\Role\admin\RoleController as RoleAdminController;
use App\Http\Controllers\Student\admin\StudentController as StudentAdminController;
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
        Route::get("/{id}", [AdminOrganizationController::class, "show"])->where('id', '[0-9]+');;
    });
    Route::prefix("/courses")->group(function () {
        Route::get("/", [CourseAdminController::class, "index"]);
        Route::get("/{id}", [CourseAdminController::class, "show"])->where('id', '[0-9]+');
    });
    Route::prefix("/departments")->group(function () {
        Route::get("/", [DepartmentAdminController::class, "index"]);
        Route::get("/{id}", [DepartmentAdminController::class, "show"])->where('id', '[0-9]+');
    });
    Route::prefix("/admin_role")->group(function () {
        Route::get("/", [AdminRoleAdminController::class, "index"]);
        Route::get("/{id}", [AdminRoleAdminController::class, "show"])->where('id', '[0-9]+');
    });
    Route::prefix("/permissions")->group(function () {
        Route::get("/", [PermissionAdminController::class, "index"]);
        Route::get("/{id}", [PermissionAdminController::class, "show"])->where('id', '[0-9]+');
    });
    Route::prefix("/promotions")->group(function () {
        Route::get("/", [PromotionAdminController::class, "index"]);
        Route::get("/{id}", [PromotionAdminController::class, "show"])->where('id', '[0-9]+');
    });
    Route::prefix("/questions")->group(function () {
        Route::get("/", [QuestionAdminController::class, "index"]);
        Route::get("/{id}", [QuestionAdminController::class, "show"])->where('id', '[0-9]+');
    });
    Route::prefix("/roles")->group(function () {
        Route::get("/", [RoleAdminController::class, "index"]);
        Route::get("/{id}", [RoleAdminController::class, "show"])->where('id', '[0-9]+');
    });
    Route::prefix("/students")->group(function () {
        Route::get("/", [StudentAdminController::class, "index"]);
        Route::get("/{id}", [StudentAdminController::class, "show"])->where('id', '[0-9]+');
    });
});
