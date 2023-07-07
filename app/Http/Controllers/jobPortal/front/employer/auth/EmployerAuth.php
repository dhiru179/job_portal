<?php

namespace App\Http\Controllers\jobPortal\front\employer\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class EmployerAuth extends Controller
{
    public function signUpPage()
    {

        return view('job_portal.front.employer.auth.signup');
    }
    public function employerRegistration(Request $request)
    {
        $data = [
            'status' => true,
            'slug' => $request->slug,
            'url' => "",
            'error' => ""
        ];
        $validation = Validator::make($request->all(), [
            'c_name' => 'required',
            'email' => "required|email|unique:employers,email",
            'phone' => 'required|numeric|min:10',
        ]);
        if ($validation->fails()) {
            $data['error'] = $validation->errors();
            return $data;
        }
        ##############################################
        /*generate password save and send email.*/
        ##############################################
        $set_default = 'admin';
        $get_data = [
            'company_name' => $request->c_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'password' => Hash::make($set_default),
        ];
        DB::table('employers')->insert($get_data);

        $credentials = ['email' => $request->email, 'password' => $set_default];

        if (Auth::guard('employer')->attempt($credentials)) {

            $data['url'] = route('employers.dashboard');
        }

        return $data;
    }
    public function loginPage()
    {

        return view('job_portal.front.employer.auth.login');
    }
    public function login(Request $request)
    {

        $validated = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::guard('employer')->attempt($credentials)) {

            return redirect()->intended('/employers/dashboard')
                ->withSuccess('Signed in');
        }

        return redirect()->back()->with('message', 'Login details are not valid');
    }

    public function logout()
    {
        Session::flush();
        Auth::guard('employer')->logout();

        return Redirect('users/login');
    }
}
