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
        $users = User::all();
        return $users;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
         $request->validate([
            'name' => 'required|string',
            'username'   =>  'required|string',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|',
            'department_id' => 'required|numeric',
        ]);

        $data = ([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'department_id' => $request->department_id,
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
                    'subject' => 'Welcome to Special Order CRM',
                    'content' => 'Dear '.$lead->name.'<br><br> Welcome to Special Order CRM, your login detail are following<br><br> Username:  '.$lead->username.'<br>Password:  '.$request->password,
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
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return view('profile');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
     public function update(Request $request, User $user)
    {
        $request->validate([
            'password' => 'required|string|min:6|confirmed',
        ]);

        $data = ([
            'password' => bcrypt($request->password),
        ]);

        $user->update($data);

        if (Auth::check()) {

            $log = ([
                'user_id' => Auth::user()->id,
                'description' => Auth::user()->name.' Change a Password',
            ]);

            \Userlog::store($log);
        }

        return back()->with('status','Your Password Successfully Changed');
    }
}
