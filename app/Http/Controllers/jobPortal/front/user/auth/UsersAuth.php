<?php

namespace App\Http\Controllers\jobPortal\front\user\auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class UsersAuth extends Controller
{
    public function signUpPage()
    {
        $city = DB::table('india_city')->get();
        return view('job_portal.front.user.auth.signup', compact(['city']));
    }
    public function userRegistration(Request $request)
    {
        // return $request->all();
        $data = [
            'status' => true,
            'slug' => $request->slug,
            'url' => "",
            'error' => "",
            'msg' => ""
        ];
        $validation = Validator::make($request->all(), [
            'user' => 'required',
            'email' => "required|email|unique:users,email",
            'city' => "required",
            'password' => 'required',
            'phone' => 'required|numeric'
        ]);
        if ($validation->fails()) {
            $data['error'] = $validation->errors();
            return $data;
        }

        User::create([
            'name' => $request->user,
            'email' => $request->email,
            'location_id' => $request->city,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
        ]);
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $data['url'] = route('landing_page');
        }

        $data['msg'] = "insert success";
        return $data;
    }
    public function loginPage()
    {

        return view('job_portal.front.user.auth.login');
    }
    public function login(Request $request)
    {

        $validated = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('/')
                ->withSuccess('Signed in');
        }

        return redirect()->back()->with('message', 'Login details are not valid');
    }

    public function logout()
    {
        Session::flush();
        Auth::logout();

        return Redirect('users/login');
    }

    function showProfile()
    {
        $id = auth()->user()->id;
        $user = User::find($id);
        $city = DB::table('india_city')->get();
        return view('job_portal.front.user.create_profile', compact(['user', 'city']));
    }
    function updateProfile(Request $request)
    {

        $id = auth()->user()->id;
        $data = [
            'status' => true,
            'slug' => $request->slug,
            'error' => "",
            'msg' => "insert success",
            'url' => ""
        ];
        $validation = Validator::make($request->all(), [
            'user' => 'required',
            // 'email' => "required|email|unique:users,email,".$id,
            'city' => "required",

        ]);
        if ($validation->fails()) {
            $data['error'] = $validation->errors();
            return $data;
        }
        $get_data = [
            'location_id' => $request->city,
            'name' => $request->user,
            'phone' => $request->phone,
            'gender' => $request->gender,

        ];
        User::where('id', $id)->update($get_data);
        $data['url'] = route('landing_page');
        return $data;
    }
}
