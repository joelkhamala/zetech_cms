<?php

namespace App\Http\Controllers\MyData;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Clearance;
use App\Models\Student;
use App\Models\Departments;

class RecordsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

    public function clearStudentRecordProcess()
    {
        $clearanceRecords = Clearance::where('gown','picked')->pluck('email')->first();
        $records = Student::all();
        $departments = Departments::all();
        return view('users.records.view',compact('records','clearanceRecords','departments'));
    }

    public function editRecordRecordProcess(Student $user, $student_id)
    {
        $departments = Departments::get();
        return view('users.records.edit', ['student_id'=>$student_id], compact('user','departments'));
    }

    public function updateStudentRecordProcess(Student $user, $student_id)
    {
        $departments = Departments::get();
        return view('users.records.index',  ['student_id'=>$student_id]);
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
