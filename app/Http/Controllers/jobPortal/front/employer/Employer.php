<?php

namespace App\Http\Controllers\jobPortal\front\employer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Query\JoinClause;

class Employer extends Controller
{

    public function dashboard()
    {

        return view('job_portal.front.employer.dashboard');
    }

    public function jobSeeker()
    {
        $city = DB::table('india_city')->get();
        $job_skill = DB::table('users_skills')->select('skills')->distinct()->get();
        $education = DB::table('education_standard')->get();
        $compact = compact(['city', 'education', 'job_skill']);
        return view('job_portal.front.employer.job_seeker', $compact);
    }



   
}
