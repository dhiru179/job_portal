@extends('job_portal.front.layout.layout')
@section('title', 'create-resume')
{{-- @section('dash', 'active') --}}
@section('layout')
    <div class="container">
        <div id="carouselExampleControls" class="carousel bg-light mt-3" data-bs-ride="carousel" data-bs-interval="false">
            <div class="carousel-inner ">

                <div class="carousel-item ">
                    <h5 class="text-center p-3">Personal Details</h5>
                    <form class="mb-3 col-8 offset-2 row " id="basic_info">
                        <input type="hidden" name="slug" value="basic_info">
                        <div class="mb-3 col-4">

                            <input type="text" name="fname" onkeydown="return /[a-z]/i.test(event.key)"
                                value="{{ $user->name }}" id="fname" class="form-control" placeholder="First Name*">
                        </div>
                        <div class="mb-3 col-4">

                            <input type="text" name="mname" onkeydown="return /[a-z]/i.test(event.key)" value=""
                                id="mname" class="form-control" placeholder="Middle Name">
                        </div>
                        <div class="mb-3 col-4">

                            <input type="text" name="lname" onkeydown="return /[a-z]/i.test(event.key)" value=""
                                id="lname" class="form-control" placeholder="Last Name">
                        </div>
                        <div class="mb-3">

                            <input name="address_1" class="form-control" id="address_1" placeholder="Address line 1*">
                        </div>
                        <div class="mb-3">

                            <input name="address_2" class="form-control" id="address_2" placeholder="Address line 2">
                        </div>
                        <div class="mb-3 col-4">

                            <input type="text" placeholder="State*" name="state" id="state" class="form-control">
                        </div>
                        <div class="mb-3 col-4">

                            <input type="text" placeholder="city*" name="city" id="city" class="form-control">
                        </div>
                        <div class="mb-3 col-4">

                            <input type="text" id="pincode" class="form-control" name="pincode" placeholder="pincode*">
                        </div>
                        <div class="mb-3">

                            <input type="text" value="{{ $user->email }}" name="email" id="email"
                                class="form-control" placeholder="Email" readonly>
                        </div>
                        <div class="mb-3 col-6">

                            <input type="text" value="{{ $user->phone }}" name="phone_1" id="phone_1"
                                class="form-control" placeholder="phone No*">
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
                                        value="public" checked>
                                    <label class="form-check-label" for="resume_public1">Male</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="resume_status" id="resume_private1"
                                        value="private">
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
                                        value="male" checked>
                                    <label class="form-check-label" for="inlineRadio1">Male</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" id="inlineRadio2"
                                        value="female">
                                    <label class="form-check-label" for="inlineRadio2">Female</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" id="inlineRadio3"
                                        value="others">
                                    <label class="form-check-label" for="inlineRadio3">Others</label>
                                </div>
                            </div>
                            <span id="gender"></span>
                        </div>
                        <div class="mb-3">

                            <textarea name="about" class="form-control" id="" cols="3" rows="3"
                                placeholder="About Myself..."></textarea>
                            <span id="about"></span>
                        </div>
                        <div class="mb-3 col-4">
                            <input type="text" name="nationality" onkeydown="return /[a-z]/i.test(event.key)"
                                id="nationality" class="form-control" placeholder="Nationality*">
                        </div>
                        <div class="mb-3 col-4">
                            <input type="text" onclick="this.setAttribute('type','date')" name="dob"
                                id="dob" class="form-control" placeholder="Date Of Birth*">
                        </div>
                        <div class="mb-3 col-4">
                            <select class="form-select" name="marital" id="marital">
                                <option value="">Select Marital Status</option>
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
                                                onclick="addRow('tbody_lan')" value="Add">
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
                        <div class="mb-3 row">
                            <div class="mb-3">
                                <select class="form-select" name="qualification[]" id="qualification.0"
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
                                <input type="text" class="form-control" name="institute_name[]" id="institute_name.0"
                                    placeholder="college/institute">
                            </div>
                            <div class="mb-3 ">
                                <input type="text" class="form-control" name="board[]" id="board_university.0"
                                    placeholder="Board/University">
                            </div>
                            <div class="mb-3 10th 12th">
                                <input type="text" class="form-control" name="course[]" id="course"
                                    placeholder="Course(eg.B.tech)">
                            </div>
                            <div class="mb-3 10th">
                                <input type="text" class="form-control" name="specialization[]" id="specialization.0"
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
                                    <span id="start_year.0"></span>
                                    <span id="passing_year.0"></span>
                                </div>
                            </div>
                            <hr>
                        </div>
                        <div id="tbody_education" class="mb-3">

                        </div>

                        <div class="d-flex justify-content-end">
                            <input type="button" class="btn btn-primary" onclick="addRow('tbody_education')"
                                value="Add">
                        </div>
                        <div class="mb-3">
                            <button type="button" class="btn btn-sm btn-dark">save</button>
                        </div>
                    </form>
                </div>

                <div class="carousel-item active">
                    <h5 class="text-center p-3">Work Experience & Skill</h5>
                    <form class="mb-3 col-8 offset-2" id="work1">
                        <input type="hidden" name="slug" value="work_experience">
                        <div class="mb-3">

                            {{-- <input type="text" class="form-control" onkeyup="addLocation(event,this)" list="cities"
                                id="add-location" placeholder="Preferred Locations(maximum 8 cities)">
                            <datalist id="cities">
                                @foreach ($city as $item)
                                    <option data-id="{{ $item->id }}" value="{{ $item->name }}">
                                @endforeach

                            </datalist> --}}
                            <select class="form-select" onchange="addLocation(event,this)" id="">
                                @foreach ($city as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                            <div id="append-location">
                            </div>
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control" onkeyup="addSkills(event)" id="add-skills"
                                placeholder="Skills">
                            <div id="append-skills">

                            </div>
                        </div>
                        <div class="mb-3 d-flex align-items-center">
                            <label class="input-group-text me-5" for="">Have you Experience</label>
                            <input type="checkbox" class="form-check-input me-3" onchange="addWorkExperence(this)"
                                name="has_experience" id="has_experience">
                        </div>
                        <div id="work_experience" class="mb-3">

                        </div>
                        <div class="mb-3">
                            <div class="mb-3 input-group">
                                <input type="text" class="form-control" name="salary" placeholder="current Salary">
                                <span class="input-group-text">In</span>
                                <select class="form-select" name="in_salary" id="">
                                    <option selected value="yearly">Yearly</option>
                                    <option value="monthly">Monthly</option>
                                </select>
                            </div>
                            <span id="salary"></span>
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
                                        onclick="addRow('tbody_social_profile')" value="Add">
                                </div>
                            </div>
                            <div id="tbody_social_profile">

                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="">upload resume(docs,pdf)</label>
                            <input type="file" class="form-control" name="users_resume">
                        </div>
                        <div class="mb-3">
                            <label for="">upload profile pic</label>
                            <input type="file" class="form-control" name="profile_pic">
                        </div>
                        <div class="mb-3">
                            <button type="button" class="btn btn-sm btn-dark" id="">save</button>
                        </div>
                    </form>
                </div>
                <div class="carousel-item ">
                    <div class="border border-1 border-info bg-white p-3">
                        <div class="d-flex justify-content-between mb-3">
                            <div class="col-8">
                                <h5>Dhiraj Kumar</h5>
                                <div>
                                    <span>city</span>
                                </div>
                                <div>
                                    <span>email</span>
                                </div>
                                <div>
                                    <span>contact</span>
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
                            <div class="d-flex justify-content-between border p-1 mb-3">
                                <div class="">
                                    <h5 class="m-0">Education</h5>
                                </div>
                                <div>
                                    <a class="btn btn-sm btn-info" href="">Add</a>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-2">
                                    <span class="text-muted">2020-2023</span>
                                </div>
                                <div class="col-8 d-flex flex-column">
                                    <span>Board/University</span>
                                    <span class="text-muted">Institute name</span>
                                    <span class="text-muted">course</span>
                                    <span class="text-muted">field in study</span>
                                </div>
                                <div class="col-2 d-flex justify-content-end" style="max-height: 30px">
                                    <a class="btn btn-sm btn-info me-1" href="">edit</a>
                                    {{-- <a class="btn btn-sm btn-danger" href="">del</a> --}}
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="d-flex justify-content-between border p-1 mb-3">
                                <div class="">
                                    <h5 class="m-0">SKILLS</h5>
                                </div>
                                <div>
                                    <a class="btn btn-sm btn-info" href="">Add</a>
                                </div>
                            </div>
                            <div class="d-flex">
                                <span class="me-1">php</span>
                                <span class="me-1">c++</span>
                                <span class="me-1">java</span>
                                <span class="me-1">python</span>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="d-flex justify-content-between border p-1 mb-3">
                                <div class="">
                                    <h5 class="m-0">EXPERIENCE</h5>
                                </div>
                                <div>
                                    <a class="btn btn-sm btn-info" href="">Add</a>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-2">
                                    <span class="text-muted">2020-2023</span>
                                </div>
                                <div class="col-8 d-flex flex-column">
                                    <span>company name</span>
                                    <span class="text-muted">city</span>
                                    <span class="text-muted">job role</span>
                                    <span class="text-muted">used skills</span>
                                </div>
                                <div class="col-2 d-flex justify-content-end" style="max-height: 30px">
                                    <a class="btn btn-sm btn-info me-1" href="">edit</a>
                                    {{-- <a class="btn btn-sm btn-danger" href="">del</a> --}}
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="d-flex justify-content-between border p-1 mb-3">
                                <div class="">
                                    <h5 class="m-0">PREFERABLE LOCATION</h5>
                                </div>
                                <div>
                                    <a class="btn btn-sm btn-info" href="">Add</a>
                                </div>
                            </div>
                            <div class="d-flex">
                                <span class="me-1">kolkata</span>
                                <span class="me-1">hwarha</span>
                                <span class="me-1">Bengaluru</span>
                                <span class="me-1">Hyderabad</span>
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

            formHtmlEducation: (count) => {
                return `<div class="mb-3 border border-1 border-primary p-3">
                            <div class="d-flex justify-content-end">
                                <input type="button" class="btn btn-sm btn-danger" onclick="$(this).parent().parent().remove()"
                                    value="Remove">
                             </div>
                            <div class="mb-3">
                                <select class="form-select" name="qualification[]" id="qualification"
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
                for (let index = 0; index < skill.length; index++) {
                    option += `<option value=${skill[index]}>${skill[index]}</option>`;


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
                                            <input type="radio" class="form-check-input" name="current_working[${count||0}]"
                                                id="current_working_yes${count||0}" value="Yes" checked>
                                            <label class="form-check-label" for="current_working_yes${count||0}">Yes</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input type="radio" class="form-check-input" name="current_working[${count||0}]"
                                                id="current_working_no${count||0}" value="No">
                                            <label class="form-check-label" for="current_working_no${count||0}">No</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3 d-flex">
                                    <label class="me-5" for="">Working Type</label>
                                    <div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="working_type[${count||0}]"
                                                id="working_type1" value="part">
                                            <label class="form-check-label" for="working_type1">Part Time</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="working_type[${count||0}]"
                                                id="working_type2" value="full" checked>
                                            <label class="form-check-label" for="working_type2">Full Time</label>
                                        </div>
                                    </div>
                                </div>


                                <div class="mb-3">
                                  
                                    <input type="text" class="form-control" name="company_name[]" id="company_name"
                                        placeholder="Company Name*">
                                </div>

                                <div class="mb-3">
                                    
                                    <input type="text" class="form-control" name="desigination[]" id="desigination"
                                        placeholder="Desigination*">
                                </div>
                                <div class="mb-3 d-flex">
                                   
                                    <input type="text" class="form-control" name="job_city[]" id="job_city"
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
                                    <select class="form-select ad-job-skills"  onchange="addJobSkills(this,${count!=null?count:0})"
                                        id="add-job-skills">
                                        ${option}
                                     </select>   
                                    <div id="append-job_skills${count!=null?count:0}">

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
            }

        }

        function addRow(slug) {
            count++;
            validate.is_validate = false;
            if (slug == "tbody_lan") {
                $('#' + slug).append(objForm.formHtmlLanguage(count));
            } else if (slug == "tbody_education") {
                $('#' + slug).append(objForm.formHtmlEducation(count));
            } else if (slug == 'tbody_skills') {
                $('#' + slug).append(objForm.formHtmlSkills());
            } else if (slug == 'tbody_project') {
                $('#' + slug).append(objForm.formHtmlProject());
            } else if (slug == 'tbody_social_profile') {
                validate.required('social_name');
                validate.required('social_url');
                if (validate.is_validate == false) {

                    $('#' + slug).append(objForm.formHtmlSocialProfile());
                }
            } else if (slug == 'tbody_experience') {
                $('#' + slug).append(objForm.formHtmlExperience(count, true, skill))
            } else if (slug == 'tbody_interest') {
                $('#' + slug).append(objForm.formHtmlInterestActiivityAwards('interest'))
            } else if (slug == 'tbody_activity') {
                $('#' + slug).append(objForm.formHtmlInterestActiivityAwards('activity'))
            } else if (slug == 'tbody_achivement') {
                $('#' + slug).append(objForm.formHtmlInterestActiivityAwards('achivement'))
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
            let count = $(elem).find('option[disabled]').length;
            if (count > 3) {
                return
            }
            let text = $(elem).find(`[value=${$(elem).val()}]`).text()
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
                    e.target.value = "";
                }
            }

        }



        function addJobSkills(elem, count) {
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

        function isValidate(form_data) {
            validate.is_validate = false;
            // validate.required('fname');
            // validate.required('phone_1')
            // validate.required('city');
            // validate.required('state');
            // validate.required('pincode');
            // validate.required('address_1');
            // validate.required('dob');
            // validate.required('nationality');
            // validate.required('email');

            return validate.is_validate;
        }


        $($('div.active').find('button[type=button]')[0]).click(function(e) {
            //    alert('d')
            // console.log(e)
            let form_data = $($('div.active').find('form')[0]).serializeArray();
            console.log(form_data);
            if (!isValidate(form_data)) {
                const url = "{{ route('users.create-resume-post') }}";
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

                console.log(form_data)
                objForm.post(url, form_data, '');
            } else {
                alert('validation failed');
            }
        })


        $('#nextForm').click(() => {
            // $('#carouselExampleControls').trigger()
            // console.log($('.item').length, $('div.active').index(), $('div.active').find('form')[0]);
            // let active_step = $('div.active').index();
            $($('div.active').find('button[type=button]')[0]).click(function(e) {
                e.preventDefault();
                let form_data = $($('div.active').find('form')[0]).serializeArray();
                if (job_location.length > 0) {
                    // for (let index = 0; index < location.length; index++) {
                    //     const element = array[index];

                    // }
                    form_data.push({
                        name: 'jobLocation',
                        value: job_location
                    })
                }
                if (skill.length > 0) {
                    form_data.push({
                        name: 'user_skill',
                        value: skill
                    })
                }
                if (job_skill.length > 0) {
                    form_data.push({
                        name: 'job_skill',
                        value: job_skill
                    })
                }


                console.log(form_data);
                if (!isValidate(form_data)) {
                    const url = "{{ route('users.create-resume-post') }}";
                    console.log(form_data)
                    objForm.post(url, form_data, '');
                } else {
                    alert('validation failed');
                }
            })
        })







        function addWorkExperence(elem) {

            let innerHtml = objForm.formHtmlExperience(null, false, skill);
            let html = ` ${innerHtml}
                             <div id="tbody_experience">
                            </div>
                            <div class="d-flex justify-content-end">
                                <input type="button" class="btn btn-primary rounded-0 btn-sm" onclick="addRow('tbody_experience')"
                                    value="Addmore">
                            </div>`;

            if (elem.checked) {
                $('#work_experience').append(html);
                elem.value = 'yes';
            } else {
                $('#work_experience').html('');
            }
        }

        // function get_form_data_as_obj(selector = '') {
        //     if (!selector) return {}
        //     let obj = {};
        //     $(selector + ' [name]').each(function() {
        //         if ($(this).attr('type') == 'checkbox') {
        //             obj[$(this).attr('name')] = $(this).prop('checked') ? 1 : 0;
        //             console.log($(this).attr('name'))
        //             return;
        //         }
        //         obj[$(this).attr('name')] = $(this).val();
        //     });
        //     return obj;
        // }
    </script>
@endsection
