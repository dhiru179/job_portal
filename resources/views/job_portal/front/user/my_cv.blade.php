@extends('job_portal.front.layout.layout')
@section('title', 'create-resume')
{{-- @section('dash', 'active') --}}
@section('layout')

    <div class="container" id="my-cv">
        <h5 class="text-center">Resume</h5>
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
                        <span>{{ !empty($user->resume_email) ? $user->resume_email : '' }}</span>
                    </div>
                    <div>
                        <span>{{ !empty($user->resume_phone_1) ? $user->resume_phone_1 : '' }}</span>
                    </div>
                    <div>
                        <span>website</span>
                    </div>
                </div>
                <div class="col-4 d-flex flex-column justify-content-center align-items-center">
                    <div class="bg-light">
                        @if (!empty($user->resume_pic))
                            <img src="{{ asset('storage/pic/' . $user->resume_pic) }}" alt=""
                                style="width:135px;height:118px">
                        @endif

                    </div>
                    <div>
                        <input type="button" key="Upload Image" class="btn btn-sm btn-info addt" value="upload img">
                    </div>
                </div>
            </div>
            <div class="mb-3">
                @if (count($edu) > 0)
                    <div class="d-flex justify-content-between border p-1 mb-3">
                        <div class="">
                            <h5 class="m-0">Education</h5>
                        </div>
                        <div>
                            <input type="button" key="Educations" class="btn btn-sm btn-info addt" value="Add">
                        </div>
                    </div>
                    @foreach ($edu as $educations)
                        <div class="mb-3 row">
                            <div class="col-2">
                                <span
                                    class="text-muted">{{ explode('-', $educations->start_year)[0] }}-{{ explode('-', $educations->passing_year)[0] }}</span>
                            </div>
                            <div class="col-8 d-flex flex-column">
                                <span>{{ $educations->board_university }}</span>
                                <span class="text-muted">{{ $educations->institute_name }}</span>
                                <span class="text-muted">{{ $educations->course }}</span>
                                <span class="text-muted">field in study</span>
                            </div>
                            <div class="col-2 d-flex justify-content-end" style="max-height: 30px">
                                <input type="button" key="Educations" object={{ json_encode($educations) }}
                                    class="addt btn btn-sm btn-info me-1" value="edit">
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
                        <input type="button" key="Skills" class="btn btn-sm btn-info addt" value="Add">
                    </div>
                </div>
                <div class="d-flex  flex-column">
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
                        <input type="button" key="Work Experience" class="btn btn-sm btn-info addt" value="Add">
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
                                <input type="button" key="Work Experience" object="{{ json_encode($item) }}"
                                    class="addt btn btn-sm btn-info me-1" value="edit">
                                {{-- <input type="button" key="experience" class="addt btn btn-sm btn-info me-1" value="edit"> --}}
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
                        <input type="button" key="Job Location" class="btn btn-sm btn-info addt" value="Add">
                    </div>
                </div>
                <div class="d-flex flex-column">
                    @if (count($job_loc) > 0)
                        @foreach ($job_loc as $item)
                            <span class="me-1">{{ $item->name }}</span>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
        <div class="my-3 d-flex">
            <button class="btn btn-sm btn-primary me-1">dawnload</button>
            {{-- <embed type="application/pdf" src="path_to_pdf_document.pdf" id="pdfDocument" width="100%" height="100%" /> --}}
            <button id="print" class="btn btn-sm btn-warning me-1">print</button>
            <button class="btn btn-sm btn-success">email</button>
        </div>

    </div>
    <div class="modal fade" id="myModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
    </div>
    <script>
        let count = 0;
        let job_location = [];
        let skill = [];
        let job_skill = [];

        let objForm = {
            formModal: (data, title) => {
                let modal = `<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">${title}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form onsubmit="return false" id="form-modal">
                                    ${data}
                                 </form>   
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary" id="save_modal">Save changes</button>
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


                let edu = `<div class="mb-3 border border-1 border-primary p-3">
                    <input type="hidden" name="education_id[]" value="${data!=''?data.id:''}">
                       ${count>0?remove_btn:""}
                        <div class="mb-3">
                            <select class="form-select" name="qualification[]" id="qualification${count}">
                                
                                <option class="text-muted" value="">Select Highest Education</option>
                                @foreach ($qualifications as $item)
                                    ${data!="" && data.education_standard_id=="{{ $item->id }}"?
                                    '<option selected value="{{ $item->id }}">{{ $item->standard }}</option>':
                                    '<option value="{{ $item->id }}">{{ $item->standard }}</option>'
                                    }
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3 d-none" id="others${count}">
                            <input type="text" class="form-control" value="" name="others_qualifications[]" id="others_qualifications${count}" placeholder="Enter Qualifications">
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control" value="${data!=''?data.institute_name:''}" name="institute_name[]" id="institute_name${count}"
                                placeholder="college/institute">
                        </div>
                        <div class="mb-3 ">
                            <input type="text" class="form-control" value="${data!=''?data.board_university:''}" name="board[]" id="board${count}"
                                placeholder="Board/University">
                        </div>
                        <div class="mb-3 10th${count} 12th${count}">
                            <input type="text" class="form-control" value="${data!=''?data.course:''}" name="course[]" id="course${count}"
                                placeholder="Course(eg.B.tech)">
                        </div>
                        <div class="mb-3 10th">
                            <input type="text" class="form-control" value="${data!=''?data.specialization:''}" name="specialization[]" id="specialization${count}"
                                placeholder="Field in Study(eg.computer science)">
                        </div>
                        <div class="mb-3">
                            <div class="d-flex input-group">
                                <input type="text" onclick="this.setAttribute('type','date')"
                                    placeholder="Start Year" value="${data!=''?data.start_year:''}" class="form-control  10th${count}"
                                    name="start_year[]" value="">
                                <span class="input-group-text 10th${count}">-</span>
                                <input type="text" onclick="this.setAttribute('type','date')" value="${data!=''?data.passing_year:''}" class="form-control"
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
            formHtmlExperience: (count, slug, obj) => {
                console.log(obj)
                let skill = typeof obj.user_skill != 'undefined' ? obj.user_skill : '';
                let data = typeof obj.exp_info != 'undefined' ? obj.exp_info : '';
                let option = "";
                let job_skill = "";
                for (let i = 0; i < skill.length; i++) {
                    option += `<option value="${skill[i]}">${skill[i]}</option>`;

                }
                if (data != '') {
                    JSON.parse(data.skills).forEach((elem, i) => {
                        job_skill +=
                            `<input type="button" onclick="removeSkills(this,'job_skills',${i})" class="btn btn-success me-1 my-1 btn-sm"  value="${elem}">`;
                    })
                }

                const html = `<div class="d-flex justify-content-end">
                            <input type="button" class="btn btn-sm btn-danger" onclick="removeExperienceBox(this,count=0)"
                                value="Remove">
                         </div>`;
                return `<div class="mt-3 row border border-1 border-primary p-3">
                    <input type="hidden" name="exp_id[]" value="${data!=''?data.id:''}">
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
                              
                                <input type="text" class="form-control" value="${data!=''?data.company_name:''}" name="company_name[]" id="company_name${count}"
                                    placeholder="Company Name*">
                            </div>

                            <div class="mb-3">
                                
                                <input type="text" class="form-control" value="${data!=''?data.desigination:''}" name="desigination[]" id="desigination${count}"
                                    placeholder="Desigination*">
                            </div>
                            <div class="mb-3">
                               
                                <input type="text" class="form-control" value="${data!=''?data.job_city:''}" name="job_city[]" id="job_city${count}"
                                    placeholder="City*">
                            </div>

                            <div class="d-flex input-group mb-3">
                                <label for="" class="input-group-text" id="time_duration">Time
                                    Duration</label>
                                <input type="text" onclick="this.setAttribute('type','date')" value="${data!=''?data.joining_data:''}" class="form-control"
                                    name="start_date[]" placeholder="form">
                                <span class="input-group-text">-</span>
                                <input type="text" onclick="this.setAttribute('type','date')" value="${data!=''?data.last_date:''}" class="form-control"
                                    name="end_date[]" placeholder="to">
                            </div>


                            <div class="mb-3">
                                <select class="form-select ad-job-skills"  onchange="addJobSkills(this,${count})"
                                    id="add-job-skills${count}">
                                    <option value="">--</option>
                                    ${option}
                                 </select>   
                                <div class="append-job-skills" id="append-job-skills${count}">
                                    ${job_skill}
                                </div>
                            </div>

                            <div class="mb-3">
                               
                                <textarea name="job_desc[]" class="form-control" id="" cols="3" rows="3"
                                    placeholder="Job Descriptions">${data!=''?data.profile_desc:''}</textarea>
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

                            alert(res.msg);

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
            saveModalForm: (key) => {
                $('#save_modal').click(function() {
                    let form_data = $('#form-modal').serializeArray();
                    let data = new FormData();
                    if (key == "Skills") {
                        $('#append-skills').find('input[type="button"]').each(function() {
                            form_data.push({
                                name: "user_skill[]",
                                value: this.value.trim(),
                            })
                        })
                    }
                    if (key == "Job Location") {
                        $('#append-location').find('input[type="button"][data-id]').each(function() {
                            form_data.push({
                                name: "jobLocation[]",
                                value: $(this).attr('data-id'),
                            })
                        })
                    }
                    if (key == "Work Experience") {
                        $('.append-job-skills').each(function(i) {
                            $(this).find('input[type="button"]').each(function() {
                                form_data.push({
                                    name: `job_skill[${i}][]`,
                                    value: this.value
                                })
                            })
                        })
                    }
                    if (key == "Upload Image") {
                        $('input[type="file"]').each(function() {
                            var ext = this.value.substring(this.value.lastIndexOf('.') + 1);
                            let name = $(this).attr('name');
                            let supportFile = [];
                            if (name == "users_resume") {
                                supportFile = ['pdf', 'doc'];
                            }
                            if (name == "profile_pic") {
                                supportFile = ['jpeg', 'png'];
                            }
                            console.log(ext, supportFile)
                            // return;
                            validate.file({
                                "name": ext,
                                "supportFile": supportFile
                            });
                            data.append(this.name, this.files[0])
                        })

                    }

                    $.each(form_data, function(i, input) {
                        data.append(input.name, input.value);
                    });
                    const obj = {
                        'url': "{{ route('users.create-resume-post') }}",
                        'data': data,
                    }
                    console.log(form_data);
                    objForm.post(obj);

                })
            },
            addMoreInModal: (obj) => {
                key = obj.key;
                $('#add_box').click(function() {
                    count = $(this).attr('index');
                    if (key == "Educations") {
                        $(`${objForm.formHtmlEducation(count)}`).insertBefore($(this).parent());
                        $(this).attr('index', count + 1)
                    } else if (key == "Work Experience") {
                        $(`${objForm.formHtmlExperience(count,true,obj)}`).insertBefore($(this)
                            .parent());
                        $(this).attr('index', count + 1)

                    }
                })
            },
            selectCountry: () => {
                $('.country').each(function() {
                    $(this).change(function() {
                        if (this.value == "") return;
                        let data = new FormData();
                        data.append("country_id", this.value);
                        data.append("slug", "state-list");
                        const obj = {
                            url: "{{ route('states') }}",
                            data: data,
                            step: 2
                        }
                        objForm.post(obj);

                    })
                })
            },
            selectState: () => {
                $('.state').each(function() {

                    $(this).change(function() {

                        if (this.value == "") return;
                        let data = new FormData();
                        data.append("state_id", this.value);
                        data.append("slug", "city-list");
                        const obj = {
                            url: "{{ route('cities') }}",
                            data: data,
                            step: 2
                        }
                        objForm.post(obj);
                    })
                })
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

        }
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

            $('.append-job-skills[key]').each(function() {
                let i = parseInt($(this).attr('key'));
                if (!job_skill[i]) {
                    job_skill[i] = [];
                }
                $(this).find('input.btn-success').each(function() {
                    job_skill[i].push($(this).val());
                })
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
                if ($('#append-job-skills' + count).find('input').length == 0) {
                    $('#add-job-skills' + count).parent().find('span.custom_error').remove();
                    $('#add-job-skills' + count).after(
                        `<span class="text-danger custom_error">Select job skills</span>`)
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





        function removeExperienceBox(elem, count) {
            job_skill.splice(count, 1);
            $(elem).parent().parent().remove();
        }

        function removeLocation(btn, option_value) {

            $(btn).remove();
        }

        function addLocation(elem) {
            $('#append-location').parent().find('span.custom_error').remove();
            let append_loc = $('#append-location').find('input[type="button"]');
            let valid = true;
           
            if (append_loc.length > 7) {
                $('#append-location').after(
                    `<span class="text-danger custom_error">Maximum 8 location allowed</span>`
                );
                valid = false;
            } else {
                append_loc.each(function() {
                    if (elem.value == $(this).attr('data-id')) {
                        valid = false;
                        $('#append-location').after(
                            `<span class="text-danger custom_error">Duplicate entry not allowed</span>`
                        );
                    }
                })
            }
            if (valid) {
                let text = $(elem).find(`option[value=${$(elem).val()}]`).text()
                let html =
                    `<input type="button" data-id="${elem.value}" onclick="removeLocation(this,${elem.value})" class="btn btn-outline-dark me-1 my-1 btn-sm " value="${text}">`;
                $('#append-location').append(html);
            }
            return;
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
                $($(elem).parent().parent().find('select')).find(`option[value=${elem.value}]`).removeAttr(
                    'disabled');
                $(elem).remove();
                if (job_skill[count].length > 0) {
                    const index = job_skill[count].indexOf(elem.value);
                    if (index > -1) { // only splice array when item is found
                        job_skill[count].splice(index, 1); // 2nd parameter means remove one item only
                    }
                }

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
            let html = `${innerHtml}
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
                </div>`;


            if (elem.checked) {
                $('#work_experience').append(html);
                elem.value = 'yes';

            } else {
                $('#work_experience').html('');
            }
        }

        $('.addt').click(function() {

            $('#myModal').html('')
            let data, innerHtml = "";
            let obj = {};
            let user_skill = [];
            let key = $(this).attr('key');
            if (typeof $(this).attr('object') !== "undefined") {
                data = JSON.parse($(this).attr('object'));
            }
            let val = this.value;
            const add_more = `<div class="d-flex justify-content-end">
                            <input type="button" index="1" class="btn btn-sm btn-success" id="add_box" 
                                    value="Add">
                            </div>`;
            const user_skill_obj = JSON.parse(`{!! json_encode($user_skill) !!}`);

            if (key == "Educations") {
                innerHtml = `<input type="hidden" name="slug" value="educations">`;

                if (val == "Add") {
                    innerHtml += objForm.formHtmlEducation(count = 0);
                    innerHtml += add_more;

                } else if (val == "edit") {
                    innerHtml += objForm.formHtmlEducation(count, data);
                } else {
                    alert("error");
                }
                console.log(val)

            } else if (key == "Skills") {
                let skillHtml = "";
                user_skill_obj.forEach(item => {
                    skillHtml += `<input type="button" data-id="${item.id }"
                                        onclick="removeSkills(this,'user_skills')"
                                        class="btn btn-success me-1 my-1 btn-sm" value="${item.skills}">`
                });
                innerHtml = `<div class="mb-3">
                    <input type="hidden" name="slug" value="work_experience">
                    <input type="hidden" name="resume_slug" value="user_skill">
                        <input type="text" class="form-control" onkeyup="addSkills(event)"  id="add-skills"
                            placeholder="Skills">
                            
                        <div id="append-skills">
                            ${skillHtml}
                        </div>
                    </div>`;

            } else if (key == "Work Experience") {
                innerHtml = `<input type="hidden" name="slug" value="work_experience">
                            <input type="hidden" name="resume_slug" value="experience">`;
                user_skill_obj.forEach(element => {
                    user_skill.push(element.skills);
                });
                console.log(user_skill_obj)
                obj.user_skill = user_skill;
                obj.exp_info = data;
                if (val == "Add") {
                    innerHtml += objForm.formHtmlExperience(count = 0, false, obj);
                    innerHtml += add_more;

                } else if (val == "edit") {
                    innerHtml += objForm.formHtmlExperience(count, false, obj);
                } else {
                    alert("error");
                }
                console.log(val)
            } else if (key == "Job Location") {

                innerHtml = `<div class="mb-3">
                    <input type="hidden" name="slug" value="work_experience">
                    <input type="hidden" name="resume_slug" value="job_location">
                    <div class="mb-3 ">
                        <label for="">Add Job Location</label>
                        <div class="row">
                            <div class="mb-3">
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
                            <div class="mb-3">
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
                            <div class="mb-3">
                                <select class="form-select city" step="2" onchange="addLocation(this)" id="add_location">
                                    @if (count($job_loc) > 0)
                                          @foreach ($cities as $key => $city) 
                                          <option  value='{{ $city->id }}'>{{ $city->name }}</option>"
                                          @endforeach
                                   @endif
                                </select>
                            </div>
                        </div>
                        <div id="append-location">

                            @if (count($job_loc) > 0)
                                @foreach ($job_loc as $city)
                                    <input type="button" data-id="{{ $city->id }}"
                                        onclick="removeLocation(this,{{ $city->id }})"
                                        class="btn btn-success me-1 my-1 btn-sm " value="{{ $city->name }}">
                                @endforeach
                            @endif
                        </div>
                    </div>
                    </div>`;
            } else if (key == "Upload Image") {
                innerHtml = `<input type="hidden" name="slug" value="work_experience">
                            <input type="hidden" name="resume_slug" value="user_files">
                            <input type="hidden" name="basic_info_id"
                        value="{{ !empty($user->basic_info_id) ? $user->basic_info_id : '' }}">
                            <input type="file" name="profile_pic" class="form-control">
                            `;
            }


            $('#myModal').append(objForm.formModal(innerHtml, key));
            $('#myModal').modal('show')
            obj.key = key;
            objForm.selectCountry();
            objForm.selectState();
            objForm.addMoreInModal(obj); //add box in modal
            objForm.saveModalForm(key);

        })






        $('#print').click(() => {
            $('#my-cv').find('.btn').remove();
            var cv = $('#my-cv');



            var newWin = window.open('', 'Print-Window');

            newWin.document.open();

            newWin.document.write('<html><body onload="window.print()">' + cv.html() + '</body></html>');

            newWin.document.close();

            setTimeout(function() {
                newWin.close();
            }, 10);
        })
    </script>
@endsection
