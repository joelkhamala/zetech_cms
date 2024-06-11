<?php

namespace App\Http\Controllers\MyData;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\StoreTranscriptsRequest;
use Illuminate\Support\Facades\File;

use App\Models\Clearance;
use App\Models\Student;
use App\Models\Departments;
use App\Models\Program;
use App\Models\Certificates;
use App\Models\Transcripts;
use App\Models\DeletedTranscripts;

class TranscriptsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTranscriptsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTranscriptsRequest $request)
    {
        //$selDept=Transcripts::where('department_id', $request->department_id)->pluck('email', $request->email)->all();

        if($request->hasFile('file_upload')) {
            $documentNameArr = [];
            foreach ($request->file_upload as $file) {
                // you can also use the original name
                $documentName = time().'~'.$request->email.'-'.$file->getClientOriginalName();
                $documentNameArr[] = $documentName;
                // Upload file to public path in documents directory
                $programName = Program::where('program_id', $request->program_id)->value('program_name');
                $programType = Program::where('program_id', $request->program_id)->value('program_type');
                $file->move(public_path('documents/transcripts/'), $documentName);
                // Database operation
                $randTrans = rand(10001,99999);
                Transcripts::create([
                    'email'=> $request->email,
                    'transcript_serial_number'=>$randTrans,
                    'file_name'=>$documentName,
                    'department_id' => $request->department_id,
                    'program_id' => $request->program_id,
                    'picked'=> 'not picked'
                ]);
            }
        }
        return back()
            ->with('message','You have successfully Uploaded the documents.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transcripts  $transcripts
     * @return \Illuminate\Http\Response
     */
    public function show($student_id)
    {
        //
        $student = Student::findOrFail($student_id);
        $email = Student::where('student_id',$student_id)->value('email');
        $transcripts = Transcripts::where('email', $email)->get();
        $certificates = Certificates::all();
        // $transcripts = Transcripts::all();
        $departments = Departments::all();
        $programs = Program::all();
        $department_id = Student::find($student_id)->value('department_id');
        return view('users.records.showRecord',['student_id', $student_id], compact('department_id','email','student','transcripts','certificates','departments','programs'));
    }


    public function transcriptsView()
    {
        $user = Student::all();
        $departments = Departments::all();
        $programs = Program::all();
        $transcripts = Transcripts::all();
        return view('transcripts', compact('user','departments','programs','transcripts'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transcripts  $transcripts
     * @return \Illuminate\Http\Response
     */
    public function edit(Transcripts $transcripts)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTranscriptsRequest  $request
     * @param  \App\Models\Transcripts  $transcripts
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTranscriptsRequest $request, Transcripts $transcripts)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transcripts  $transcripts
     * @return \Illuminate\Http\Response
     */
    public function destroyTrans(Request $request, $transcript_id)
    {
        //
        if($request->has('trans_delete'))
        {
            $transcript = Transcripts::findOrFail($transcript_id);
            $transBackup = DeletedTranscripts::create([
                'email'=> $request->email,
                'transcript_serial_number'=>$request->transcript_serial_number,
                'file_name'=>$request->file_name,
                'department_id' => $request->department_id,
                'program_id' => $request->program_id,
                'retrieved'=> 'not retrieved'
            ]);
            if($transBackup)
            {
                $programName = Program::where('program_id', $request->program_id)->value('program_name');
                $programType = Program::where('program_id', $request->program_id)->value('program_type');
                if($transcript->delete()){
                    $move = File::move(public_path('documents/transcripts/'.$request->trans_delete), public_path('deleted_files/transcripts/'.$request->trans_delete));
                    if($move)
                    {
                        return redirect()->back()->with('message', 'Transcript Deleted Successfully, a backup can be found in Deleted Transcripts'); 
                    }
                    else
                    {
                        return redirect()->back()->with('message', 'Transcript Deleted Successfully, However, we experienced a problem creating a backup'); 
                    }
                }
            }
        }
    }
}
