<?php

namespace App\Http\Controllers\jobPortal\front\auth;

use App\Http\Controllers\Controller;
use App\Mail\verfyUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;

class UsersAuth extends Controller
{
    public function signUpPage()
    {
        if (Auth::check()) {
            return Redirect()->route('landing_page');
        }
        return view('job_portal.front.auth.signup');
    }
    public function userRegistration(Request $request)
    {

        $data = [
            'status' => true,
            'slug' => $request->slug,
        ];
        $validation = Validator::make($request->all(), [
            'user' => 'required',
            'email' => "required|email|unique:users,email",
            'user_type' => 'required|in:seeker,employer',
            'password' => 'required',
            'cnf_password' => 'required_with:password|same:password|min:6',
            'phone' => 'required|numeric'
        ]);
        if ($validation->fails()) {
            $data['status'] = false;
            $data['error'] = $validation->errors();
            return $data;
        }

        $salt = Str::random(50);

        $user_id = User::insertGetId([
            'name' => $request->user,
            'email' => $request->email,
            'phone' => $request->phone,
            'user_type' => $request->user_type,
            'remember_token' => $salt,
            'password' => Hash::make($request->password),
            'created_at' => gmdate("Y/m/d H:i:s"),
        ]);

        #send email to verify
       
        // $email = $request->email;
        Mail::to($request->email)->send(new verfyUser($salt,$user_id,$request));
        // Mail::send("job_portal.front.layout.email", $mail_data, function ($msg) use ($request) {
        //     $msg->to($request->email);
        //     $msg->subject('hello');
        // });
        Session::flash('message', "veryfication link send in email($request->email)");
        $data['url'] = route('landing_page');
        return $data;
    }
    public function loginPage()
    {
        if (Auth::check()) {
            return Redirect()->route('landing_page');
        }
        return view('job_portal.front.auth.login');
    }
    public function login(Request $request)
    {


        $validated = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        // $credentials = $request->only('email', 'password');
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
            'account_status' => 'active'
        ];
        if (Auth::attempt($credentials)) {
            if (Auth::user()->user_type == "employer") {
                return redirect('/employers/dashboard')
                    ->withSuccess('Signed in');
            } else {
                return redirect()->intended('/')
                    ->withSuccess('Signed in');
            }
        }

        return redirect()->back()->with('message', 'Login details are not valid or check verify');
    }

    public function verfyUrl(Request $request)
    {
        // Mail::to("kumardhiraj.179@gmail.com")->send(new verfyUser("fdf"));
        // return $this->toVerifyEmail($url);
        if (Auth::check()) {
            return Redirect()->route('landing_page')->with('message', 'Account verfied');
        } else {
            if (!empty($request->url)) {
                $decrypted = Crypt::decryptString(trim($request->url));
                $extract = explode(' ', $decrypted);
                $user_id = $extract[0];
                $user = User::find($user_id);
                $get_current_time = strtotime(gmdate("Y/m/d H:i:s"));
                $user_created_time = strtotime($user->created_at);
                $time = $get_current_time - $user_created_time;
                // return [$time,Hash::check($user->remember_token, $extract[1])];
                if ((int)$time < 600 && Hash::check($user->remember_token, $extract[1])) {
                    $credentials = [
                        'email' => $user->email,
                        'password' => $extract[2]
                    ];
                    if (Auth::attempt($credentials)) {
                        User::whereId($user->id)->update(['account_status' => 'active','email_verified_at'=>gmdate("Y/m/d H:i:s")]);
                        if (Auth::user()->user_type == "employer") {
                            return redirect('/employers/dashboard')
                                ->withSuccess('Signed in');
                        } else {
                            return redirect()->intended('/')
                                ->withSuccess('Signed in');
                        }
                    }
                    return redirect()->route('users.login')->with('message', 'Unauthorised!');
                }
                return view('job_portal.front.auth.verify_email')->with('message', 'token expired send again to vrify.');
            }
            return Redirect()->route('landing_page');
        }
    }

    function toVerifyEmail(Request $request)
    {


        return $request->all();
    }

    public function logout()
    {
        Session::flush();
        Auth::logout();

        return Redirect('users/login');
    }
}
