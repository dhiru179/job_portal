<?php

namespace App\Http\Controllers\jobPortal\front\auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ManageProfile extends Controller
{

    function showProfile($type = null)
    {
        $id = auth()->user()->id;
        $user = DB::table('users')
            ->select(
                'users.email',
                'users.phone',
                'user_profile.f_name',
                'user_profile.m_name',
                'user_profile.l_name',
                'user_profile.gender',
                'user_profile.date_of_birth',
                'user_profile.primary_phone',
                'user_profile.secondary_phone',
                'user_profile.about_self',
                'user_profile.profile_pic',

                'user_profile.company_name',
                'user_profile.email as office_email',
                'user_profile.logo',
                'user_profile.website',
            )
            ->leftJoin('user_profile', 'users.id', 'user_profile.user_id')
            ->where(['users.id' => $id])
            ->get()->first();

        return view('job_portal.front.user.create_profile', compact(['user', 'type']));
    }
    function updateProfile(Request $request)
    {

        $id = auth()->user()->id;
        $data = [
            'status' => true,
            'slug' => $request->slug,
            'error' => "",
            'msg' => "",
            'url' => ""
        ];
        $validate_field = [
            "phone_1" => "required|numeric",
            "phone_2" => "numeric",
            "about_self" => "max:500",
        ];
        $get_data = [
            'user_id' => $id,
            'f_name' => $request->f_name,
            'm_name' => $request->m_name,
            'l_name' => $request->l_name,
            'primary_phone' => $request->phone_1,
            'secondary_phone' => $request->phone_2,
            'about_self' => $request->about_self,
        ];
        function manageFiles($request, $get_data)
        {

            if ($request->hasFile('profile_pic')) {
                $pic = $request->file('profile_pic');
                $profile_name = time() . '_' . $pic->getClientOriginalName();
                $pic->storeAs('/public/pic', $profile_name); //store in laravel 
                $get_data['profile_pic'] = $profile_name;
            }
            if ($request->hasFile('logo')) {
                $pic = $request->file('logo');
                $profile_name = time() . '_' . $pic->getClientOriginalName();
                $pic->storeAs('/public/pic', $profile_name); //store in laravel 
                $get_data['logo'] = $profile_name;
            }

            return $get_data;
        }
   
        if ($request->type == "employer") {

            $validate_field["f_name"] = "required";
            $validate_field["company_name"] = 'required';
            $validate_field["office_email"] = "required|email|unique:user_profile,email,$id,user_id";
            $validate_field["website"] = 'required';

            $get_data['company_name'] = $request->company_name;
            $get_data['email'] = $request->office_email;
            $get_data['website'] = $request->website;
            $get_data['company_status'] = 'active';
            
        } else {

            $validate_field["f_name"] = "required";
            $validate_field["gender"] = "required|in:male,female,others";

            $get_data['gender'] = $request->gender;
            $get_data['date_of_birth'] = $request->dob;
        }

        $validation = Validator::make($request->all(), $validate_field);
        if ($validation->fails()) {
            $data['error'] = $validation->errors();
            $data['msg'] = 'error';
            return $data;
        }



        $exist = DB::table('user_profile')->where(['user_id' => $id])->exists();
        if ($exist) {
            $data_with_files = manageFiles($request, $get_data);
            DB::table('user_profile')->where(['user_id' => $id])->update($data_with_files);
            $data['msg'] = "update Successfully";
        } else {

            $data_with_files = manageFiles($request, $get_data);
            DB::table('user_profile')->insert($data_with_files);
            $data['msg'] = "Insert Successfully";
          
        }

        if($request->type == "employer")
        {
            User::whereId($id)->update(['user_type' => 'employer']);
        }

        // $data['url'] = route('landing_page');
        return $data;
    }
    function verfyUserForPost()
    {
        
        if (Auth::check()) {
            if (Auth::user()->user_type == "employer") {
                return redirect()->route('employers.dashboard');
            }
            return $this->showProfile('employer');
        }

        return redirect()->route('users.signup');
    }
}
