@extends('job_portal.front.layout.layout')
@section('title', 'verify')
{{-- @section('dash', 'active') --}}
@section('layout')

    <div class="container col-4 offset-4">
        <form class="row mt-5" onsubmit="return login(event,this)" method="POST" id="form">
            @csrf
            <h3 class="text-center">verify</h3>
            <div class="mb-3">
                <label for="">Enter Email</label>
                <input type="text" id="email" name="email" class="form-control">
                @if ($errors->has('email'))
                    <span class="text-danger">{{ $errors->first('email') }}</span>
                @endif
            </div>
          
            @if (session()->has('message'))
                <div class="alert alert-success">
                    {{ session()->get('message') }}
                </div>
            @endif
            <div class="mb-3">
                <input type="submit" class="btn btn-success" id="submit" value="Send">
            </div>
        </form>
    </div>
    <script>
 
        function login(e, form) {
            validate.is_validate = false;
            // validate.required('email');
            // validate.required('password')
            if (validate.is_validate == false) {
                const url = "{{ route('users.verfy-email') }}";
                $(form).attr('action', url);

            }
            // e.preventDefault();

        }
    </script>
@endsection
