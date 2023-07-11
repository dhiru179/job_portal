@extends('job_portal.front.layout.layout')
@section('title', 'create-resume')
{{-- @section('dash', 'active') --}}
@section('layout')
    <div class="container">
        <div id="carouselExampleControls" class="carousel  mb-3" data-bs-ride="carousel" data-bs-interval="false">
            <div class="carousel-inner">

                <div class="carousel-item active">
                    <form onsubmit="return createResume(event,this)" method="POST" class="mb-3 col-8 offset-2 row">
                        @csrf
                        <h5>Basic Education</h5>
                        <input type="hidden" name="slug" value="basic_info">
                        <div class="mb-3 col-4">
                            <label for="">Enter Name</label>
                            <input type="text" name="fname" value="{{ $user->name }}" id="fname"
                                class="form-control">
                        </div>
                        <div class="mb-3 col-4">
                            <label for="">Middle Name</label>
                            <input type="text" name="mname" value="" id="mname" class="form-control">
                        </div>
                        <div class="mb-3 col-4">
                            <label for="">Last Name</label>
                            <input type="text" name="lname" value="" id="lname" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="">Email</label>
                            <input type="text" value="{{ $user->email }}" name="email" id="email"
                                class="form-control w-50">
                        </div>
                        <div class="mb-3 col-4">
                            <label for="">phone 1</label>
                            <input type="text" value="{{ $user->phone }}" name="phone_1" id="phone_2"
                                class="form-control">
                        </div>
                        <div class="mb-3 col-4">
                            <label for="">phone 2</label>
                            <input type="text" value="" name="phone_1" id="phone_2" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label class="me-3" for="">Gender</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="inlineRadio1"
                                    value="male">
                                <label class="form-check-label" for="inlineRadio1">Male</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="inlineRadio2"
                                    value="female">
                                <label class="form-check-label" for="inlineRadio2">Female</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="others" id="inlineRadio3"
                                    value="option3">
                                <label class="form-check-label" for="inlineRadio3">Others</label>
                            </div>

                        </div>
                        <div class="mb-3 col-4">
                            <label for="">Date Of Birth</label>
                            <input type="date" name="dob" id="dob" class="form-control">
                        </div>
                        <div class="mb-3 col-4">
                            <label class="me-3" for="">Marital Status</label>
                            <select class="form-select" name="marital" id="">
                                <option value=""></option>
                                <option value="married">Married</option>
                                <option value="single">Single</option>
                                <option value="widowed">Widowed</option>
                                <option value="seperated">Seperated</option>
                                <option value="divorced">Divorced</option>
                            </select>
                        </div>
                        <div class="mb-3 col-4">
                            <label for="">Nationality</label>
                            <input type="text" class="form-control">
                        </div>
                        <div class="mb-3 col-4">
                            <label for="">State</label>
                            <input type="text" name="state" class="form-control">
                        </div>
                        <div class="mb-3 col-4">
                            <label for="">City</label>
                            <input type="text" name="city" class="form-control">
                        </div>
                        <div class="mb-3 col-4">
                            <label for="">Pincode</label>
                            <input type="text" class="form-control" name="pincode">
                        </div>
                        <div class="mb-3">
                            <label for="">Address</label>
                            <textarea name="address" class="form-control" id="" cols="1" rows="1"></textarea>
                        </div>
                        <div class="mb-3">
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
                                            <input class="form-check-input" type="checkbox" name="speak[]"
                                                id="inlineRadio1" onclick="" value="true">

                                        </td>
                                        <td>
                                            <input class="form-check-input" type="checkbox" name="read[]"
                                                id="inlineRadio1" value="true">
                                        </td>
                                        <td>
                                            <input class="form-check-input" type="checkbox" name="write[]"
                                                id="inlineRadio1" value="true">
                                        </td>
                                        <td>
                                            <input type="button" class="btn btn-sm btn-primary"
                                                onclick="addRow('tbody_lan')" value="Add">
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                        <div class="mb-3">
                            <label for="">About</label>
                            <textarea name="about" class="form-control" id="" cols="1" rows="1"></textarea>
                        </div>
                        <div class="mb-3">
                            <input type="submit" class="btn btn-primary" value="save">
                        </div>
                    </form>
                </div>
                <div class="carousel-item ">
                    <form onsubmit="return createResume(event,this)" method="POST" class="mb-3 row">
                        @csrf
                        <h5>Resume Objective</h5>
                        <input type="hidden" name="slug" value="resume_headlines">
                        <div class="mb-3">
                            <label for="">Objective</label>
                            <textarea class="form-control" name="resume_headline" id="resume_headline"></textarea>
                        </div>
                        <div class="mb-3">
                            <input type="submit" class="btn btn-primary" value="Save">
                        </div>
                    </form>
                </div>
                <div class="carousel-item ">
                    <form onsubmit="return createResume(event,this)" method="POST" class="mb-3 col-8 offset-2">
                        @csrf
                        <div class="mb-3 row">
                            <input type="hidden" name="slug" value="educations">
                            <div class="mb-3 col-4">
                                <label for="qualification">Qualification</label>
                                <select class="form-select" name="qualification[]" id="qualification"
                                    onchange="standard(this,'')">
                                    @foreach ($qualifications as $item)
                                        <option value="{{ $item->id }}">{{ $item->standard }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3 col-4">
                                <label for="institute_name">Institute/Schools</label>
                                <input type="text" class="form-control" name="institute_name[]" id="institute_name">
                            </div>
                            <div class="mb-3 col-4">
                                <label for="board_university"></label>
                                <select class="form-select" name="board[]" id="board_university">
                                    @foreach ($boards as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3 col-4">
                                <label for="" id="change_passing_year">passing year</label>
                                <div class="d-flex input-group">
                                    <input type="text" class="form-control d-none if_not_10_12th" name="start_year[]"
                                        value="">
                                    <span class="input-group-text d-none if_not_10_12th">-</span>
                                    <input type="text" class="form-control" name="end_year[]">
                                </div>
                            </div>

                            <div class="mb-3 col-4 d-none if_not_10_12th">
                                <label for="course">Course</label>
                                <input type="text" class="form-control" name="course[]">
                            </div>
                            <div class="mb-3 col-4 d-none if_not_10_12th">
                                <label for="specialization">Specialization</label>
                                <input type="text" class="form-control" name="specialization[]" id="specialization">
                            </div>

                            <div class="mb-3 col-4">
                                <label for="marks">Marks/Grade</label>
                                <input type="text" class="form-control" name="marks[]" id="marks">
                            </div>
                            <div class="mb-3 col-4">
                                <label for="total_marks">Total Marks</label>
                                <input type="text" class="form-control" name="total_marks[]" id="total_marks">
                            </div>
                            <hr>
                        </div>
                        <div id="tbody_education" class="mb-3">

                        </div>

                        <div class="">
                            <input type="button" class="btn btn-primary" onclick="addRow('tbody_education')"
                                value="Add">
                        </div>
                    </form>
                </div>
                <div class="carousel-item ">
                    <form onsubmit="return createResume(event,this)" method="POST" class="mb-3 col-8 offset-2">
                        @csrf
                        <div class="mb-3">
                            <label for="">Select Location</label>
                            <input type="text" class="form-control" id="my-element">
                        </div>
                        <div class="mb-3 row">
                            <input type="hidden" name="slug" value="work_experience">
                            <div class="mb-3 col-4">
                                <label class="me-3" for="">Current Working</label>
                                <select name="current_working[]" class="form-select" id="">
                                    <option value="yes">Yes</option>
                                    <option value="no">No</option>
                                </select>
                            </div>
                            <div class="mb-3 col-4">
                                <label class="me-3" for="">Working Type</label>
                                <select name="working_type[]" class="form-select" id="">
                                    <option value="part">Part Time</option>
                                    <option value="full">Full Time</option>
                                </select>

                            </div>

                            <div class="mb-3 col-4">
                                <label for="company_name">Company Name</label>
                                <input type="text" class="form-control" name="company_name[]" id="company_name">
                            </div>

                            <div class="mb-3 col-4">
                                <label for="desigination">Desigination</label>
                                <input type="text" class="form-control" name="desigination[]" id="desigination">
                            </div>
                            <div class="mb-3 col-4">
                                <label for="job_city">Job City</label>
                                <input type="text" class="form-control" name="job_city[]" id="job_city">
                            </div>
                            <div class="mb-3 col-4">
                                <label for="" id="time_duration">Time Duration</label>
                                <div class="d-flex input-group">
                                    <input type="text" class="form-control" name="start_date[]" value="">
                                    <span class="input-group-text">-</span>
                                    <input type="text" class="form-control" name="end_date[]">
                                </div>
                            </div>

                            <div class="mb-3 col-4">
                                <label for="job_skill">Job Skills</label>
                                <input type="text" class="form-control" name="job_skills[1][]">
                            </div>
                            <div class="mb-3">
                                <label for="Job Descriptions">Job Descriptions</label>
                                <textarea name="job_desc[]" class="form-control" id="" cols="3" rows="3"></textarea>
                            </div>
                        </div>
                        <hr>
                        <div id="tbody_experience" class="mb-3">

                        </div>

                        <div class="">
                            <input type="button" class="btn btn-primary" onclick="addRow('tbody_experience')"
                                value="Add">
                        </div>
                    </form>
                </div>
                <div class="carousel-item ">

                </div>
                <div class="carousel-item ">

                </div>
            </div>
            {{-- <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button> --}}

        </div>
        <div class="d-flex justify-content-end">
            <button type="button" class="btn btn-danger mx-3" data-bs-target="#carouselExampleControls"
                data-bs-slide="next">Save And Continue</button>
        </div>
    </div>
    <script>
        let count = 1;
        let objForm = {
            formHtmlEducation: (count) => {
                return `<div class="row mx-0"> <div class="mb-3 col-4">
                                <label for="qualification">Qualification</label>
                                <select class="form-select" name="qualification[]" id="qualification"
                                    onchange="standard(this,${count})">
                                    @foreach ($qualifications as $item)
                                        <option value="{{ $item->id }}">{{ $item->standard }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3 col-4">
                                <label for="institute_name">Institute/Schools</label>
                                <input type="text" class="form-control" name="institute_name[]" id="institute_name">
                            </div>
                            <div class="mb-3 col-4">
                                <label for="board_university"></label>
                                <select class="form-select" name="board[]" id="board_university">
                                    @foreach ($boards as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3 col-4">
                                <label for="" id="change_passing_year${count}">passing year</label>
                                <div class="d-flex input-group">
                                    <input type="text" class="form-control d-none if_not_10_12th${count}" name="start_year[]"
                                        value="">
                                    <span class="input-group-text d-none if_not_10_12th${count}">-</span>
                                    <input type="text" class="form-control" name="end_year[]">
                                </div>
                            </div>
    
                            <div class="mb-3 col-4 d-none if_not_10_12th${count}">
                                <label for="course">Course</label>
                                <input type="text" class="form-control" name="course[]">
                            </div>
                            <div class="mb-3 col-4 d-none if_not_10_12th${count}">
                                <label for="specialization">Specialization</label>
                                <input type="text" class="form-control" name="specialization[]" id="specialization">
                            </div>
    
                            <div class="mb-3 col-4">
                                <label for="marks">Marks/Grade</label>
                                <input type="text" class="form-control" name="marks[]" id="marks">
                            </div>
                            <div class="mb-3 col-4">
                                <label for="total_marks">Total Marks</label>
                                <input type="text" class="form-control" name="total_marks[]" id="total_marks">
                            </div>  <div class="mb-3">
                                <input type="button" class="btn btn-sm btn-danger" onclick="removeRow(this)"
                                    value="del">
                              </div><hr> </div>`;

            },
            formHtmlLanguage: (count) => {
                return `<tr id="tr1">
                                <td class="text-center">
                                    <input type="text" name="language[]" class="form-control form-control-sm">
                                </td>
                                
                                <td>
                                  <input class="form-check-input" type="checkbox" name="speak[]"
                                                id="inlineRadio1" onclick="" value="true">
                                              
                                 </td>
                                 <td>
                                   <input class="form-check-input" type="checkbox" name="read[]"
                                                id="inlineRadio1" value="true">
                                    </td>
                                 <td>
                                                <input class="form-check-input" type="checkbox" name="write[]"
                                                id="inlineRadio1" value="true">
                               </td>
                                <td>
                                    <input type="button" class="btn btn-sm btn-danger" onclick="removeRow(this)"
                                        value="Remove">
                                </td>
                            </tr>`;
            },
            formHtmlSkills: () => {
                return `      <tr>
                                <td class="text-center">
                                    <input type="text" name="skills[]" class="form-control">
                                </td>

                                <td>
                                    <input type="button" class="btn btn-sm btn-danger" onclick="removeRow(this)"
                                        value="del">
                                </td>
                            </tr>`;
            },
            formHtmlProject: () => {
                return ` <tr>
                            <td class="text-center">
                                <input type="text" name="project_title[]" class="form-control">
                            </td>
                            <td class="text-center">
                                <div class="d-flex">
                                    <input type="text" name="time_taken[]" class="form-control">
                                    <select class="form-select" name="duration_qty[]" id="">
                                        <option value="days">days</option>
                                        <option value="weeks">weeks</option>
                                        <option value="months">months</option>
                                    </select>
                                 </div>
                            </td>
                            <td>
                                <textarea name="about_project" id="" class="form-control"></textarea>
                            </td>
                            <td>
                                <input type="button" class="btn btn-sm btn-danger" onclick="removeRow(this)"
                                    value="del">
                             </td>
                        </tr>`;
            },
            formHtmlSocialProfile: () => {
                return `     <tr>
                            <td class="text-center">
                                <input type="text" name="social_name[]" class="form-control">
                            </td>
                            <td class="text-center">
                                <input type="text" name="social_url[]" class="form-control">
                            </td>
                            <td>
                                <input type="button" class="btn btn-sm btn-danger" onclick="removeRow(this)"
                                    value="del">
                             </td>
                        </tr>`;
            },
            formHtmlExperience: (count) => {
                return `  <div class="row mx-0">
                            <div class="mb-3 col-4">
                                <label class="me-3" for="">Current Working</label>
                                <select name="current_working[]" class="form-select" id="">
                                    <option value="yes">Yes</option>
                                    <option value="no">No</option>
                                </select>
                            </div>
                            <div class="mb-3 col-4">
                                <label class="me-3" for="">Working Type</label>
                                <select name="working_type[]" class="form-select" id="">
                                    <option value="part">Part Time</option>
                                    <option value="full">Full Time</option>
                                </select>

                            </div>

                            <div class="mb-3 col-4">
                                <label for="company_name">Company Name</label>
                                <input type="text" class="form-control" name="company_name[]" id="company_name">
                            </div>

                            <div class="mb-3 col-4">
                                <label for="desigination">Desigination</label>
                                <input type="text" class="form-control" name="desigination[]" id="desigination">
                            </div>
                            <div class="mb-3 col-4">
                                <label for="job_city">Job City</label>
                                <input type="text" class="form-control" name="job_city[]" id="job_city">
                            </div>
                            <div class="mb-3 col-4">
                                <label for="" id="time_duration">Time Duration</label>
                                <div class="d-flex input-group">
                                    <input type="text" class="form-control" name="start_date[]" value="">
                                    <span class="input-group-text">-</span>
                                    <input type="text" class="form-control" name="end_date[]">
                                </div>
                            </div>

                            <div class="mb-3 col-4">
                                <label for="job_skill">Job Skills</label>
                                <input type="text" class="form-control" name="job_skills[1][]">
                            </div>
                            <div class="mb-3">
                                <label for="">Job Descriptions</label>
                                <textarea name="job_desc[]" class="form-control" id="" cols="3" rows="3"></textarea>
                            </div>
                        
                        <div class="mb-3">
                            <input type="button" class="btn btn-sm btn-danger" onclick="removeRow(this)"
                                value="del">
                         </div>
                              <hr>
                        </div>         
                            `;
            }

        }

        function addRow(slug) {
            count++;
            if (slug == "tbody_lan") {
                $('#' + slug).append(objForm.formHtmlLanguage(count));
            } else if (slug == "tbody_education") {
                $('#' + slug).append(objForm.formHtmlEducation(count));
            } else if (slug == 'tbody_skills') {
                $('#' + slug).append(objForm.formHtmlSkills());
            } else if (slug == 'tbody_project') {
                $('#' + slug).append(objForm.formHtmlProject());
            } else if (slug == 'tbody_social_profile') {
                $('#' + slug).append(objForm.formHtmlSocialProfile());
            } else if (slug == 'tbody_experience') {
                $('#' + slug).append(objForm.formHtmlExperience(count))
            }
        }

        function removeRow(elem) {
            $($(elem).parent()).parent().remove();
            // $('#tr' + id).remove();
        }

        function createResume(e, form) {
            validate.is_validate = false;
            // validate.required('email');
            // validate.required('password')
            if (validate.is_validate == false) {
                const url = "{{ route('users.create-resume-post') }}";
                $(form).attr('action', url);

            }
            // e.preventDefault();
        }

        function standard(elem, count) {
            console.log($(elem).find(":selected").text().trim())
            $val = $(elem).find(":selected").text().trim();
            if ($val == "10th" || $val == "12th") {
                $('#change_passing_year' + count).text('passing year');
                $('.if_not_10_12th' + count).addClass('d-none');
            } else {
                $('#change_passing_year' + count).text('Session');
                $('.if_not_10_12th' + count).removeClass('d-none');
            }
        }
        var mySellect = sellect("#my-element", {
            originList: ['banana', 'apple', 'pineapple', 'papaya', 'grape', 'orange', 'grapefruit', 'guava',
                'watermelon', 'melon'
            ],
            destinationList: ['banana', 'papaya', 'grape', 'orange', 'guava']
        });
        mySellect.init();
        
    </script>
@endsection
