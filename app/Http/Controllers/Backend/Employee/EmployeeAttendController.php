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
use App\Model\EmployeeSalaryLog;
use App\Model\Designation;
use App\Model\LeavePurpose;
use App\Model\EmployeeLeave;
use App\Model\EmployeeAttendance;
use DB;
use PDF;

class EmployeeAttendController extends Controller
{
    public function view(){  
        $data['allData'] = EmployeeAttendance::orderBy('id', 'desc')->get();
        
        return view('backend.employee.employee_attendance.view-employee-attendance', $data);
    }

    public function add(){
        $data['employees'] = User::where('user_type', 'employee')->get();

        return view('backend.employee.employee_attendance.add-employee-attendance', $data);
    }

    public function store(Request $request){
        $countemployee = count($request->employee_id);
        for ($i=0; $i < $countemployee; $i++) { 
            $attend_status = 'attend_status'.$i;
            $attend = new EmployeeAttendance();
            $attend->date = date('Y-m-d', strtotime($request->date));
            $attend->employee_id = $request->employee_id[$i];
            $attend->attend_status = $request->$attend_status;
            $attend->save();
        }
        
       return redirect()->route('employees.attendance.view')->with('success', 'Data inserted successfully');
    }

    public function edit($id){
        $data['editData'] = EmployeeLeave::find($id);
        $data['employees'] = User::where('user_type', 'employee')->get();
        $data['leave_purpose'] = LeavePurpose::all();

        return view('backend.employee.employee_leave.add-employee-leave', $data);
    }

    public function update(Request $request, $id){   
        if ($request->leave_purpose_id == "0") {
            $leavepurpose = new LeavePurpose();
            $leavepurpose->name = $request->name();
            $leavepurpose->save();
            $leave_purpose_id = $leavepurpose->id;
        }else {
            $leave_purpose_id = $request->leave_purpose_id;
        }
        $employee_leave = EmployeeLeave::find($id);
        $employee_leave->employee_id = $request->employee_id;
        $employee_leave->start_date = date('Y-m-d', strtotime($request->start_date));
        $employee_leave->end_date = date('Y-m-d', strtotime($request->end_date));
        $employee_leave->leave_purpose_id = $leave_purpose_id;
        $employee_leave->save();
        
       return redirect()->route('employees.leave.view')->with('success', 'Data updated successfully');
    }

    public function details($id){
        $data['details'] = User::find($id);
        $pdf = PDF::loadView('backend.employee.employee_reg.employee-details-pdf', $data);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('document.pdf');
    }
}
