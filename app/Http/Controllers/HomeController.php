<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Departments;

use App\Models\Student;
use App\Models\Remarks;
use App\Models\User;
use App\Models\Roles;
use App\Models\Program;
use App\Models\Librarian;
use App\Models\Clearance;
use App\Models\Finance;
use App\Models\FeesData;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $approved = 'Approved';
        $students = Student::all();
        $studentsApproved = Student::where('status_of_graduation','LIKE',"{$approved}%")->get();
        $studNumber = $students->count();
        $studApprovedNumber = $studentsApproved->count();
        return view('home',compact('students','studentsApproved','studNumber','studApprovedNumber'));
    }

    public function welcome()
    {
        return view('welcome');
    }

    public function hodindex()
    {
        $departments = Departments::all();
        $programs = Program::all();
        $students = Student::all();
        $approved = Student::where('status_of_graduation','=','approved');
        return view('users.hod.home', compact('departments','students','approved','programs'));
    }

    public function registrarindex()
    {
        $remarks=Remarks::all();
        $students=Student::all();
        $users=User::all();
        $roles=Roles::all();
        $departments=Departments::all();
        $programs=Program::all();
        return view('users.registrar.home',compact('students','remarks','users','roles','departments','programs'));
    }

    public function financeindex()
    {
        $remarks=Remarks::all();
        $students=Student::all();
        $users=User::all();
        $roles=Roles::all();
        $departments=Departments::all();
        $programs=Program::all();
        $fees=FeesData::all()->sum('amount');
        $feesData=FeesData::all();
        return view('users.finance.home',compact('feesData','students','remarks','users','roles','departments','programs','fees'));
    }

    public function roindex()
    {
        $remarks=Remarks::all();
        $students=Student::all();
        $users=User::all();
        $roles=Roles::all();
        $departments=Departments::all();
        $programs=Program::all();
        return view('users.records.home',compact('students','remarks','users','roles','departments','programs'));
    }

    public function libindex()
    {
        $remarks=Remarks::all();
        $students=Student::all();
        $users=User::all();
        $roles=Roles::all();
        $departments=Departments::all();
        $programs=Program::all();
        $clearanceReports = Clearance::where('library','cleared');
        $clearNots = Clearance::where('library','not cleared');
        $pendingBooks = Librarian::where('cleared','no');
        return view('users.librarian.home',compact('students','remarks','users','roles','departments','programs','clearNots','clearanceReports','pendingBooks'));
    }

    public function studentindex()
    {
        $remarks=Remarks::all();
        $students=Student::all();
        $users=User::all();
        $roles=Roles::all();
        $departments=Departments::all();
        $programs=Program::all();
        $books = Librarian::all();
        $clearances=Clearance::all();
        $finances=Finance::all();
        return view('users.student.home',compact('students','remarks','finances','clearances','users','roles','departments','programs','books'));
    }


    public function hodLogin()
    {
        return view('hodLogin');
    }


    public function handleAdmin()
    {
        return view('hodLogin');
    }  
}
