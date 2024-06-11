<?php

namespace App\Http\Controllers\MyData;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\DepartmentStoreRequest;
use App\Http\Requests\LibraryRequest;

use App\Models\Departments;
use App\Models\Student;
use App\Models\Program;
use App\Models\Clearance;
use App\Models\Librarian;
use App\Models\Finance;
use App\Models\FeesData;

class DepartmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $departments = Departments::get();
        if($request->has('search')){
            $departments = Departments::where('department_name','like', "%{$request->search}%")->get();
        }
        return view('departments.index', compact('departments'));
    }

    public function clearApprovedStudentsProcess(Request $request)
    {
        $status = 'approved';
        $programs = Program::all();
        $clears = Clearance::all();
        $students = Student::where('status_of_graduation', $status)->get();
        if($request->has('search')){
            $students = Student::where('first_name','like', "%{$request->search}%")->orWhere('middle_name','like', "%{$request->search}%")->orWhere('last_name','like', "%{$request->search}%")->get();
        }
        return view('users.librarian.clearApprovedStudents', compact('students','programs','clears'));
    }

    public function clearStudentLibView($student_id)
    {
        $student = Student::find($student_id);
        $departments = Departments::all();
        $programs = Program::all();
        $email = $student->email;
        $libraryDetails = Librarian::where('email', $email)->where('cleared','no')->get();
        return view('users.librarian.clearStudentLibView',compact('student','departments','programs','libraryDetails'));
    }


    public function clearBookProcess(Request $request)
    {
        if($request->has('clearSave'))
        {
            Librarian::where('email', $request->email)->where('librarian_id', $request->book_id)
            ->update([
                'cleared' => 'yes',
            ]);
            return redirect()->back()->with('message','Book Cleared successfully');
        }
        else
        {
            return redirect()->back()->with('message','Book Not Cleared');
        }
    }

    public function saveFeesProcess(Request $request, Finance $finance)
    {
        FeesData::create([
            'email' => $request->email,  
            'amount' => $request->fee_amount,
            'reason' => $request->reason,
            'bank' => $request->bank,
            'code' => $request->code          
        ]);

        if($request->reason == 'graduation')
        {
            $graduation = Finance::where('email', $request->email)->pluck('gown_fees')->first();
            $grad = $graduation - $request->fee_amount;  
            $finance->where('email', $request->email)
            ->update([
                'gown_fees' => $grad
            ]);
        }
        else
        {
            $fee = Finance::where('email', $request->email)->pluck('school_fees')->first();
            $sch_fee = $fee - $request->fee_amount;   
            $finance->where('email', $request->email)
            ->update([
                'school_fees' => $sch_fee
            ]);
        }

        return redirect()->route('feesPayment')->with('message', 'Fees Paid Successfully');
    }

    public function clearLibRecordProcess(Request $request, $student_id)
    {
        $email = Student::where('student_id', $student_id)->pluck('email')->first();
        $libraryEmail = Librarian::where('email', $email)->where('cleared','no')->get();
        $finEmail = Clearance::where('email', $email)->where('library','not cleared')->get();
        $cont = $libraryEmail->count();
        $contFin = $finEmail->count();
        if($request->has('clearFinance'))
            {
                if($contFin>0)
                {
                    return redirect()->route('users.finance.viewFinanceDetails')->with('message', 'Student Has not cleared with library, hence cannot be cleared at Finance');
                }
                else
                {
                    Clearance::where('email', $email)
                    ->update([
                        'finance' => 'cleared',
                    ]);

                    Finance::where('email', $email)
                    ->update([
                        'officer_id'=>$request->officer_id
                    ]);
                    
                    return redirect()->route('users.finance.viewFinanceDetails')->with('message', 'Student Finance Records Successfully Cleared');
                }
            }
            else
            {
                if($cont>0)
                {
                    return redirect()->route('users.librarian.clearApprovedStudents')->with('message', 'Student has Not returned some books hence cannot be cleared');
                }
                else
                {
                    Clearance::where('email', $email)
                        ->update([
                            'library' => 'cleared',
                        ]);
                        return redirect()->route('users.librarian.clearApprovedStudents')->with('message', 'Student Library Records Successfully Cleared');
                }
            }
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('departments.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DepartmentStoreRequest $request)
    {
        //
        //Save Program data
        Departments::create([
            'department_name' => $request->department_name,
        ]);

        return redirect()->route('departments.index')->with('message', 'Department Successfully Added');
    }

    public function saveLibRecordProcess(LibraryRequest $request)
    {
        //Save Library data
        foreach($request->book_title as $key => $bk_title)
        {
            foreach($request->book_name as $key => $bk_name)
            {
                foreach($request->book_author as $key => $bk_author)
                {
                    foreach($request->date_borrowed as $key => $dateborrowed)
                    {
                        $bookName = Librarian::where('book_author', $bk_author)->pluck('book_name')->first();
                        $bookTitle = Librarian::where('book_author', $bk_author)->pluck('book_title')->first();
                        $bookAuthor = Librarian::where('book_author', $bk_author)->pluck('book_author')->first();

                        if($bk_author == $bookAuthor && $bookTitle == $bk_title)
                        {
                            continue;
                        }
                        else
                        {
                            Librarian::create([
                                'email' => $request->email,
                                'department_id' => $request->department_id,
                                'book_title' => $bk_title,
                                'book_name' => $bk_name,
                                'book_author' => $bk_author,
                                'date_borrowed' => $dateborrowed,
                            ]);

                            Clearance::where('email', $request->email)
                            ->update([
                                'library' => 'not cleared',
                            ]);
                        }

                    }
                }
            }
        }

        return redirect()->route('users.librarian.clearApprovedStudents')->with('message', 'Record Successfully Added');        
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
    public function edit(Departments $department)
    {
        //
        return view('departments.edit', compact('department'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DepartmentStoreRequest $request, Departments $department)
    {
        //
        $department->update([
            'department_name' => $request->department_name,
        ]);
        return redirect()->route('departments.index')->with('message', 'Department Successfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Departments $department)
    {
        //Deleting Data
        if($department->delete()){
            return redirect()->route('departments.index')->with('message', 'Department Deleted Successfully'); 
        }
    }
}
