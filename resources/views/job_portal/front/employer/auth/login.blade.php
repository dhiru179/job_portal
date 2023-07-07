@extends('job_portal.front.layout.layout')
@section('title', 'login')
{{-- @section('dash', 'active') --}}
@section('layout')

    <div class="container col-4 offset-4">
        <form class="row mt-5" onsubmit="return login(event,this)" method="POST" id="form">
            @csrf
            <h3 class="text-center">Employer Login</h3>
            <div class="mb-3">
                <label for="">User Email</label>
                <input type="text" id="email" name="email" class="form-control">
                @if ($errors->has('email'))
                    <span class="text-danger">{{ $errors->first('email') }}</span>
                @endif
            </div>
            <div class="mb-3">
                <label for="">Password</label>
                <input type="text" id="password" name="password" class="form-control">
                @if ($errors->has('password'))
                    <span class="text-danger">{{ $errors->first('password') }}</span>
                @endif
            </div>
            @if (session()->has('message'))
                <div class="alert alert-success">
                    {{ session()->get('message') }}
                </div>
            @endif
            <div class="mb-3">
                <input type="submit" class="btn btn-success" id="submit" value="submit">
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


        function login(e, form) {
            validate.is_validate = false;
            // validate.required('email');
            // validate.required('password')
            if (validate.is_validate == false) {
                const url = "{{ route('employers.login.post') }}";
                $(form).attr('action', url);

            }
            // e.preventDefault();

        }
    </script>
@endsection
