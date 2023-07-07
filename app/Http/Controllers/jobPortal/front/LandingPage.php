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

        $join_query = DB::table('emp_job_post')
            ->select('emp_job_post.*', 'skills.skill', 'employers.company_name', 'user_apply_jobs.user_id', 'user_apply_jobs.job_status')
            ->join('employers', 'emp_job_post.emp_id', 'employers.id')
            ->joinSub($skill, 'skills', function (JoinClause  $query) {
                $query->on('emp_job_post.id', '=', 'skills.job_post_id');
            })
            ->leftJoin('user_apply_jobs', 'emp_job_post.id', '=', 'user_apply_jobs.job_post_id');

        $employers = DB::table('employers')->distinct()->limit(5)->get();
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
        return view('job_portal.front.landing', compact(['result', 'employers',]));
    }
}
