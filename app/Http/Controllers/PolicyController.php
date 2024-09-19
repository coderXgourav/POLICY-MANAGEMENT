<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AdminModel;
use App\Models\PolicyModel;
use App\Models\PolicyAssignToEmployeeModel;
use App\Models\DepartmentModel; 

use DB;



class PolicyController extends Controller
{
      // swal
      public function swal($status,$title,$icon){
        $response = [
            'status'=>$status,
            'title'=>$title,
            'icon'=>$icon,
        ];
        echo json_encode($response);
      }

      //    getAdminDetails 
  public function adminDetails()
  {
    $admin_id = session('admin');
    $admin_data = AdminModel::find($admin_id);
    return $admin_data;
  }
  

//   employeeLogout 
  public function addPolicyPage()
  {

    $admin_data = self::adminDetails();
    return view('admin.dashboard.policy.addPolicy',['admin'=>$admin_data]);
    // return view('admin.dashboard.policy.addPolicy');

  }

    //   addPolicy
    public function addPolicy(Request $request)
    {
        $policy_title = $request->policy_title;
        $policy_file = $request->policy_file;
        
        $exe = $policy_file->getClientOriginalExtension();
        $file_name = time().'.'.$exe;
        $move = $policy_file->move('policy_files',$file_name);

        $checkTitle = PolicyModel::where('policy_title',$policy_title)->first(); 
        if($checkTitle){
           return self::swal(false,'Policy Already Exist' ,'error');
        }
        $policyData = new PolicyModel;
        $policyData->policy_title = $policy_title;
        $policyData->policy_file = $file_name;
        $policyData->save();
        return self::swal(true,'Successfull' ,'success');
    }

    // viewPolicyPage 
    public function viewPolicyPage()
    {
        $admin_data = self::adminDetails();
        $policy_files = PolicyModel::orderBy('policy_id','DESC')->paginate(10);
        return view('admin.dashboard.policy.viewPolicy',['admin'=>$admin_data,'policy'=>$policy_files]);
        // return view('admin.dashboard.policy.viewPolicy',['policy'=>$policy_files]);
    }

    // viewPolicy
    public function viewPolicy($id)
    {
        $admin_data = self::adminDetails();
        $policy = PolicyModel::find($id);
       
        return view('admin.dashboard.policy.show_policy',['admin'=>$admin_data,'policy'=>$policy]);
        // return view('admin.dashboard.policy.show_policy',['policy'=>$policy]);

    }

       //    policyVisibility
       public function policyVisibility()
       {
        $admin_data = self::adminDetails();
        
        $policy = DB::table('policy')
        ->join('policy_assign_to_employee','policy_assign_to_employee.main_policy_id','=','policy.policy_id')
        ->join('employee','employee.employee_id','=','policy_assign_to_employee.main_employee_id')
        ->join('department','department.department_id','=','policy_assign_to_employee.main_department_id')
        ->orderBy('policy_assign_to_employee.policy_assign_to_employee_id','DESC')
        ->paginate(10);
        return view('admin.dashboard.policy.reports',['admin'=>$admin_data,'policy'=>$policy]);
           
       }

      //  deletePolicy
      public function deletePolicy(Request $request)
      {
        $delete = PolicyModel::find($request->id)->delete();
        return self::swal(true,'Deleted','success');
        
      }

      // editPolicyPage

      public function editPolicyPage($id)
      {
        $admin_data = self::adminDetails();
        $policy = PolicyModel::find($id);
        return view('admin.dashboard.policy.edit_policy',['admin'=>$admin_data,'policy'=>$policy]);

      }
 
          //   updatePolicy
    public function updatePolicy(Request $request)
    {
        $policy_title = $request->policy_title;
        $policy_file = $request->policy_file;
        $id = $request->id;

        if($policy_file==""){
         $file = 0;
        }else{
          $exe = $policy_file->getClientOriginalExtension();
          $file_name = time().'.'.$exe;
          $move = $policy_file->move('policy_files',$file_name);
          $file = 1;
        }
        

        $checkTitle = PolicyModel::where('policy_title',$policy_title)->count(); 
        if($checkTitle>1){
           return self::swal(false,'Policy Already Exist' ,'warning');
        }
        $policyData = PolicyModel::find($id);
        $policyData->policy_title = $policy_title;

        if($file>0){
          $policyData->policy_file = $file_name;
        }
        $policyData->save();
        return self::swal(true,'Updated' ,'success');

      
      }

      // editAssignedPolicyToEmployeePage
      public function editAssignedPolicyToEmployeePage($id)
      {

        $admin_data = self::adminDetails();
      
        $data = DB::table('policy_assign_to_employee')
    ->join('employee', 'employee.employee_id', '=', 'policy_assign_to_employee.main_employee_id')
    ->join('policy', 'policy.policy_id', '=', 'policy_assign_to_employee.main_policy_id')
    ->join('department', 'department.department_id', '=', 'policy_assign_to_employee.main_department_id') // Fixed here
    ->where('policy_assign_to_employee.policy_assign_to_employee_id', $id)
    ->first();

    $department = DepartmentModel::orderBy('department_id','DESC')->get();
    $policy = PolicyModel::orderBy('policy_id','DESC')->get();
    return view('admin.dashboard.policy.edit_assigned_policy_to_employee',['admin'=>$admin_data,'data'=>$data,'department'=>$department,'policy'=>$policy]);

      }

      // updateEmployeeAssignedPolicy
      public function updateEmployeeAssignedPolicy(Request $request)
      {

        $check = PolicyAssignToEmployeeModel::where('main_employee_id',$request->employee)
        ->where('main_department_id',$request->department)
        ->where('main_policy_id',$request->policy)
        ->count();
       if($check>0){
        return self::swal(false,'Policy Already Assigned','warning');
       }

        $update = PolicyAssignToEmployeeModel::find($request->id);
        $update->main_department_id = $request->department;
        $update->main_employee_id = $request->employee;
        $update->main_policy_id = $request->policy;
        $update->save();
        

        return self::swal(true,'Updated','success');

      }



      // END CLASS 


}