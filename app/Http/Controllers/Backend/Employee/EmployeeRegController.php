<?php

namespace App\Http\Controllers\Backend\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\AssignSubject;
use App\Model\DiscountStudent;
use App\User;
use App\Model\StudentClass;
use App\Model\StudentGroup;
use App\Model\StudentShift;
use App\Model\AssignStudent;
use App\Model\Year;
use DB;
use PDF;
use App\Model\EmployeeSalaryLog;
use App\Model\Designation;

class EmployeeRegController extends Controller
{
    public function view(){  
        $data['allData'] = User::where('user_type', 'employee')->get();
        
        return view('backend.employee.employee_reg.view-employee', $data);
    }

    public function add(){
        $data['designations'] = Designation::all();
        return view('backend.employee.employee_reg.add-employee', $data);
    }

    public function store(Request $request){
        //Generate student Id
        DB::transaction(function() use($request){
            $checkYear = date('Y', strtotime($request->join_date));
            // dd($checkYear);
            $employee = User::where('user_type', 'employee')->orderBy('id', 'DESC')->first();
            if($employee == null){
                $firstReg = 0;
                $employeeId = $firstReg+1;
                if($employeeId < 10){
                    $id_no = '000'.$employeeId;
                }elseif($employeeId < 100){
                    $id_no = '00'.$employeeId;
                }elseif($employeeId < 1000){
                    $id_no = '0'.$employeeId;
                }
            }else{
                $employee = User::where('user_type', 'employee')->orderBy('id', 'DESC')->first()->id;
                $employeeId = $employee+1;
                if($employeeId < 10){
                    $id_no = '000'.$employeeId;
                }elseif($employeeId < 100){
                    $id_no = '00'.$employeeId;
                }elseif($employeeId < 1000){
                    $id_no = '0'.$employeeId;
                }
            }
            $final_id_no = $checkYear.$id_no;

            $user = new User();
            $code = rand(0000, 9999);   
            $user->id_no = $final_id_no;
            $user->password = bcrypt($code);
            $user->code = $code;
            $user->user_type = 'employee';
            $user->name = $request->name;
            $user->fname = $request->fname;
            $user->mname = $request->mname;
            $user->mobile = $request->mobile;
            $user->address = $request->address;
            $user->gender = $request->gender;
            $user->religion = $request->religion;
            $user->salary = $request->salary;
            $user->designation_id = $request->designation_id;
            $user->dob = date('Y-m-d', strtotime ($request->dob));
            $user->join_date = date('Y-m-d', strtotime ($request->join_date));
            if($request->file('image')){
                $file = $request->file('image');
                $fileName = date('YmdHi').$file->getClientOriginalName();
                $file->move(public_path('upload/employee_images'), $fileName);
                $user['image'] = $fileName;
            }
            $user->save();

            $employee_salary = new EmployeeSalaryLog();
            $employee_salary->employee_id = $user->id;
            $employee_salary->effected_date = date('Y-m-d', strtotime($request->join_date));
            $employee_salary->previous_salary = $request->salary;
            $employee_salary->present_salary = $request->salary;
            $employee_salary->increment_salary= '0';
            $employee_salary->save();
        });
        
        return redirect()->route('employees.reg.view')->with('success', 'Data inserted successfully');
    }

    public function edit($student_id){
        $data['editData'] = AssignStudent::with(['student', 'discount'])->where('student_id', $student_id)->first();
        // dd($data['editData']->toArray());
        $data['years'] = Year::orderBy('id', 'desc')->get();
        $data['classes'] = StudentClass::all();
        $data['groups'] = StudentGroup::all();
        $data['shifts'] = StudentShift::all();
        return view('backend.student.student_reg.add-student', $data);
    }

    public function update(Request $request, $student_id){
        DB::transaction(function() use($request, $student_id){
            
            $user = User::where('id', $student_id)->first();
            $user->name = $request->name;
            $user->fname = $request->fname;
            $user->mname = $request->mname;
            $user->mobile = $request->mobile;
            $user->address = $request->address;
            $user->gender = $request->gender;
            $user->religion = $request->religion;
            $user->dob = date('Y-m-d', strtotime ($request->dob));
            if($request->file('image')){
                $file = $request->file('image');
                @unlink(public_path('upload/student_images/'.$user->image));
                $fileName = date('YmdHi').$file->getClientOriginalName();
                $file->move(public_path('upload/student_images'), $fileName);
                $user['image'] = $fileName;
            }
            $user->save();

            $assign_student = AssignStudent::where('id', $request->id)->where('student_id', $student_id)->first();
            $assign_student->year_id = $request->year_id;
            $assign_student->class_id = $request->class_id;
            $assign_student->group_id = $request->group_id;
            $assign_student->shift_id = $request->shift_id;
            $assign_student->save();

            $discount_student = DiscountStudent::where('assign_student_id', $request->id)->first();
            $discount_student->discount = $request->discount;
            $discount_student->save();
        });
        
        return redirect()->route('students.registration.view')->with('success', 'Data updated successfully');

    }

    public function promotion($student_id){
        $data['editData'] = AssignStudent::with(['student', 'discount'])->where('student_id', $student_id)->first();
        // dd($data['editData']->toArray());
        $data['years'] = Year::orderBy('id', 'desc')->get();
        $data['classes'] = StudentClass::all();
        $data['groups'] = StudentGroup::all();
        $data['shifts'] = StudentShift::all();
        return view('backend.student.student_reg.promotion-student', $data);
    }

    public function promotionStore(Request $request, $student_id){
        DB::transaction(function() use($request, $student_id){
            
            $user = User::where('id', $student_id)->first();
            $user->name = $request->name;
            $user->fname = $request->fname;
            $user->mname = $request->mname;
            $user->mobile = $request->mobile;
            $user->address = $request->address;
            $user->gender = $request->gender;
            $user->religion = $request->religion;
            $user->dob = date('Y-m-d', strtotime ($request->dob));
            if($request->file('image')){
                $file = $request->file('image');
                @unlink(public_path('upload/student_images/'.$user->image));
                $fileName = date('YmdHi').$file->getClientOriginalName();
                $file->move(public_path('upload/student_images'), $fileName);
                $user['image'] = $fileName;
            }
            $user->save();

            $assign_student = new AssignStudent();
            $assign_student->student_id = $student_id;
            $assign_student->year_id = $request->year_id;
            $assign_student->class_id = $request->class_id;
            $assign_student->group_id = $request->group_id;
            $assign_student->shift_id = $request->shift_id;
            $assign_student->save();

            $discount_student = new DiscountStudent();
            $discount_student->assign_student_id = $assign_student->id;
            $discount_student->fee_category_id = '1';
            $discount_student->discount = $request->discount;
            $discount_student->save();
        });
        
        return redirect()->route('students.registration.view')->with('success', 'Student Promotion successfully');

    }

    public function details($student_id){
        $data['details'] = AssignStudent::with(['student', 'discount'])->where('student_id', $student_id)->first();
        $pdf = PDF::loadView('backend.student.student_reg.student-details-pdf', $data);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('document.pdf');
    }
}
