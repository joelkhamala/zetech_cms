<?php

namespace App\Http\Controllers\MyData;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCertificatesRequest;


use Illuminate\Support\Facades\File;

use App\Models\Clearance;
use App\Models\Student;
use App\Models\Departments;
use App\Models\Program;
use App\Models\Certificates;
use App\Models\Transcripts;

class CertificatesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('users.records.create');
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
     * @param  \App\Http\Requests\StoreCertificatesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCertificatesRequest $request)
    {
        //
        if($request->hasFile('file_upload')) {
                // Getting the original name
                $file=$request->file_upload;
                $documentName = time().'~'.$request->email.'-'.$file->getClientOriginalName();
                // Upload file to public path in documents directory
                $file->move(public_path('documents/certificates'), $documentName);
                // Database operation
                $randCert = rand(10001,99999);
                Certificates::create([
                    'email'=> $request->email,
                    'certificate_serial_number'=> $randCert,
                    'file_name'=> $documentName,
                    'department_id' => $request->department_id,
                    'program_id' => $request->program_id,
                    'picked'=> 'not picked',
                    'issued_by' => '0'
                ]);
        }
        return redirect()->back()
            ->with('message','Certificate successfully Uploaded.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Certificates  $certificates
     * @return \Illuminate\Http\Response
     */
    public function show($student_id)
    {
        //
        $student = Student::findOrFail($student_id);
        $email = Student::find($student_id)->value('email');
        $department_id = Student::find($student_id)->value('department_id');
        $certificates = Certificates::all();
        $transcripts = Transcripts::all();
        $departments = Departments::all();
        $programs = Program::all();
        return view('users.records.certRecord',['student_id', $student_id], compact('department_id','email','student','transcripts','certificates','departments','programs'));
    }

    public function certificatesView()
    {
        $user = Student::all();
        $departments = Departments::all();
        $programs = Program::all();
        $certificates = Certificates::all();
        return view('certificates', compact('user','departments','programs','certificates'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Certificates  $certificates
     * @return \Illuminate\Http\Response
     */
    public function edit(Certificates $certificates)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCertificatesRequest  $request
     * @param  \App\Models\Certificates  $certificates
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCertificatesRequest $request, Certificates $certificates)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Certificates  $certificates
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $certificate_id)
    {
        //
        if($request->has('file_delete'))
        {
            $certificate = Certificates::findOrFail($certificate_id);
            if($certificate->delete()){
                $move = File::move(public_path('documents/certificates/'.$request->file_delete), public_path('deleted_files/certificates/'.$request->file_delete));
                if($move)
                {
                    return redirect()->back()->with('message', 'Certificate Deleted Successfully, a backup can be found in Deleted certificates'); 
                }
                else
                {
                    return redirect()->back()->with('message', 'Certificate Deleted Successfully, However, we experienced a problem creating a backup'); 
                }
            }
        }
    }
}
