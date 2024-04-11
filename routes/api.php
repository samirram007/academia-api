<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\FeeController;
use App\Http\Controllers\Api\EnumController;
use App\Http\Controllers\Api\RoomController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\FloorController;
use App\Http\Controllers\Api\CampusController;
use App\Http\Controllers\Api\SchoolController;
use App\Http\Controllers\Api\AddressController;
use App\Http\Controllers\Api\FeeHeadController;
use App\Http\Controllers\Api\SectionController;
use App\Http\Controllers\Api\SubjectController;
use App\Http\Controllers\Api\BuildingController;
use App\Http\Controllers\Api\DocumentController;
use App\Http\Controllers\Api\DepartmentController;
use App\Http\Controllers\Api\SchoolTypeController;
use App\Http\Controllers\Api\DesignationController;
use App\Http\Controllers\Api\FeeTemplateController;
use App\Http\Controllers\Api\AcademicClassController;
use App\Http\Controllers\Api\EducationBoardController;
use App\Http\Controllers\Api\AcademicSessionController;
use App\Http\Controllers\Api\AcademicStandardController;
use App\Http\Controllers\Api\FeeTemplateDetailsController;

Route::post('register',[AuthController::class,'register']);
Route::post('login',[AuthController::class,'login']);
Route::middleware('auth:api')->group(function(){
    Route::get('user',[AuthController::class,'user']);
    Route::post('logout',[AuthController::class,'logout']);

Route::apiResource('users', UserController::class);
Route::post('/documents', [DocumentController::class, 'store']);
Route::put('/documents/{id}', [DocumentController::class, 'update']);
Route::delete('/documents/{id}', [DocumentController::class, 'delete']);
Route::get('/documents/user', [DocumentController::class, 'userDocuments']);
Route::get('/documents/{id}', [DocumentController::class, 'show']);
Route::get('/documents/file/{id}', [DocumentController::class, 'getFile']);
Route::post('/documents/folder',[DocumentController::class, 'imageToFolder']);

Route::apiResource('school_types', SchoolTypeController::class);
Route::apiResource('schools', SchoolController::class);
Route::apiResource('campuses', CampusController::class);
Route::apiResource('buildings', BuildingController::class);
Route::apiResource('floors', FloorController::class);

Route::apiResource('rooms', RoomController::class);
Route::apiResource('academic_classes', AcademicClassController::class);
Route::apiResource('academic_standards', AcademicStandardController::class);
Route::apiResource('academic_sessions', AcademicSessionController::class);
Route::apiResource('addresses', AddressController::class);
Route::apiResource('departments', DepartmentController::class);
Route::apiResource('designations', DesignationController::class);
Route::apiResource('education_boards', EducationBoardController::class);
Route::apiResource('sections', SectionController::class);
Route::apiResource('subjects', SubjectController::class);

Route::apiResource('fee_heads', FeeHeadController::class);
Route::apiResource('fee_templates', FeeTemplateController::class);
Route::apiResource('fee_template_details', FeeTemplateDetailsController::class);
Route::apiResource('fees', FeeController::class);

});

Route::get('/address_type', [EnumController::class, 'address_type']);
Route::get('/gender', [EnumController::class, 'gender']);
Route::get('/nationality', [EnumController::class, 'nationality']);
Route::get('/language', [EnumController::class, 'language']);
Route::get('/religion', [EnumController::class, 'religion']);
Route::get('/caste', [EnumController::class, 'caste']);
Route::get('/guardian_type', [EnumController::class, 'guardian_type']);
Route::get('/room_type', [EnumController::class, 'room_type']);
Route::get('/user_status', [EnumController::class, 'user_status']);
Route::get('/user_type', [EnumController::class, 'user_type']);
