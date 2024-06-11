<?php

namespace App\Http\Controllers\MyData;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\FinanceRequest;

use App\Http\Requests\RemarksStoreRequest;

use App\Models\Student;
use App\Models\Departments;
use App\Models\Roles;
use App\Models\User;
use App\Models\Program;
use App\Models\Remarks;
use App\Models\Clearance;
use App\Models\Librarian;
use App\Models\Finance;

class FinanceController extends Controller
{
    //
    public function index()
    {
        //
        $finances = Finance::all();
        return view('users.finance.index', compact('finances'));
    }

    public function viewFinanceDetailsView()
    {
        $finances = Finance::all();
        $students = Student::where('status_of_graduation','approved')->get();
        $clearances = Clearance::where('library','cleared')->get();
        $programs = Program::all();
        $departments = Departments::all();
        return view('users.finance.viewFinanceDetails', compact('finances','students','programs','departments','clearances'));
    }



    public function clearFinanceProcess(Student $student, Request $request, $student_id)
    {
        //
        $departments = Departments::all();
        $programs = Program::all();
        $finances = Finance::all();
        $students = Student::where('student_id', $student_id)->get();
        return view('users.finance.clearViewFinance', compact('students','programs','departments','finances'));
    }
}
