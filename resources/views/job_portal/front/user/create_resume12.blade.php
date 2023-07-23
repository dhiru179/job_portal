@extends('job_portal.front.layout.layout')
@section('title', 'create-resume')
{{-- @section('dash', 'active') --}}
@section('layout')
    <div class="container">
        <div id="carouselExampleControls" class="carousel bg-light mt-3" data-bs-ride="carousel" data-bs-interval="false">
            <div class="carousel-inner ">

                <div class="carousel-item  ">
                    <h5 class="text-center p-3">Personal Details</h5>
                    <form class="mb-3 col-8 offset-2 row " id="basic_info">
                        <input type="hidden" name="slug" value="basic_info">
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

                            <input type="text" placeholder="State*"
                                value="{{ !empty($user->state) ? $user->state : '' }}" name="state" id="state"
                                class="form-control">
                        </div>
                        <div class="mb-3 col-4">

                            <input type="text" placeholder="city*" value="{{ !empty($user->city) ? $user->city : '' }}"
                                name="city" id="city" class="form-control">
                        </div>
                        <div class="mb-3 col-4">

                            <input type="text" id="pincode" class="form-control"
                                value="{{ !empty($user->pincode) ? $user->pincode : '' }}" name="pincode"
                                placeholder="pincode*">
                        </div>
                        <div class="mb-3">

                            <input type="text" value="{{ auth()->user()->email }}" name="email" id="email"
                                class="form-control" placeholder="Email" readonly>
                        </div>
                        <div class="mb-3 col-6">

                            <input type="text" name="phone_1" id="phone_1" class="form-control"
                                value="{{ !empty($user->phone_1) ? $user->phone_1 : '' }}" placeholder="phone No*">
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
                                    <input class="form-check-input" type="radio" name="resume_status"
                                        id="resume_private1" value="private"
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
                                placeholder="About Myself...">{{ !empty($user->about_self) ? $user->about_self : '' }}</textarea>
                            <span id="about"></span>
                        </div>
                        <div class="mb-3 col-4">
                            <input type="text" name="nationality" onkeydown="return /[a-z]/i.test(event.key)"
                                id="nationality" value="{{ !empty($user->nationality) ? $user->nationality : '' }}"
                                class="form-control" placeholder="Nationality*">
                        </div>
                        <div class="mb-3 col-4">
                            <input type="text"
                                onclick="this.setAttribute('type','date');var date = new Date();date.setFullYear( date.getFullYear() - 16 );this.setAttribute('max',`${(date.getFullYear() ) + '-' + (date.getMonth()) + '-' + (date.getDate())}`)"
                                name="dob" id="dob" class="form-control"
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
                        <div class="mb-3">
                            <button type="button" class="btn btn-sm btn-dark" id="">save</button>
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

                <div class="carousel-item ">
                    <h5 class="text-center p-3">Educational Qualification</h5>
                    <form class="mb-3 col-8 offset-2">
                        <input type="hidden" name="slug" value="educations">
                        @if (count($edu) > 0)
                            @foreach ($edu as $key => $educations)
                                <div class="mb-3 row border border-1 border-info p-3">
                                    <div class="mb-3">
                                        <select class="form-select" name="qualification[]"
                                            id="qualification{{ $key }}"
                                            onchange="highestQualifications(this,'')">
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
                                        <input type="text" class="form-control"
                                            value="{{ $educations->institute_name }}" name="institute_name[]"
                                            id="institute_name{{ $key }}" placeholder="college/institute">
                                    </div>
                                    <div class="mb-3 ">
                                        <input type="text" class="form-control"
                                            value="{{ $educations->board_university }}" name="board[]"
                                            id="board_university{{ $key }}" placeholder="Board/University">
                                    </div>
                                    <div class="mb-3 10th 12th">
                                        <input type="text" class="form-control" value="{{ $educations->course }}"
                                            name="course[]" id="course{{ $key }}"
                                            placeholder="Course(eg.B.tech)">
                                    </div>
                                    <div class="mb-3 10th">
                                        <input type="text" class="form-control"
                                            value="{{ $educations->specialization }}" name="specialization[]"
                                            id="specialization{{ $key }}"
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
                                    <input type="text" class="form-control" name="institute_name[]"
                                        id="institute_name0" placeholder="college/institute">
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
                                    <input type="text" class="form-control" name="specialization[]"
                                        id="specialization0" placeholder="Field in Study(eg.computer science)">
                                </div>
                                <div class="mb-3">
                                    <div class="d-flex input-group">
                                        <input type="text" onclick="this.setAttribute('type','date')"
                                            placeholder="Start Year" class="form-control 10th" name="start_year[]"
                                            value="">
                                        <span class="input-group-text 10th">-</span>
                                        <input type="text" onclick="this.setAttribute('type','date')"
                                            class="form-control" name="passing_year[]" placeholder="Passing Year">
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
                        <div class="mb-3">
                            <button type="button" class="btn btn-sm btn-dark">save</button>
                        </div>


                    </form>
                </div>

                <div class="carousel-item ">
                    <h5 class="text-center p-3">Work Experience & Skill</h5>
                    <form class="mb-3 col-8 offset-2" id="work1" enctype="multipart/form-data">
                        <input type="hidden" name="slug" value="work_experience">
                        <input type="hidden" name="basic_info_id" value="{{ !empty($user->id) ? $user->id : '' }}">

                        <div class="mb-3">

                            {{-- <input type="text" class="form-control" onkeyup="addLocation(event,this)" list="cities"
                                id="add-location" placeholder="Preferred Locations(maximum 8 cities)">
                            <datalist id="cities">
                                @foreach ($city as $item)
                                    <option data-id="{{ $item->id }}" value="{{ $item->name }}">
                                @endforeach

                            </datalist> --}}
                            <select class="form-select" onchange="addLocation(event,this)" id="">
                                @php
                                    $count = count($job_loc);
                                    for ($i = 0; $i < count($city); $i++) {
                                        $id = $city[$i]->id;
                                        $name = $city[$i]->name;
                                        if (count($job_loc) > 0) {
                                            for ($j = 0; $j < count($job_loc); $j++) {
                                                if ($id == $job_loc[$j]->location_id) {
                                                    echo "<option disabled value='$id'>$name</option>";
                                                }
                                            }
                                        }
                                        echo "<option value='$id'>$name</option>";
                                    }
                                @endphp
                            </select>
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
                                name="has_experience" id="has_experience"
                                {{ !empty($user->has_experience) && $user->has_experience == 'yes' ? 'checked' : '' }}>
                        </div>
                        <div id="work_experience" class="mb-3">

                            @if (!empty($user->has_experience) && $user->has_experience == 'yes')
                                <div id="tbody_experience">
                                    @foreach ($exp as $key => $item)
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

                                                <input type="text" class="form-control"
                                                    value="{{ $item->company_name }}" name="company_name[]"
                                                    id="company_name{{ $key }}" placeholder="Company Name*">
                                            </div>

                                            <div class="mb-3">

                                                <input type="text" class="form-control"
                                                    value="{{ $item->desigination }}" name="desigination[]"
                                                    id="desigination{{ $key }}" placeholder="Desigination*">
                                            </div>
                                            <div class="mb-3">

                                                <input type="text" class="form-control" value="{{ $item->job_city }}"
                                                    name="job_city[]" id="job_city{{ $key }}"
                                                    placeholder="City*">
                                            </div>

                                            <div class="d-flex input-group mb-3">
                                                <label for="" class="input-group-text" id="time_duration">Time
                                                    Duration</label>
                                                <input type="text" onclick="this.setAttribute('type','date')"
                                                    value="{{ $item->joining_data }}" class="form-control"
                                                    name="start_date[]" placeholder="form">
                                                <span class="input-group-text">-</span>
                                                <input type="text" onclick="this.setAttribute('type','date')"
                                                    value="{{ $item->last_date }}" class="form-control"
                                                    name="end_date[]" placeholder="to">
                                            </div>


                                            <div class="mb-3">
                                                <select class="form-select ad-job-skills"
                                                    onchange="addJobSkills(this,{{ $key }})"
                                                    id="add-job-skills{{ $key }}">
                                                    <option value="">--</option>
                                                    <option value="abc">abc</option>
                                                    <option value="dss">dss</option>
                                                </select>
                                                <div class="append-job_skills" key="{{ $key }}"
                                                    id="append-job_skills{{ $key }}">
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
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="col-3 me-1">
                                    <input type="text" class="form-control" placeholder="Social Name"
                                        id="social_name">
                                </div>
                                <div class="col-8 me-1">
                                    <input type="text" class="form-control" placeholder="url address"
                                        id="social_url">
                                </div>
                                <div class="col-1">
                                    <input type="button" class="btn btn-sm btn-primary"
                                        onclick="addRow(this,'tbody_social_profile')" value="Add">
                                </div>
                            </div>
                            <div id="tbody_social_profile">

                            </div>
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
                        <div class="mb-3">
                            <button type="button" class="btn btn-sm btn-dark" id="">save</button>
                        </div>
                    </form>
                </div>
                <div class="carousel-item active">
                    <div class="border border-1 border-info bg-white p-3">
                        <div class="d-flex justify-content-between mb-3">
                            <div class="col-8">
                                <h5>{{ !empty($user->f_name) ? $user->f_name : '' }}
                                    {{ !empty($user->m_name) ? $user->m_name : '' }}
                                    {{ !empty($user->m_name) ? $user->l_name : '' }}</h5>
                                <div>
                                    <span>{{ !empty($user->city) ? $user->city : '' }}</span>
                                </div>
                                <div>
                                    <span>{{ auth()->user()->email }}</span>
                                </div>
                                <div>
                                    <span>{{ !empty($user->phone_1) ? $user->phone_1 : '' }}</span>
                                </div>
                                <div>
                                    <span>website</span>
                                </div>
                            </div>
                            <div class="col-4 d-flex flex-column justify-content-center align-items-center">
                                <div class="bg-light" style="width: 150px;height:50px">

                                </div>
                                <a class="btn btn-sm btn-info" href="">upload img</a>
                            </div>
                        </div>
                        <div class="mb-3">
                            @if (count($edu) > 0)
                                <div class="d-flex justify-content-between border p-1 mb-3">
                                    <div class="">
                                        <h5 class="m-0">Education</h5>
                                    </div>
                                    <div>
                                        <input type="button" key="educations" object={{ json_encode($edu) }}
                                            class="btn btn-sm btn-info addt" value="Add">
                                    </div>
                                </div>
                                @foreach ($edu as $item)
                                    <div class="mb-3 row">
                                        <div class="col-2">
                                            <span
                                                class="text-muted">{{ $educations->start_year }}-{{ $educations->passing_year }}</span>
                                        </div>
                                        <div class="col-8 d-flex flex-column">
                                            <span>{{ $educations->board_university }}</span>
                                            <span class="text-muted">{{ $educations->institute_name }}</span>
                                            <span class="text-muted">{{ $educations->course }}</span>
                                            <span class="text-muted">field in study</span>
                                        </div>
                                        <div class="col-2 d-flex justify-content-end" style="max-height: 30px">
                                            <a class="btn btn-sm btn-info me-1" href="">edit</a>
                                            {{-- <a class="btn btn-sm btn-danger" href="">del</a> --}}
                                        </div>
                                    </div>
                                @endforeach
                            @endif

                        </div>
                        <div class="mb-3">
                            <div class="d-flex justify-content-between border p-1 mb-3">
                                <div class="">
                                    <h5 class="m-0">SKILLS</h5>
                                </div>
                                <div>
                                    <input type="button" class="btn btn-sm btn-info addt" value="Add">
                                </div>
                            </div>
                            <div class="d-flex">
                                @if (count($user_skill) > 0)
                                    @foreach ($user_skill as $item)
                                        <span class="me-1">{{ $item->skills }}</span>
                                    @endforeach
                                @endif
                            </div>

                        </div>
                        <div class="mb-3">
                            <div class="d-flex justify-content-between border p-1 mb-3">
                                <div class="">
                                    <h5 class="m-0">EXPERIENCE</h5>
                                </div>
                                <div>
                                    <input type="button" class="btn btn-sm btn-info addt" value="Add">
                                </div>
                            </div>
                            @if (count($exp) > 0)
                                @foreach ($exp as $item)
                                    <div class="mb-3 row">
                                        <div class="col-2">
                                            <span
                                                class="text-muted">{{ explode('-', $item->joining_data)[0] }}-{{ explode('-', $item->last_date)[0] }}</span>
                                        </div>
                                        <div class="col-8 d-flex flex-column">
                                            <span>{{ $item->company_name }}</span>
                                            <span class="text-muted">{{ $item->job_city }}</span>
                                            <span class="text-muted">{{ $item->desigination }}</span>
                                            <div class="d-flex">
                                                @foreach (json_decode($item->skills) as $skill)
                                                    <span class="text-muted me-1">{{ $skill }}</span>
                                                @endforeach
                                            </div>

                                        </div>
                                        <div class="col-2 d-flex justify-content-end" style="max-height: 30px">
                                            <a class="btn btn-sm btn-info me-1" href="">edit</a>
                                            {{-- <a class="btn btn-sm btn-danger" href="">del</a> --}}
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <div class="mb-3">
                            <div class="d-flex justify-content-between border p-1 mb-3">
                                <div class="">
                                    <h5 class="m-0">PREFERABLE LOCATION</h5>
                                </div>
                                <div>
                                    <input type="button" class="btn btn-sm btn-info addt" value="Add">
                                </div>
                            </div>
                            <div class="d-flex">
                                @if (count($job_loc) > 0)
                                    @foreach ($job_loc as $item)
                                        <span class="me-1">{{ $item->name }}</span>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="mt-3 d-flex">
                        <button class="btn btn-sm btn-primary me-1">dawnload</button>
                        <button class="btn btn-sm btn-warning me-1">print</button>
                        <button class="btn btn-sm btn-success">email</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-end my-3">

            <button type="button" class="btn btn-success mx-3" id="backForm" data-bs-target="#carouselExampleControls"
                data-bs-slide="prev">Back</button>
            <button type="button" class="btn btn-danger mx-3" id="nextForm" data-bs-target="#carouselExampleControls"
                data-bs-slide="next">Save And Continue</button>
        </div>
        <div class="modal fade" id="myModal" data-bs-backdrop="static" tabindex="-1"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
        </div>
    </div>
    <script>
        let count = 0;
        let job_location = [];
        let skill = [];
        let job_skill = [];
        let validate = {
            required: function(e) {
                typeof e == 'string' ? id = e : id = e.target.id;
                let inputField = $('#' + id);
                // $('#'+id).next().find('span').remove();
                $('#' + id).parent().find('span.custom_error').remove();

                if ($.trim(inputField.val()) == '') {

                    $('#' + id).after(`<span class="text-danger custom_error">This field is required</span>`)
                    validate.is_validate = true;
                }
                return validate.is_validate;
            },
            email: function(e) {
                typeof e == 'string' ? id = e : id = e.target.id;
                let emailPattern = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
                let inputField = $('#' + id);
                // $('#'+id).next().find('span').remove();
                $('#' + id).parent().find('span.custom_error').remove();

                if ($.trim(inputField.val()) == '') {
                    validate.required(id);

                } else {
                    if (!emailPattern.test(inputField.val())) {
                        validate.is_validate = true;
                        $('#' + id).after(`<span class="text-danger custom_error">Enter Valid Email address</span>`)
                    } else {
                        validate.is_validate = false;
                        // $('#admin_email_msg').html('');
                    }
                }
            }

        };
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
                                    <div id="append-job_skills${count}">

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
            post: (url, data, elem) => {
                $.ajax({
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}",
                    },
                    contentType: false,
                    processData: false,
                    url: url,
                    data: data,
                    success: function(res) {
                        console.log(res);

                        if (res.status) {
                            if (res.error != "") {
                                objForm.returnError(res.error);
                                return false;
                            } else if (res.msg != "  ") {
                                alert(res.msg);
                                // $(elem).attr('data-bs-target', "#carouselExampleControls");
                                // $(elem).attr('data-bs-slide', "next");
                                // $(elem).trigger('click');
                                return false;
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


        }

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
                console.log(validate.is_validate)
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
                if ($('#append-job_skills' + count).find('input').length == 0) {
                    $('#add-job-skills' + count).parent().find('span.custom_error').remove();
                    $('#add-job-skills' + count).after(`<span class="text-danger custom_error">Select job skills</span>`)
                    validate.is_validate = true;
                }
                console.log(validate.is_validate)
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
                    console.log('count')
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



        function highestQualifications(elem, count) {
            console.log($(elem).find(":selected").text().trim())
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

        function addLocation(e, elem) {
            $('#append-location').parent().find('span.custom_error').remove();
            let count = $(elem).find('option[disabled]').length;
            if (count > 3) {
                return
            }
            let text = $(elem).find(`[value=${$(elem).val()}]`).text()
            console.log(elem.value, text)
            job_location.push(parseInt(elem.value));
            let html =
                `<input type="button" onclick="removeLocation(this,${elem.value})" class="btn btn-outline-dark me-1 my-1 btn-sm " value="${text}">`;
            $('#append-location').append(html);
            // e.target.value = "";
            $(elem).find(`[value=${$(elem).val()}]`).attr('disabled', true);

        }

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
            validate.is_validate = false;
            validate.required('add-skills');
            if (validate.is_validate == false) {

                if (e.keyCode == 188 || e.keyCode == 32 || e.keyCode == 13) {
                    skill.push(e.target.value)

                    let html =
                        `<input type="button" onclick="removeSkills(this,'user_skills')" class="btn btn-outline-dark me-1 my-1 btn-sm" value="${e.target.value}">`;
                    $('#append-skills').append(html);

                    $('.ad-job-skills').append(`<option value=${e.target.value}>${e.target.value}</option>`)

                    e.target.value = "";
                }
            }

        }



        function addJobSkills(elem, count) {
            $('#add-job-skills' + count).parent().find('span.custom_error').remove();
            $(elem).find(`option[value=${elem.value}]`).attr('disabled', 'true');
            if (!job_skill[count]) {
                job_skill[count] = [];
            }
            console.log(count);
            job_skill[count].push(elem.value);
            let html =
                `<input type="button" onclick="removeSkills(this,'job_skills',${count})" class="btn btn-outline-dark me-1 my-1 btn-sm"  value="${elem.value}">`;

            $('#append-job_skills' + count).append(html);

        }


        
        function isValidate(form_data, step) {
            validate.is_validate = false;
            if (step == 0) {
                validate.required('fname');
                validate.required('phone_1')
                validate.required('city');
                validate.required('state');
                validate.required('pincode');
                validate.required('address_1');
                validate.required('dob');
                validate.required('nationality');
                validate.required('email');
            } else if (step == 1) {

            } else if (step == 2) {



                if (job_location.length == 0) {
                    $('#append-location').parent().find('span.custom_error').remove();
                    $('#append-location').after(`<span class="text-danger custom_error">Select Job location</span>`)
                    validate.is_validate = true;
                }
                if (skill.length == 0) {
                    $('#add-skills').parent().find('span.custom_error').remove();
                    $('#add-skills').after(`<span class="text-danger custom_error">Select skills</span>`)
                    validate.is_validate = true;
                }
                if ($('#has_experience').prop('checked')) {
                    if ($('#current_salary').val().length == 0) {
                        $('#current_salary').parent().find('span.custom_error').remove();
                        $('#current_salary').parent().after(
                            `<span class="text-danger custom_error">This field id required</span>`)
                    }
                }
            }

            return validate.is_validate;
        }

        function addArray(form_data) {


            if (job_location.length > 0) {
                for (let index = 0; index < job_location.length; index++) {
                    form_data.push({
                        name: 'jobLocation[]',
                        value: job_location[index]
                    })
                }

            }
            if (skill.length > 0) {
                for (let index = 0; index < skill.length; index++) {
                    // const element = array[index];
                    form_data.push({
                        name: 'user_skill[]',
                        value: skill[index]
                    })
                }

            }
            if (job_skill.length > 0) {
                for (let i = 0; i < job_skill.length; i++) {
                    // const element = array[index];
                    for (let j = 0; j < job_skill[i].length; j++) {
                        // const element = array[j];
                        form_data.push({
                            name: `job_skill[${i}][]`,
                            value: job_skill[i][j]
                        })
                    }

                }
            }


        }

        $($('div.active').find('button[type=button]')[0]).click(function(e) {
            //    alert('d')
            // console.log(e)
            let form_data = $($('div.active').find('form')[0]).serializeArray();
            console.log(form_data);
            // if ($('div.active').index() == 2) {
            //     addArray(form_data);
            // }
            if (!isValidate(form_data, $('div.active').index())) {
                const url = "{{ route('users.create-resume-post') }}";
                console.log(form_data)
                objForm.post(url, form_data, '');
            } else {
                alert('validation failed');
            }
        })


        $('#nextForm').click(() => {
            // $('#carouselExampleControls').trigger()
            console.log($('.item').length, $('div.active').index(), $('div.active').find('form')[0]);
            // let active_step = $('div.active').index();

            $($('div.active').find('button[type=button]')[0]).click(function(e) {
                e.preventDefault();
                let form_data = $($('div.active').find('form')[0]).serializeArray();
                if ($('div.active').index() == 2) {
                    addArray(form_data);
                }
                if (!isValidate(form_data, $('div.active').index())) {
                    const url = "{{ route('users.create-resume-post') }}";
                    var data = new FormData();
                    $.each(form_data, function(key, input) {
                        // console.log(`${input.name}`, input.value);
                        data.append(`${input.name}`, input.value);
                    });

                    //File data
                    $('input[type="file"]').each(function() {
                        // console.log(this)
                        data.append(this.name, this.files[0])
                    })
                    console.log(form_data, data)
                    objForm.post(url, data, '');
                } else {
                    alert('validation failed');
                }
            })
        })
        var autoLoad = (function() {

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

            $('.append-job_skills[key]').each(function() {
                let i = parseInt($(this).attr('key'));
                if (!job_skill[i]) {
                    job_skill[i] = [];
                }
                $(this).find('input.btn-success').each(function() {
                    job_skill[i].push($(this).val());
                })
            })

        }());



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
                $('#work_experience').append(html);
                elem.value = 'yes';

            } else {
                $('#work_experience').html('');
            }
        }

        // $('.addt').(function() {
        $('.addt').click(function() {
            // console.log(objForm.formModal("df"));
            $('#myModal').html('')
            let html = "";
            let key = $(this).attr('key');
            let data = JSON.parse($(this).attr('object'));
            console.log(key, data)
            if (key == "educations") {
                let edu = "";
                data.forEach(element => {
                    edu += objForm.formHtmlEducation(count, element);
                });
                html = objForm.formModal(edu);
            }
            $('#myModal').append(html);
            $('#myModal').modal('show')
        })
        // })
    </script>
@endsection
