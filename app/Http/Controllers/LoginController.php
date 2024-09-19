<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AdminModel;
use App\Models\EmployeeModel;
use Session; 


class LoginController extends Controller
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

    //   login

    public function login(Request $request){
      if(isset($request->adminOrEmployee)){
        self::adminLogin($request->email,$request->password);
      }else{
        self::employeeLogin($request->email,$request->password);
      }
    }

    // adminLogin
    public function adminLogin($email, $password)
    {
           $email_check = AdminModel::where('admin_email','=',$email)->first();
           if($email_check){
            if($email_check->admin_password==$password){
              session::put('admin',$email_check->admin_id);
              return self::swal(true,"Login Successfull","success");
            }else{
             return self::swal(false,"Invalid Password", "error");
            }
           }else{
            return self::swal(false,"Invalid Email Or Password", "error");
           }
    }

    // employeeLogin
    public function employeeLogin($email, $password)
    {
        $email_check = EmployeeModel::where('employee_email','=',$email)->first();
        if($email_check){
         if($email_check->employee_password==$password){
           session::put('employee',$email_check->employee_id);
           return self::swal(true,"Login Successfull","success");
         }else{
          return self::swal(false,"Invalid Password", "error");
         }
        }else{
         return self::swal(false,"Invalid Email Or Password", "error");
        }
       
    }
}
