<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobPostValidation extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public $min_salary,$max_salary;
    public function __construct(Request $request)
    {
        
        $this->min_salary = $request->min_salary;
        $this->max_salary = $request->max_salary;
    }
    public function authorize()
    {
        return Auth::check(); 
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'job_title' => 'required',
            'vacancy' => "required",
            'job_city' => 'required|array',
            'job_city.*' => "required|string|distinct",
            'min_salary' => 'required|numeric',
            'max_salary' => ['required','numeric',$this->min_salary < $this->max_salary?'':"not_in:$this->max_salary"],
            "skills"    => "required|array",
            "skills.*"  => "required|string|distinct",
            'qualification' => 'required',
            'experience' => 'required',
            'gender' => 'required',
            'description' => 'required'
        ];
    }
    public function failedValidation(Validator $validator)

    {
        throw new HttpResponseException(response()->json([

            'status'   => false,
          
            'message'   => 'Validation errors',

            'data'      => $validator->errors()

        ]));

    }

    public function messages(){
        return [
            'max_salary.not_in'    => "Max salary should be greater than min salary.",
            'skills.required' => 'Select at least one skill',
            'job_city.required' => "select at least one city",
        ];
    }
}
