<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Mail;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function users()
    {
        if(!in_array(Auth::user()->department->name, array('Admin') )){
            return redirect('/')->with('Message','You Are Not Allowed There');
        }
        $users = User::all();
        return view('users')->with('users',$users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!in_array(Auth::user()->department->name, array('Admin') )){
            return redirect('/')->with('Message','You Are Not Allowed There');
        }
        return view('create_user');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!in_array(Auth::user()->department->name, array('Admin') )){
            return redirect('/')->with('Message','You Are Not Allowed There');
        }
         $request->validate([
            'name' => 'required|string',
            'username'   =>  'required|string',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|',
            'department_id' => 'required|numeric',
            'mobile' => 'nullable|string|max:191',
            'image' => 'nullable|image',
        ]);

         // dd($request->all());
        $image = null;
        if($request->has('image')){
        $file = $request->file('image');
        $image = time().$file->getClientOriginalName();
        $file->move(public_path('images/users'), $image);
        }
        $data = ([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'department_id' => $request->department_id,
            'mobile'    => $request->mobile,
            'image' =>  $image,
            'approval_auth' => $request->approval_auth,
        ]);

        $userinsert = User::create($data);
        $lead = User::find($userinsert->id);

        if (Auth::check()) {

            $log = ([
                'user_id' => Auth::user()->id,
                'description' => 'New User Created by '.Auth::user()->name.'. User Id '.$lead->id.'; User Name '. $lead->name,
            ]);

            \Userlog::store($log);
        }

         $email = array(
                    'to' => $lead->email,
                    'to-name' => $lead->name,
                    'subject' => 'Welcome to E-Nuska CRM',
                    'content' => 'Dear '.$lead->name.'<br><br> Welcome to E-Nuska CRM, your login detail are following<br><br> Username:  '.$lead->username.'<br>Password:  '.$request->password,
        );
                
        Mail::send([], [], function($message) use ($email) {
            $message->to($email['to']);
            $message->subject($email['subject']);
            $message->setBody($email['content'], 'text/html');
        });

        return back()->with('status','New User Successfully Register');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        if($user->id == null)
            return view('myprofile');
        else
            return view('profile')->with('user',$user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        if(!in_array(Auth::user()->department->name, array('Admin') )){
            return redirect('/')->with('Message','You Are Not Allowed There');
        }
        return view('edit_user')->with('user',$user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
     public function update(Request $request, User $user)
    {
        if($request->filled('selfuser'))
        {
            $request->validate([
            'password' => 'required|string|min:6|confirmed',
        ]);

        $data = ([
            'password' => bcrypt($request->password),
        ]);

            $log = ([
                'user_id' => Auth::user()->id,
                'description' => Auth::user()->name.' Change a Password',
            ]);
        }
        else
        {
            if(!in_array(Auth::user()->department->name, array('Admin') )){
                return redirect('/')->with('Message','You Are Not Allowed There');
            }
            $request->validate([
                'name' => 'required|string',
                'department_id' => 'required|numeric',
                'mobile' => 'nullable|string|max:191',
                'image' => 'nullable|image',
                'password' => 'nullable|string|min:6',
            ]);
            $image = $user->image;
            if($request->has('image')){
            $file = $request->file('image');
            $image = time().$file->getClientOriginalName();
            $file->move(public_path('images/users'), $image);
            }
            $password = $request->has('password') ? bcrypt($request->password) : $user->password;
            $data = ([
                'name' => $request->name,
                'password' => $password,
                'department_id' => $request->department_id,
                'mobile'    => $request->mobile,
                'image' =>  $image,
                'approval_auth' => $request->approval_auth,
            ]);
            if($request->has('password')){
                $email = array(
                    'to' => $user->email,
                    'to-name' => $user->name,
                    'subject' => 'Password Change to E-Nuska',
                    'content' => 'Dear '.$user->name.'<br><br> Your Password is changed by Admin, your new login detail are following<br><br> Username:  '.$user->username.'<br>Password:  '.$request->password.'<br><br> <a href="https://e-nuska.apothecare.com.pk" target="_blank">E-Nuska CRM</a>',
                    );
                    
                    Mail::send([], [], function($message) use ($email) {
                    $message->to($email['to']);
                    $message->subject($email['subject']);
                    $message->setBody($email['content'], 'text/html');
                    });
            }

            $log = ([
                'user_id' => Auth::user()->id,
                'description' => 'User Update by'.Auth::user()->name.', User Id: '.$user->id.', Old User Detail: '.json_encode($user).'; New User Detail: '.json_encode($data),
            ]);
        }
        $user->update($data);
        \Userlog::store($log);

        return back()->with('status','User Successfully Update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if(!in_array(Auth::user()->department->name, array('Admin') )){
            return redirect('/')->with('Message','You Are Not Allowed There');
        }
        $log = ([
                    'user_id' => Auth::user()->id,
                    'description' => 'User Deleted by '.Auth::user()->name.'. User Name '.$user->name,
                ]);
        \Userlog::store($log);
        $user->delete();
        return back()->with('status','User Successfully Deleted');
    }
}
