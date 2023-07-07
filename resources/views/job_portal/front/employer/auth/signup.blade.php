@extends('job_portal.front.layout.layout')
@section('title', 'sign up')
{{-- @section('dash', 'active') --}}
@section('layout')

    <div class="container col-4 offset-4">
        <form class="row mt-5" id="form">
            <h3 class="text-center">Employer Regesteration</h3>
            <div class="mb-3">
                <label for="">Company Name</label>
                <input type="text" name="c_name" id="c_name" class="form-control">
            </div>
            <div class="mb-3">
                <label for="">Email</label>
                <input type="text" name="email" id="email" class="form-control">
            </div>
            <div class="mb-3">
                <label for="">phone</label>
                <input type="text" name="phone" id="phone" class="form-control">
            </div>
            <div class="mb-3">
                <label for="">address</label>
                <input type="text" name="address" id="address" class="form-control">
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
                                objForm.user_signup(res.error);
                            } else if (res.url != "") {
                                window.location.replace(res.url);
                            } else {
                                alert(res.msg);
                            }

                        }
                    },
                    error: (err) => console.log(err),
                });
            },
            user_signup: (data) => {
                for (const [key, value] of Object.entries(data)) {
                    // console.log(`${key}: ${value}`);
                    $('#' + key).after(`<span class="text-danger">${value[0]}</span>`);
                }
            }
        }

        $('#submit').click((e) => {
            validate.is_validate = false;
            validate.required('c_name');
            validate.email('email');
            validate.required('phone');

            if (validate.is_validate == false) {
                const url = "{{ route('employers.signup.post') }}";
                let data = $('#form').serializeArray();
                data.push({
                    name: "slug",
                    value: "user_signup"
                })
                objForm.post(url, data);
            }

        })
    </script>
@endsection
