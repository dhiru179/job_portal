@extends('job_portal.front.layout.layout_emp')
@section('title', 'ad-post')
{{-- @section('dash', 'active') --}}
@section('layout')

    <div class="container">
        <div class="mt-5 col-8 offset-2">
            <form class="row mb-5" id="form">
                <input type="hidden" name="post_id" value="{{!empty($post->id)?$post->id:''}}">
                <div class="mb-3 col-6">
                    <label for="">Job Title</label>
                    <input type="text" id="job_title" value="{{ !empty($post->job_title) ? $post->job_title : '' }}"
                        name="job_title" class="form-control">
                </div>
                <div class="mb-3 col-6">
                    <label for="">No Of Opening</label>
                    <input type="number" id="vacancy" value="{{ !empty($post->no_of_vacancy) ? $post->no_of_vacancy : '' }}"
                        name="vacancy" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="">Select Job city</label>
                    <div class="row">
                        <div class="col-4">
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
                        <div class="col-4">
                            <select name="" id="state" step="0" class="form-select state">
                              
                                    <option class="text-muted" value="">select states</option>
                                

                            </select>

                        </div>
                        <div class="col-4">
                            <select name="city" id="city" step="0" class="form-select city">
                                
                                    <option class="text-muted" value="">select city</option>
                                

                            </select>

                        </div>
                    </div>
                    <div id="append-location">

                        @if (isset($job_post_city) && count($job_post_city) > 0)
                            @foreach ($job_post_city as $item)
                                <input type="button" data-id="{{ $item->id }}"
                                    onclick="$(this).remove()"
                                    class="btn btn-success me-1 my-1 btn-sm " value="{{ $item->name }}">
                            @endforeach
                        @endif
                    </div>
                    {{-- <div class="mb-3">
                    <label for="">Link Google Map</label>
                    <input type="text" id="g_map" name="g_map" class="form-control">
                </div> --}}
                </div>



                <div class="mb-3">
                    <label for="">Salary Range</label>
                    <div class="input-group">
                        <input type="number" class="form-control" id="min_salary"
                            value="{{ !empty($post->min_salary) ? $post->min_salary : '' }}" name="min_salary">
                        <span class="input-group-text">To</span>
                        <input type="number" class="form-control" id="max_salary"
                            value="{{ !empty($post->max_salary) ? $post->max_salary : '' }}" name="max_salary">
                    </div>

                </div>


                <div class="mb-3">
                    <div class="" id="skils_box">

                    </div>
                    <label for="">Skills</label>
                    <input type="text" class="form-control" onkeyup="addSkills(event)" id="add-skills"
                        placeholder="Skills">
                    <div id="append-skills">
                        @if (isset($job_post_skill)&&count($job_post_skill) > 0)
                            @foreach ($job_post_skill as $item)
                                <input type="button" data-id="{{ $item->id }}" onclick="$(this).remove()"
                                    class="btn btn-success me-1 my-1 btn-sm" value="{{ $item->skill }}">
                            @endforeach
                        @endif
                    </div>
                </div>
                <div class="mb-3">

                    <label for="">Heighest Qualification</label>
                    <select class="form-select" name="qualification" id="qualification">
                        @foreach ($education as $item)
                            @if (!empty($post->education_standard_id) && $post->education_standard_id == $item->id)
                                <option selected value="{{ $item->id }}">{{ $item->standard }}</option>
                            @endif
                            <option value="{{ $item->id }}">{{ $item->standard }}</option>
                        @endforeach
                    </select>

                </div>

                <div class="mb-3">
                    <label for="">Experience</label>
                    <div class="input-group">
                        <input type="number" class="form-control" min="0" max="50" step="0.5"
                            id="experience" value="{{ !empty($post->experience) ? $post->experience : '' }}" name="experience">
                        <span class="input-group-text">Years</span>

                    </div>

                </div>

                <div class="mb-3">
                    <label for="">Gender</label>
                    <select name="gender" id="gender" class="form-select">
                        @if (!empty($post->gender))
                            <option selected value="{{ $post->gender }}">{{ ucfirst($post->gender) }}</option>
                        @endif
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                        <option value="both">Both</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="">Job Descriptions</label>
                    <textarea col="3" rows="3" name="description" id="description" class="form-control">{{!empty($post->gender)?$post->job_descriptions:''}}</textarea>
                </div>
                <div class="mb-3">
                    <input type="button" class="btn btn-success" id="submit" value="Submit">
                </div>
            </form>
        </div>
    </div>
    <script>
        let objForm = {

            post: (obj) => {
                $.ajax({
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}",
                    },
                    url: obj.url,
                    contentType: false,
                    processData: false,
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
                            if (res.slug == "job_post") {
                                if (res.error != "") {
                                    objForm.errorReturn(res.error);
                                } else {
                                    alert(res.msg);
                                    location.reload();
                                }
                            }


                        }
                    },
                    error: (err) => console.log(err),
                });
            },
            errorReturn: (data) => {
                $('span.custom_error').remove();
                for (const [key, value] of Object.entries(data)) {
                    console.log(key, value)
                    $(`input[name=${key}]`).parent().after(
                        `<span class="text-danger custom_error">${value[0]}</span>`);
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
        }

        function is_validate() {
            $('span.custom_error').remove();
            validate.is_validate = false;
            if ($('#append-skills').find('input[type="button"]').length == 0) {
                $('#append-skills').after('<span class="text-danger custom_error">Select Skills</span>')
                validate.is_validate = true;
            }
            if ($('#append-location').find('input[type="button"]').length == 0) {
                $('#append-location').after('<span class="text-danger custom_error">Select job city</span>')
                validate.is_validate = true;
            }
            validate.required('job_title');
            validate.required('vacancy');
            // validate.required('min_salary');
            validate.required('qualification');
            validate.required('gender');
            return validate.is_validate;
        }
        var autoLoad = (function() {
            $('#max_salary').keyup(function() {
                $('span.custom_error').remove();
                if (parseInt($('#min_salary').val()) > parseInt(this.value)) {
                    $('input[name="max_salary"]').parent().after(
                        `<span class="text-danger custom_error">Max salary should be less than min salary</span>`
                    );
                } else {
                    $('span.custom_error').remove();
                }
            })

        })();

        $('#submit').click((e) => {

            if (!is_validate()) {
                let form_data = $('#form').serializeArray();
                form_data.push({
                    name: "slug",
                    value: "job_post"
                })
                $('#append-skills').find('input[type="button"]').each(function() {
                    form_data.push({
                        name: "skills[]",
                        value: this.value.trim(),
                    })
                })
                $('#append-location').find('input[type="button"][data-id]').each(function() {
                    form_data.push({
                        name: "job_city[]",
                        value: $(this).attr('data-id'),
                    })
                })
                let data = new FormData();
                $.each(form_data, function(key, input) {
                    data.append(input.name, input.value);
                });
                const obj = {
                    url: "{{ route('employers.jobpost.modify') }}",
                    data: data,

                }
                objForm.post(obj);
            } else {
                alert("validate false");
            }

        })
        let selectCountry = $('.country').each(function() {
            $(this).change(function() {
                if (this.value == "") return;
                let data = new FormData();
                data.append("country_id", this.value);
                data.append("slug", "state-list");
                const obj = {
                    url: "{{ route('states') }}",
                    data: data,
                    step: 0
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
                    step: 0
                }
                objForm.post(obj);
            })
        })

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


                    let html =
                        `<input type="button" onclick="$(this).remove()"  class="btn btn-outline-primary me-1 my-1 btn-sm" value="${value}">`;
                    $('#append-skills').append(html);
                    e.target.value = "";
                }
            } else {
                $('#add-skills').after(
                    `<span class="text-danger custom_error">Null or Duplicate entry</span>`
                );
            }

        }

        $('#city').click(function() {
            $('#append-location').parent().find('span.custom_error').remove();
            let append_loc = $('#append-location').find('input[type="button"]');
            let valid = true;
            let elem = this.value;
            if (append_loc.length > 7) {
                $('#append-location').after(
                    `<span class="text-danger custom_error">Maximum 8 location allowed</span>`
                );
                valid = false;
            } else {
                append_loc.each(function() {
                    if (elem == $(this).attr('data-id')) {
                        valid = false;
                        $('#append-location').after(
                            `<span class="text-danger custom_error">Duplicate entry not allowed</span>`
                        );
                    }
                })
            }
            if (valid) {
                let text = $(this).find(`option[value=${elem}]`).text()
                let html =
                    `<input type="button" data-id="${elem}" onclick="$(this).remove()" class="btn btn-outline-primary me-1 my-1 btn-sm " value="${text}">`;
                $('#append-location').append(html);
            }
            return;
        })
    </script>
@endsection
