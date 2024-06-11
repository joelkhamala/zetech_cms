<?php

namespace App\Http\Controllers\MyData;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Gowns;
use App\Models\Clearance;

class GownsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $gowns = Gowns::get();
        if($request->has('search')){
            $gowns = Gowns::where('gown_serial_number','like', "%{$request->search}%")->get();
        }
        return view('gowns.index',compact('gowns'));
    }

    public function createNew()
    {
        return view('gowns.create');
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        //Save user data
        if($request->has('number_of_gowns'))
        {
            for($i=1;$i<=$request->number_of_gowns;$i++)
            {
                $serial = rand('100001','999999');
                $gownCount=Gowns::where('gown_serial_number', $serial)->pluck('gown_serial_number')->first();
                if($gownCount>0)
                {
                    continue;
                }
                else
                {
                    Gowns::create([
                        'email'=>'gown@gownsdepartment.com',
                        'gown_serial_number' => $serial,
                        'condition' => $request->gown_condition,
                        'size' => $request->gown_size,
                    ]); 
                }
            }
        }

        return redirect()->route('gowns.index')->with('message', 'Gown Successfully Created');
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
    public function edit(Gowns $gown)
    {
        return view('gowns.edit', compact('gown'));
    }

    public function issuedGownsView(Request $request)
    {
        $gowns = Gowns::where('picked','picked')->get();
        if($request->has('search')){
            $gowns = Gowns::where('gown_serial_number','like', "%{$request->search}%")->get();
        }
        return view('gowns.issuedGowns',compact('gowns'));
    }


    public function returnedGownsView(Request $request)
    {
        $gowns = Gowns::where('returned','returned')->get();
        if($request->has('search')){
            $gowns = Gowns::where('gown_serial_number','like', "%{$request->search}%")->get();
        }
        return view('gowns.returnedGowns',compact('gowns'));
    }

    public function selectGownProcess(Request $request, Gowns $gown, Clearance $clear, $gown_id)
    {
        $gown->where('gown_id', $gown_id)
        ->update([
            'email'=>$request->email,
            'picked'=> 'picked',
            'returned'=> 'not returned',
        ]);

        $clear->where('email', $request->email)
        ->update([
            'gown'=>'picked'
        ]);
        
        return redirect()->back()->with('message', 'Gown Picked Successfully');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gowns $gown)
    { 
        //
        $gown->update([
            'gown_serial_number' => $request->gown_serial_number,
            'size' => $request->gown_size,
            'condition' => $request->gown_condition,
        ]);

        return redirect()->route('gowns.index')->with('message', 'Gown Details Successfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gowns $gown)
    {
        //Deleting Data
        if($gown->delete()){
            if($gown->count()<=0)
            {
                $gown->truncate();
            }
            return redirect()->route('gowns.index')->with('message', 'Gown Deleted Successfully'); 
        }
    }
}
