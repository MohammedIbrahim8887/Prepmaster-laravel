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
use App\Http\Controllers\Admin\user\AdminController as AdminUserController;
use App\Http\Controllers\Course\user\CourseController as CourseUserController;
use App\Http\Controllers\Department\user\DepartmentController as DepartmentUserController;
use App\Http\Controllers\AdminRole\user\AdminRoleController as AdminRoleUserController;
use App\Http\Controllers\Permission\user\PermissionController as PermissionUserController;
use App\Http\Controllers\Promotion\user\PromotionController as PromotionUserController;
use App\Http\Controllers\Question\user\QuestionController as QuestionUserController;
use App\Http\Controllers\Role\user\RoleController as RoleUserController;
use App\Http\Controllers\Student\user\StudentController as StudentUserController;
use App\Http\Controllers\Organization\user\OrganizationController as UserOrganizationController;


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
        Route::post("/", [AdminOrganizationController::class, "store"]);
        Route::get("/{id}", [AdminOrganizationController::class, "show"])->where('id', '[0-9]+');;
    });
    Route::middleware('auth:sanctum')->prefix("/courses")->group(function () {
        Route::get("/", [CourseAdminController::class, "index"]);
        Route::get("/{id}", [CourseAdminController::class, "show"])->where('id', '[0-9]+');
    });
    Route::prefix("/departments")->group(function () {
        Route::get("/", [DepartmentAdminController::class, "index"]);
        Route::post("/", [DepartmentAdminController::class, "store"]);
        Route::get("/{id}", [DepartmentAdminController::class, "show"])->where('id', '[0-9]+');
    });
    Route::prefix("/admin_role")->group(function () {
        Route::get("/", [AdminRoleAdminController::class, "index"]);
        Route::get("/{id}", [AdminRoleAdminController::class, "show"])->where('id', '[0-9]+');
    });
    Route::prefix("/permissions")->group(function () {
        Route::get("/", [PermissionAdminController::class, "index"]);
        Route::post("/", [PermissionAdminController::class, "store"]);
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
        Route::post("/", [RoleAdminController::class, "store"]);
        Route::get("/{id}", [RoleAdminController::class, "show"])->where('id', '[0-9]+');
    });
    Route::prefix("/students")->group(function () {
        Route::get("/", [StudentAdminController::class, "index"]);
        Route::post("/", [StudentAdminController::class, "store"]);
        Route::get("/{id}", [StudentAdminController::class, "show"])->where('id', '[0-9]+');
    });
});
Route::prefix("/user")->group(function () {
    Route::middleware('auth:sanctum')->prefix("/admins")->group(function () {
        Route::get("/", [AdminUserController::class, "index"]);
        Route::get("/{id}", [AdminUserController::class, "show"])->where('id', '[0-9]+');
    });
    Route::prefix("/orgs")->group(function () {
        Route::get("/", [UserOrganizationController::class, "index"]);
        Route::get("/{id}", [UserOrganizationController::class, "show"])->where('id', '[0-9]+');;
    });
    Route::prefix("/courses")->group(function () {
        Route::get("/", [CourseUserController::class, "index"]);
        Route::get("/{id}", [CourseUserController::class, "show"])->where('id', '[0-9]+');
    });
    Route::prefix("/departments")->group(function () {
        Route::get("/", [DepartmentUserController::class, "index"]);
        Route::get("/{id}", [DepartmentUserController::class, "show"])->where('id', '[0-9]+');
    });
    Route::prefix("/admin_role")->group(function () {
        Route::get("/", [AdminRoleUserController::class, "index"]);
        Route::get("/{id}", [AdminRoleUserController::class, "show"])->where('id', '[0-9]+');
    });
    Route::prefix("/permissions")->group(function () {
        Route::get("/", [PermissionUserController::class, "index"]);
        Route::get("/{id}", [PermissionUserController::class, "show"])->where('id', '[0-9]+');
    });
    Route::prefix("/promotions")->group(function () {
        Route::get("/", [PromotionUserController::class, "index"]);
        Route::get("/{id}", [PromotionUserController::class, "show"])->where('id', '[0-9]+');
    });
    Route::prefix("/questions")->group(function () {
        Route::get("/", [QuestionUserController::class, "index"]);
        Route::get("/{id}", [QuestionUserController::class, "show"])->where('id', '[0-9]+');
    });
    Route::prefix("/roles")->group(function () {
        Route::get("/", [RoleUserController::class, "index"]);
        Route::get("/{id}", [RoleUserController::class, "show"])->where('id', '[0-9]+');
    });
    Route::prefix("/students")->group(function () {
        Route::get("/", [StudentUserController::class, "index"]);
        Route::get("/{id}", [StudentUserController::class, "show"])->where('id', '[0-9]+');
    });
});
