<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\OrderProduct;
use App\Models\Lead;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!in_array(Auth::user()->department->name, array('Pharmacy','Admin','Call Center','Riders') )){
            return redirect('/')->with('Message','You Are Not Allowed There');
        }
        if(Auth::user()->department->name === 'Riders')
        {
            $orders = Order::where('user_id',Auth::user()->id)->get();
            return view('orders')->with('orders',$orders);
        }
        $orders = Order::all();
        return view('order/orders')->with('orders',$orders);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function beingprocess()
    {
        if(!in_array(Auth::user()->department->name, array('Pharmacy','Admin','Call Center','Riders') )){
            return redirect('/')->with('Message','You Are Not Allowed There');
        }
        if(Auth::user()->department->name === 'Riders')
        {
            $orders = Order::where(['status_id'=> 4,'user_id' => Auth::user()->id])->get();
            return view('order/beingprocess')->with('orders',$orders);
        }
        $orders = Order::where('status_id',4)->get();
        return view('order/beingprocess')->with('orders',$orders);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function shipped()
    {
        if(!in_array(Auth::user()->department->name, array('Pharmacy','Admin','Call Center','Riders') )){
            return redirect('/')->with('Message','You Are Not Allowed There');
        }
        if(Auth::user()->department->name === 'Riders')
        {
            $orders = Order::where(['status_id'=> 5,'user_id' => Auth::user()->id])->get();
            return view('order/shipped')->with('orders',$orders);
        }
        $orders = Order::where('status_id',5)->get();
        return view('order/shipped')->with('orders',$orders);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function cancelled()
    {
        if(!in_array(Auth::user()->department->name, array('Pharmacy','Admin','Call Center','Riders') )){
            return redirect('/')->with('Message','You Are Not Allowed There');
        }
        if(Auth::user()->department->name === 'Riders')
        {
            $orders = Order::where(['status_id'=> 6,'user_id' => Auth::user()->id])->get();
            return view('order/cancelled')->with('orders',$orders);
        }
        $orders = Order::where('status_id',6)->get();
        return view('order/cancelled')->with('orders',$orders);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function refund()
    {
        if(!in_array(Auth::user()->department->name, array('Pharmacy','Admin','Call Center','Riders') )){
            return redirect('/')->with('Message','You Are Not Allowed There');
        }
        if(Auth::user()->department->name === 'Riders')
        {
            $orders = Order::where(['status_id'=> 7,'user_id' => Auth::user()->id])->get();
            return view('order/refund')->with('orders',$orders);
        }
        $orders = Order::where('status_id',7)->get();
        return view('order/refund')->with('orders',$orders);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function completed()
    {
        if(!in_array(Auth::user()->department->name, array('Pharmacy','Admin','Call Center','Riders') )){
            return redirect('/')->with('Message','You Are Not Allowed There');
        }
        if(Auth::user()->department->name === 'Riders')
        {
            $orders = Order::where(['status_id'=> 8,'user_id' => Auth::user()->id])->get();
            return view('order/completed')->with('orders',$orders);
        }
        $orders = Order::where('status_id',8)->get();
        return view('order/completed')->with('orders',$orders);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return "Create Now Order";
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!in_array(Auth::user()->department->name, array('Pharmacy','Admin','Call Center') )){
            return redirect('/')->with('Message','You Are Not Allowed There');
        }
        if ($request->ajax()) {         
            $this->validate($request, [
            'customer_name' => 'required|string|max:191',
            'number' => 'required|string|max:191',
            'address' => 'required|string|max:1000',
            'doctor' => 'required|integer',
            'medicine_name' => 'required|array|min:1',
            'medicine_name.*' => 'required|string|max:191',
            'quantity' => 'required|array|min:1',
            'quantity.*' => 'required|integer',
            ]);
        }

        $order = Order::create([
            'customer_name' => $request->customer_name,
            'customer_number' => $request->number,
            'customer_address' => $request->address,
            'lead_id' => $request->lead,
            'doctor_id' => $request->doctor,
        ]);

        if($order){

            $medicine_name = $request->medicine_name;
            $quantity = $request->quantity;
            foreach ($quantity as $key => $value) {
                $products = new OrderProduct;
                    $products->medicine_name = $medicine_name[$key];
                    $products->quantity = $quantity[$key];
                    $products->order_id = $order->id;
                    $products->save();
            }
        }

        $lead = Lead::find($request->lead);
        $lead->update(['status_id' => $request->status_id]);

        $log = ([
                'user_id' => Auth::user()->id,
                'description' => 'New Order Created by: '.Auth::user()->name.'. From Lead Id: '.$lead->id.'; Order Id '.$order->id,
            ]);

            \Userlog::store($log);

            $result = ([
            'status' => 'Order Successfully Created!'
        ]);
        return $result;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        if(!in_array(Auth::user()->department->name, array('Pharmacy','Admin','Call Center')) || ($order->status_id != 4 && !in_array(Auth::user()->department->name, array('Pharmacy','Admin'))) ){
            return redirect('/')->with('Message','You Are Not Allowed There');
        }
        return view('order/edit_order')->with('order',$order);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        if(!$request->filled('alledit') && $request->status_id == 4 && $order->user_id == null && isset($request->user_id))
        {
            $order->update([
                'user_id' => $request->user_id,
            ]);

            $log = ([
                'user_id' => Auth::user()->id,
                'description' => 'Rider Assigned by '.Auth::user()->name.'. Order Id '.$order->id.'; Rider assigned: '.$order->user->name,
            ]);

        }
        else if(!$request->filled('alledit') && $request->status_id == 5)
        {
            if($order->user_id == null)
                return back()->with('Message','Assign Rider Before Mark Completed');
            $log = ([
                'user_id' => Auth::user()->id,
                'description' => 'Order Mark as Shipped by '.Auth::user()->name.'. Order Id '.$order->id.'; Order Old Status: '.$order->status->status,
            ]);
            $order->update($request->all());
        }
        else if($request->status_id === 6 && !isset($request->alledit))
        {
            $log = ([
                'user_id' => Auth::user()->id,
                'description' => 'Order Mark as Cancelled by '.Auth::user()->name.'. Order Id '.$order->id.'; Order Old Status: '.$order->status->status,
            ]);
            $order->update($request->all());
        }
        else if($request->status_id === 7 && !isset($request->alledit))
        {
            $log = ([
                'user_id' => Auth::user()->id,
                'description' => 'Order Mark as Refund by '.Auth::user()->name.'. Order Id '.$order->id.'; Old Status: '.$order->status->status,
            ]);
            $order->update($request->all());
        }
        else if($request->status_id === 8 && !isset($request->alledit))
        {
            $log = ([
                'user_id' => Auth::user()->id,
                'description' => 'Order Mark as Completed and Upload Invoice by '.Auth::user()->name.'. Order Id '.$order->id.'; Order Old Status: '.$order->status->status.'; Total Invoice Without Discount: '.$request->invoice_without_discount.'; Total Invoice With Discount: '.$request->invoice_with_discount,
            ]);
            if($request->has('invoice_file')){
                $file = $request->file('invoice_file');
                $image = $file->getClientOriginalName();
                $file->move(public_path('images/invoice'), $image);
            }
            $data = ([
                'invoice_with_discount' => $request->invoice_with_discount,
                'invoice_without_discount' => $request->invoice_without_discount,
                'invoice_file' => $image,
                'status_id' => $request->status_id,
            ]);
            $order->update($data);
        } 
        else
        {
            $request->validate([
                'customer_name' => 'required|string|max:191',
                'number' => 'required|string|max:191',
                'address' => 'required|string|max:1000',
                'doctor' => 'required|integer',
                'status' => 'required|integer',
                'rider' => 'nullable|integer',
                'invoice_with_discount' => 'nullable|string',
                'invoice_without_discount' => 'nullable|string',
                'medicine_name' => 'required|array|min:1',
                'medicine_name.*' => 'required|string|max:191',
                'quantity' => 'required|array|min:1',
                'quantity.*' => 'required|integer',
            ]);
            $image = $order->invoice_file;
            if($request->has('invoice_file')){
                $file = $request->file('invoice_file');
                $image = $file->getClientOriginalName();
                $file->move(public_path('images/invoice'), $image);
            }
            $log = ([
                'user_id' => Auth::user()->id,
                'description' => 'Order Updated by '.Auth::user()->name.'. Order Id '.$order->id.'; Old Order Data '.json_encode($order).' New Order Data '.json_encode($request->all()),
            ]);
            $data = ([
                'customer_name' => $request->customer_name,
                'customer_number' => $request->number,
                'customer_address' => $request->address,
                'doctor_id' => $request->doctor,
                'status_id' => $request->status,
                'user_id'   => $request->rider,
                'invoice_with_discount' => $request->invoice_with_discount,
                'invoice_without_discount' => $request->invoice_without_discount,
                'invoice_file' => $image,
            ]);
            $order->update($data);
            $medicine_name = $request->medicine_name;
            $quantity = $request->quantity;
            $order->orderproducts()->forceDelete();
            foreach ($quantity as $key => $value) 
            {
                $order->orderproducts()->create([
                    'medicine_name' => $request->medicine_name[$key],
                    'quantity' => $request->quantity[$key],
                ]);
            }

        }
        \Userlog::store($log);
         return back()->with('status','Order Successfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        $log = ([
                    'user_id' => Auth::user()->id,
                    'description' => 'Order Deleted by '.Auth::user()->name.'. Order Id '.$lead->id,
                ]);
        \Userlog::store($log);
        $order->delete();
        return back()->with('status','Order Successfully Deleted');
    }
}
