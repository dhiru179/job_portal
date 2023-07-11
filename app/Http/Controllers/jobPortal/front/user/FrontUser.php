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
        $boards = DB::table('board_university')->get();
        return view('job_portal.front.user.create_resume', compact(['user', 'qualifications', 'boards']));
    }

    function createResumeStore(Request $request)
    {
        $slug = $request->slug;
        switch ($slug) {
            case 'basic_info':
                return $this->storeBasicInfo($request);
                break;
            case 'resume_headlines':
                return $this->storeHeadlines($request);
                break;
            case 'resume_skills':
                return $this->storeSkills($request);
                break;
            case 'educations':
                return $this->storeEducation($request);
                break;
            case 'projects':
                return $this->storeProject($request);
                break;
            case 'social_profile':
                return $this->storeSocialProfile($request);
                break;
            case 'resume_profile_summary':
                return $this->storeProfileSummary($request);
                break;
            case 'upload_resume':
                return $this->uploadResume($request);
                break;
            default:
                # code...
                break;
        }
        return $request->all();
    }
    function storeBasicInfo($request)
    {

        // return $request->all();
        $id = auth()->user()->id;
        $get_data = [
            'user_id' => $id,
            'name' => $request->user,
            'gender' => $request->gender,
            'email' => $request->email,
            'phone_1' => $request->phone_1,
            'phone_2' => $request->phone_2,
            'marital _status' => $request->marital,
            'date_of_birth' => $request->dob,
        ];
        $get_id = DB::table('users_personal_details')->insertGetId($get_data);
        $address = $request->address;
        $language = $request->language;
        $bulk_address = [];
        $bulk_language = [];
        if (sizeof($address) > 0) {
            for ($i = 0; $i < sizeof($address); $i++) {
                $bulk_address[] = [
                    'personal_details_id' => $get_id,
                    'address_type' => $request->address_type[$i],
                    'address' => $request->address[$i],
                    'pincode' => $request->pincode[$i],
                ];
            }
            DB::table('user_address')->insert($bulk_address);
        }
        if (sizeof($language) > 0 && $language[0] != null) {
            for ($i = 0; $i < sizeof($language); $i++) {
                $bulk_language[] = [
                    'personal_details_id' => $get_id,
                    'name' => $request->language[$i],
                    'speak' => true,
                    'read' => true,
                    'write' => true
                    // 'speak' => $request->speak[$i],
                    // 'read' => $request->read[$i],
                    // 'write' => $request->write[$i]

                ];
            }
            DB::table('language')->insert($bulk_language);
        }
        return redirect()->back()->with('message', 'Save Success');
    }

    function storeHeadlines($request)
    {
        $id = auth()->user()->id;
        $get_data = [
            'user_id' => $id,
            'resume_headlines' => $request->resume_headline,
        ];

        DB::table('users_resume_headlines')->insert($get_data);
        return redirect()->back()->with('message', 'Save Success');
    }

    function storeSkills($request)
    {
        $skills = $request->skills;
        $id = auth()->user()->id;
        $bulk_skills = [];
        if (sizeof($skills) > 0 && $skills[0] != null) {
            for ($i = 0; $i < sizeof($skills); $i++) {
                $bulk_skills[] = [
                    'user_id' => $id,
                    'skills' => $request->skills[$i],
                ];
            }
            DB::table('users_skills')->insert($bulk_skills);
        }
        return redirect()->back()->with('message', 'Save Success');
    }

    function storeEducation($request)
    {
        //  return empty($request->session_end[0])==true?"dsd":$request->session_end[0];

        $id = auth()->user()->id;
        $get_data = [];
        if (is_array($request->qualification) && count($request->qualification) > 0) {
            for ($i = 0; $i < count($request->qualification); $i++) {
                $get_data[] = [
                    'user_id' => $id,
                    'qualification_id' => $request->qualification[$i],
                    'board_university_id' => $request->board[$i],
                    'start_year' => $request->session_start[$i],
                    'end_year' => $request->session_end[$i],
                    'marks_grade' => $request->marks[$i],
                    'total_marks' => $request->total_marks[$i],
                    'course' => $request->course[$i],
                    'specialization' => $request->specialization[$i],
                ];
            }
            DB::table('users_education_profile')->insert($get_data);
        }
        return redirect()->back()->with('message', 'Save Success');
    }

    function storeProject($request)
    {

        $id = auth()->user()->id;
        $get_data = [];
        if (is_array($request->project_title) && count($request->project_title) > 0) {
            for ($i = 0; $i < count($request->project_title); $i++) {
                $get_data[] = [
                    'user_id' => $id,
                    'project_title' => $request->project_title[$i],
                    'project_time' => $request->time_taken[$i],
                    'duration_qty' => $request->duration_qty[$i],
                    'about_project' => $request->about_project[$i],
                ];
            }
            DB::table('users_project')->insert($get_data);
        }
        return redirect()->back()->with('message', 'Save Success');
    }

    function storeSocialProfile($request)
    {

        $id = auth()->user()->id;
        $get_data = [];
        if (is_array($request->social_url) && count($request->social_url) > 0) {
            for ($i = 0; $i < count($request->social_url); $i++) {
                $get_data[] = [
                    'user_id' => $id,
                    'social_name' => $request->social_name[$i],
                    'url' => $request->social_url[$i],

                ];
            }
            DB::table('users_social_profiles')->insert($get_data);
        }
        return redirect()->back()->with('message', 'Save Success');
    }

    function storeProfileSummary($request)
    {
        $id = auth()->user()->id;
        $get_data = [
            'user_id' => $id,
            'profile_summary' => $request->resume_profile_summary,
        ];

        DB::table('users_resume_profile_summary')->insert($get_data);
        return redirect()->back()->with('message', 'Save Success');
    }


    function uploadResume($request)
    {
        $request->validate([
            'resume_files' => 'required|mimes:csv,pdf,docs|max:2048'
            ]);
      
        if ($request->hasFile('resume_files')) {
            $id = auth()->user()->id;
            $files = $request->file('resume_files');
            $file_name = $id.'_'.time().'_'.$files->getClientOriginalName();
            $get_data = [
                'user_id' => $id,
                'resume_files' => $file_name
            ];
            DB::table('user_resume_files')->insert($get_data);
            $files->storeAs('/public/users_resume', $file_name); //store in laravel 
        }

        return redirect()->back()->with('message', 'Save Success');
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
