@extends('job_portal.front.layout.layout')
@section('title', 'create-profile')
{{-- @section('dash', 'active') --}}
@section('layout')
    <div class="container">
        <form class="mt-5 col-6 offset-3" action="" id="form">
            <h3 class="text-center">Create Profile</h3>
            <input type="hidden" name="user_id" value={{ $user->id }}>
            <div class="mb-3">
                <label for="">User Name</label>
                <input type="text" name="user" id="user" value="{{ $user->name }}" class="form-control">
            </div>
            <div class="mb-3">
                <label for="">Email</label>
                <input type="text" id="email" value="{{ $user->email }}" class="form-control" disabled>
            </div>
            <div class="mb-3">
                <label for="">phone</label>
                <input type="text" name="phone" id="phone" value="{{ $user->phone }}" class="form-control">
            </div>
            <div class="mb-3">


                <label class="me-3" for="">Gender</label>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="gender" id="inlineRadio1" value="male"
                        @php echo $user->gender=="male"?"checked":"" @endphp>
                    <label class="form-check-label" for="inlineRadio1">Male</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="gender" id="inlineRadio2"
                        value="female"@php echo $user->gender=="female"?"checked":"" @endphp>
                    <label class="form-check-label" for="inlineRadio2">Female</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="gender" id="inlineRadio3"
                        value="others"@php echo $user->gender=="others"?"checked":"" @endphp>
                    <label class="form-check-label" for="inlineRadio3">Others</label>
                </div>

            </div>
            <div class="mb-3">
                <label for="">Date Of Birth</label>
                <input type="date" name="dob" id="dob" value="{{ $user->date_of_birth }}" class="form-control">
            </div>
            <div class="mb-3">
                <label for="">Address</label>
                <textarea name="address" id="address" class="form-control">{{ $user->address }}</textarea>
            </div>
            <div class="mb-3">
                <input type="file" name="img" id="img" class="form-control">
            </div>

            <div class="mb-3">
                <input type="button" class="btn btn-success" id="submit" value="submit">
            </div>
        </form>
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
                for (const [key, value] of Object.entries(data)) {
                    // console.log(`${key}: ${value}`);
                    $('#' + key).after(`<span class="text-danger">${value[0]}</span>`);
                }
            }
        }

        $('#submit').click((e) => {
            validate.is_validate = false;
            validate.required('user');
            validate.email('email');
            validate.required('phone');
            validate.required('dob');
            // validate.required('gender');

            if (validate.is_validate == false) {
                const url = "{{ route('users.create-profile.post') }}";
                let data = $('#form').serializeArray();
                data.push({
                    name: "slug",
                    value: "user_signup"
                })
                // console.log(data);
                objForm.post(url, data);
            }

        })
    </script>
@endsection
