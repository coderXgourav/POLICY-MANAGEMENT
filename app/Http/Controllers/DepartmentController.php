<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\DepartmentModel;
use App\Models\AdminModel;
use App\Models\PolicyModel;
use App\Models\PolicyAssignToGroupModel;
use DB;


class DepartmentController extends Controller
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
          

    // adminDetails
    public function adminDetails()
  {
    $admin_id = session('admin');
    $admin_data = AdminModel::find($admin_id);
    return $admin_data;
  }


    // addDepartmentPage
    public function addDepartmentPage()
    {
        $admin_data = self::adminDetails();
        return view('admin.dashboard.department.add_department',['admin'=>$admin_data]);


    }

    // addDepartment
    public function addDepartment(Request $request)
    {
        $department_name = $request->department_name;
        $check = DepartmentModel::where('department_name',$department_name)->count();
        if($check>0){
            return self::swal(false,'Department Already Exist','warning');
        }else{
            $department_save = new DepartmentModel;
            $department_save->department_name = $department_name;
            $department_save ->save();
            return self::swal(true,'Successfull','success');
        }

 
    }

    // viewDepartment 
    public function viewDepartment()
    {
        $admin_data = self::adminDetails();
        $departments = DepartmentModel::orderBy('department_id','DESC')->paginate(10);
        return view('admin.dashboard.department.view_department',['admin'=>$admin_data,'department'=>$departments]);

    }

    // sendPolicyToGroup
    public function sendPolicyToGroup()
    {
        $admin_data = self::adminDetails();
        $departments = DepartmentModel::orderBy('department_id','DESC')->get();
        $policy = PolicyModel::orderBy('policy_id','DESC')->get();

        return view('admin.dashboard.department.policy_assign_department',['admin'=>$admin_data,'department'=>$departments,'policy'=>$policy]);

    }

    // assignToGroup 
    public function assignToGroup(Request $request)
    {

        $policy = $request->policy_ids;

        foreach ($policy as $key => $value) {
            $check = PolicyAssignToGroupModel::where([
                ['main_department_id','=',$request->department],
                ['main_policy_id','=',$value]
            ])->first();
        }

        if($check){
            return self::swal(false,'Policy Already Assigned','warning');
        }
        foreach ($policy as $key => $value) {
            $policy_send = new PolicyAssignToGroupModel;
            $policy_send->main_department_id = $request->department;
            $policy_send->main_policy_id = $value;
            $policy_send->save();
        }
   
        return self::swal(true, "Successfull",'success');

    }

    // deleteDepartment

    public function deleteDepartment(Request $request)
    {
        $delete = DepartmentModel::find($request->id)->delete();
        return self::swal(true,'Deleted','success');
      
    }

    // viewAssignedDepartment
    public function viewAssignedDepartment()
    {
        $admin_data = self::adminDetails();

        $data = DB::table('policy_assign_to_group')
        ->join('department','department.department_id','=','policy_assign_to_group.main_department_id')
        ->join('policy','policy.policy_id','=','policy_assign_to_group.main_policy_id')
        ->orderBy('policy_assign_to_group_id','DESC')
        ->paginate(10);

        return view('admin.dashboard.department.view_assigned_policy_to_department',['admin'=>$admin_data,'data'=>$data]);

    }

    // deleteDepartment
    public function deleteAsignPolicyToDepartment(Request $request)
    {
        $delete = PolicyAssignToGroupModel::find($request->id)->delete();
        return self::swal(true,'Deleted','success');
        
    }

    // editDepartmentPage

    public function editDepartmentPage($id)
    {
      $department = DepartmentModel::find($id);
      $admin_data = self::adminDetails();
      
      if($department){
        return view('admin.dashboard.department.edit_department',['admin'=>$admin_data,'department'=>$department]);
      }
    }
    
    // updateDepartment

    public function updateDepartment(Request $request)
    {
        $department = DepartmentModel::find($request->department_id);
        $department->department_name = $request->department_name;
        $department->save();
        return self::swal(true,'Updated','success');
        
    }


    // editPolicyToDepartmentPage

  public function editPolicyToDepartmentPage($id)
  {
    $data = PolicyAssignToGroupModel::find($id);

  
    $admin_data = self::adminDetails();
    $departments = DepartmentModel::orderBy('department_id','DESC')->get();
    $policy = PolicyModel::orderBy('policy_id','DESC')->get();
    return view('admin.dashboard.department.edit_policy_assign_to_group',['admin'=>$admin_data,'data'=>$data,'department'=>$departments,'policy'=>$policy]);

  }

//   updatePolicyToGroup

        public function updatePolicyToGroup(Request $request)
        {
            $update = PolicyAssignToGroupModel::find($request->id);
            $update->main_department_id = $request->department;
            $update->main_policy_id = $request->policy;
            $update->save();
            return self::swal(true,'Updated','success');
        }


    // END CLASS 
    
}