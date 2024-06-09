<?php

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
use App\Http\Controllers\Api\StudentController;
use App\Http\Controllers\Api\SubjectController;
use App\Http\Controllers\Api\TeacherController;
use App\Http\Controllers\Api\BuildingController;
use App\Http\Controllers\Api\DocumentController;
use App\Http\Controllers\Api\GuardianController;
use App\Http\Controllers\Api\DepartmentController;
use App\Http\Controllers\Api\SchoolTypeController;

use App\Http\Controllers\Api\DesignationController;
use App\Http\Controllers\Api\FeeTemplateController;
use App\Http\Controllers\Api\SubjectGroupController;
use App\Http\Controllers\Api\AcademicClassController;
use App\Http\Controllers\Api\EducationBoardController;
use App\Http\Controllers\Api\AcademicSessionController;
use App\Http\Controllers\Api\AcademicStandardController;
use App\Http\Controllers\Api\ExpenseController;
use App\Http\Controllers\Api\ExpenseHeadController;
use App\Http\Controllers\Api\FeeItemController;
use App\Http\Controllers\Api\FeeItemMonthController;
use App\Http\Controllers\Api\FeeTemplateItemController;
use App\Http\Controllers\Api\JourneyTypeController;
use App\Http\Controllers\Api\MonthController;
use App\Http\Controllers\Api\PromotionController;
use App\Http\Controllers\Api\StudentSessionController;
use App\Http\Controllers\Api\StudentIdCardController;
use App\Http\Controllers\Api\TransportController;
use App\Http\Controllers\Api\TransportDocumentController;
use App\Http\Controllers\Api\TransportExpenseController;
use App\Http\Controllers\Api\TransportFeeController;
use App\Http\Controllers\Api\TransportInsuranceController;
use App\Http\Controllers\Api\TransportPickupDropController;
use App\Http\Controllers\Api\TransportPickupDropPointController;
use App\Http\Controllers\Api\TransportSlotController;
use App\Http\Controllers\Api\TransportTeamController;
use App\Http\Controllers\Api\TransportTypeController;
use App\Http\Controllers\Api\TransportUserController;
use App\Models\JourneyType;

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::middleware('auth:api')->group(function () {
    Route::get('user', [AuthController::class, 'user']);
    Route::post('logout', [AuthController::class, 'logout']);

    Route::apiResource('users', UserController::class);
    Route::apiResource('students', StudentController::class);
    Route::apiResource('student_id_cards',StudentIdCardController::class);
    Route::apiResource('guardians', GuardianController::class);
    Route::apiResource('teachers', TeacherController::class);
    Route::post('/documents', [DocumentController::class, 'store']);
    Route::put('/documents/{id}', [DocumentController::class, 'update']);
    Route::delete('/documents/{id}', [DocumentController::class, 'delete']);
    Route::get('/documents/user', [DocumentController::class, 'userDocuments']);
    Route::get('/documents/{id}', [DocumentController::class, 'show']);
    Route::get('/documents/file/{id}', [DocumentController::class, 'getFile']);
    Route::post('/documents/folder', [DocumentController::class, 'imageToFolder']);

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
    Route::apiResource('subject_groups', SubjectGroupController::class);
    Route::apiResource('subjects', SubjectController::class);

    Route::apiResource('fee_heads', FeeHeadController::class);
    Route::apiResource('fee_templates', FeeTemplateController::class);
    Route::post('fee_templates/clone/{id}', [FeeTemplateController::class,'clone']);
    Route::apiResource('fee_template_items', FeeTemplateItemController::class);
    Route::apiResource('fees', FeeController::class);
    Route::get('fees_by_student_session/{student_session}',[ FeeController::class,'FeesByStudentSession']);


    Route::apiResource('expenses', ExpenseController::class);
    Route::apiResource('expense_heads', ExpenseHeadController::class);


    Route::get('student_sessions_by_student_id/{student_id}', [StudentSessionController::class,'StudentSessionsByStudentId']);
    Route::get('student_sessions', [StudentSessionController::class,'index']);
    Route::get('student_sessions/{student_session}', [StudentSessionController::class,'show']);
    Route::post('student_sessions', [StudentSessionController::class,'store']);
    Route::get('student_sessions_generate_roll_no', [StudentSessionController::class,'generate_roll_no']);

    Route::post('student_sessions/enrollment', [StudentSessionController::class,'enrollment']);
    Route::put('student_sessions/enrollment/{id}', [StudentSessionController::class,'enrollmentUpdate']);
    Route::apiResource('promotions',PromotionController::class);
    Route::apiResource('transports',TransportController::class);
    Route::apiResource('transport_types',TransportTypeController::class);
    Route::apiResource('transport_documents',TransportDocumentController::class);
    Route::apiResource('transport_insurances',TransportInsuranceController::class);
    Route::apiResource('transport_users',TransportUserController::class);
    Route::apiResource('transport_teams',TransportTeamController::class);
    Route::apiResource('transport_fees',TransportFeeController::class);
    // Route::apiResource('transport_fee_items',TransportFeeItemController::class);
    // Route::apiResource('transport_fee_item_months',TransportFeeItemMonthController::class);
    Route::apiResource('transport_expenses',TransportExpenseController::class);
    Route::apiResource('transport_slots',TransportSlotController::class);
    Route::apiResource('transport_pickup_drop_points',TransportPickupDropPointController::class);
    Route::apiResource('transport_pickup_drops',TransportPickupDropController::class);
    Route::apiResource('journey_types',JourneyTypeController::class);



});
Route::get('/months', [MonthController::class, 'index']);
Route::apiResource('fee_items', FeeItemController::class);
Route::apiResource('fee_item_months', FeeItemMonthController::class);
Route::get('/address_type', [EnumController::class, 'address_type']);
Route::get('/gender', [EnumController::class, 'gender']);
Route::get('/nationality', [EnumController::class, 'nationality']);
Route::get('/language', [EnumController::class, 'language']);
Route::get('/religion', [EnumController::class, 'religion']);
Route::get('/caste', [EnumController::class, 'caste']);
Route::get('/guardian_type', [EnumController::class, 'guardian_type']);
Route::get('/subject_type', [EnumController::class, 'subject_type']);
Route::get('/room_type', [EnumController::class, 'room_type']);
Route::get('/user_status', [EnumController::class, 'user_status']);
Route::get('/user_type', [EnumController::class, 'user_type']);
