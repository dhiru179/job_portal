<?php

namespace App\Http\Controllers\jobPortal\front\user;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class FrontUser extends Controller
{
    public function index()
    {
        return view('job_portal.front.user.index');
    }
    function createResume()
    {
        return view('job_portal.front.user.create_resume');
    }
    function createProfile()
    {
        $user = User::all()[0];
        return view('job_portal.front.user.create_profile', compact(['user']));
    }
    function createProfileSave(Request $request)
    {
        $data = [
            'status' => true,
            'slug' => $request->slug,
            'error' => "",
            'msg' => "insert success",
            'url'=>""
        ];
        $validation = Validator::make($request->all(), [
            'user' => 'required',
            'dob' => 'required',
            'gender' => 'required'
        ]);
        if ($validation->fails()) {
            $data['error'] = $validation->errors();
            return $data;
        }
        $get_data = [
            'name' => $request->user,
            'phone' => $request->phone,
            'gender' => $request->gender,
            'date_of_birth' => $request->dob,
            'address' => $request->address,
        ];
        User::where('id', $request->user_id)->update($get_data);
        $data['url'] = route('landing_page');
        return $data;
    }
    function uploadResume()
    {
    }
    function applyJob(Request $request)
    {

        $data = [
            'status' => true,
            'slug' => $request->slug,
            'url' => "",
            'error' => "",
        ];
        $get_data = [
            'emp_id' => $request->emp_id,
            'job_post_id' => $request->post_id,
            'user_id' => $request->user_id,
            'job_status' => $request->job_status
        ];
        $result = DB::table('user_apply_jobs')->where(
            [
                'emp_id' => $request->emp_id,
                'job_post_id' => $request->post_id,
                'user_id' => $request->user_id,
            ]
        )->get();
        if (count($result) > 0) {
            DB::table('user_apply_jobs')->where(['id' => $result[0]->id])->update(['job_status' => $request->job_status]);
            return $data;
        }
        DB::table('user_apply_jobs')->insert($get_data);

        return $data;
    }

    function listApplyJob()
    {
        $user_id = auth()->user()->id;
        $result = DB::table('user_apply_jobs')
            ->join('employers', 'user_apply_jobs.emp_id', '=', 'employers.id')
            ->join('emp_job_post', 'user_apply_jobs.job_post_id', '=', 'emp_job_post.id')
            ->join('users', 'user_apply_jobs.user_id', '=', 'users.id')
            ->select('emp_job_post.*', 'user_apply_jobs.job_status ')
            ->where(['users.id' => $user_id])
            ->get();
        $skills  = DB::table('job_skills')->get();


        return view('job_portal.front.user.list_apply_job', compact(['result']));
    }
}
