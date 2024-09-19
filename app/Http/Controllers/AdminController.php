<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AdminModel;
use App\Models\PolicyModel;
use App\Models\EmployeeModel;
use App\Models\PolicyAssignToEmployeeModel;

use Session; 

class AdminController extends Controller
{

  
//    getAdminDetails 
  public function adminDetails()
  {
    $admin_id = session('admin');
    $admin_data = AdminModel::find($admin_id);
    return $admin_data;
  }
    // adminDashboard 
    public function adminDashboard()
    {
        $admin_id = session('admin');
        $admin_data = AdminModel::find($admin_id);
  
        $total_policy = PolicyModel::count();
        $total_employee = EmployeeModel::count();
        
        $total_assign = PolicyAssignToEmployeeModel::count();
        $total_done_policy = PolicyAssignToEmployeeModel::where('status',2)->count();
        
        return view('admin.dashboard.index',['admin'=>$admin_data,'total_policy'=>$total_policy,'total_employee'=>$total_employee,'total_assign'=>$total_assign,'done_policy'=>$total_done_policy]);
    }

    // adminLogout 
    public function adminLogout(Request $request)
    {
        $request->session()->forget('admin');
        return redirect('/login');
    }



    // END OF CLASS 
}
