<?php

namespace App\Http\Controllers\jobPortal\admin\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
class AdminAuth extends Controller
{
    // public function signUp()
    // {
    //     return view('job_portal.admin.signup');
    // }
    // public function storeAdminInfo(Request $request)
    // {
    //     return view('job_portal.front.employer.signup');
    // }
    function loginPage()
    {
        return view('job_portal.admin.auth.login');
    }
    public function login(Request $request)
    {
      
        $validated = $request->validate([
            'user_id' => 'required',
            'password' => 'required',
        ]);
     
        $credentials = $request->only('user_id', 'password');
             
        if (Auth::guard('admin')->attempt($credentials)) {
          
            return redirect()->intended('/admin/dashboard')
                ->withSuccess('Signed in');
        }

        return redirect()->back()->with('message','Login details are not valid');
    }
    
    public function logout()
    {
        Session::flush();
        Auth::guard('admin')->logout();
  
        return Redirect('/admin');
    
    }
}

