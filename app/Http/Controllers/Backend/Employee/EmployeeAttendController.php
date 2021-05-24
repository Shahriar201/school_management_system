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
        $data['allData'] = EmployeeAttendance::select('date')->groupBy('date')->orderBy('id', 'desc')->get();
        
        return view('backend.employee.employee_attendance.view-employee-attendance', $data);
    }

    public function add(){
        $data['employees'] = User::where('user_type', 'employee')->get();

        return view('backend.employee.employee_attendance.add-employee-attendance', $data);
    }

    public function store(Request $request){
        EmployeeAttendance::where('date', date('Y-m-d', strtotime($request->date)))->delete();
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

    public function edit($date){
        $data['editData'] = EmployeeAttendance::where('date', $date)->get();
        $data['employees'] = User::where('user_type', 'employee')->get();

        return view('backend.employee.employee_attendance.add-employee-attendance', $data);
    }

    public function details($date){
        $data['details'] = EmployeeAttendance::where('date', $date)->get();

        return view('backend.employee.employee_attendance.employee-attendance-details', $data);
    }
}
