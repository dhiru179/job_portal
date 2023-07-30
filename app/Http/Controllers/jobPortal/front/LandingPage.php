<?php

namespace App\Http\Controllers\jobPortal\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Query\JoinClause;

class LandingPage extends Controller
{
    public function landingPage(Request $request)
    {
        $skill = DB::table('job_skills')
            ->select(DB::raw('GROUP_CONCAT(job_skills.skill) as skill,job_post_id'))
            ->groupBy('job_skills.job_post_id');

        $city_job_post = DB::table('emp_job_post_city')
            ->join('cities', 'emp_job_post_city.location_id', 'cities.id')
            ->select(DB::raw('GROUP_CONCAT(cities.name) as job_post_city,emp_job_post_city.job_post_id'))
            ->groupBy('emp_job_post_city.job_post_id');

        $join_query = DB::table('emp_job_post')
            ->join('user_profile','emp_job_post.user_id','user_profile.user_id')
            ->joinSub($skill, 'skills', function (JoinClause  $query) {
                $query->on('emp_job_post.id', '=', 'skills.job_post_id');
            })
            ->joinSub($city_job_post, 'post_city', function (JoinClause  $query) {
                $query->on('emp_job_post.id', '=', 'post_city.job_post_id');
            });
        
        if ($request->keyword != "") {
            $join_query->orWhere('emp_job_post.job_title', 'like', '%' . $request->keyword . '%');
            $join_query->orWhere('skills.skill', 'like', '%' . $request->keyword . '%');
            $join_query->orWhere('emp_job_post.job_descriptions', 'like', '%' . $request->keyword . '%');
        }
        if(is_array($request->emp_id) && count($request->emp_id) > 0)
        {
            $join_query->whereIn('emp_job_post.emp_id',$request->emp_id);
        }
        $result = $join_query->get();
       
        return view('job_portal.front.landing', compact(['result']));
    }
}
