<?php

namespace App\Http\Controllers\jobPortal\front\employer;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class Employer extends Controller
{
    public function dashboard()
    {
        // $users = DB::table('users')
        //         ->join('education')
        return view('job_portal.front.employer.dashboard');
    }
    public function jobPost()
    {
        
        $city = DB::table('india_city')->get();
        return view('job_portal.front.employer.job_post',compact(['city']));
    }

    public function jobPostStore(Request $request)
    {
        $data = [
            'status' => true,
            'slug' => $request->slug,
            'url' => "",
            'error' => "",
            'msg' => ""
        ];
        $validation = Validator::make(
            $request->all(),
            [
                'job_title' => 'required',
                'vacancy' => "required",
                'city' => 'required',
                'min_salary' => 'required|numeric',
                'max_salary' => $request->min_salary > $request->max_salary ? 'required|numeric' : "",
                "skill"    => "required|array",
                "skill.*"  => "required|string|distinct",
                'qualification' => 'required',
                'experience' => 'required',
                'gender' => 'required',
                'description' => 'required'
            ],
            [
                'max_salary.required'    => 'Max salary should be greater than min salary.',
                'skill.required' => 'Select at least one skill',

            ]
        );

        if ($validation->fails()) {
            $data['error'] = $validation->errors();
            return $data;
        }

        $get_data = [
            'emp_id' => auth('employer')->user()->id,
            'job_title' => $request->job_title,
            'location_id' => $request->city,
            // 'url_location	' => $request->job_title,
            'min_salary' => $request->min_salary,
            'max_salary' => $request->max_salary,
            'job_descriptions' => $request->description,
            'qualification' => $request->qualification,
            'experience' => $request->experience,
            'gender' => $request->gender,
        ];
        $skils = $request->skill;
        $skill_array = [];
        $job_post_id = DB::table('emp_job_post')->insertGetId($get_data);
        foreach ($skils as $key => $value) {
            $skill_array[] = [
                'job_post_id' => $job_post_id,
                'skill' => $value,
            ];
        }
        DB::table('job_skills')->insert($skill_array);

        $data['msg'] = "insert success";
        return $data;
    }

    public function postList()
    {
        $emp_id = auth('employer')->user()->id;
        $result = DB::table('emp_job_post')
        ->join('job_skills', 'emp_job_post.id', '=', 'job_skills.job_post_id')
        ->select('emp_job_post.*', DB::raw('group_concat(job_skills.skill) as skill'))
        ->where(['emp_job_post.emp_id'=>$emp_id])
        ->groupBy('emp_job_post.id')
        ->get();
        return view('job_portal.front.employer.posts_list',compact(['result']));
    }
}
