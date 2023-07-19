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
        $id = auth()->user()->id;
        $user = User::find($id);
        $qualifications = DB::table('education_standard')->get();
        $city = DB::table('india_city')->get();
        return view('job_portal.front.user.create_resume', compact(['user', 'qualifications', 'city']));
    }

    function createResumeStore(Request $request)
    {
        $slug = $request->slug;

        $data = [
            'status' => true,
            'slug' => $request->slug,
            'error' => "",
            'msg' => "hfh",
            'update_id' => "",
            'id' => auth()->user()->id,
        ];

        // return [$request->all(), $data];
        switch ($slug) {
            case 'basic_info':
                return $this->storeBasicInfo($data, $request);
                break;
            case 'work_experience':
                return $this->storeWorkExperience($data, $request);
                break;
            case 'educations':
                return $this->storeEducation($data, $request);
                break;

            default:
                # code...
                break;
        }
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
        if ($data['update_id'] > 0) {
            //update
            // DB::table('users_basic_info')->where(['id' => $data['users_basic_info_id']])->update($basic_info);
            // $data['msg'] = 'update Success';
        } else {
            //insert
            $get_id = DB::table('users_basic_info')->insertGetId($basic_info);
            DB::table('users_address')->insert($basic_address);
            $data['msg'] = 'Save Success';
        }


        return $data;
        // return redirect()->back()->with('message', 'Save Success');
    }



    function storeEducation($data, $request)
    {
        //  return empty($request->session_end[0])==true?"dsd":$request->session_end[0];
        $validation = Validator::make(
            $request->all(),
            [
                'qualification.*' => 'required|array',
                'start_year.*' => 'required|array',
                'institute_name.*' => 'required|array',
                'passing_year.*' => 'required|array',
                'board.*' => 'required|array',
            ],
            [
                'qualification.required' => 'This field required',

            ]
        );
        if ($validation->fails()) {
            $data['error'] = $validation->errors();
            return $data;
        }
        return $request->all();
        $get_data = [];
        if (is_array($request->qualification) && count($request->qualification) > 0) {
            for ($i = 0; $i < count($request->qualification); $i++) {
                $get_data[] = [
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
            }
            if ($data['update_id'] > 0) {
                //update

                $data['msg'] = "update success";
            } else {

                DB::table('users_education_profile')->insert($get_data);
                $data['msg'] = "insert success";
            }
            return $data;
        }
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
        $get_data = [];
        $add_locations = [];
        $users_skills = [];
        $users_job_skills = [];
        $job_loctaions = $request->jobLocation;
        foreach ($job_loctaions as $value) {
            $add_locations[] = [
                'user_id' => $data['id'],
                'location_id' => $value,
            ];
        }
        // DB::table('users_job_locations')->insert($add_locations);

        if (is_array($request->addskills) && count($request->addskills) > 0) {
            for ($i = 0; $i < count($request->addskills); $i++) {
                $users_skills[] = [
                    'user_id' => $data['id'],
                    'skill' => $request->addskills[$i],
                ];
            }
        }

        $basic_info = [
            'has_experience' => $request->get('has_experience', 'no'),
            'salary' => $request->salary,
            'in_salary' => $request->in_salary,
        ];
        // DB::table('users_basic_info')->where(['id' => 1])->update($basic_info);
        if ($request->hasFile('resume_files')) {
            $files = $request->file('users_resume');
            $pic = $request->file('profile_pic');
            $file_name = time() . '_' . $files->getClientOriginalName();
            $profile_name = time() . '_' . $pic->getClientOriginalName();
            $get_data = [
                [
                    'user_id' => $data['id'],
                    'resume_files' => $file_name,
                    'type' => 'files',
                ],
                [
                    'user_id' => $data['id'],
                    'resume_files' => $profile_name,
                    'type' => 'pic',
                ],
            ];
            DB::table('users_files')->insert($get_data);
            $files->storeAs('/public/users_files', $file_name); //store in laravel 
            $pic->storeAs('/public/users_files', $profile_name); //store in laravel 
        }

        if (is_array($request->company_name) && count($request->company_name) > 0) {
            $job_skill = [];
            for ($i = 0; $i < count($request->company_name); $i++) {
                    foreach ($request->job_skill[$i] as $key => $value) {
                       $job_skill[] = [
                        'job_skills'=>$value,
                       ];
                    }
                    $get_data[] = [
                    'user_id' => $data['id'],
                    'is_working' => $request->current_working[$i],
                    'work_type' => $request->working_type[$i],
                    'company_name' => $request->company_name[$i],
                    'desigination' => $request->desigination[$i],
                    'job_city' => $request->job_city[$i],
                    'joining_data' => $request->start_date[$i],
                    'last_date' => $request->end_date[$i],
                    'skills' => json_encode($job_skill),
                    'profile_desc' => $request->job_desc[$i],
                ];
            }
            if ($data['update_id'] > 0) {
                //update

                $data['msg'] = "update success";
            } else {
                return $get_data;
                DB::table('users_work_experience')->insert($get_data);
                $data['msg'] = "insert success";
            }
            return $data;
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
