@extends('job_portal.front.layout.layout_emp')
@section('title', 'ad-post')
{{-- @section('dash', 'active') --}}
@section('layout')

    <div class="container">
        <div class="mt-5 col-8 offset-2">
            <form class="row mb-5" action="" id="form">
                <div class="mb-3 col-6">
                    <label for="">Job Title</label>
                    <input type="text" id="job_title" name="job_title" class="form-control">
                </div>
                <div class="mb-3 col-6">
                    <label for="">No Of Opening</label>
                    <input type="text" id="vacancy" name="vacancy" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="">Location</label>
                    <select class="form-select" name="city" id="city">
                        <option value="">select city</option>
                        @foreach ($city as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
                {{-- <div class="mb-3">
                    <label for="">Link Google Map</label>
                    <input type="text" id="g_map" name="g_map" class="form-control">
                </div> --}}


                <div class="mb-3">
                    <label for="">Salary Range</label>
                    <div class="input-group">
                        <input type="text" class="form-control" name="min_salary" value="9000">
                        <span class="input-group-text">To</span>
                        <input type="text" class="form-control" name="max_salary" value="18000">
                    </div>
                    <span id="min_salary"></span>
                    <span id="max_salary"></span>
                </div>


                <div class="mb-3">
                    <div class="" id="skils_box">

                    </div>
                    <label for="">Skills</label>
                    {{-- <input type="text" class="form-control"> --}}
                    <div class="" id="skill">

                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="skill[]" id="skill_1" value="php">
                            <label class="form-check-label" for="skill_1">php</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="skill[]" id="skill_2" value="c++"
                                checked>
                            <label class="form-check-label" for="skill_2">c++</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="skill[]" id="skill_3" value="java">
                            <label class="form-check-label" for="skill_3">java</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="skill[]" id="skill_4" value="react">
                            <label class="form-check-label" for="skill_4">react</label>
                        </div>
                    </div>
                </div>
                <div class="mb-3">

                    <label for="">Qualification</label>
                    <div class="radio-toolbar" id="qualification">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="qualification" id="inlineRadio1"
                                value="10th">
                            <label class="form-check-label" for="inlineRadio1">10th</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="qualification" id="inlineRadio2"
                                value="12th" checked>
                            <label class="form-check-label" for="inlineRadio2">12th</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="qualification" id="inlineRadio3"
                                value="graduate">
                            <label class="form-check-label" for="inlineRadio3">Graduate</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="qualification" id="inlineRadio4"
                                value="post_graduate">
                            <label class="form-check-label" for="inlineRadio4">Post Graduate</label>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="">Experience</label>
                    <div class="" id="experience">

                        <div class="radio-toolbar">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="experience" id="internship"
                                    value="internship"
                                    onchange="this.checked==true ? ($('#manual_exp').addClass('d-none'),$('#manual_exp').attr('disabled',true)):''">
                                <label class="form-check-label" for="internship">Internship</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="experience" id="fresher"
                                    value="0"
                                    onchange="this.checked==true ? ($('#manual_exp').addClass('d-none'),$('#manual_exp').attr('disabled',true)):''">
                                <label class="form-check-label" for="fresher">Fresher</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="experience" id="exp_1"
                                    value="1"
                                    onchange="this.checked==true ? ($('#manual_exp').addClass('d-none'),$('#manual_exp').attr('disabled',true)):''">
                                <label class="form-check-label" for="exp_1">1+</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="experience" id="exp_3"
                                    value="3"
                                    onchange="this.checked==true ? ($('#manual_exp').addClass('d-none'),$('#manual_exp').attr('disabled',true)):''"
                                    checked>

                                <label class="form-check-label" for="exp_3">3+</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="experience" id="exp_5"
                                    value="5"
                                    onchange="this.checked==true ? ($('#manual_exp').addClass('d-none'),$('#manual_exp').attr('disabled',true)):''">
                                <label class="form-check-label" for="exp_5">5+</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="experience"
                                    onchange="this.checked==true ? ($('#manual_exp').removeClass('d-none'),$('#manual_exp').attr('disabled',false)) :''"
                                    id="exp">
                                <label class="form-check-label" for="exp">others</label>
                            </div>
                        </div>

                        <input type="text" id="manual_exp" name="experience"
                            class=" mb-3 d-none form-control ms-5 w-50" disabled>


                    </div>

                </div>

                <div class="mb-3">
                    <label for="">Gender</label>
                    <div class="radio-toolbar" id="gender">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" id="gender_both"
                                value="both" checked>
                            <label class="form-check-label" for="gender_both">Male/Female</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" id="gender_m"
                                value="male">
                            <label class="form-check-label" for="gender_m">Male</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" id="gender_f"
                                value="female">
                            <label class="form-check-label" for="gender_f">Female</label>
                        </div>

                    </div>

                </div>
                <div class="mb-3">
                    <label for="">Job Descriptions</label>
                    <textarea col="3" rows="3" name="description" id="description" class="form-control"></textarea>
                </div>
                <div class="mb-3">
                    <input type="button" class="btn btn-success" id="submit" value="Submit">
                </div>
            </form>
        </div>
    </div>
    <script>
        let validate = {
            required: function(e) {
                typeof e == 'string' ? id = e : id = e.target.id;
                let inputField = $('#' + id);
                $('#' + id).next().remove();

                if ($.trim(inputField.val()) == '') {
                    $('#' + id).after(`<span class="text-danger">This field is required</span>`)
                    validate.is_validate = true;
                }
                return validate.is_validate;
            },
            email: function(e) {
                typeof e == 'string' ? id = e : id = e.target.id;
                let emailPattern = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
                let inputField = $('#' + id);
                $('#' + id).next().remove();

                if ($.trim(inputField.val()) == '') {
                    validate.required(id);

                } else {
                    if (!emailPattern.test(inputField.val())) {
                        validate.is_validate = true;
                        $('#' + id).after(`<span class="text-danger">Enter Valid Email address</span>`)
                    } else {
                        validate.is_validate = false;
                        // $('#admin_email_msg').html('');
                    }
                }
            }

        };
        let objForm = {

            post: (url, data) => {
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
                                objForm.errorReturn(res.error);
                            } else {
                                alert(res.msg);
                                location.reload();
                            }

                        }
                    },
                    error: (err) => console.log(err),
                });
            },
            errorReturn: (data) => {
                for (const [key, value] of Object.entries(data)) {
                    // console.log(`${key}: ${value}`);
                    $('#' + key).next('span').remove();
                    $('#' + key).after(`<span class="text-danger">${value[0]}</span>`);
                }
            }
        }

        $('#submit').click((e) => {
            validate.is_validate = false;
            validate.required('job_title');
            validate.required('vacancy');
            // validate.required('city');
            // validate.required('location');
            // validate.required('min_salary');

            if (validate.is_validate == false) {
                const url = "{{ route('employers.jobpost.post') }}";
                let data = $('#form').serializeArray();
                data.push({
                    name: "slug",
                    value: "user_signup"
                })
                // console.log(data);
                objForm.post(url, data);
            } else {
                alert("validate false");
            }

        })
    </script>
@endsection
