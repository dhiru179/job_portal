@extends('job_portal.front.layout.layout')
@section('title', 'login')
{{-- @section('dash', 'active') --}}
@section('layout')

    <div class="container col-4 offset-4">
        <form class="row mt-5" onsubmit="return login(event,this)" method="POST" id="form">
            @csrf
            <h3 class="text-center">Login</h3>
            <div class="mb-3">
                <label for="">Enter Email</label>
                <input type="text" id="email" name="email" class="form-control">
                @if ($errors->has('email'))
                    <span class="text-danger">{{ $errors->first('email') }}</span>
                @endif
            </div>
            <div class="mb-3">
                <label for="">Enter Password</label>
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
 
        function login(e, form) {
            validate.is_validate = false;
            // validate.required('email');
            // validate.required('password')
            if (validate.is_validate == false) {
                const url = "{{ route('users.login.post') }}";
                $(form).attr('action', url);

            }
            // e.preventDefault();

        }
    </script>
@endsection
