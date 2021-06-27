<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Doctor;
use App\Models\Remark;

class LeadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!in_array(Auth::user()->department->name, array('Pharmacy','Admin','Call Center') ))
        {
            return redirect('/')->with('Message','You Are Not Allowed There');
        }
        $leads = Lead::latest()->get();
        return view('lead/leads')->with('leads',$leads);
    }

    /**
     * Display a listing of the pending leads.
     *
     * @return \Illuminate\Http\Response
     */
    public function pending()
    {
        if(!in_array(Auth::user()->department->name, array('Pharmacy','Admin','Call Center') ))
        {
            return redirect('/')->with('Message','You Are Not Allowed There');
        }
        $leads = Lead::where('status_id',1)->get();
        return view('lead/customerconsent')->with('leads',$leads);
    }

    /**
     * Display a listing of the Order Created leads.
     *
     * @return \Illuminate\Http\Response
     */
    public function ordercreated()
    {
        if(!in_array(Auth::user()->department->name, array('Pharmacy','Admin','Call Center') ))
        {
            return redirect('/')->with('Message','You Are Not Allowed There');
        }
        $leads = Lead::where('status_id',2)->get();
        return view('lead/saleordercreated')->with('leads',$leads);
    }

    /**
     * Display a listing of the closed leads.
     *
     * @return \Illuminate\Http\Response
     */
    public function customernotinterested()
    {
        if(!in_array(Auth::user()->department->name, array('Pharmacy','Admin','Call Center') ))
        {
            return redirect('/')->with('Message','You Are Not Allowed There');
        }
        $leads = Lead::where('status_id',3)->get();
        return view('lead/close')->with('leads',$leads);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!in_array(Auth::user()->department->name, array('Pharmacy','Admin','Doctors') )){
            return redirect('/')->with('Message','You Are Not Allowed There');
        }
        $doctors = Doctor::all();
        return view('lead/create_lead')->with('doctors',$doctors);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!in_array(Auth::user()->department->name, array('Pharmacy','Admin','Doctors') )){
            return redirect('/')->with('Message','You Are Not Allowed There');
        }
        if ($request->ajax()) {         
            $this->validate($request, [
            'customer_name' => 'required|string|max:191',
            'number' => 'required|string|max:191',
            'file1' => 'nullable|image',
            'file2' => 'nullable|image',
            'doctor' => 'required|integer',
            'medicine_name' => 'required|array|min:1',
            'medicine_name.*' => 'required|string|max:191',
            'quantity' => 'required|array|min:1',
            'quantity.*' => 'required|integer',
            ]);
        }



        $image1 = null;
        if($request->has('file1')){
        $file = $request->file('file1');
        $image1 = time().$file->getClientOriginalName();
        $file->move(public_path('images/prescription'), $image1);
        }

        $image2 = null;
        if($request->has('file2')){
        $file = $request->file('file2');
        $image2 = time().$file->getClientOriginalName();
        $file->move(public_path('images/prescription'), $image2);
        }

        $lead = Lead::create([
            'customer_name' => $request->customer_name,
            'customer_number' => $request->number,
            'file1' => $image1,
            'file2' => $image2,
            'doctor_id' => $request->doctor,
        ]);

        if($lead){

            $medicine_name = $request->medicine_name;
            $quantity = $request->quantity;
            foreach ($quantity as $key => $value) {
                $products = new Product;
                    $products->medicine_name = $medicine_name[$key];
                    $products->quantity = $quantity[$key];
                    $products->lead_id = $lead->id;
                    $products->save();
            }
        }

        if (Auth::check()) {

            $log = ([
                'user_id' => Auth::user()->id,
                'description' => 'New Lead Created by '.Auth::user()->name.'. Lead Id '.$lead->id,
            ]);

            \Userlog::store($log);
        }

       $result = ([
            'status' => 'Lead Successfully Created!'
        ]);
        return $result;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Lead  $lead
     * @return \Illuminate\Http\Response
     */
    public function show(Lead $lead)
    {
        return $lead;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Lead  $lead
     * @return \Illuminate\Http\Response
     */
    public function createorder(Lead $lead)
    {
        if(!in_array(Auth::user()->department->name, array('Pharmacy','Admin','Call Center') )){
            return redirect('/')->with('Message','You Are Not Allowed There');
        }
        return view('order/create_order')->with('lead',$lead);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Lead  $lead
     * @return \Illuminate\Http\Response
     */
    public function edit(Lead $lead)
    {
        if(!in_array(Auth::user()->department->name, array('Pharmacy','Admin') )){
            return redirect('/')->with('Message','You Are Not Allowed There');
        }
        return "Edit Lead => ".$lead;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Lead  $lead
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lead $lead)
    {
        switch ($request->status_id) {
            case '3':
                $log = ([
                    'user_id' => Auth::user()->id,
                    'description' => 'Lead Updated by '.Auth::user()->name.'. Lead Id '.$lead->id.'; Old Lead Status: '.$lead->status->status.'; New Lead Status: Customer Not Interested;',
                ]);
                $lead->update([
                    'status_id' => $request->status_id,
                ]);
                Remark::create([
                    'lead_id' => $lead->id,
                    'description' => $request->remarks,
                    'user_id'   => Auth::user()->id,
                ]);
                \Userlog::store($log);
                break;
            
            default:
                $request->validate([
                    'customer_name' => 'required|string|max:191',
                    'customer_number' => 'required|string|max:191',
                    'file1' => 'nullable|image',
                    'file2' => 'nullable|image',
                    'doctor_id' => 'required|integer',
                    'status_id' => 'required|integer',
                ]);
                $image1 = $lead->file1;
                if($request->has('file1')){
                    $file = $request->file('file1');
                    $image1 = time().$file->getClientOriginalName();
                    $file->move(public_path() . '/images/prescription/', $image);
                }

                $image2 = $lead->file2;
                if($request->has('file2')){
                    $file = $request->file('file2');
                    $image2 = time().$file->getClientOriginalName();
                    $file->move(public_path() . '/images/prescription/', $image);
                }
                $data = ([
                    'customer_name' => $request->customer_name,
                    'customer_number' => $request->number,
                    'file1' => $image1,
                    'file2' => $image2,
                    'doctor_id' => $request->doctor,
                ]);
                $log = ([
                    'user_id' => Auth::user()->id,
                    'description' => 'Lead Updated by '.Auth::user()->name.'. Lead Id '.$lead->id.'; Old Lead Data '.var_dump($lead).' New Lead Data '.var_dump($request->all()),
                ]);
                \Userlog::store($log);
                $lead->update($data);
                break;
        }


        return back()->with('status','Lead Update Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Lead  $lead
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lead $lead)
    {
        if (Auth::check()) {

            $log = ([
                'user_id' => Auth::user()->id,
                'description' => 'Lead Deleted by '.Auth::user()->name.'. Lead Id '.$lead->id.'; Lead Status '. $lead->status->status,
            ]);

            \Userlog::store($log);
        }

        $lead->delete();
        return back()->with('status','Lead Delete Successfully');
    }
}
