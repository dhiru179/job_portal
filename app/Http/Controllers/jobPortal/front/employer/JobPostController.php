<?php

namespace App\Http\Controllers\jobPortal\front\employer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Query\JoinClause;
use App\Http\Requests\JobPostValidation;

class JobPostController extends Controller
{

    private function getUsefullTable($get_tbl = [], $id = false)
    {
        if ($id) {
            $job_post_skill = DB::table('job_skills')->where(['job_post_id' => $id])->get();
            $post = DB::table('emp_job_post')->where(['id' => $id])->get()->first();
            $job_post_city = DB::table('emp_job_post_city')
                ->select('cities.*')
                ->join('cities', 'emp_job_post_city.location_id', 'cities.id')
                ->where(['emp_job_post_city.job_post_id' => $id])
                ->get();
        }
        $education = DB::table('education_standard')->get();
        $countries = DB::table('countries')->get();
        return compact($get_tbl);
    }
    public function jobPost()
    {
        $need_tbl = ['countries', 'education', 'countries'];
        return view('job_portal.front.employer.create_job_post', $this->getUsefullTable($need_tbl));
    }

    public function showJobPost($id)
    {
        $need_tbl = ['countries', 'education', 'countries', 'post', 'job_post_skill', 'job_post_city'];
        $compact =  $this->getUsefullTable($need_tbl, $id);
        return view('job_portal.front.employer.show_job_post', $compact);
    }

    public function modifyJobPost($id)
    {
        $need_tbl = ['countries', 'education', 'countries', 'post', 'job_post_skill', 'job_post_city'];
        return view('job_portal.front.employer.modify_job_post', $this->getUsefullTable($need_tbl, $id));
    }

    public function jobPostCreate(JobPostValidation  $request)
    {
        $data = [
            'status' => true,
            'slug' => $request->slug,
            'url' => "",
            'error' => "",
            'msg' => ""
        ];


        $get_data = [
            'user_id' => auth()->user()->id,
            'job_title' => $request->job_title,
            'no_of_vacancy' => $request->vacancy,
            'min_salary' => $request->min_salary,
            'max_salary' => $request->max_salary,
            'job_descriptions' => $request->description,
            'education_standard_id' => $request->qualification,
            'experience' => $request->experience,
            'gender' => $request->gender,
        ];


        $skill_array = [];
        $job_post_location = [];

        $job_post_id = DB::table('emp_job_post')->insertGetId($get_data);
        foreach ($request->skills  as $key => $value) {
            $skill_array[] = [
                'job_post_id' => $job_post_id,
                'skill' => $value,
            ];
        }

        foreach ($request->job_city as $key => $value) {
            $job_post_location[] = [
                'job_post_id' => $job_post_id,
                'location_id' => $value,
            ];
        }
        if (count($skill_array) > 0) {

            DB::table('job_skills')->insert($skill_array);
        }
        if (count($job_post_location) > 0) {


            DB::table('emp_job_post_city')->insert($job_post_location);
        }

        $data['msg'] = "insert success";


        return $data;
    }

    public function jobPostUpdate(JobPostValidation $request)
    {
        $data = [
            'status' => true,
            'slug' => $request->slug,
            'url' => "",
            'error' => "",
            'msg' => ""
        ];

            $get_data = [
            'user_id' => auth()->user()->id,
            'job_title' => $request->job_title,
            'no_of_vacancy' => $request->vacancy,
            'min_salary' => $request->min_salary,
            'max_salary' => $request->max_salary,
            'job_descriptions' => $request->description,
            'education_standard_id' => $request->qualification,
            'experience' => $request->experience,
            'gender' => $request->gender,
        ];
        function manageLocation($request)
        {
            $job_post_location = [];

            $exist_loc = [];
            $is_exist_loc = DB::table('emp_job_post_city')->where(['job_post_id' => $request->post_id])->get();
            foreach ($is_exist_loc as $key => $value) {
                $exist_loc[] = $value->location_id;
            }
            if (count($exist_loc) > 0) {
                $insert_id = array_diff($request->job_city, $exist_loc); //insert id
                $delete_id = array_diff($exist_loc, $request->job_city); //delete_id
                if (count($insert_id) > 0) {
                    foreach ($insert_id as $key => $value) {
                        $job_post_location[] = [
                            'job_post_id' => $request->post_id,
                            'location_id' => $value,
                        ];
                    }
                    DB::table('emp_job_post_city')->insert($job_post_location);
                }
                if (count($delete_id) > 0) {
                    foreach ($delete_id as $key => $value) {
                        DB::table('emp_job_post_city')->where([
                            'job_post_id' => $request->post_id,
                            'location_id' => $value,
                        ])->delete();
                    }
                }
            }
        }

        function manageSkills($request)
        {
            $skill_array = [];

            $exist_skill = [];
            $is_exist_skill = DB::table('job_skills')->where(['job_post_id' => $request->post_id])->get();
            foreach ($is_exist_skill as $key => $value) {
                $exist_skill[] = $value->skill;
            }
            if (count($exist_skill) > 0) {
                $insert_id = array_diff($request->skills, $exist_skill); //insert id
                $delete_id = array_diff($exist_skill, $request->skills); //delete_id
                if (count($insert_id) > 0) {
                    foreach ($insert_id as $key => $value) {
                        $skill_array[] = [
                            'job_post_id' => $request->post_id,
                            'skill' => $value,
                        ];
                    }
                    DB::table('job_skills')->insert($skill_array);
                }
                if (count($delete_id) > 0) {
                    foreach ($delete_id as $key => $value) {
                        DB::table('job_skills')->where([
                            'job_post_id' => $request->post_id,
                            'skill' => $value,
                        ])->delete();
                    }
                }
            }
        }


        //update
        DB::table('emp_job_post')->where(['id' => $request->post_id])->update($get_data);
        manageLocation($request);
        manageSkills($request);
        $data['msg'] = "update success";

        return $data;
    }

    public function postList()
    {
        $id = auth()->user()->id;
        $skill = DB::table('job_skills')
            ->select(DB::raw('GROUP_CONCAT(job_skills.skill) as skill,job_post_id'))
            ->groupBy('job_skills.job_post_id');
        $city_job_post = DB::table('emp_job_post_city')
            ->join('cities', 'emp_job_post_city.location_id', 'cities.id')
            ->select(DB::raw('GROUP_CONCAT(cities.name) as job_post_city,emp_job_post_city.job_post_id'))
            ->groupBy('emp_job_post_city.job_post_id');

        $post = DB::table('emp_job_post')
            ->joinSub($skill, 'skills', function (JoinClause  $query) {
                $query->on('emp_job_post.id', '=', 'skills.job_post_id');
            })
            ->joinSub($city_job_post, 'post_city', function (JoinClause  $query) {
                $query->on('emp_job_post.id', '=', 'post_city.job_post_id');
            })
            ->where(['emp_job_post.user_id' => $id])->get();

        return view('job_portal.front.employer.posts_list', compact(['post']));
    }
}
