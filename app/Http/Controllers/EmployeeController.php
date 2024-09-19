<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AdminModel; 
use App\Models\EmployeeModel; 
use App\Models\DepartmentModel; 
use App\Models\PolicyModel; 
use App\Models\McqResultModel;
use App\Models\DummyMarkModel;
use App\Models\PassMarkModel;
use App\Models\SignatureModel;
use App\Models\McqModel; 
use App\Models\PolicyAssignToEmployeeModel; 
use Session; 
use DB;
use Mail;
use App\Mail\policyAssignEmail;

class EmployeeController extends Controller
{
    //

    //    getAdminDetails 
  public function adminDetails()
  {
    $admin_id = session('admin');
    $admin_data = AdminModel::find($admin_id);
    return $admin_data;
  }

        // swal

        public function swal($status,$title,$icon){
            $response = [
                'status'=>$status,
                'title'=>$title,
                'icon'=>$icon,
            ];
            echo json_encode($response);
          }

    public function employeeDetails()
    {
      $employee_id = session('employee');
      $employee_data = EmployeeModel::find($employee_id);
      return $employee_data;
    }

        // addEmployeePage 
        public function addEmployeePage()
        {
            $admin_data = self::adminDetails();
            $departments = DepartmentModel::orderBy('department_id','DESC')->get();
            return view('admin.dashboard.employee.addEmployee',['admin'=>$admin_data,'departments'=>$departments]);
        }
    
        // addEmployee 
        public function addEmployee(Request $request)
        {
                $name= $request->name;
                 $email = $request->email;
                 $number = $request->number;
                 $password = $request->password;
                 $empType = $request->empType;

                if(EmployeeModel::where('employee_number',$number)->first()){
                    return self::swal(false,"Number Already Registered","error");
                }
                if(EmployeeModel::where('employee_email',$email)->first()){
                    return self::swal(false,"Email Already Registered","error");
                }
           
                 $employee = new EmployeeModel;
                 $employee->employee_name = $name;
                 $employee->employee_email = $email;
                 $employee->employee_number = $number;
                 $employee->employee_password = $password ;
                 $employee->department_id = $empType ;
                 $save = $employee->save();
                 if($save){
                    return self::swal(true,"Successfull","success");
                 }else{
                    return self::swal(false,"Sorry , Technical Issue..","error");
                 }
                 
    
        }

        // viewEmployee 
        public function viewEmployee()
        {
            $admin_data = self::adminDetails();
            $employees = DB::table('employee')
            ->join('department','department.department_id','=','employee.department_id')
            ->orderBy('employee_id','DESC')
            ->paginate(10);

            return view('admin.dashboard.employee.viewEmployee',['admin'=>$admin_data,'employees'=>$employees]);
            
        }


        // employeeDashboard
        public function employeeDashboard()
        {
            $employee_details = DB::table('employee')
            ->join('department','department.department_id','=','department.department_id')
            ->where('employee.employee_id',session('employee'))
            ->first();
        
            return view('employeePanel.dashboard.index',['employee'=>$employee_details]);
        }

        // employeeLogout

        public function employeeLogout(Request $request)
        {
            $request->session()->forget('employee');
            return redirect('/login');
        }

        // deleteEmployee
        public function deleteEmployee(Request $request)
        {
            $delete = EmployeeModel::find($request->id)->delete();
            return self::swal(true,'Deleted','success');


        }

        // viewAssignedPolicy
        public function viewAssignedPolicy()
        {

            $employee_data = self::employeeDetails();

            $group_policy = DB::table('policy_assign_to_employee')
            ->join('department','department.department_id','=','policy_assign_to_employee.main_department_id')
            ->join('policy','policy.policy_id','=','policy_assign_to_employee.main_policy_id')
            ->join('employee','employee.employee_id','=','policy_assign_to_employee.main_employee_id')
            ->where('employee.employee_id',session('employee'))
            ->orderBy('policy_assign_to_employee.policy_assign_to_employee_id','DESC')
            ->paginate(10);
          
            return view('employeePanel.dashboard.policy.viewPolicy',['employee'=>$employee_data,'policy'=>$group_policy]);
        }

        // viewPolicyByEmployee
        public function viewPolicyByEmployee($id)
        {
            $employee_data = self::employeeDetails();
            $policy = PolicyModel::find($id);

            $haveMcq = DB::table('policy')
            ->join('mcq','mcq.main_policy_id','=','policy.policy_id')
            ->where('policy.policy_id',$id)
            ->count();
           

            if($haveMcq>0){
                
                $status = PolicyAssignToEmployeeModel::where('main_policy_id',$id)
                ->where('main_employee_id',session('employee'))
                ->first();

                if($status->status==0){
                    $status->status=1;
                }
                
                $status->save();
                
                $passMarkDetails = DB::table('policy')
                ->join('pass_mark','pass_mark.policy_main_id','=','policy.policy_id')
                ->where('pass_mark.policy_main_id',$id)
                ->first();

                if($passMarkDetails){
                    $pass_mark = $passMarkDetails->pass_mark;

                        $user_mark = McqResultModel::where('main_policy_id',$id)
                        ->where('main_employee_id',session('employee'))
                        ->orderBy('marks','DESC')
                        ->select('marks')
                        ->first();

                if($user_mark){

                    $mark = $user_mark->marks;
                    
                    if($mark>=$pass_mark){
                        $mcq_test = 2;
                     }else{
                 $mcq_test = 1;
                     }
                }else{
                    $mcq_test = 1;
                        }
                }else{
                    $mcq_test = 1;
                        }
            }else{

                $status = PolicyAssignToEmployeeModel::where('main_policy_id',$id)
                ->where('main_employee_id',session('employee'))
                ->first();
                
                if($status->status==0){
                    $status->status=1;
                    $status->save();
                }
              
            
             $mcq_test = 0;
             
            }
            // echo $mcq_test;
            
            // die();

          
            return view('employeePanel.dashboard.policy.show_policy',['employee'=>$employee_data,'policy'=>$policy,'mcq_test'=>$mcq_test]);
        }

        // viewPolicyQuestions 
        public function viewPolicyQuestions($id)
        {
            $employee_data = self::employeeDetails();
            
            $questions = DB::table('policy')
            ->join('mcq','mcq.main_policy_id','=','policy.policy_id')
            ->where('mcq.main_policy_id',$id)
            ->get();
            
            $pass_mark = DB::table('policy')
            ->join('pass_mark','pass_mark.policy_main_id','=','policy.policy_id')
            ->first();
            if($pass_mark){
                return view('employeePanel.dashboard.mcq.mcqpage',['employee'=>$employee_data,'mcq'=>$questions,'pass_mark'=>$pass_mark->pass_mark]);
            }else{
                return redirect('/employee/view-policy');
            }



            // echo "<pre>";
            // print_r($pass_mark);
            // die();

         

        }

        // departmentWisePolicy
        public function departmentWisePolicy($id)
        {

            $employee_data = self::employeeDetails();
            $department_id = $employee_data->department_id;

            $group_policy = DB::table('policy_assign_to_group')
            ->join('department','department.department_id','=','policy_assign_to_group.main_department_id')
            ->join('policy','policy.policy_id','=','policy_assign_to_group.main_policy_id')
            // ->join('employee','employee.department_id','=','department.department_id')
            ->where('policy_assign_to_group.main_department_id',$department_id)
            ->paginate(10);

            return view('employeePanel.dashboard.policy.view_group_policy',['employee'=>$employee_data,'policy'=>$group_policy]);
        }




        // mcqCheck
        public function mcqCheck(Request $request){
            
            $mcqId = $request->mcq_id;
            $ans = $request->user_ans;

            $checkAnswer = McqModel::find($mcqId);
         
          if($checkAnswer->ans==$ans){
            $currentMark = session('mark');
            $newMark = $currentMark+1;
            session(['mark' => $newMark]);   
          }else{
           echo "wrong";
          }
          echo session('mark');
            
            
             
        }



        // policyTestSubmit 

        public function policyTestSubmit(Request $request)
        {
       // Step 1: Retrieve all questions related to the policy_id
        $questions = DB::table('mcq')
        ->join('policy', 'policy.policy_id', '=', 'mcq.main_policy_id')
        ->where('policy.policy_id', $request->policy_id)
        ->pluck('mcq.mcq_id'); // Retrieve only the mcq_id values

$pass_mark = PassMarkModel::where('policy_main_id',$request->policy_id)->first();

if(!$pass_mark){
    return self::swal(false,'Contact with Admin','warning');
}
$pass_mark = $pass_mark->pass_mark;

// Step 2: Retrieve correct answers for all questions
$correct_ans = McqModel::whereIn('mcq_id', $questions)->pluck('ans', 'mcq_id');

// Step 3: Calculate the score based on user answers
$score = 0;

foreach ($questions as $ques) {
$user_ans = $request->$ques; // Assuming $request->$ques contains the user's answer
$correct_ans_for_question = $correct_ans[$ques] ?? null;

if ($correct_ans_for_question !== null && $user_ans === $correct_ans_for_question) {
    $score++;
}
}

if($score>=$pass_mark){

$save_result = new McqResultModel;
$save_result->main_policy_id = $request->policy_id;
$save_result->main_employee_id = session('employee');
$save_result->marks = $score;
$save_result->date_time = date('s:i:H d-m-Y'); 
$save_result->save();

$title = "Policy Test Pass (Mark-".$score.")";

return self::swal($request->policy_id,$title,'success');

}else{
    $title = "Policy Test Fail (Mark-".$score.")";
     return self::swal(false,$title,'warning');
}

          
        }


        

        // checkPolicyStatus
        public function checkPolicyStatus(Request $request)
        {
         $id = $request->id;
         
      
    

        $checkStatus = McqResultModel::where('main_policy_id',$id)
        ->where('main_employee_id',session('employee'))
        ->orderBy('marks','DESC')
        ->select('marks')
        ->first();

        if(!$checkStatus){
            return self::swal(false,'View Policy','error');
        }

        $passMarkDetails = DB::table('policy')
        ->join('pass_mark','pass_mark.policy_main_id','=','policy.policy_id')
        ->where('pass_mark.policy_main_id',$id)
        ->first();
        
        if($passMarkDetails){
            $passMark = $passMarkDetails->pass_mark;
        }else{
           return self::swal(false,'Contact with Admin','error');
        }

        array($checkStatus);
   
        $userMark =  $checkStatus['marks'];


        if($userMark>=$passMark){
            return self::swal(true,'Successful, Download Paper','success');

        }else{
            return self::swal(false,'Failed, Retest Exam','error');
        }


        }

        // getPolicyPaper

       public function getPolicyPaper($id)
        {

         $checkMcq = McqModel::where('main_policy_id',$id)->count();

         if($checkMcq>0){
            
            $checkStatus = McqResultModel::where('main_policy_id',$id)
            ->where('main_employee_id',session('employee'))
            ->orderBy('marks','DESC')
            ->select('marks')
            ->first();
    
            if(!$checkStatus){
                return redirect('/employee/view-policy');
            }
    
            $passMarkDetails = DB::table('policy')
            ->join('pass_mark','pass_mark.policy_main_id','=','policy.policy_id')
            ->where('pass_mark.policy_main_id',$id)
            ->first();
            
            if($passMarkDetails){
                $passMark = $passMarkDetails->pass_mark;
            }else{
                return redirect('/employee/view-policy');
            }
    
            array($checkStatus);
       
            $userMark =  $checkStatus['marks'];
    
    
            if($userMark>=$passMark){
    
                 $signature = SignatureModel::where('main_employee_id',session('employee'))
                 ->where('main_policy_id',$id)
                 ->first();
                 
                if($signature){
                 return redirect('/employee/view-policy');
                }
                $policy = PolicyModel::find($id);
                $employee_data = self::employeeDetails();
             return view('employeePanel.dashboard.policy.e_sign_policy',['employee'=>$employee_data,'policy'=>$policy]); 
            }else{
                return redirect('/employee/view-policy');
            }
         }else{
            $signature = SignatureModel::where('main_employee_id',session('employee'))
            ->where('main_policy_id',$id)
            ->first();
            
           if($signature){
            return redirect('/employee/get-certificate/'.$id);
           }

            $employee_data = self::employeeDetails();
            $policy = PolicyModel::find($id);
 return view('employeePanel.dashboard.policy.e_sign_policy',['employee'=>$employee_data,'policy'=>$policy]); 
           
         }
                
      }


        
           // uploadSign
           public function uploadSign(Request $request)
           {
               $folderPath = public_path('signature/');
           
               // Extract base64 data
               $image_parts = explode(";base64,", $request->signed);
           
               // Determine image type
               $image_type_aux = explode("image/", $image_parts[0]);
               $image_type = $image_type_aux[1];
           
               // Generate unique file name
               $file = uniqid() . '.' . $image_type;
               $file_path = $folderPath . $file;
             
           
               // Decode base64 data
               $image_base64 = base64_decode($image_parts[1]);
           
               // Save decoded image to file
               $save_result = file_put_contents($file_path, $image_base64);
           
               if ($save_result !== false) {

                    $save = new SignatureModel;
                    $save->main_employee_id = session('employee');
                    $save->main_policy_id = $request->policy_id;
                    $save->signature = $file;
                    $save->save();

                    $status = PolicyAssignToEmployeeModel::where('main_policy_id',$request->policy_id)
                    ->where('main_employee_id',session('employee'))->first();

                    if($status->status==1){
                        $status->status=2;
                        $status->save();
                    }
                   
                   return response()->json([
                    'status'=>true,
                    'policy_id'=>$request->policy_id
                   ]);

               } else {
                return response()->json([
                    'status'=>false,
                    'policy_id'=>$request->policy_id
                   ]);
               }
           }

     
        //    editEmployeePage 
        
        public function editEmployeePage($id){
            $employee = EmployeeModel::find($id);
            $admin_data = self::adminDetails();
            $departments = DepartmentModel::orderBy('department_id','DESC')->get();
            
            return view('admin.dashboard.employee.edit_employee',['admin'=>$admin_data,'employee'=>$employee,'departments'=>$departments]);
        }


        public function updateEmployee(Request $request)
        {

            $check_email = EmployeeModel::where('employee_email',$request->email)->count();
            $check_number = EmployeeModel::where('employee_number',$request->number)->count();
            
          if($check_email>1){
            return self::swal(false,'Email Already Exist','warning');
          }
          
          if($check_number<1){
            return self::swal(false,'Number Already Exist','warning');
          }

            
            $update = EmployeeModel::find($request->id);
            $update->employee_name = $request->name;
            $update->employee_email = $request->email;
            $update->employee_number = $request->number;
            $update->employee_password = $request->password;
            $update->department_id = $request->empType;
            $update->save();
            return self::swal(true,"Updated",'success');
            
        }

        // certificatePage

        public function certificatePage()
        {
            return view('employeePanel.dashboard.policy.certificate');
        }




        // certificateDownloadPage
        public function certificateDownloadPage($id)
        {
            $check_details = DB::table('employee')
            ->join('policy_assign_to_employee','policy_assign_to_employee.main_employee_id','=','employee.employee_id')
            ->join('policy','policy.policy_id','=','policy_assign_to_employee.main_policy_id')
            ->join('signature','signature.main_employee_id','=','employee.employee_id')
            ->where('signature.main_employee_id',session('employee'))
            ->where('signature.main_policy_id',$id)
            ->where('policy.policy_id',$id)
            ->where('employee.employee_id',session('employee'))
            ->first();

            // echo "<pre>";
            // print_r($check_details);
            // die();

           $employee_data = self::employeeDetails();
            if($check_details){
                return view('employeePanel.dashboard.policy.certificate',['policy'=>$check_details->policy_title,'employee'=>$employee_data]);
            }
            return redirect('/employee/view-policy');
        }

        // employeeCertificatePage

        public function employeeCertificatePage(Request $request)
        {
            $id = $request->policy_id;

            $check_details = DB::table('employee')
            ->join('policy_assign_to_employee','policy_assign_to_employee.main_employee_id','=','employee.employee_id')
            ->join('policy','policy.policy_id','=','policy_assign_to_employee.main_policy_id')
            ->join('signature','signature.main_employee_id','=','employee.employee_id')
            ->where('signature.main_employee_id',session('employee'))
            ->where('signature.main_policy_id',$id)
            ->where('policy.policy_id',$id)
            ->where('employee.employee_id',session('employee'))
            ->first();

            $employee_data = self::employeeDetails();

            if($check_details){
                return view('employeePanel.dashboard.policy.certificate',['policy'=>$check_details->policy_title,'employee'=>$employee_data]);
            }
            return redirect('/employee/view-policy');
        }
        // END CLASS 
}