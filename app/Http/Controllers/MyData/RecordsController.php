<?php

namespace App\Http\Controllers\MyData;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Clearance;
use App\Models\Student;
use App\Models\Departments;
use App\Models\Program;
use App\Models\Certificates;
use App\Models\Transcripts;
use App\Models\FeesData;

class RecordsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createTransView()
    {
        //
        $departments = Departments::all();
        $programs = Program::all();
        $records = Student::all();
        $transcripts = Transcripts::all();
        $certificates = Certificates::all();
        return view('users.records.createTrans', compact('departments','programs','records','transcripts','certificates'));
    }

    public function createCertView()
    {
        //
        $departments = Departments::all();
        $programs = Program::all();
        $records = Student::all();
        $transcripts = Transcripts::all();
        $certificates = Certificates::all();
        return view('users.records.createCert', compact('departments','programs','records','transcripts','certificates'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function clearStudentRecordProcess(Request $request)
    {
        $records = Student::all();
        $departments = Departments::all();
        $transcripts = Transcripts::all();
        $certificates = Certificates::all();
        $clearances = Clearance::where('gown','picked')->get();
        $emailCleared = Clearance::where('certTrans','picked')->get();
        if($request->has('search')){
            $records = Student::where('user_name','like', "%{$request->search}%")->orWhere('email','like', "%{$request->search}%")->get();
        }
        return view('users.records.view',compact('emailCleared','clearances','records','departments','transcripts','certificates'));
    }

    public function clearStudRecordProc(Request $request, $email)
    {
        $records = Student::all();
        $departments = Departments::all();
        $transcripts = Transcripts::all();
        $certificates = Certificates::all();
        $clearances = Clearance::where('gown','picked')->get();
        if($request->has('clearStudentRecord'))
        {
            Clearance::where('email',$email)
            ->update([
                'certTrans' => 'picked'
            ]);
        return redirect()->back()->with('message','Student Cleared Successfully');
        }
    }

    public function editRecordRecordProcess($student_id)
    {
        $user = Student::find($student_id);
        $departments = Departments::get();
        return view('users.records.edit', ['student_id'=>$student_id], compact('user','departments'));
    }

    public function updateStudentRecordProcess(Student $user, $student_id)
    {
        $departments = Departments::get();
        return view('users.records.index',  ['student_id'=>$student_id]);
    }

    public function feesViewShow()
    {
        $students=Student::all();
        $departments=Departments::all();
        $programs=Program::all();
        $fees=FeesData::all()->sum('amount');
        $feesData=FeesData::all();
        return view('feesView',compact('feesData','students','departments','programs','fees'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
