<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!in_array(Auth::user()->department->name, array('Pharmacy','Admin') ))
        {
            return redirect('/')->with('Message','You Are Not Allowed There');
        }
        $doctors = Doctor::all();

        return view('doctors')->with('doctors',$doctors);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!in_array(Auth::user()->department->name, array('Pharmacy','Admin') ))
        {
            return redirect('/')->with('Message','You Are Not Allowed There');
        }
        return view('create_doctor');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!in_array(Auth::user()->department->name, array('Pharmacy','Admin') ))
        {
            return redirect('/')->with('Message','You Are Not Allowed There');
        }
        $request->validate([
            'name' => 'required|string|max:191',
            'number' => 'required|string|max:191',
            'clinic_name' => 'nullable|string',
        ]);

        $doctor = Doctor::create([
            'doctor_name' => $request->name,
            'doctor_number' => $request->number,
            'doctor_clinic' => $request->clinic_name,
        ]);
        $log = ([
                'user_id' => Auth::user()->id,
                'description' => 'New Doctor Added by'.Auth::user()->name.', Doctor Name: '.$doctor->doctor_name,
        ]);
        \Userlog::store($log);

        return back()->with('status','Doctor Successfully Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function show(Doctor $doctor)
    {
        // return $doctor;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function edit(Doctor $doctor)
    {
        if(!in_array(Auth::user()->department->name, array('Pharmacy','Admin') ))
        {
            return redirect('/')->with('Message','You Are Not Allowed There');
        }
        return view('edit_doctor')->with('doctor',$doctor);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Doctor $doctor)
    {
        if(!in_array(Auth::user()->department->name, array('Pharmacy','Admin') ))
        {
            return redirect('/')->with('Message','You Are Not Allowed There');
        }
        $request->validate([
            'name' => 'required|string|max:191',
            'number' => 'required|string|max:191',
            'clinic_name' => 'nullable|string',
        ]);

        $data = ([
            'doctor_name' => $request->name,
            'doctor_number' => $request->number,
            'doctor_clinic' => $request->clinic_name,
        ]);
        $log = ([
                'user_id' => Auth::user()->id,
                'description' => 'Doctor Updated by'.Auth::user()->name.', Doctor id: '.$doctor->id.'; Old Doctor Value: '.json_encode($doctor).'; New Doctor Value: '.json_encode($data),
        ]);
        \Userlog::store($log);
        $doctor->update($data);

        return back()->with('status','Doctor Successfully Updated');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Doctor $doctor)
    {
        if(!in_array(Auth::user()->department->name, array('Pharmacy','Admin') ))
        {
            return redirect('/')->with('Message','You Are Not Allowed There');
        }
        $log = ([
                'user_id' => Auth::user()->id,
                'description' => 'Doctor Deleted by'.Auth::user()->name.', Doctor name: '.$doctor->doctor_name,
        ]);
        \Userlog::store($log);
        $doctor->delete();

       return back()->with('status','Doctor Successfully Deleted');
    }
}
