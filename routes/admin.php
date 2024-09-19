<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\PolicyController;
use App\Http\Controllers\McqController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\PolicyAssignController;



Route::get('/login',function(){
    return view('login.index');
});






Route::group(['middleware'=>'admin'],function(){

    Route::get('/admin/dashboard',[AdminController::class,'adminDashboard']);
    Route::get('/admin/logout',[AdminController::class,'adminLogout']);

    // EMPLOYEE ROUTES 
    Route::get('/admin/add-employee',[EmployeeController::class,'addEmployeePage']);
    Route::post('/admin/add-employee',[EmployeeController::class,'addEmployee']);
    Route::get('/admin/view-employee',[EmployeeController::class,'viewEmployee']);
    Route::get('/admin/delete-employee',[EmployeeController::class,'deleteEmployee']);
    Route::get('/admin/edit-employee/{id}',[EmployeeController::class,'editEmployeePage']);
    Route::post('/admin/edit-employee',[EmployeeController::class,'updateEmployee']);

    // POLICY ROUTES 
    Route::get('/admin/add-policy',[PolicyController::class,'addPolicyPage']);
    Route::post('/admin/add-policy',[PolicyController::class,'addPolicy']);
    Route::get('/admin/view-policy',[PolicyController::class,'viewPolicyPage']);
    Route::get('/admin/view-policy/{id}',[PolicyController::class,'viewPolicy']);
    Route::get('/admin/policy-visibility',[PolicyController::class,'policyVisibility']);
    Route::get('/admin/delete-policy',[PolicyController::class,'deletePolicy']);
    Route::get('/admin/edit-policy/{id}',[PolicyController::class,'editPolicyPage']);
    Route::post('/admin/update-policy',[PolicyController::class,'updatePolicy']);
    Route::get('/admin/edit-assigned-policy-to-employee/{id}',[PolicyController::class,'editAssignedPolicyToEmployeePage']);
Route::post('/admin/update-assign-policy',[PolicyController::class,'updateEmployeeAssignedPolicy']);
    // MCQ ROUTES 
     Route::get('/admin/add-mcq',[McqController::class,'addMcqPage']);
     Route::post('/admin/add-mcq',[McqController::class,'addMcq']);
     Route::get('/admin/view-mcq',[McqController::class,'viewMcq']);
     Route::get('/admin/show-question/{id}',[McqController::class,'showMcq']);
     Route::get('/admin/delete-mcq',[McqController::class,'deleteMcq']);
     Route::get('/admin/edit-mcq/{id}',[McqController::class,'editMcqPage']);
     Route::post('/admin/update-mcq',[McqController::class,'updateMcq']);


    // MARKS ROUTE 

    Route::get('/admin/set-mcq-marks',[McqController::class,'setMarks']);
    Route::post('/admin/set-marks',[McqController::class,'setPassMark']);
    Route::get('/admin/fetch-no-of-question',[McqController::class,'showNumberOfQuestion']);
    Route::get('/admin/view-mcq-marks',[McqController::class,'viewSetMarks']);
    Route::get('/admin/delete-passmark',[McqController::class,'deleteSetMark']);
    Route::get('/admin/edit-passmark/{id}',[McqController::class,'editPassMark']);
    Route::post('/admin/update-marks',[McqController::class,'updatePassMark']);
    
 
    // DEPARTMENT ROUTE 
    
    Route::get('/admin/add-department',[DepartmentController::class,'addDepartmentPage']);
    Route::get('/admin/view-department',[DepartmentController::class,'viewDepartment']);
    Route::post('/admin/add-department',[DepartmentController::class,'addDepartment']);
    Route::get('/admin/policy-send-department',[DepartmentController::class,'sendPolicyToGroup']);
    Route::post('/admin/assign-policy-to-group',[DepartmentController::class,'assignToGroup']);
    Route::get('/admin/delete-department',[DepartmentController::class,'deleteDepartment']);
    Route::get('/admin/view-assign-policy-department',[DepartmentController::class,'viewAssignedDepartment']);
    Route::get('/admin/delete-asign-department',[DepartmentController::class,'deleteAsignPolicyToDepartment']);
    Route::get('/admin/edit-department/{id}',[DepartmentController::class,'editDepartmentPage']);
    Route::post('/admin/edit-department',[DepartmentController::class,'updateDepartment']);
    Route::get('/admin/edit-asign-department/{id}',[DepartmentController::class,'editPolicyToDepartmentPage']);
    Route::post('/admin/update-assign-policy-to-group',[DepartmentController::class,'updatePolicyToGroup']);
    

    // ASSIGNMENT ROUTE 

    Route::get('/admin/assign-policy',[PolicyAssignController::class,'policyAssignPage']);
    Route::get('/admin/view-assign-policy',[PolicyAssignController::class,'viewAssignPolicy']);
    Route::get('/admin/fetch-employee',[PolicyAssignController::class,'fetchDepartmentEmployee']);
    Route::post('/admin/assign-policy',[PolicyAssignController::class,'assignPolicyToEmployee']);
    Route::get('/admin/delete-assign-policy-to-employee',[PolicyAssignController::class,'deletePolicyAssignToEmployee']);

    




  
    
    

    
});