<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\admin\AdminController as AdminAdminController;
use App\Http\Controllers\Admin\user\AdminController as UserAdminController;
use App\Http\Controllers\Organization\admin\OrganizationController as AdminOrganizationController;
use App\Http\Controllers\Organization\user\OrganizationController as UserOrganizationController;
use App\Http\Controllers\Student\user\StudentController as UserStudentController;
use App\Http\Controllers\Department\admin\DepartmentController as AdminDepartmentController;
use App\Http\Controllers\Department\user\DepartmentController as UserDepartmentController;
use App\Http\Controllers\Course\admin\CourseController as AdminCourseController;
use App\Http\Controllers\Course\user\CourseController as UserCourseController;

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

Route::middleware('auth:sanctum')->group(function () {
    // Admin routes
    Route::prefix('admin/admin')->middleware('auth:sanctum')->group(function () {
        Route::get('get_admin/{id}', [AdminAdminController::class, 'getAdmin']);
        Route::resource('get_admins', AdminAdminController::class);
        Route::delete('delete_admin', [AdminAdminController::class, 'deleteAdmin']);
        Route::post('update_admin', [AdminAdminController::class, 'updateAdmin']);
        Route::patch('change_password', [AdminAdminController::class, 'changePassword']);
    });

    // User routes
    Route::prefix('admin/user')->middleware('auth:sanctum')->group(function () {
        Route::get('get_admin/{id}', [UserAdminController::class, 'getAdmin']);
        Route::delete('delete_admin', [UserAdminController::class, 'deleteAdmin']);
        Route::post('update_admin', [UserAdminController::class, 'updateAdmin']);
        Route::patch('change_password', [UserAdminController::class, 'changePassword']);
    });

    // Admin routes
    Route::prefix('organization/admin')->middleware('auth:sanctum')->group(function () {
        Route::get('get_org/{id}', [AdminOrganizationController::class, 'getOrg']);
        Route::resource('get_orgs', AdminOrganizationController::class);
        Route::delete('delete_org', [AdminOrganizationController::class, 'deleteOrg']);
        Route::post('update_org', [AdminOrganizationController::class, 'updateOrg']);
        Route::patch('change_password', [AdminOrganizationController::class, 'changePassword']);
    });

    // User routes
    Route::prefix('organization/user')->middleware('auth:sanctum')->group(function () {
        Route::get('get_org/{id}', [UserOrganizationController::class, 'getOrg']);
        Route::delete('delete_org', [UserOrganizationController::class, 'deleteOrg']);
        Route::post('update_org', [UserOrganizationController::class, 'updateOrg']);
        Route::patch('change_password', [UserOrganizationController::class, 'changePassword']);
    });

    // User routes
    Route::prefix('student/user')->middleware('auth:sanctum')->group(function () {
        Route::get('get_student/{id}', [UserStudentController::class, 'getStudent']);
        Route::delete('delete_student', [UserStudentController::class, 'deleteStudent']);
        Route::post('update_student', [UserStudentController::class, 'updateStudent']);
        Route::patch('change_password', [UserStudentController::class, 'changePassword']);
    });
    // Admin routes
    Route::prefix('department/admin')->middleware('auth:sanctum')->group(function () {
        Route::get('get_department/{id}', [AdminDepartmentController::class, 'getDepartment']);
        Route::resource('get_departments', AdminDepartmentController::class);
        Route::delete('delete_department', [AdminDepartmentController::class, 'deleteDepartment']);
        Route::post('update_department', [AdminDepartmentController::class, 'updateDepartment']);
    });

    // User routes
    Route::prefix('department/user')->middleware('auth:sanctum')->group(function () {
        Route::get('get_department/{id}', [UserDepartmentController::class, 'getDepartment']);
        Route::resource('get_departments', UserDepartmentController::class);
    });
    // Admin routes
    Route::prefix('course/admin')->middleware('auth:sanctum')->group(function () {
        Route::get('get_course/{id}', [AdminCourseController::class, 'getCourse']);
        Route::resource('get_courses', AdminCourseController::class);
        Route::delete('delete_course', [AdminCourseController::class, 'deleteCourse']);
        Route::post('update_course', [AdminCourseController::class, 'updateCourse']);
    });

    // User routes
    Route::prefix('course/user')->middleware('auth:sanctum')->group(function () {
        Route::get('get_course/{id}', [UserCourseController::class, 'getCourse']);
        Route::resource('get_courses', UserCourseController::class);
    });
});
