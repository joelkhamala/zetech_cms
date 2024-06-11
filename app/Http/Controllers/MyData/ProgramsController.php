<?php

namespace App\Http\Controllers\MyData;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\ProgramStoreRequest;

use App\Models\Program;
use App\Models\Departments;

class ProgramsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $programs = Program::get();
        $departments = Departments::get();
        if($request->has('search')){
            $programs = Program::where('program_name','like', "%{$request->search}%")->get();
        }
        return view('programs.index', compact('programs','departments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $programs = Program::get();
        $departments = Departments::get();
        return view('programs.create', compact('programs','departments'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProgramStoreRequest $request)
    {
        //Save Program data
        Program::create([
            'program_name' => $request->program_name,
            'program_code' => $request->program_code,
            'program_type' => $request->program_type,
            'department_id' => $request->department_id,
        ]);

        return redirect()->route('programs.create')->with('message', 'Program Successfully Added');
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
    public function edit(Program $program)
    {
        //
        $programs = Program::get();
        $departments = Departments::get();
        return view('programs.edit', compact('program','departments'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $program_id)
    {
        //
        Program::where('program_id', $program_id)->update([
            'program_name' => $request->program_name,
            'program_code' => $request->program_code,
            'program_type' => $request->program_type,
            'department_id' => $request->department_id,
        ]);
        return redirect()->route('programs.index')->with('message', 'Program Successfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Program $program)
    {
        //Deleting Data
        if($program->delete()){
            return redirect()->route('programs.index')->with('message', 'Program Deleted Successfully'); 
        }
    }
}
