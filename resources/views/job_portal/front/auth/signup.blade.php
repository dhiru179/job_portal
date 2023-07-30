@extends('job_portal.front.layout.layout')
@section('title', 'sign up')
{{-- @section('dash', 'active') --}}
@section('layout')

    <div class="container col-4 offset-4">
        <form class="row mt-3 needs-validation" id="form" novalidate>
            <h3 class="text-center">signUp</h3>
            <div class="mb-3">
                <label for="">Enter Name</label>
                <input type="text" name="user" id="user" class="form-control">
            </div>
            <div class="mb-3">
                <label for="">Are you : </label>
                <div class="form-check form-check-inline mx-3">
                    <input class="form-check-input" type="radio" id="inlineCheckbox1" name="user_type" value="seeker"
                        checked>
                    <label class="form-check-label" for="inlineCheckbox1">Employee </label>
                </div>
                <div class="form-check form-check-inline mx-3">
                    <input class="form-check-input" type="radio" id="inlineCheckbox2" name="user_type" value="employer">
                    <label class="form-check-label" for="inlineCheckbox2">Employer</label>
                </div>

            </div>
            <div class="mb-3">
                <label for="">Enter Email</label>
                <input type="text" name="email" id="email" class="form-control">
            </div>
            <div class="mb-3">
                <label for="">Enter Phone</label>
                <input type="text" name="phone" id="phone" class="form-control">

            </div>

            <div class="mb-3">
                <label for="">Password</label>
                <input type="password" name="password" id="password" class="form-control">
            </div>
            <div class="mb-3">
                <label for="">Confirm Password</label>
                <input type="password" name="cnf_password" id="cnf_password" class="form-control">
            </div>

            <div class="mb-3">

                <input type="button" class="btn btn-success" id="submit" value="submit">
            </div>
        </form>
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
                    success: function(res) {
                        console.log(res);

                        if (res.status) {
                            window.location.replace(res.url);

                        } else {
                            objForm.user_signup(res.error);
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
        const autoload = (function() {
            $('#user').blur(() => validate.required("user"));
            $('#user').keyup(() => validate.required("user"));
            $('#email').blur(() => validate.email("email"));
            $('#email').keyup(() => validate.email("email"));
            $('#phone').blur(() => validate.mobile("phone"));
            $('#phone').keyup(() => validate.mobile("phone"));
            $('#password').blur(() => validate.password("password"));
            $('#password').keyup(() => validate.password("password"));
            $('#cnf_password').blur(() => validate.cnfPassword("password", "cnf_password"));
            $('#cnf_password').keyup(() => validate.cnfPassword("password", "cnf_password"));
        })();


        $('#submit').click((e) => {
            validate.is_validate = false;
            validate.required('user');
            validate.email('email');
            validate.required('phone');
            validate.required('password')
            if (validate.is_validate == false) {
                const url = "{{ route('users.signup.post') }}";
                let data = $('#form').serializeArray();
                data.push({
                    name: "slug",
                    value: "user_signup"
                })
                objForm.post(url, data);
            }

        })
        // Example starter JavaScript for disabling form submissions if there are invalid fields
    </script>
@endsection
