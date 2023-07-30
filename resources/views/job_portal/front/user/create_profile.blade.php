@extends('job_portal.front.layout.layout')
@section('title', 'create-profile')
{{-- @section('dash', 'active') --}}
@section('layout')
    <div class="container">
        <form class="mt-5 col-6 offset-3 row" action="" id="form">

            @if ($type == 'employer')
            <h5 class="text-center">Company profile</h5>
                <div class="mb-3 col-4">
                    <input type="text" name="f_name" id="f_name" value="{{ !empty($user->f_name) ? $user->f_name : '' }}"
                        class="form-control" placeholder="first name">
                </div>
                <div class="mb-3 col-4">

                    <input type="text" name="m_name" id="m_name"
                        value="{{ !empty($user->m_name) ? $user->m_name : '' }}" class="form-control"
                        placeholder="middle name">
                </div>
                <div class="mb-3 col-4">

                    <input type="text" name="l_name" id="l_name"
                        value="{{ !empty($user->l_name) ? $user->l_name : '' }}" class="form-control"
                        placeholder="last name">
                </div>
                <div class="mb-3">

                    <input type="text" id="email" value="{{ !empty($user->email) ? $user->email : '' }}"
                        class="form-control" placeholder="Email" disabled>
                </div>
                <div class="mb-3">
                    <input type="text" name="phone_1" id="phone_1"
                        value="{{ !empty($user->primary_phone) ? $user->primary_phone : $user->phone }}"
                        class="form-control" placeholder="primary mobile">
                </div>
                <div class="mb-3">

                    <input type="text" name="phone_2" id="phone_2"
                        value="{{ !empty($user->secondary_phone) ? $user->secondary_phone : '' }}" class="form-control"
                        placeholder="alternative mobile">
                </div>
                <div class="mb-3">
                    <input type="text" name="company_name"  value="{{ !empty($user->company_name) ? $user->company_name : '' }}" class="form-control" placeholder="Company Name">
                </div>
                <div class="mb-3">
                    <input type="email"  name="office_email" value="{{ !empty($user->office_email) ? $user->office_email : '' }}" class="form-control" placeholder="Office Email">
                </div>
                <div class="mb-3">
                    <input type="text" name="website" value="{{ !empty($user->website) ? $user->website : '' }}" class="form-control" placeholder="Enter Website">
                </div>
                <div class="mb-3">
                    <label for="">Profile pic</label>
                    <input type="file" name="profile_pic" id="profile_pic" class="form-control"
                        placeholder="profile pic">
                    @if (!empty($user->profile_pic))
                        <a href="{{ asset('storage/pic/' . $user->profile_pic) }}">View Image</a>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="">Company Logo</label>
                    <input type="file" name="logo" id="logo" class="form-control" placeholder="Company Logo">
                    @if (!empty($user->logo))
                        <a href="{{ asset('storage/pic/' . $user->logo) }}">View Logo</a>
                    @endif
                </div>
                <div class="mb-3">
                    <textarea name="about_self" class="form-control" placeholder="Write..." id="" cols="3" rows="3">{{ !empty($user->about_self) ? $user->about_self : '' }}</textarea>
                </div>
            @else
                <h3 class="text-center">Create Profile</h3>
                <div class="mb-3 col-4">
                    <input type="text" name="f_name" id="f_name"
                        value="{{ !empty($user->f_name) ? $user->f_name : '' }}" class="form-control"
                        placeholder="first name">
                </div>
                <div class="mb-3 col-4">

                    <input type="text" name="m_name" id="m_name"
                        value="{{ !empty($user->m_name) ? $user->m_name : '' }}" class="form-control"
                        placeholder="middle name">
                </div>
                <div class="mb-3 col-4">

                    <input type="text" name="l_name" id="l_name"
                        value="{{ !empty($user->l_name) ? $user->l_name : '' }}" class="form-control"
                        placeholder="last name">
                </div>
                <div class="mb-3">

                    <input type="text" id="email" value="{{ !empty($user->email) ? $user->email : '' }}"
                        class="form-control" placeholder="Email" disabled>
                </div>
                <div class="mb-3">
                    <input type="text" name="phone_1" id="phone_1"
                        value="{{ !empty($user->primary_phone) ? $user->primary_phone : $user->phone }}"
                        class="form-control" placeholder="primary mobile">
                </div>
                <div class="mb-3">

                    <input type="text" name="phone_2" id="phone_2"
                        value="{{ !empty($user->secondary_phone) ? $user->secondary_phone : '' }}" class="form-control"
                        placeholder="alternative mobile">
                </div>
                <div class="mb-3">
                    <label class="me-3" for="">Gender</label>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="gender" id="inlineRadio1" value="male"
                            {{ !empty($user->gender) && $user->gender == 'male' ? 'checked' : 'checked' }}>
                        <label class="form-check-label" for="inlineRadio1">Male</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="gender" id="inlineRadio2" value="female"
                            {{ !empty($user->gender) && $user->gender == 'female' ? 'checked' : '' }}>
                        <label class="form-check-label" for="inlineRadio2">Female</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="gender" id="inlineRadio3" value="others"
                            {{ !empty($user->gender) && $user->gender == 'others' ? 'checked' : '' }}>
                        <label class="form-check-label" for="inlineRadio3">Others</label>
                    </div>

                </div>

                <div class="mb-3">

                    <input type="text" name="dob" id="dob" class="form-control"
                        value="{{ !empty($user->date_of_birth) ? $user->date_of_birth : '' }}"
                        placeholder="Date Of Birth*">
                </div>

                <div class="mb-3">
                    <label for="">Profile pic</label>
                    <input type="file" name="profile_pic" id="profile_pic" class="form-control"
                        placeholder="profile pic">
                    @if (!empty($user->profile_pic))
                        <a href="{{ asset('storage/pic/' . $user->profile_pic) }}">View Image</a>
                    @endif
                </div>

                <div class="mb-3">
                    <textarea name="about_self" class="form-control" placeholder="Write..." id="" cols="3"
                        rows="3">{{ !empty($user->about_self) ? $user->about_self : '' }}</textarea>
                </div>

            @endif
            <div class="mb-3">
                <input type="button" class="btn btn-success" id="submit" value="submit">
            </div>
        </form>
        {{-- <div class="">
            <div class="card d-flex mt-3">
                <div>

                    <img src="..." class="card-img-top" alt="...">
                </div>
                <div class="card-body">
                  <h5 class="card-title">{{ $user->name }}</h5>
                  <p class="card-text">{{ $user->email }}</p>
                  <p class="card-text">{{ $user->phone }}</p>
                  <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
              </div>
            <div class="d-flex">
                <div class="card">

                </div>
            </div>
        </div> --}}
    </div>
    <script>
        let objForm = {

            post: (url, data) => {
                $.ajax({
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}",
                    },
                    url: url,
                    data: data,
                    contentType: false,
                    processData: false,
                    success: function(res) {
                        console.log(res);

                        if (res.status) {
                            if (res.error != "") {
                                objForm.errorReturn(res.error);
                            } else if (res.url != "") {
                                window.location.replace(res.url);
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
                $('.custom_error').remove();
                for (const [key, value] of Object.entries(data)) {
                    // console.log(`${key}: ${value}`);
                    $(`[name=${key}]`).after(`<span class="text-danger custom_error">${value[0]}</span>`);
                }
            }
        }
        var autoLoad = (function() {
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


            $('#phone_1').keyup(() => validate.mobile("phone_1"));
            $('#phone_2').keyup(() => validate.mobile("phone_2"));

        }());

        function validation() {
            validate.is_validate = false;
            validate.required('f_name');
            validate.mobile('phone_1');
            validate.mobile('phone_2');
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

                validate.file({
                    "name": ext,
                    "supportFile": supportFile,
                    "id": this.id,
                });
            })
            return validate.is_validate;
        }

        $('#submit').click((e) => {

            // validate.required('gender');

            if (!validation()) {
                const url = "{{ route('users.create-profile.post') }}";
                let form_data = $('#form').serializeArray();

                form_data.push({
                    name: "slug",
                    value: "user_signup"
                },{
                    name: "type",
                    value: "{{$type}}"
                })

                let data = new FormData();
                $.each(form_data, function(key, input) {
                    data.append(input.name, input.value);
                });
                $('input[type="file"]').each(function() {
                    // console.log(this)
                    data.append(this.name, this.files[0])
                })

                // console.log(data);
                objForm.post(url, data);
            } else {
                alert('validation_error');
            }

        })
    </script>
@endsection
