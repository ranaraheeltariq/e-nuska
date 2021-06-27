<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $doctors = Doctor::all();

        return $doctors;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
        return $doctor;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function edit(Doctor $doctor)
    {
        return "Doctor Edit => ".$doctor;
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
        $request->validate([
            'doctor_name' => 'required|string|max:191',
            'doctor_number' => 'required|string|max:191',
            'doctor_clinic' => 'nullable|string',
        ]);

        $data = ([
            'doctor_name' => $request->doctor_name,
            'doctor_number' => $request->doctor_number,
            'doctor_clinic' => $request->doctor_clinic,
        ]);

        $doctor->update($data);

        return "Doctor Update => ".$doctor;

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Doctor $doctor)
    {
        $doctor->delete();

        return "Doctor Successfully Deleted";
    }
}
