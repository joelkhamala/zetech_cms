<?php

namespace App\Http\Controllers\MyData;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\DepartmentStoreRequest;
use App\Http\Requests\LibraryRequest;
use App\Http\Requests\FeesDataRequest;

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
        $clearEmail = Clearance::where('library','cleared')->get();
        $depClears = Clearance::where('department','cleared')->get();
        $students = Student::where('status_of_graduation', $status)->get();
        if($request->has('search')){
            $students = Student::where('first_name','like', "%{$request->search}%")->orWhere('middle_name','like', "%{$request->search}%")->orWhere('last_name','like', "%{$request->search}%")->get();
        }
        return view('users.librarian.clearApprovedStudents', compact('depClears','students','programs','clears','clearEmail'));
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

    public function saveFeesProcess(FeesDataRequest $request, Finance $finance)
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
            $graduation = Finance::where('email', $request->email)->value('gown_fees');
            $fee = Finance::where('email', $request->email)->value('school_fees');
            $extrafee = Finance::where('email', $request->email)->value('extra_fee');

            if($graduation>$request->fee_amount)
            {
            $grad = $graduation - $request->fee_amount;
            $fees = $fee;
            $extra = $extrafee;
            }
            else
            {
                $grad=0;
                $feeRem = $request->fee_amount - $graduation;
                if($fee>$feeRem)
                {
                    $fees = $fee - $feeRem;
                    $extra = $extrafee;
                }
                else
                {
                    $fees = 0;
                    $extra = ($extrafee - $fee) + $feeRem;
                }
            }
            $finance->where('email', $request->email)
            ->update([
                'gown_fees' => $grad,
                'school_fees' => $fees,
                'extra_fee' => $extra
            ]);
        }
        else
        {
            $graduation = Finance::where('email', $request->email)->value('gown_fees');
            $fee = Finance::where('email', $request->email)->value('school_fees');
            $extrafee = Finance::where('email', $request->email)->value('extra_fee');
            if($fee>$request->fee_amount)
            {
            $fees = $fee - $request->fee_amount;
            $grad = $graduation;
            $extra = $extrafee;
            }
            else
            {
                $fees=0;
                $feeRem = $request->fee_amount - $fee;
                if($graduation>$feeRem)
                {
                    $grad = $graduation - $feeRem;
                    $extra = $extrafee;
                }
                else
                {
                    $grad = 0;
                    $extra = ($extrafee - $graduation) + $feeRem;
                }
            }
            $finance->where('email', $request->email)
            ->update([
                'school_fees' => $fees,
                'gown_fees' => $grad,
                'extra_fee' => $extra
            ]);
        }

        return redirect()->route('feesPayment')->with('message', 'Fees Paid Successfully');
    }

    public function clearLibRecordProcess(Request $request, $student_id)
    {
        $email = Student::where('student_id', $student_id)->value('email');
        $libraryEmail = Librarian::where('email', $email)->where('cleared','no')->get();
        $finEmail = Clearance::where('email', $email)->where('library','not cleared')->get();
        $cont = $libraryEmail->count();
        $contFin = $finEmail->count();
        if($request->has('clearFinance'))
            {
                if($contFin>0)
                {
                    return redirect()->back()->with('message', 'Student Has not cleared with library, hence cannot be cleared at Finance');
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
            $bk_name = $request->book_name[$key];
            $bk_author = $request->book_author[$key];
            $dateborrowed = $request->date_borrowed[$key];

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

        return redirect()->back()->with('message', 'Record(s) Successfully Added');        
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
