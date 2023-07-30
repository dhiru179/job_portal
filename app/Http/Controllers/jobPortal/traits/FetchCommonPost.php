<?php

namespace App\Http\Controllers\jobPortal\traits;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class FetchCommonPost extends Controller
{
    public function getStates(Request $request)
    {
        $country_id = $request->country_id;
        $states = DB::table('states')->where(['country_id' => $country_id])->get();
        $data = [
            'status' => true,
            'data' => $states,
            'slug' => $request->slug,
            'error' => ""
        ];
        return $data;
    }
    public function getCities(Request $request)
    {
        $state_id = $request->state_id;
        $states = DB::table('cities')->where(['state_id' => $state_id])->get();
        $data = [
            'status' => true,
            'data' => $states,
            'slug' => $request->slug,
            'error' => ""
        ];
        return $data;
    }
}
