<?php

namespace App\Http\Controllers\MyData;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\StudentStoreRequest;
use App\Http\Requests\studentUpdateRequest;
use App\Http\Requests\ConfirmNameRequest;
use App\Http\Requests\FinanceRequest;

use App\Http\Requests\RemarksStoreRequest;
use Illuminate\Support\Facades\Hash;

use App\Models\Student;
use App\Models\Departments;
use App\Models\Roles;
use App\Models\User;
use App\Models\Program;
use App\Models\Remarks;
use App\Models\Clearance;
use App\Models\Librarian;
use App\Models\Finance;
use App\Models\FeesData;
use App\Models\Gowns;
use App\Models\Transcripts;
use App\Models\Certificates;

class StudentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        //
        $programs = Program::all();
        $students = Student::get();
        if($request->has('search')){
            $students = Student::where('first_name','like', "%{$request->search}%")->orWhere('middle_name','like', "%{$request->search}%")->orWhere('last_name','like', "%{$request->search}%")->get();
        }
        return view('students.index', compact('students','programs'));
    }

    public function selectApprovedList()
    {
        $departments = Departments::all();
        $programs = Program::all();
        $approved = 'approved';
        $studentsApproved = Student::where('status_of_graduation','like', "{$approved}")->get();
        return view('students.approvedList', compact('studentsApproved','programs','departments'));

    }

    public function getApprovedStudents(Request $request)
    {
        //
        $approved = 'approved';

        $departments = Departments::all();
        $programs = Program::all();
        $remarks = Remarks::all();
        $studentsApproved = Student::where('status_of_graduation','=', "{$approved}")->get();
        if($request->has('search')){
            $studentsApproved = Student::where('status_of_graduation','=', "{$approved}")->where('first_name','like', "%{$request->search}%")->orWhere('middle_name','like', "%{$request->search}%")->orWhere('last_name','like', "%{$request->search}%")->get();
        }
        return view('users.hod.approvedStudents', compact('departments','programs','studentsApproved','remarks'));
    }

    public function getStudentNames(Request $request, $department_id)
    {
        //
        $confirmed = 'confirmed';
        $departments = Departments::all();
        $remarks = Remarks::all();
        $programs = Program::all();
        $depClears = Clearance::where('department','cleared')->get();
        $allStudents = Student::where('confirmed','=', "{$confirmed}")->where('department_id','=',"{$department_id}")->get();
        if($request->has('search')){
            $allStudents = Student::where('confirmed','=', "{$confirmed}")->where('department_id','=',"{$department_id}")->where('first_name','like', "%{$request->search}%")->orWhere('middle_name','like', "%{$request->search}%")->orWhere('last_name','like', "%{$request->search}%")->get();
        }
        return view('users.hod.nameConfirm', compact('depClears','departments','programs','allStudents','remarks'));
    }

    public function viewAllStudents(Request $request)
    {
        //
        $departments = Departments::all();
        $programs = Program::all();
        $remarks = Remarks::all();
        $allStudents = Student::get();
        if($request->has('search')){
            $allStudents = Student::where('first_name','like', "%{$request->search}%")->orWhere('middle_name','like', "%{$request->search}%")->orWhere('last_name','like', "%{$request->search}%")->get();
        }
        return view('users.hod.viewAll', compact('departments','programs','allStudents','remarks'));
    }

    public function viewStudents(Student $student, Request $request)
    {
        //
        $departments = Departments::all();
        $programs = Program::all();
        $students = Student::get();
        if($request->has('search')){
            $students = Student::where('first_name','like', "%{$request->search}%")->orWhere('middle_name','like', "%{$request->search}%")->orWhere('last_name','like', "%{$request->search}%")->get();
        }
        return view('students.viewStudents', compact('students','programs','departments'));
    }


    public function viewStudent($student_id)
    {
        //
        $departments = Departments::all();
        $programs = Program::all();
        $remarks = Remarks::where('remark_to','=',"{$student_id}")->get();
        $student = Student::find($student_id);
        return view('users.hod.view', compact('departments','programs','student','remarks'));
    }


    public function graduationList($department_id, Request $request)
    {
        $departments = Departments::all();
        $programs = Program::all();
        $remarks = Remarks::all();
        $students = Student::where('department_id', '=', "{$department_id}")->get();
        $depclear = Clearance::where('department','cleared')->get();
        if($request->has('search')){
            $students = Student::where('department_id', '=', "{$department_id}")->where('first_name','like', "%{$request->search}%")->orWhere('middle_name','like', "%{$request->search}%")->orWhere('last_name','like', "%{$request->search}%")->get();
        }
        return view('users.hod.graduationList', compact('department_id','depclear','departments','programs','remarks','students'));
    }


    public function createList($department_id)
    {
        $department = Departments::find($department_id);
        $programs = Program::where('department_id','=',"{$department_id}")->get();
        return view('users.hod.createList',compact('department','programs'));
    }

    public function addRemarks($department_id, $student_id)
    {
        // $studentData = Student::where('student_id','=', "{$student_id}")->get();
        $studentData = Student::find($student_id);
        return view('users.hod.addRemarks', compact('studentData'));
    }


    public function viewRemarks($department_id,$student_id)
    {
        // $studentData = Student::where('student_id','=', "{$student_id}")->get();
        $studentData = Student::find($student_id);
        $remarkData = Remarks::where('remark_to','=', "{$student_id}")->get();
        return view('users.hod.viewRemarks', compact('studentData','remarkData'));
    }

    public function saveRemarks(RemarksStoreRequest $request)
    {
        //Save Student data
        Remarks::create([
            'user_id' => $request->user_id,
            'user_department_id' => $request->user_department_id,
            'remark_title' => $request->remark_title,
            'remark_to' => $request->remark_to,
            'issue' => $request->issue,
            'remark' => $request->remark,
        ]);

        return redirect()->route('users.hod.graduationList', $request->department_id)->with('message', 'Remark Sent');
    }


    public function saveConfirmProcess(ConfirmNameRequest $request)
    {
        //Save Student data
       
        $data = Student::where('student_id', $request->student_id)
       ->update([
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'confirmed' => 'confirmed',
        ]);
        if($data)
        {
            return redirect()->back()->with('message', 'Name Confirmed');
        }
    }


    // public function addRemarks($department_id, $student_id, Student $student, Request $request, RemarksStoreRequest $remarksRequest)
    // {
    //     $departments = Departments::all();
    //     $programs = Program::all();
    //     $students = Student::where('department_id', '=', "{$department_id}")->get();
    //     $studentData = Student::find($student_id);
        
    //     return view('users.hod.addRemarks', compact('departments','programs','students','studentData'));
    // }
    

    public function clearanceStatusProcessor()
    {
        $remarks = Remarks::all();
        $libraryClears = Clearance::where('library','cleared')->get();
        $financeClears = Clearance::where('finance','cleared')->get();
        $gownClears = Clearance::where('gown','picked')->get();
        $certificateClears = Clearance::where('certTrans','picked')->get();
        return view('users.student.clearanceStatus',compact('remarks','libraryClears','financeClears','gownClears','certificateClears'));
    }

    public function graduationStepsShow($email)
    {
        $departments = Departments::all();
        $students = Student::all();
        $roles = Roles::all();
        $users = User::all();
        $books = Librarian::all();
        $remarks = Remarks::all();
        $gowns = Gowns::where('picked','not picked')->get();
        $serialNo = Gowns::where('email', $email)->value('gown_serial_number');
        $emailGown = Gowns::where('picked','picked')->value('email');
        $depclearances = Clearance::where('department','cleared')->where('email', $email)->get();
        $libclearances = Clearance::where('library','cleared')->where('email', $email)->get();
        $finclearances = Clearance::where('finance','cleared')->where('email', $email)->get();
        $gownclearances = Clearance::where('gown','picked')->where('email', $email)->get();
        $recordsclearances = Clearance::where('certTrans','picked')->where('email', $email)->get();
        $recordDetails = Transcripts::where('email', $email)->get();
        $certificateDetails = Certificates::where('email', $email)->get();
        $certclearances = Clearance::where('certTrans','picked')->where('email', $email)->get();
        return view('users.student.clearanceProcess', compact('departments','students','roles','users','books','remarks','depclearances','libclearances','finclearances','gownclearances','certclearances','certificateDetails','gowns','emailGown','serialNo','recordDetails'));
    }

    public function feesPaymentView()
    {
        $finances = Finance::all();
        $feesdata = FeesData::all();
        $totalGrads = FeesData::where('reason','graduation')->sum('amount');
        $totalTuits = FeesData::where('reason','tuition');
        return view('users.student.feesPayment', compact('finances','feesdata','totalGrads','totalTuits'));
    }

    public function clearStudentDeptProcess(Clearance $clear, $student_id)
    {
        $email=Student::where('student_id', $student_id)->value('email');
        $clear->where('email', $email)
        ->update([
            'department' => 'cleared'
        ]);

        return redirect()->back()->with('message', 'Student Cleared Successfully');
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $stu = 'Student';
        $departments = Departments::all();
        $roles = Roles::find(7);
        $users = User::all();
        $programs = Program::all();
        return view('students.create', compact('departments','programs','roles','users'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StudentStoreRequest $request)
    {
        //Save Student data
        Student::create([
            'user_name' => $request->user_name,
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'national_id' => $request->national_id,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->admissionNumber),
            'guardianPhone' => $request->guardianPhone,
            'admissionNumber' => $request->admissionNumber,
            'yearOfAdmission' => $request->yearOfAdmission,
            'department_id' => $request->department_id,
            'program_id' => $request->program_id,
        ]);

        User::create([
            'user_name' => $request->user_name,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'role_id' => $request->role_id,
            'department_id' => $request->department_id,
            'password' => Hash::make($request->admissionNumber),
        ]);

        Clearance::create([
            'email' => $request->email,
            'department_id' => $request->department_id,
            'program_id' => $request->program_id,
        ]);

        Finance::create([
            'email' => $request->email,
            'department_id' => $request->department_id,
            'program_id' => $request->program_id,
        ]);

        return redirect()->route('students.index')->with('message', 'Student Successfully Added');
    }

    public function saveStudents(StudentStoreRequest $request)
    {
        //Save Student data
        $createS = Student::create([
            'user_name' => $request->user_name,
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'national_id' => $request->national_id,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->admissionNumber),
            'guardianPhone' => $request->guardianPhone,
            'admissionNumber' => $request->admissionNumber,
            'yearOfAdmission' => $request->yearOfAdmission,
            'department_id' => $request->department_id,
            'program_id' => $request->program_id,
        ]);

        $createU = User::create([
            'user_name' => $request->user_name,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'role_id' => $request->role_id,
            'department_id' => $request->department_id,
            'password' => Hash::make($request->admissionNumber),
        ]);

        $createC = Clearance::create([
            'email' => $request->email,
            'department_id' => $request->department_id,
            'program_id' => $request->program_id,
        ]);

        Finance::create([
            'email' => $request->email,
            'department_id' => $request->department_id,
            'program_id' => $request->program_id,
        ]);

        if($createS && $createU && $createC)
        {
            $message = "Graduating Student Successfully Added";
        }
        else
        {
            $message = "Some records not Created";
        }

        return redirect()->route('users.hod.graduationList', $request->department_id)->with('message', $message);
    }

    public function createListProcess(StudentStoreRequest $request, $department_id)
    {
        //Save Student data
        $createS = Student::create([
            'user_name' => $request->user_name,
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'national_id' => $request->national_id,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->admissionNumber),
            'guardianPhone' => $request->guardianPhone,
            'admissionNumber' => $request->admissionNumber,
            'yearOfAdmission' => $request->yearOfAdmission,
            'department_id' => $request->department_id,
            'program_id' => $request->program_id,
        ]);

        $createU = User::create([
            'user_name' => $request->user_name,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'role_id' => $request->role_id,
            'department_id' => $request->department_id,
            'password' => Hash::make($request->admissionNumber),
        ]);

        $createC = Clearance::create([
            'email' => $request->email,
            'department_id' => $request->department_id,
            'program_id' => $request->program_id,
        ]);
        if($createS && $createU && $createC)
        {
            $message = "Graduating Student Successfully Added";
        }
        else
        {
            $message = "Some records not Created";
        }
        
        return redirect()->route('users.hod.graduationList',['department_id'=>$department_id])->with('message',$message);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    { 
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student, Request $request)
    {
        //
        $departments = Departments::all();
        $programs = Program::all();
        $data = Student::where('student_id', $request->student_id)
       ->update([
           'status_of_graduation' => $request->approval
        ]);
        if($data)
        {
            return redirect()->route('students.viewStudents')->with('message', 'Student Records Successfully Approved');
        }
        return view('students.edit', compact('student','departments','programs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(studentUpdateRequest $request, Student $student)
    {
        //
        $student->update([
            'user_name' => $request->user_name,
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'national_id' => $request->national_id,
            'phone' => $request->phone,
            'password' => Hash::make($request->admissionNumber),
            'guardianPhone' => $request->guardianPhone,
            'admissionNumber' => $request->admissionNumber,
            'yearOfAdmission' => $request->yearOfAdmission,
            'department_id' => $request->department_id,
            'program_id' => $request->program_id,
        ]);

        if($request->has('admissionNumber'))
        {
            User::where('user_name', $request->user_name)->where('logged_once','<=','0')
            ->update([
            'password' => Hash::make($request->admissionNumber),
             ]);
        }

        return redirect()->route('students.viewStudents')->with('message', 'Student Details Successfully Updated');
    }

    public function updateStudentLogins(studentUpdateRequest $request, Student $student)
    {
        //
        $student->update([
            'user_name' => $request->user_name,
            'password' => Hash::make($request->password),
        ]);
        
        User::where('email', $request->email)->where('logged_once','>','0')
        ->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('students.index')->with('message', 'Student Login Details Successfully Updated'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        //
        //Deleting Data
        if($student->delete()){
            return redirect()->route('students.index')->with('message', 'Student Deleted Successfully'); 
        }
    }
}
