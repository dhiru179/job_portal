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
    function commonCvResumeTable()
    {
        $id = auth()->user()->id;
        $user = DB::table('users_basic_info')
            ->select('users_basic_info.*', 'users_address.id as address_id', 'users_address.address_first', 'users_address.address_second', 'users_address.state', 'users_address.city', 'users_address.pincode')
            ->join('users_address', 'users_basic_info.user_id', 'users_address.user_id')
            ->where(['users_basic_info.user_id' => $id])
            ->get()->first();

        $edu = DB::table('users_education_profile')->where(['user_id' => $id])->get();
        $exp = DB::table('users_work_experience')->where(['user_id' => $id])->get();
        $job_loc = DB::table('users_job_locations')
            ->select('users_job_locations.*', 'india_city.name')
            ->join('india_city', 'users_job_locations.location_id', 'india_city.id')
            ->where(['user_id' => $id])->get();
        $user_skill = DB::table('users_skills')->where(['user_id' => $id])->get();
        $social = DB::table('users_social_url')->where(['user_id' => $id])->get();
        $files = DB::table('users_files')->where(['user_id' => $id])->get();
        $qualifications = DB::table('education_standard')->get();
        $city = DB::table('india_city')->get();
        return $compact = compact(['user', 'qualifications', 'edu', 'city', 'job_loc', 'user_skill', 'exp', 'files']);
    }
    function viewMyCv()
    {
        $compact = $this->commonCvResumeTable();
        return view('job_portal.front.user.my_cv', $compact);
    }
    function createResume()
    {
        $compact = $this->commonCvResumeTable();
        return view('job_portal.front.user.create_resume', $compact);
    }

    function createResumeStore(Request $request)
    {


        $data = [
            'status' => true,
            'slug' => $request->slug,
            'error' => "",
            'msg' => "hfh",
            'update_id' => "",
            'id' => auth()->user()->id,
        ];

        // return [$request->all(), $data];
        switch ($request->slug) {
            case 'basic_info':
                return $this->storeBasicInfo($data, $request);
                break;
            case 'work_experience':
                return $this->storeWorkExperience($data, $request);
                break;
            case 'educations':
                return $this->storeUserEducation($data, $request);
                break;

            default:
                # code...
                break;
        }

        $data['msg'] = "slug not match";
        return $data;
        return $request->all();
    }
    function storeBasicInfo($data, $request)
    {
        // return $request->all();
        // $is_basic_ = DB::table('users_basic_info')->where(['user_id' => $data['id']])->get();
        // if (count($is_resume_exist) > 0) {
        //     $data['users_basic_info_id'] = $is_resume_exist[0]->id;
        // }
        $validation = Validator::make(
            $request->all(),
            [
                "fname" => 'required',
                // "mname" => 'required',
                "lname" => 'required',
                "email" => 'required|email',
                "phone_1" => 'required',
                // "phone_2"=>'required',
                'gender' => 'required',
                "dob" => 'required',
                "marital" => 'required',
                "state" => 'required',
                "city"   => 'required',
                "pincode" => 'required|numeric|min:6',
                "address_1" => 'required',
                "about" => 'required',
                'resume_status' => 'required',
                'nationality' => 'required',
            ],
            [
                // 'language.required' => 'Select at least one language',

            ]
        );
        if ($validation->fails()) {
            $data['error'] = $validation->errors();
            return $data;
        }

        $basic_info = [
            'user_id' => $data['id'],
            'f_name' => $request->fname,
            'm_name' => $request->mname,
            'l_name' => $request->lname,
            'gender' => $request->gender,
            'email' => $request->email,
            'phone_1' => $request->phone_1,
            'phone_2' => $request->phone_2,
            'marital_status' => $request->marital,
            'date_of_birth' => $request->dob,
            'about_self' => $request->about,
            'nationality' => $request->nationality,
            'access_info' => $request->resume_status,

        ];

        $basic_address = [
            'user_id' => $data['id'],
            'address_first' => $request->address_1,
            'address_second' => $request->address_2,
            'state' => $request->state,
            'city' => $request->city,
            'pincode' => $request->pincode,
        ];

        if ($request->basic_info_id > 0 && $request->user_address_id > 0) {
            //update
            // return $basic_info;
            DB::table('users_basic_info')->where(['id' => $request->basic_info_id])->update($basic_info);
            DB::table('users_address')->where(['id' => $request->user_address_id])->update($basic_address);
            $data['msg'] = 'update Success';
        } else {
            //insert
            $get_id = DB::table('users_basic_info')->insertGetId($basic_info);
            DB::table('users_address')->insert($basic_address);
            $data['msg'] = 'Save Success';
            $data['basic_info_id'] = $get_id;
        }


        return $data;
        // return redirect()->back()->with('message', 'Save Success');
    }



    function storeUserEducation($data, $request)
    {
        //  return empty($request->session_end[0])==true?"dsd":$request->session_end[0];
        $validation = Validator::make(
            $request->all(),
            [
                'qualification.*' => 'required',
                'start_year.*' => 'required',
                'institute_name.*' => 'required',
                'passing_year.*' => 'required',
                'board.*' => 'required',
            ],
            [
                'qualification.required' => 'This field required',

            ]
        );
        if ($validation->fails()) {
            $data['error'] = $validation->errors();
            return $data;
        }

        $insert_data = [];
        $update_data = [];

        if (is_array($request->qualification) && count($request->qualification) > 0) {
            for ($i = 0; $i < count($request->qualification); $i++) {
                $get_data = [
                    'user_id' => $data['id'],
                    'education_standard_id' => $request->qualification[$i],
                    'board_university' => $request->board[$i],
                    'institute_name' => $request->institute_name[$i],
                    'start_year' => $request->start_year[$i],
                    'passing_year' => $request->passing_year[$i],
                    // 'marks_grade' => $request->marks[$i],
                    // 'total_marks' => $request->total_marks[$i],
                    'course' => $request->course[$i],
                    'specialization' => $request->specialization[$i],
                ];
                if (!empty($request->education_id[$i])) {
                    $update_data[$request->education_id[$i]] = $get_data;
                } else {
                    $insert_data[] = $get_data;
                }
            }
        }


        if (count($update_data) > 0) {
            foreach ($update_data as $id => $value) {
                DB::table('users_education_profile')->where(['id' => $id])->update($value);
            }
            $data['msg'] = "update success";
        }
        if (count($insert_data) > 0) {
            DB::table('users_education_profile')->insert($insert_data);
            $data['msg'] = "insert success";
        }

        // return [$get_data, $insert_data, $update_data];


        return $data;
        // return redirect()->back()->with('message', 'Save Success');
    }


    function storeWorkExperience($data, $request)
    {
        // $validation = Validator::make(
        //     $request->all(),
        //     [
        //         'salary'=>'required',
        //         'in_salary'=>'required',
        //         // 'qualification' => 'required|array'
        //     ],
        //     [
        //         // 'qualification.required' => 'This field required',

        //     ]
        // );
        // if ($validation->fails()) {
        //     $data['error'] = $validation->errors();
        //     return $data;
        // }
        // return $request->all();


        function manageFiles($request, $data)
        {
            if ($request->hasFile('users_resume') || $request->hasFile('profile_pic')) {

                $files = $request->file('users_resume');
                $pic = $request->file('profile_pic');
                $file_name = time() . '_' . $files->getClientOriginalName();
                $profile_name = time() . '_' . $pic->getClientOriginalName();
                $get_data = [
                    [
                        'user_id' => $data['id'],
                        'files' => $file_name,
                        'type' => 'files',
                    ],
                    [
                        'user_id' => $data['id'],
                        'files' => $profile_name,
                        'type' => 'pic',
                    ],
                ];
                $check_user_file = DB::table('users_files')->where(['user_id' => $data['id'], 'type' => 'files'])->get();
                $check_user_pic = DB::table('users_files')->where(['user_id' => $data['id'], 'type' => 'pic'])->get();
                if (count($check_user_file) > 0) {
                    //update
                } else if (count($check_user_pic) > 0) {
                    //update
                } else {
                    //insert
                    DB::table('users_files')->insert($get_data);
                    $files->storeAs('/public/files', $file_name); //store in laravel 
                    $pic->storeAs('/public/pic', $profile_name); //store in laravel 
                }
            }
            $data['msg'] = "success";
            return $data;
        }
        function manageExperience($request, $data)
        {
            $insert_data = [];
            $update_data = [];
            if (is_array($request->company_name) && count($request->company_name) > 0) {
               
                for ($i = 0; $i < count($request->company_name); $i++) {

                    $get_data = [
                        'user_id' => $data['id'],
                        'is_working' => $request->current_working[$i],
                        'work_type' => $request->working_type[$i],
                        'company_name' => $request->company_name[$i],
                        'desigination' => $request->desigination[$i],
                        'job_city' => $request->job_city[$i],
                        'joining_data' => $request->start_date[$i],
                        'last_date' => $request->end_date[$i],
                        'skills' => json_encode($request->job_skill[$i]),
                        // 'skills' => json_encode($job_skills),
                        'profile_desc' => $request->job_desc[$i],
                    ];
                    if (!empty($request->exp_id[$i])) {
                        $update_data[$request->exp_id[$i]] = $get_data;
                    } else {
                        $insert_data[] = $get_data;
                    }
                }
            }
            if (count($update_data) > 0) {
                foreach ($update_data as $id => $value) {
                    DB::table('users_work_experience')->where(['id' => $id])->update($value);
                }
                $data['msg'] = "update success";
            }
            if (count($insert_data) > 0) {
                DB::table('users_work_experience')->insert($insert_data);
                $data['msg'] = "insert success";
            }
            return $data;
        }
        function manageJobLocation($request, $data)
        {
     
            if (is_array($request->jobLocation) && count($request->jobLocation) > 0) {

                function insertLocation($job_loctaions, $data)
                {
                    $add_locations = [];
                    foreach ($job_loctaions as $value) {
                        $add_locations[] = [
                            'user_id' => $data['id'],
                            'location_id' => $value,
                        ];
                    }
                    return $add_locations;
                }


                $exist_loc = [];
                $is_exist_loc = DB::table('users_job_locations')->where(['user_id' => $data['id']])->get();
                foreach ($is_exist_loc as $key => $value) {
                    $exist_loc[] = $value->location_id;
                }

                if (count($is_exist_loc) > 0) {
                    //update and insert or delete
                    $insert_id = array_diff($request->jobLocation, $exist_loc); //insert id
                    $delete_id = array_diff($exist_loc, $request->jobLocation); //delete_id
                    if (count($insert_id) > 0) {
                        DB::table('users_job_locations')->insert(insertLocation($insert_id, $data));
                        $data['loc_update'] = "loc update";
                    }
                    if (count($delete_id) > 0) {

                        foreach (insertLocation($delete_id, $data) as $key => $value) {
                            DB::table('users_job_locations')->where($value)->delete();
                        }
                    }
                } else {
                    //insert
                    DB::table('users_job_locations')->insert(insertLocation($request->jobLocation, $data));
                    $data['msg'] = "insert";
                }
            }
            $data['msg'] = "success job location";
            return $data;
        }
        function manageUserSkill($request, $data)
        {

            if (is_array($request->user_skill) && count($request->user_skill) > 0) {

                function insertUserSkill($user_skill, $data)
                {
                    $skills = [];
                    foreach ($user_skill as $key => $value) {
                        $skills[] = [
                            'user_id' => $data['id'],
                            'skills' => $value,
                        ];
                    }

                    return $skills;
                }


                $exist_skill = [];
                $is_exist_skill = DB::table('users_skills')->where(['user_id' => $data['id']])->get();

                if (count($is_exist_skill) > 0) {
                    foreach ($is_exist_skill as $key => $value) {
                        $exist_skill[] = $value->skills;
                    }
                    //update and insert or delete
                    $insert_id = array_diff($request->user_skill, $exist_skill); //insert id
                    $delete_id = array_diff($exist_skill, $request->user_skill); //delete_id
                    if (count($insert_id) > 0) {

                        DB::table('users_skills')->insert(insertUserSkill($insert_id, $data));
                        $data['msg'] = "update skill";
                    }
                    if (count($delete_id) > 0) {

                        foreach (insertUserSkill($delete_id, $data) as $key => $value) {
                            DB::table('users_skills')->where($value)->delete();
                        }
                        $data['msg'] = "delete skill";
                    }
                } else {
                    //insert
                    DB::table('users_skills')->insert(insertUserSkill($request->user_skill, $data));
                    $data['msg'] = "insert";
                }
            }
            $data['msg'] = "success user skill";
            return $data;
        }
        function manageSocialUrl($request, $data)
        {
            if (is_array($request->social_url) && count(array_filter($request->social_url)) > 0) {
                function socialUrl($request_url, $data)
                {
                    $social_url = [];
                    foreach ($request_url as $key => $value) {
                        if ($value != "") {
                            $social_url[] = [
                                'user_id' => $data['id'],
                                'social_url' => $value
                            ];
                        }
                    }
                    return $social_url;
                }
                $exist_url = [];
                $check = DB::table('users_social_url')->where(['user_id' => $data['id']])->get();
                if (count($check) > 0) {
                    foreach ($check as $key => $value) {
                        $exist_url[] = $value->social_url;
                    }
                    //update and insert or delete
                    $insert_id = array_diff($request->social_url, $exist_url); //insert id
                    $delete_id = array_diff($exist_url, $request->social_url); //delete_id
                    if (count($insert_id) > 0) {
                        DB::table('users_social_url')->insert(socialUrl($insert_id, $data));
                        $data['msg'] = "update url";
                    }
                    if (count($delete_id) > 0) {

                        foreach (socialUrl($delete_id, $data) as $key => $value) {
                            DB::table('users_social_url')->where($value)->delete();
                        }
                        $data['msg'] = "delete url";
                    }
                } else {
                    DB::table('users_social_url')->insert(socialUrl($request->social_url, $data));
                    $data['msg'] = "insert url";
                }
            }
        }
        function updateBasicInfo($request, $data)
        {
            // if ($request->basic_info_id > 0) {
            $basic_info = [
                'has_experience' => $request->get('has_experience', 'no'),
                'last_salary' => $request->salary,
                'salary_in' => !empty($request->salary) ? $request->in_salary : "",
                'published' => 'yes'
            ];

            DB::table('users_basic_info')->where(['user_id' => $data['id']])->update($basic_info);
            // }
        }

        switch ($request->resume_slug) {
            case 'user_files':
                return  manageFiles($request, $data);
                break;
            case 'job_location':
                return manageJobLocation($request, $data);
                break;
            case 'user_skill':
                return manageUserSkill($request, $data);
                break;
            case 'experience':
                return manageExperience($request, $data);
                break;
            default:
                manageExperience($request, $data);
                manageJobLocation($request, $data);
                manageUserSkill($request, $data);
                manageSocialUrl($request, $data);
                updateBasicInfo($request, $data);
                $data['my_cv'] = route('users.my-cv');
                return $data;
                break;
        }
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
            ->select('emp_job_post.*', 'user_apply_jobs.job_status')
            ->where(['users.id' => $user_id])
            ->get();
        $skills  = DB::table('job_skills')->get();


        return view('job_portal.front.user.list_apply_job', compact(['result']));
    }
}
