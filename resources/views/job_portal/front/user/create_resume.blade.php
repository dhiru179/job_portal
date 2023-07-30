@extends('job_portal.front.layout.layout')
@section('title', 'create-resume')
{{-- @section('dash', 'active') --}}
@section('layout')
    <style>
        /* Mark input boxes that gets an error on validation: */
        input.invalid {
            background-color: #ffdddd;
        }


        /* Make circles that indicate the steps of the form: */
        .step {
            height: 25px;
            width: 25px;
            margin: 0 2px;
            background-color: #bbbbbb;
            border: none;
            /* border-radius: 50%; */
            display: inline-block;
            opacity: 0.5;
        }

        /* Mark the active step: */
        .step.active1 {
            opacity: 1;
        }

        /* Mark the steps that are finished and valid: */
        .step.finish {
            background-color: #04AA6D;
        }
    </style>
    <div class="container col-8 offset-2">
        <!-- Circles which indicates the steps of the form: -->
        <div class=" my-3 d-flex align-items-center justify-content-center">
            <span class="step mx-5"></span>
            <span class="step mx-5"></span>
            <span class="step mx-5"></span>
            <span class="step mx-5"></span>
        </div>

        <div class="col-12">

            <div class="item d-none">
                <form class="row d-flex " action="">

                    <h5 class="text-center p-3">Personal Details</h5>
                    <input type="hidden" name="slug" value="basic_info">
                    <input type="hidden" name="basic_info_id"
                        value="{{ !empty($user->basic_info_id) ? $user->basic_info_id : '' }}">
                    <input type="hidden" name="user_address_id"
                        value="{{ !empty($user->user_address_id) ? $user->user_address_id : '' }}">
                    <div class="mb-3 col-4">

                        <input type="text" name="fname" onkeydown="return /[a-z]/i.test(event.key)"
                            value="{{ !empty($user->f_name) ? $user->f_name : '' }}" id="fname" class="form-control"
                            placeholder="First Name*">
                    </div>
                    <div class="mb-3 col-4">

                        <input type="text" name="mname" onkeydown="return /[a-z]/i.test(event.key)"
                            value="{{ !empty($user->m_name) ? $user->m_name : '' }}" id="mname" class="form-control"
                            placeholder="Middle Name">
                    </div>
                    <div class="mb-3 col-4">

                        <input type="text" name="lname" onkeydown="return /[a-z]/i.test(event.key)"
                            value="{{ !empty($user->l_name) ? $user->l_name : '' }}" id="lname" class="form-control"
                            placeholder="Last Name">
                    </div>
                    <div class="mb-3">

                        <input name="address_1" class="form-control"
                            value="{{ !empty($user->address_first) ? $user->address_first : '' }}" id="address_1"
                            placeholder="Address line 1*">
                    </div>
                    <div class="mb-3">

                        <input name="address_2" class="form-control"
                            value="{{ !empty($user->address_second) ? $user->address_second : '' }}" id="address_2"
                            placeholder="Address line 2">
                    </div>
                    <div class="mb-3 col-4">
                        {{-- <div class="">
                            <input type="text" class="form-select search-select" placeholder="select country">
                        </div> --}}

                        <select class="form-select country" name="" id="country" step="0">
                            <option class="text-muted" value="">select country</option>
                            @foreach ($countries as $country)
                                @if (!empty($user->country_id) && $country->id == $user->country_id)
                                    <option selected value="{{ $country->id }}">{{ $country->name }}</option>
                                @endif
                                <option value="{{ $country->id }}">{{ $country->name }}</option>
                            @endforeach
                        </select>

                    </div>
                    <div class="mb-3 col-4">
                        <select name="" id="state" step="0" class="form-select state">
                            @if (!empty($user->state_id))
                                @foreach ($states as $state)
                                    @if ($state->id == $user->state_id)
                                        <option selected value="{{ $state->id }}">{{ $state->name }}</option>
                                    @endif
                                    <option value="{{ $state->id }}">{{ $state->name }}</option>
                                @endforeach
                            @else
                                <option class="text-muted" value="">select states</option>
                            @endif

                        </select>

                    </div>
                    <div class="mb-3 col-4">
                        <select name="city" id="city" step="0" class="form-select city">
                            @if (!empty($user->city_id))
                                @foreach ($cities as $city)
                                    @if ($city->id == $user->city_id)
                                        <option selected value="{{ $city->id }}">{{ $city->name }}</option>
                                    @endif
                                    <option value="{{ $city->id }}">{{ $city->name }}</option>
                                @endforeach
                            @else
                                <option class="text-muted" value="">select city</option>
                            @endif

                        </select>

                    </div>
                    <div class="mb-3 col-4">

                        <input type="text" id="pincode" class="form-control"
                            value="{{ !empty($user->pincode) ? $user->pincode : '' }}" name="pincode"
                            placeholder="pincode*">
                    </div>
                    <div class="mb-3">
                        <input type="text" name="email" id="email"
                            value="{{ !empty($user->resume_email) ? $user->resume_email : auth()->user()->email }}"
                            class="form-control" placeholder="Email">
                    </div>
                    <div class="mb-3 col-6">
                        <input type="text" name="phone_1" id="phone_1" class="form-control"
                            value="{{ !empty($user->resume_phone_1) ? $user->resume_phone_1 : auth()->user()->phone }}"
                            placeholder="phone No*">
                    </div>
                    <div class="mb-3 col-6">
                        {{-- <label for="">phone 2</label>
                        <input type="text" value="" name="phone_2" id="phone_2" class="form-control"> --}}
                    </div>
                    <div class="mb-3 col-6">
                        <label for=""><strong> Resume Settings </strong> <span
                                class="text-danger">*</span></label>
                        <div class="mt-2">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="resume_status" id="resume_public1"
                                    value="public"
                                    {{ !empty($user->access_info) && $user->access_info == 'public' ? 'checked' : 'checked' }}>
                                <label class="form-check-label" for="resume_public1">Public</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="resume_status" id="resume_private1"
                                    value="private"
                                    {{ !empty($user->access_info) && $user->access_info == 'private' ? 'checked' : '' }}>
                                <label class="form-check-label" for="resume_private1">Private</label>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 col-6">
                        <label class="me-3" for=""><strong>Gender</strong><span
                                class="text-danger">*</span></label>
                        <div class="mt-2">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="inlineRadio1"
                                    value="male"
                                    {{ !empty($user->gender) && $user->gender == 'male' ? 'checked' : 'checked' }}>
                                <label class="form-check-label" for="inlineRadio1">Male</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="inlineRadio2"
                                    value="female"
                                    {{ !empty($user->gender) && $user->gender == 'female' ? 'checked' : '' }}>
                                <label class="form-check-label" for="inlineRadio2">Female</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="inlineRadio3"
                                    value="others"
                                    {{ !empty($user->gender) && $user->gender == 'others' ? 'checked' : '' }}>
                                <label class="form-check-label" for="inlineRadio3">Others</label>
                            </div>
                        </div>
                        <span id="gender"></span>
                    </div>
                    <div class="mb-3">

                        <textarea name="about" class="form-control" id="" cols="3" rows="3"
                            placeholder="About Myself...">{{ (!empty($user->resume_about_self) ? $user->resume_about_self : !empty($user->about_self)) ? $user->about_self : '' }}</textarea>
                        <span id="about"></span>
                    </div>
                    <div class="mb-3 col-4">
                        <input type="text" name="nationality" onkeydown="return /[a-z]/i.test(event.key)"
                            id="nationality" value="{{ !empty($user->nationality) ? $user->nationality : '' }}"
                            class="form-control" placeholder="Nationality*">
                    </div>
                    <div class="mb-3 col-4">
                        <input type="text" name="dob" id="dob" class="form-control"
                            value="{{ !empty($user->date_of_birth) ? $user->date_of_birth : '' }}"
                            placeholder="Date Of Birth*">
                    </div>
                    <div class="mb-3 col-4">
                        <select class="form-select" name="marital" id="marital">
                            <option value="">Select Marital Status</option>
                            @if (!empty($user->marital_status))
                                <option selected value="{{ $user->marital_status }}">
                                    {{ ucfirst($user->marital_status) }}</option>
                            @endif
                            <option value="married">Married</option>
                            <option value="single">Single</option>
                            <option value="widowed">Widowed</option>
                            <option value="seperated">Seperated</option>
                            <option value="divorced">Divorced</option>
                        </select>
                    </div>

                    {{-- <div class="mb-3">
                        <label for="">Language</label>
                        <table class="table table-bordered text-center mb-3">
                            <thead>
                                <tr>
                                    <th scope="col">Language</th>
                                    <th scope="col">Speak</th>
                                    <th scope="col">Read</th>
                                    <th scope="col">Write</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody id="tbody_lan">
                                <tr id="tr1">
                                    <td class="text-center">
                                        <input type="text" name="language[]" class="form-control form-control-sm">
                                    </td>

                                    <td>
                                        <input class="form-check-input" type="checkbox" speak="speak"
                                            id="inlineRadio1">

                                    </td>
                                    <td>
                                        <input class="form-check-input" type="checkbox" read="read"
                                            id="inlineRadio1">
                                    </td>
                                    <td>
                                        <input class="form-check-input" type="checkbox" write="write"
                                            id="inlineRadio1">
                                    </td>
                                    <td>
                                        <input type="button" class="btn btn-sm btn-primary"
                                            onclick="addRow(this,'tbody_lan')" value="Add">
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                        <span id="language"></span>
                    </div> --}}

                </form>
            </div>

            <div class="item d-none">
                <form class="row d-flex " action="">
                    <h5 class="text-center p-3">Educational Qualification</h5>
                    <input type="hidden" name="slug" value="educations">
                    @if (count($edu) > 0)
                        @foreach ($edu as $key => $educations)
                            <input type="hidden" name="education_id[]" value="{{ $educations->id }}">
                            <div class="mb-3 row border border-1 border-info p-3">
                                <div class="mb-3">
                                    <select class="form-select" name="qualification[]"
                                        id="qualification{{ $key }}" onchange="highestQualifications(this,'')">
                                        <option class="text-muted" value="">Select Highest Education</option>
                                        @foreach ($qualifications as $item)
                                            @if ($educations->education_standard_id == $item->id)
                                                <option selected value="{{ $item->id }}">{{ $item->standard }}
                                                </option>
                                            @endif
                                            <option value="{{ $item->id }}">{{ $item->standard }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3 d-none" id="others">
                                    <input type="text" class="form-control" name="others_qualifications[]"
                                        id="others_qualifications" placeholder="Enter Qualifications">
                                </div>
                                <div class="mb-3">
                                    <input type="text" class="form-control" value="{{ $educations->institute_name }}"
                                        name="institute_name[]" id="institute_name{{ $key }}"
                                        placeholder="college/institute">
                                </div>
                                <div class="mb-3 ">
                                    <input type="text" class="form-control"
                                        value="{{ $educations->board_university }}" name="board[]"
                                        id="board_university{{ $key }}" placeholder="Board/University">
                                </div>
                                <div class="mb-3 10th 12th">
                                    <input type="text" class="form-control" value="{{ $educations->course }}"
                                        name="course[]" id="course{{ $key }}" placeholder="Course(eg.B.tech)">
                                </div>
                                <div class="mb-3 10th">
                                    <input type="text" class="form-control" value="{{ $educations->specialization }}"
                                        name="specialization[]" id="specialization{{ $key }}"
                                        placeholder="Field in Study(eg.computer science)">
                                </div>
                                <div class="mb-3">
                                    <div class="d-flex input-group">
                                        <input type="text" onclick="this.setAttribute('type','date')"
                                            placeholder="Start Year" class="form-control 10th" name="start_year[]"
                                            value="{{ $educations->start_year }}">
                                        <span class="input-group-text 10th">-</span>
                                        <input type="text" onclick="this.setAttribute('type','date')"
                                            class="form-control" name="passing_year[]" placeholder="Passing Year"
                                            value="{{ $educations->passing_year }}">
                                    </div>
                                    <div class="d-flex">
                                        <span id="start_year{{ $key }}"></span>
                                        <span id="passing_year{{ $key }}"></span>
                                    </div>
                                </div>

                            </div>
                        @endforeach
                    @else
                        <div class="mb-3 row">
                            <div class="mb-3">
                                <select class="form-select" name="qualification[]" id="qualification0"
                                    onchange="highestQualifications(this,'')">
                                    <option class="text-muted" value="">Select Highest Education</option>
                                    @foreach ($qualifications as $item)
                                        <option value="{{ $item->id }}">{{ $item->standard }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3 d-none" id="others">
                                <input type="text" class="form-control" name="others_qualifications[]"
                                    id="others_qualifications" placeholder="Enter Qualifications">
                            </div>
                            <div class="mb-3">
                                <input type="text" class="form-control" name="institute_name[]" id="institute_name0"
                                    placeholder="college/institute">
                            </div>
                            <div class="mb-3 ">
                                <input type="text" class="form-control" name="board[]" id="board_university0"
                                    placeholder="Board/University">
                            </div>
                            <div class="mb-3 10th 12th">
                                <input type="text" class="form-control" name="course[]" id="course0"
                                    placeholder="Course(eg.B.tech)">
                            </div>
                            <div class="mb-3 10th">
                                <input type="text" class="form-control" name="specialization[]" id="specialization0"
                                    placeholder="Field in Study(eg.computer science)">
                            </div>
                            <div class="mb-3">
                                <div class="d-flex input-group">
                                    <input type="text" onclick="this.setAttribute('type','date')"
                                        placeholder="Start Year" class="form-control 10th" name="start_year[]"
                                        value="">
                                    <span class="input-group-text 10th">-</span>
                                    <input type="text" onclick="this.setAttribute('type','date')" class="form-control"
                                        name="passing_year[]" placeholder="Passing Year">
                                </div>
                                <div class="d-flex">
                                    <span id="start_year0"></span>
                                    <span id="passing_year0"></span>
                                </div>
                            </div>
                            <hr>
                        </div>
                    @endif
                    <div id="tbody_education" class="mb-3">

                    </div>

                    <div class="d-flex justify-content-end">
                        <input type="button" class="btn btn-primary" onclick="addRow(this,'tbody_education')"
                            value="Add">
                    </div>

                </form>
            </div>

            <div class="item d-none">
                <form class="row d-flex ">
                    <h5 class="text-center p-3">Work Experience & Skill</h5>
                    <input type="hidden" name="slug" value="work_experience">
                    <input type="hidden" name="basic_info_id"
                        value="{{ !empty($user->basic_info_id) ? $user->basic_info_id : '' }}">

                    <div class="mb-3 ">
                        <label for="">Add Job Location</label>
                        <div class="row">
                            <div class="col-4">
                                <select class="form-select country" step="2" name="">
                                    <option class="text-muted" value="">select country</option>
                                    @foreach ($countries as $country)
                                        @if (!empty($user->country_id) && $country->id == $user->country_id)
                                            <option selected value="{{ $country->id }}">{{ $country->name }}</option>
                                        @endif
                                        <option value="{{ $country->id }}">{{ $country->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-4">
                                <select name="" step="2" class="form-select state">
                                    @if (!empty($user->state_id))
                                        @foreach ($states as $state)
                                            @if ($state->id == $user->state_id)
                                                <option selected value="{{ $state->id }}">{{ $state->name }}</option>
                                            @endif
                                            <option value="{{ $state->id }}">{{ $state->name }}</option>
                                        @endforeach
                                    @else
                                        <option class="text-muted" value="">select states</option>
                                    @endif
                                </select>
                            </div>
                            <div class="col-4">
                                <select class="form-select city" step="2" id="add_location">
                                    @php
                                        
                                        $exist_job_loc = [];
                                        foreach ($job_loc as $key => $value) {
                                            $exist_job_loc[] = $value->location_id;
                                        }
                                        foreach ($cities as $key => $item) {
                                            $id = $item->id;
                                            $name = $item->name;
                                            if (in_array("$item->id", $exist_job_loc)) {
                                                echo "<option disabled value='$id'>$name</option>";
                                            } else {
                                                echo "<option value='$id'>$name</option>";
                                            }
                                        }
                                    @endphp
                                </select>
                            </div>
                        </div>
                        <div id="append-location">

                            @if (count($job_loc) > 0)
                                @foreach ($job_loc as $item)
                                    <input type="button" data-id="{{ $item->location_id }}"
                                        onclick="removeLocation(this,{{ $item->location_id }})"
                                        class="btn btn-success me-1 my-1 btn-sm " value="{{ $item->name }}">
                                @endforeach
                            @endif
                        </div>
                    </div>


                    <div class="mb-3">
                        <input type="text" class="form-control" onkeyup="addSkills(event)" id="add-skills"
                            placeholder="Skills">
                        <div id="append-skills">
                            @if (count($user_skill) > 0)
                                @foreach ($user_skill as $item)
                                    <input type="button" data-id="{{ $item->id }}"
                                        onclick="removeSkills(this,'user_skills')"
                                        class="btn btn-success me-1 my-1 btn-sm" value="{{ $item->skills }}">
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="mb-3 d-flex align-items-center">
                        <label class="input-group-text me-5" for="">Have you Experience</label>
                        <input type="checkbox" class="form-check-input me-3" onchange="addWorkExperence(this)"
                            name="has_experience" id="has_experience" value="yes"
                            {{ !empty($user->has_experience) && $user->has_experience == 'yes' ? 'checked' : '' }}>
                    </div>
                    <div id="work_experience" class="mb-3">

                        @if (!empty($user->has_experience) && $user->has_experience == 'yes')
                            <div id="tbody_experience">
                                @foreach ($exp as $key => $item)
                                    <input type="hidden" name="exp_id[]" value="{{ $item->id }}">
                                    <div class="mt-3 row border border-1 border-primary p-3">

                                        <div class="mb-3 d-flex">
                                            <label class="me-5" for="">Current Working</label>
                                            <div>
                                                <div class="form-check form-check-inline">
                                                    <input type="radio" class="form-check-input"
                                                        name="current_working[{{ $key }}]"
                                                        id="current_working_yes{{ $key }}" value="Yes"
                                                        {{ $item->is_working == 'yes' ? 'checked' : '' }}>
                                                    <label class="form-check-label"
                                                        for="current_working_yes{{ $key }}">Yes</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input type="radio" class="form-check-input"
                                                        name="current_working[{{ $key }}]"
                                                        id="current_working_no{{ $key }}" value="No"
                                                        {{ $item->is_working == 'no' ? 'checked' : '' }}>
                                                    <label class="form-check-label"
                                                        for="current_working_no{{ $key }}">No</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3 d-flex">
                                            <label class="me-5" for="">Working Type</label>
                                            <div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio"
                                                        name="working_type[{{ $key }}]"
                                                        id="working_type1{{ $key }}" value="part"
                                                        {{ $item->work_type == 'part' ? 'checked' : '' }}>
                                                    <label class="form-check-label"
                                                        for="working_type1{{ $key }}">Part Time</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio"
                                                        name="working_type[{{ $key }}]"
                                                        id="working_type2{{ $key }}" value="full"
                                                        {{ $item->work_type == 'full' ? 'checked' : '' }}>
                                                    <label class="form-check-label"
                                                        for="working_type2{{ $key }}">Full Time</label>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="mb-3">
                                            <input type="text" class="form-control" value="{{ $item->company_name }}"
                                                name="company_name[]" id="company_name{{ $key }}"
                                                placeholder="Company Name*">
                                        </div>

                                        <div class="mb-3">

                                            <input type="text" class="form-control" value="{{ $item->desigination }}"
                                                name="desigination[]" id="desigination{{ $key }}"
                                                placeholder="Desigination*">
                                        </div>
                                        <div class="mb-3">

                                            <input type="text" class="form-control" value="{{ $item->job_city }}"
                                                name="job_city[]" id="job_city{{ $key }}" placeholder="City*">
                                        </div>

                                        <div class="d-flex input-group mb-3">
                                            <label for="" class="input-group-text" id="time_duration">Time
                                                Duration</label>
                                            <input type="text" onclick="this.setAttribute('type','date')"
                                                value="{{ $item->joining_data }}" class="form-control"
                                                name="start_date[]" placeholder="form">
                                            <span class="input-group-text">-</span>
                                            <input type="text" onclick="this.setAttribute('type','date')"
                                                value="{{ $item->last_date }}" class="form-control" name="end_date[]"
                                                placeholder="to">
                                        </div>


                                        <div class="mb-3">
                                            <select class="form-select ad-job-skills"
                                                onchange="addJobSkills(this,{{ $key }})"
                                                id="add-job-skills{{ $key }}">
                                                <option value="">--</option>
                                                <option value="abc">abc</option>
                                                <option value="dss">dss</option>
                                            </select>
                                            <div class="append-job-skills" key="{{ $key }}"
                                                id="append-job-skills{{ $key }}">
                                                @foreach (json_decode($item->skills) as $skill)
                                                    <input type="button"
                                                        onclick="removeSkills(this,'job_skills',{{ $key }})"
                                                        class="btn btn-success me-1 my-1 btn-sm"
                                                        value="{{ $skill }}">
                                                @endforeach
                                            </div>
                                        </div>

                                        <div class="mb-3">

                                            <textarea name="job_desc[]" class="form-control" id="" cols="3" rows="3"
                                                placeholder="Job Descriptions">{{ $item->profile_desc }}</textarea>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="d-flex justify-content-end">
                                <input type="button" count={{ count($exp) - 1 }}
                                    class="btn btn-primary rounded-0 btn-sm" onclick="addRow(this,'tbody_experience')"
                                    value="Addmore">
                            </div>
                            <div class="mb-3">
                                <div class="my-3 input-group">
                                    <input type="text" class="form-control" value="{{ $user->last_salary }}"
                                        name="salary" id="current_salary" placeholder="current Salary">
                                    <span class="input-group-text">In</span>
                                    <select class="form-select" name="in_salary" id="">
                                        <option {{ $user->salary_in == 'yearly' ? 'selected' : '' }} value="yearly">
                                            Yearly
                                        </option>
                                        <option {{ $user->salary_in == 'yearly' ? 'monthly' : '' }} value="monthly">
                                            Monthly
                                        </option>
                                    </select>
                                </div>
                                <span id="salary"></span>
                            </div>
                        @endif
                    </div>


                    <div class="mb-3">
                        {{-- <label for="">social profile</label> --}}
                        {{-- <div class="d-flex justify-content-between align-items-center">
                            <div class="col-3 me-1">
                                <input type="text" class="form-control" placeholder="Social Name" id="social_name">
                            </div>
                            <div class="col-8 me-1">
                                <input type="text" class="form-control" placeholder="url address" id="social_url">
                            </div>
                            <div class="col-1">
                                <input type="button" class="btn btn-sm btn-primary"
                                    onclick="addRow(this,'tbody_social_profile')" value="Add">
                            </div>
                        </div>
                        <div id="tbody_social_profile">

                        </div> --}}
                        <input type="text" class="form-control mb-3" placeholder="Facebook" name="social_url[]">
                        <input type="text" class="form-control mb-3" placeholder="Linkdin" name="social_url[]">
                        <input type="text" class="form-control mb-3" placeholder="twitter" name="social_url[]">
                        <input type="text" class="form-control mb-3" placeholder="google plus" name="social_url[]">
                        <input type="text" class="form-control mb-3" placeholder="instagram" name="social_url[]">
                        <input type="text" class="form-control mb-3" placeholder="your blog" name="social_url[]">
                    </div>
                    <div class="mb-3">
                        <label for="">upload resume(docs,pdf)</label>
                        <input type="file" class="form-control" name="users_resume">
                        @if (!empty($files[0]->type) && $files[0]->type == 'files')
                            <a class="mt-3" href="{{ asset('storage/files/' . $files[0]->files) }}">Resume</a>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="">upload profile pic</label>
                        <input type="file" class="form-control" name="profile_pic">
                        @if (!empty($files[1]->type) && $files[1]->type == 'pic')
                            <a class="mt-3" href="{{ asset('storage/pic/' . $files[1]->files) }}">Avatar</a>
                        @endif
                    </div>

                </form>
            </div>


            <div class="item  d-none">
                <h5>prepareing...</h5>
            </div>
        </div>



        <div class="d-flex justify-content-end my-3 me-5">
            <button type="button" class="btn btn-success me-3" id="prevBtn" onclick="prevItem(-1)">Previous</button>
            <button type="button" class="btn btn-danger" id="nextBtn" onclick="nextItem(1)">Next</button>
        </div>


    </div>

    <script>
        let current_item = 0; // Current tab is set to be the first tab (0)
        let count = 0;
        let job_location = [];
        let skill = [];
        let job_skill = [];

        let objForm = {
            formModal: (data) => {
                let modal = `<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    ${data}
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary">Save changes</button>
                                </div>
                                </div>
                            </div>
                            `;
                return modal;
            },
            formHtmlEducation: (count, data = "") => {
                const remove_btn = ` <div class="d-flex justify-content-end">
                                <input type="button" class="btn btn-sm btn-danger" onclick="$(this).parent().parent().remove()"
                                    value="Remove">
                             </div>`;
                const add_more = `<div class="d-flex justify-content-end">
                                <input type="button" class="btn btn-sm btn-danger" onclick="$(this).parent().parent().remove()"
                                        value="Add">
                                </div>`;

                let edu = `<div class="mb-3 border border-1 border-primary p-3">
                           ${data==""?remove_btn:""}
                            <div class="mb-3">
                                <select class="form-select" name="qualification[]" id="qualification${count}"
                                    onchange="highestQualifications(this,${count})">
                                    <option class="text-muted" value="">Select Highest Education</option>
                                    @foreach ($qualifications as $item)
                                        <option value="{{ $item->id }}">{{ $item->standard }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3 d-none" id="others${count}">
                                <input type="text" class="form-control" name="others_qualifications[]" id="others_qualifications${count}" placeholder="Enter Qualifications">
                            </div>
                            <div class="mb-3">
                                <input type="text" class="form-control" name="institute_name[]" id="institute_name${count}"
                                    placeholder="college/institute">
                            </div>
                            <div class="mb-3 ">
                                <input type="text" class="form-control" name="board[]" id="board${count}"
                                    placeholder="Board/University">
                            </div>
                            <div class="mb-3 10th${count} 12th${count}">
                                <input type="text" class="form-control" name="course[]" id="course${count}"
                                    placeholder="Course(eg.B.tech)">
                            </div>
                            <div class="mb-3 10th">
                                <input type="text" class="form-control" name="specialization[]" id="specialization${count}"
                                    placeholder="Field in Study(eg.computer science)">
                            </div>
                            <div class="mb-3">
                                <div class="d-flex input-group">
                                    <input type="text" onclick="this.setAttribute('type','date')"
                                        placeholder="Start Year" class="form-control  10th${count}"
                                        name="start_year[]" value="">
                                    <span class="input-group-text 10th${count}">-</span>
                                    <input type="text" onclick="this.setAttribute('type','date')" class="form-control"
                                        name="passing_year[]" placeholder="Passing Year">
                                </div>
                                <div class="d-flex">
                                    <span id="start_year.${count}"></span>
                                    <span id="passing_year.${count}"></span>
                                 </div> 
                            </div>
                        </div>`;
                return edu;

            },
            formHtmlLanguage: (count) => {
                return `<tr id="tr1">
                                <td class="text-center">
                                    <input type="text" name="language[]" class="form-control form-control-sm">
                                </td>
                                
                                <td>
                                  <input class="form-check-input" type="checkbox" speak="speak"
                                                id="inlineRadio1" onclick="" value="true">
                                              
                                 </td>
                                 <td>
                                   <input class="form-check-input" type="checkbox"" read="read"
                                                id="inlineRadio1" value="true">
                                    </td>
                                 <td>
                                                <input class="form-check-input" type="checkbox" write="write"
                                                id="inlineRadio1" value="true">
                               </td>
                                <td>
                                    <input type="button" class="btn btn-sm btn-danger" onclick="removeRow(this)"
                                        value="Remove">
                                </td>
                            </tr>`;
            },

            formHtmlProject: () => {
                return ` <div class="row">
                    <div class="mb-3">
                            <label for="project_title">Project Title</label>
                            <input type="text" class="form-control"
                                name="pro
                            ject_title[]" placeholder="project title">
                        </div>
                        <div class="mb-3">
                            <label for="time-duration">Time Duration</label>
                            <div class="input-group">
                                <input type="text" name="time_taken[]" class="form-control">
                                <span class="input-group-text">IN</span>
                                <select class="form-select" name="duration_qty[]" id="">
                                    <option value="days">days</option>
                                    <option value="weeks">weeks</option>
                                    <option value="months">months</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="">About Project</label>
                            <textarea class="form-control" name="about_project" id="" cols="4" rows="3"></textarea>
                        </div>
                            <div class="mb-3">
                                <input type="button" class="btn btn-sm btn-danger" onclick="removeRow(this)"
                                    value="del">
                             </div>
                        </div>`;
            },
            formHtmlSocialProfile: () => {
                let html = `<div class="d-flex align-items-center border border-1 border-info rounded p-2 justify-content-between mt-3">
                                    <span><strong>${$('#social_name').val()} : &nbsp;</strong><a href="${$('#social_url').val()}" class="text-danger">${$('#social_url').val()}</a></span>
                                    <input type="button" class="btn btn-sm btn-danger" onclick="$(this).parent().remove()"
                                    value="Remove">
                             </div>`;

                $('#social_name').val('');
                $('#social_url').val('');
                return html;
            },
            formHtmlExperience: (count, slug, skill) => {
                let option = "";
                for (let i = 0; i < skill.length; i++) {
                    option += `<option value="${skill[i]}">${skill[i]}</option>`;

                }
                const html = `<div class="d-flex justify-content-end">
                                <input type="button" class="btn btn-sm btn-danger" onclick="removeExperienceBox(this,count=0)"
                                    value="Remove">
                             </div>`;
                return `<div class="mt-3 row border border-1 border-primary p-3">
                             ${slug==true?html:""}
                                <div class="mb-3 d-flex">
                                    <label class="me-5" for="">Current Working</label>
                                    <div>
                                        <div class="form-check form-check-inline">
                                            <input type="radio" class="form-check-input" name="current_working[${count}]"
                                                id="current_working_yes${count}" value="Yes" checked>
                                            <label class="form-check-label" for="current_working_yes${count}">Yes</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input type="radio" class="form-check-input" name="current_working[${count}]"
                                                id="current_working_no${count}" value="No">
                                            <label class="form-check-label" for="current_working_no${count}">No</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3 d-flex">
                                    <label class="me-5" for="">Working Type</label>
                                    <div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="working_type[${count}]"
                                                id="working_type1" value="part">
                                            <label class="form-check-label" for="working_type1">Part Time</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="working_type[${count}]"
                                                id="working_type2" value="full" checked>
                                            <label class="form-check-label" for="working_type2">Full Time</label>
                                        </div>
                                    </div>
                                </div>


                                <div class="mb-3">
                                  
                                    <input type="text" class="form-control" name="company_name[]" id="company_name${count}"
                                        placeholder="Company Name*">
                                </div>

                                <div class="mb-3">
                                    
                                    <input type="text" class="form-control" name="desigination[]" id="desigination${count}"
                                        placeholder="Desigination*">
                                </div>
                                <div class="mb-3">
                                   
                                    <input type="text" class="form-control" name="job_city[]" id="job_city${count}"
                                        placeholder="City*">
                                </div>

                                <div class="d-flex input-group mb-3">
                                    <label for="" class="input-group-text" id="time_duration">Time
                                        Duration</label>
                                    <input type="text" onclick="this.setAttribute('type','date')" class="form-control"
                                        name="start_date[]" placeholder="form">
                                    <span class="input-group-text">-</span>
                                    <input type="text" onclick="this.setAttribute('type','date')" class="form-control"
                                        name="end_date[]" placeholder="to">
                                </div>


                                <div class="mb-3">
                                    <select class="form-select ad-job-skills"  onchange="addJobSkills(this,${count})"
                                        id="add-job-skills${count}">
                                        <option value="">--</option>
                                        ${option}
                                     </select>   
                                    <div class="append-job-skills" id="append-job-skills${count}" key="${count}">

                                    </div>
                                </div>

                                <div class="mb-3">
                                   
                                    <textarea name="job_desc[]" class="form-control" id="" cols="3" rows="3"
                                        placeholder="Job Descriptions"></textarea>
                                </div>
                            </div>       
                            `;
            },
            formHtmlInterestActiivityAwards: (val) => {
                let html = `  <li class="d-flex justify-content-between align-items-center mb-1">
                                    ${$('#'+val).val()}
                                    <input type="button" class="btn btn-sm btn-danger" onclick="$($(this).parent()).remove()"
                                    value="del">
                                </li>`;
                $('#' + val).val('');
                return html;
            },
            post: (obj) => {
                $.ajax({
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}",
                    },
                    contentType: false,
                    processData: false,
                    url: obj.url,
                    data: obj.data,
                    success: function(res) {
                        console.log(res);

                        if (res.status) {
                            if (res.slug == "state-list") {
                                objForm.showStates(res.data, obj.step);
                                return;
                            }
                            if (res.slug == "city-list") {
                                objForm.showCity(res.data, obj.step);
                                return;
                            }
                            if (obj.slug == "multiform") {
                                if (res.error != "") {
                                    objForm.returnError(res.error);
                                    return false;
                                } else if (res.msg != "  ") {
                                    alert(res.msg);
                                    $('#basic_info_id').val(res.basic_info_id);
                                    $('.item').eq(obj.current_item).addClass('d-none');
                                    current_item = obj.current_item + obj.next;

                                    // if (current_item >= $('.item').length) {
                                    //     //...the form gets submitted:
                                    //     $("#resume").submit();
                                    //     return false;
                                    // }
                                    // Otherwise, display the correct tab:
                                    objForm.showTab(current_item, res);
                                    return false;
                                }
                            }

                        }
                    },
                    error: (err) => console.log(err),
                });
            },
            returnError: (data) => {
                $('.error').remove();
                for (const [key, value] of Object.entries(data)) {
                    // console.log(`${key}: ${value}`);
                    // if(key.includes('.'))
                    // {
                    //     $('#' + key).after(`<span class="text-danger error">${value}</span>`);
                    // }

                    $('#' + key).after(`<span class="text-danger error">${value}</span>`);
                }
            },
            showStates: (data, current_item) => {
                let option = "";
                $(`.state[step=${current_item}]`).html('');
                data.forEach(elem => {
                    option += `<option value="${elem.id}">${elem.name}</option>`;
                })
                $(`.state[step=${current_item}]`).append(option);
            },
            showCity: (data, current_item) => {
                let option = "";
                $(`.city[step=${current_item}]`).html('');
                data.forEach(elem => {
                    option += `<option value="${elem.id}">${elem.name}</option>`;
                })
                $(`.city[step=${current_item}]`).append(option);
            },
            showTab: (n, res) => {
                $('.item').eq(n).removeClass('d-none');
                // ... and fix the Previous/Next buttons:
                if (n == 0) {
                    $('#prevBtn').addClass('d-none');
                } else {
                    $('#prevBtn').removeClass('d-none');
                }
                if (n == ($('.item').length - 1)) {
                    setInterval(() => {
                        window.location.replace(res.my_cv);

                    }, 1500);
                } else if (n == ($('.item').length - 2)) {
                    $('#nextBtn').html('Submit');

                } else {
                    $('#nextBtn').html('Next');

                }

                // ... and run a function that displays the correct step indicator:
                objForm.fixStepIndicator(n)
            },
            fixStepIndicator: (n) => {
                // This function removes the "active" class of all steps...
                var i, x = document.getElementsByClassName("step");
                for (i = 0; i < $(".step").length; i++) {
                    x[i].className = x[i].className.replace(" active1", "");
                }
                //... and adds the "active" class to the current step:
                x[n].className += " active1";
            },
            validateForm: () => {
                $("span.custom_error").remove();
                var y, i;
                validate.is_validate = false;
                let setValidateField = [];
                y = $('.item').eq(current_item).find("input[id]");
                if (current_item == 0) {
                    setValidateField = ['fname', 'phone_1', 'city', 'state', 'pincode', 'address_1', 'dob',
                        'nationality',
                        'email', 'marital',
                    ];
                } else if (current_item == 1) {
                    setValidateField = [];
                } else if (current_item == 2) {

                    setValidateField = [];

                    $('input[type="file"]').each(function() {
                        if (this.value.trim().length == 0) return;
                        var ext = this.value.substring(this.value.lastIndexOf('.') + 1);
                        let name = $(this).attr('name');
                        let supportFile = [];
                        if (name == "users_resume") {
                            supportFile = ['pdf', 'doc'];
                        }
                        if (name == "profile_pic") {
                            supportFile = ['jpeg', 'png'];
                        }
                        //     console.log(ext)
                        validate.file({
                            "name": ext,
                            "supportFile": supportFile
                        });
                    })

                    if ($('#append-location').find('input[type="button"]').length == 0) {
                        $('#append-location').after(
                            `<span class="text-danger custom_error">Select Job location</span>`)
                        validate.is_validate = true;
                    }

                    if ($('#append-skills').find('input[type="button"]').length == 0) {
                        $('#append-skills').after(
                            `<span class="text-danger custom_error">Please select at least one skill</span>`)
                        validate.is_validate = true;
                    }

                    if ($('#has_experience').prop('checked')) {
                        if ($('#current_salary').val().length == 0) {
                            $('#current_salary').parent().after(
                                `<span class="text-danger custom_error">This field id required</span>`)
                        }

                    }

                }
                for (i = 0; i < y.length; i++) {
                    setValidateField.forEach(elem => {
                        if (y[i].id == elem) {
                            validate.required(elem)
                        }
                    })
                }
                // If the valid status is true, mark the step as finished and valid:
                if (validate.is_validate == false) {
                    let span =
                        `<span class="d-flex justify-content-center align-items-center text-dark">${current_item+1}</span>`;
                    $(".step").eq(current_item).addClass("bg-info");
                    $(".step").eq(current_item).html(span);
                }
                return validate.is_validate; // return the valid status
            },
            prepareAndPost: (current_item, n) => {
                let form_data = $('.item').eq(current_item).find('form').serializeArray();
                objForm.addAddtFormData(form_data, current_item);
                let data = new FormData();
                $.each(form_data, function(key, input) {
                    data.append(input.name, input.value);
                });
                if (current_item == 2) {
                    $('input[type="file"]').each(function() {
                        if (this.value.length == 0) return;
                        data.append(this.name, this.files[0])
                    })
                }
                const obj = {
                    'url': "{{ route('users.create-resume-post') }}",
                    'data': data,
                    'current_item': current_item,
                    'next': n,
                    'slug': "multiform"
                }
                objForm.post(obj);
            },
            addAddtFormData: (form_data, step) => {

                if (step == 2) {
                    $('#append-location').find('input[type="button"]').each(function() {
                        form_data.push({
                            name: 'jobLocation[]',
                            value: $(this).attr('data-id')
                        })
                    })

                    $('#append-skills').find('input[type="button"]').each(function() {
                        form_data.push({
                            name: 'user_skill[]',
                            value: this.value
                        })
                    })

                    $('.append-job-skills').each(function(i) {
                        $(this).find('input[type="button"]').each(function() {
                            form_data.push({
                                name: `job_skill[${i}][]`,
                                value: this.value
                            })
                        })
                    })


                    // $('#tbody_social_profile').find('span').each(function(){

                    // })
                }


            }

        }
        var autoLoad = (function() {
            objForm.showTab(current_item);
            if ($('#append-location').find('input[data-id]').length > 0) {
                $('#append-location').find('input[data-id]').each(function() {
                    job_location.push(parseInt($(this).attr('data-id')));

                })
            }

            if ($('#append-skills').find('input[data-id]').length > 0) {
                $('#append-skills').find('input[data-id]').each(function() {
                    skill.push($(this).val());

                })
            }

            $('.append-job-skills[key]').each(function() {
                let i = parseInt($(this).attr('key'));
                if (!job_skill[i]) {
                    job_skill[i] = [];
                }
                $(this).find('input.btn-success').each(function() {
                    job_skill[i].push($(this).val());
                })
            })
            $('#dob').click(function() {
                this.setAttribute('type', 'date');
                // min="1980-01-01" max="2000-01-01"
                let dateObj = new Date();
                let month = dateObj.getMonth(); //months from 1-12
                let day = dateObj.getDate();
                dateObj.setFullYear(dateObj.getFullYear() - 16);
                let year = dateObj.getFullYear();
                this.setAttribute('max', `${year}-${month<10?'0'+month:month}-${day}`)
            })

        }());

        function addRow(elem, slug) {

            validate.is_validate = false;
            if (slug == "tbody_lan") {
                count++;
                $('#' + slug).append(objForm.formHtmlLanguage(count));
            } else if (slug == "tbody_education") {
                validate.required(`qualification${count}`);
                validate.required('institute_name' + count);
                validate.required('board_university' + count);
                validate.required('specialization' + count);

                if (validate.is_validate == false) {
                    count++;
                    $('#' + slug).append(objForm.formHtmlEducation(count));
                }

            } else if (slug == 'tbody_skills') {
                count++;
                $('#' + slug).append(objForm.formHtmlSkills());

            } else if (slug == 'tbody_project') {
                count++;
                $('#' + slug).append(objForm.formHtmlProject());
            } else if (slug == 'tbody_social_profile') {
                validate.required('social_name');
                validate.required('social_url');
                if (validate.is_validate == false) {
                    count++;

                    $('#' + slug).append(objForm.formHtmlSocialProfile());
                }
            } else if (slug == 'tbody_experience') {
                // count update
                var attr = $(elem).attr('count');

                if (typeof attr !== 'undefined' && attr !== false) {
                    count = parseInt($(elem).attr("count"));

                }


                validate.required('company_name' + count);
                validate.required('desigination' + count);
                validate.required('job_city' + count);
                if ($('#append-job-skills' + count).find('input').length == 0) {
                    $('#add-job-skills' + count).parent().find('span.custom_error').remove();
                    $('#add-job-skills' + count).after(`<span class="text-danger custom_error">Select job skills</span>`)
                    validate.is_validate = true;
                }

                if (skill.length == 0) {
                    $('#add-skills').parent().find('span.custom_error').remove();
                    $('#add-skills').after(`<span class="text-danger custom_error">Select skills</span>`)
                    validate.is_validate = true;

                }
                if (validate.is_validate == false) {
                    if (typeof attr !== 'undefined' && attr !== false) {
                        $(elem).attr("count", count + 1);
                        count = count + 1;

                    } else {

                        count++;
                    }

                    $('#' + slug).append(objForm.formHtmlExperience(count, true, skill));
                }
            } else if (slug == 'tbody_interest') {
                count++;
                $('#' + slug).append(objForm.formHtmlInterestActiivityAwards('interest'));
            } else if (slug == 'tbody_activity') {
                count++;
                $('#' + slug).append(objForm.formHtmlInterestActiivityAwards('activity'));
            } else if (slug == 'tbody_achivement') {
                count++;
                $('#' + slug).append(objForm.formHtmlInterestActiivityAwards('achivement'));
            }

        }

        function removeRow(elem) {
            $($(elem).parent()).parent().remove();
            // $('#tr' + id).remove();
        }



        function nextItem(n) {
            if (n == 1 && objForm.validateForm()) {
                return false;
            }

            objForm.prepareAndPost(current_item, n);
            // next and show after ajax succesd msg
            return;
        }

        function prevItem(n) {
            $('.item').eq(current_item).addClass('d-none');
            current_item = current_item + n;
            objForm.showTab(current_item);
        }


        function highestQualifications(elem, count) {

            $val = $(elem).find(":selected").text().trim();
            if ($val == "10th") {
                $('#change_passing_year' + count).text('passing year');
                // $('.10th' + count).addClass('d-none');
            } else if ($val == "Intermediate / (10+2)") {
                // $('.12th' + count).addClass('d-none');
            } else if ($val == "others") {
                $('#others' + count).removeClass('d-none');
            } else {
                $('#change_passing_year' + count).text('Session');
                // $(`.10th${count}.12th${count}`).removeClass('d-none');
                $('#others' + count).addClass('d-none');
            }
        }

        function removeExperienceBox(elem, count) {
            job_skill.splice(count, 1);
            $(elem).parent().parent().remove();
        }

        function removeLocation(btn, option_value) {
            let select = $($(btn).parent()).parent().find('select')[0];
            // console.log(job_location.length,"d",job_location,option_value)
            if (job_location.length > 0) {
                const index = job_location.indexOf(option_value);
                if (index > -1) { // only splice array when item is found
                    job_location.splice(index, 1); // 2nd parameter means remove one item only
                }
                // console.log(job_location.length,index,job_location)
            }
            $(select).find(`option[value=${option_value}]`).removeAttr('disabled');
            $(btn).remove();
        }

        const addLocation = $('#add_location').change(function() {
            $('#append-location').parent().find('span.custom_error').remove();
            let count = $(this).find('option[disabled]').length;
            if (count > 7) {
                return
            }
            let text = $(this).find(`[value=${$(this).val()}]`).text()

            job_location.push(parseInt(this.value));
            let html =
                `<input type="button" data-id="${this.value}" onclick="removeLocation(this,${this.value})" class="btn btn-outline-dark me-1 my-1 btn-sm " value="${text}">`;
            $('#append-location').append(html);
            // e.target.value = "";
            $(this).find(`[value=${$(this).val()}]`).attr('disabled', true);
        })

        function removeSkills(elem, slug, count = 0) {
            if (slug == "user_skills") {
                $('.ad-job-skills').find(`option[value=${elem.value}]`).remove();
                if (skill.length > 0) {
                    const index = skill.indexOf(elem.value);
                    if (index > -1) { // only splice array when item is found
                        skill.splice(index, 1); // 2nd parameter means remove one item only
                    }
                    // console.log(job_location.length,index,job_location)
                }
                $(elem).remove();
            } else if (slug == "job_skills") {
                $($(elem).parent().parent().find('select')).find(`option[value=${elem.value}]`).removeAttr('disabled');
                $(elem).remove();
                if (job_skill[count].length > 0) {
                    const index = job_skill[count].indexOf(elem.value);
                    if (index > -1) { // only splice array when item is found
                        job_skill[count].splice(index, 1); // 2nd parameter means remove one item only
                    }
                }

            }
        }

        function addSkills(e) {
            $('#append-skills').parent().find('span.custom_error').remove();
            let valid = true;
            let value = e.target.value.trim();
            $('#append-skills').find('input[type="button"]').each(function() {
                if (e.target.value == this.value) {

                    return valid = false;
                }
                // $('#' + id).parent().find('span.custom_error').remove();
            })

            if (value.length > 0 && valid) {

                if (e.keyCode == 188 || e.keyCode == 32 || e.keyCode == 13) {
                    skill.push(value)

                    let html =
                        `<input type="button" onclick="removeSkills(this,'user_skills')" class="btn btn-outline-dark me-1 my-1 btn-sm" value="${value}">`;
                    $('#append-skills').append(html);

                    $('.ad-job-skills').append(`<option value=${value}>${value}</option>`)

                    e.target.value = "";
                }
            } else {
                $('#add-skills').after(
                    `<span class="text-danger custom_error">Null or Duplicate entry</span>`
                );
            }

        }



        function addJobSkills(elem, count) {
            $('#add-job-skills' + count).parent().find('span.custom_error').remove();
            let valid = true;
            $(elem).parent().find('.append-job-skills').find('input[type="button"]').each(function() {
                if (elem.value == this.value) {
                    return valid = false;
                }

            })
            // $(elem).find(`option[value=${elem.value}]`).attr('disabled', 'true');
            if (valid) {
                if (!job_skill[count]) {
                    job_skill[count] = [];
                }

                job_skill[count].push(elem.value);
                let html =
                    `<input type="button" onclick="removeSkills(this,'job_skills',${count})" class="btn btn-outline-dark me-1 my-1 btn-sm"  value="${elem.value}">`;

                $(elem).parent().find('.append-job-skills').append(html);
            } else {
                $(elem).parent().find('.append-job-skills').after(
                    `<span class="text-danger custom_error">Duplicate entry not allowed</span>`
                );
            }
        }


        function addWorkExperence(elem) {

            let innerHtml = objForm.formHtmlExperience(0, false, skill);
            let html = ` ${innerHtml}
                 <div id="tbody_experience">
                </div>
                <div class="d-flex justify-content-end">
                    <input type="button" class="btn btn-primary rounded-0 btn-sm" onclick="addRow(this,'tbody_experience')"
                        value="Addmore">
                </div>
                <div class="mb-3">
                <div class="my-3 input-group">
                    <input type="text" class="form-control" name="salary" id="current_salary"
                        placeholder="current Salary">
                    <span class="input-group-text">In</span>
                    <select class="form-select" name="in_salary" id="">
                        <option selected value="yearly">Yearly</option>
                        <option value="monthly">Monthly</option>
                    </select>
                </div>
                <span id="salary"></span>
            </div>

                `;

            if (elem.checked) {
                let skill_count = $('#append-skills').find('input[type="button"]').length;
                if (skill_count > 0) {
                    $('#work_experience').append(html);
                    elem.value = 'yes';
                } else {

                    $(elem).prop('checked', false);
                    alert('please add skill');
                }


            } else {
                $('#work_experience').html('');
            }
        }

        let selectCountry = $('.country').each(function() {
            $(this).change(function() {
                if (this.value == "") return;
                let data = new FormData();
                data.append("country_id", this.value);
                data.append("slug", "state-list");
                const obj = {
                    url: "{{ route('states') }}",
                    data: data,
                    step: current_item
                }
                objForm.post(obj);

            })
        })

        let selectState = $('.state').each(function() {

            $(this).change(function() {

                if (this.value == "") return;
                let data = new FormData();
                data.append("state_id", this.value);
                data.append("slug", "city-list");
                const obj = {
                    url: "{{ route('cities') }}",
                    data: data,
                    step: current_item
                }
                objForm.post(obj);
            })
        })


        // $('.search-select').click(function() {
        //     let html = ` <ul class="list-group">
    //                         <li active_input="" class="list-group-item ">
    //                             <input type="text" class="form-control form-control-sm " />
    //                          </li>
    //                         <li class="list-group-item">A second item</li>
    //                         <li class="list-group-item">A third item</li>
    //                         <li class="list-group-item">A fourth item</li>
    //                         <li class="list-group-item">And a fifth one</li>
    //                     </ul>`;
        //     $(this).after(html);
        //     $(this).parent().find('li').click(function() {
        //                   console.log(this)

        //     })
        //     $('.search-select').blur(function() {
        //         console.log($(this).parent().find('ul[active_input]'))
        //         let flag = false;
        //         $(this).parent().find('ul[active_input]').click(function(){
        //             alert("ffff")
        //             flag = true;
        //             return;
        //         })
        //         if(!flag)
        //         {
        //             console.log("fd5");
        //             $(this).paren.find('ul').remove();
        //         }
        //     })
        // })
    </script>
@endsection
