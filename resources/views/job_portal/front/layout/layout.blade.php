<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{-- <link rel="stylesheet" href="{{asset('/bootstrap/bootstrap.min.css')}}">
   
    <script src="{{asset('/bootstrap/jquery.min.js')}}"></script> --}}
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"
        integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    {{-- <link rel="stylesheet" href="{{asset('multi_select/sellect.css')}}">
       <script src="{{asset('multi_select/sellect.js')}}"></script> --}}
       <script  src="{{asset('asset/js/validation.js')}}"></script> 
    <title>@yield('title')</title>
    <style>
        .radio-toolbar {
            margin: 10px;
        }

        .radio-toolbar input[type="radio"] {
            opacity: 0;
            position: fixed;
            width: 0;
        }

        .radio-toolbar label {
            display: inline-block;
            background-color: #ddd;
            padding: 10px 20px;
            font-family: sans-serif, Arial;
            font-size: 16px;
            border: 2px solid #444;
            border-radius: 4px;
        }

        .radio-toolbar label:hover {
            background-color: #dfd;
        }

        .radio-toolbar input[type="radio"]:focus+label {
            border: 2px dashed #444;
        }

        .radio-toolbar input[type="radio"]:checked+label {
            background-color: rgb(228, 187, 255);
            border-color: #0d6efd;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('landing_page') }}">Job Portal</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    @auth
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{ route('users.index') }}">Home</a>
                        </li>
                    @endauth
                    <li class="nav-item">
                        <a class="nav-link active" href="{{route('users.job-posts')}}">Job Post</a>
                    </li>
                

                </ul>

                @auth
                    <div class="d-flex">
                        <div class="dropdown nav-item">
                            <a class="nav-link active dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <span class="me-2">Hello {{ Auth::user()->name }}</span>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="{{ route('users.create-profile') }}">Create Profile</a>
                                </li>
                                <li><a class="dropdown-item" href="{{ route('users.create-resume') }}">Create Resume</a>
                                </li>
                                <li>
                                    <hr>
                                </li>

                                <li><a class="dropdown-item" href="{{ route('users.my-cv') }}">My Resume</a>
                                </li>

                                <li><a class="dropdown-item" href="{{ route('users.upload-resume') }}">Upload Resume</a>
                                </li>
                                <li><a class="dropdown-item" href="{{ route('users.list-apply-job') }}">Applied Job</a></li>

                            </ul>
                        </div>

                        <form action="{{ route('users.logout') }}" method="post">
                            @csrf
                            <input type="submit" class="btn btn-dark" value="Logout">
                        </form>
                    </div>
                @endauth

                @guest
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link active" href="{{ route('users.login') }}">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="{{ route('users.signup') }}">signUp</a>
                        </li>
                    </ul>

                @endguest


            </div>
        </div>
    </nav>
    @if (session()->has('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Message</strong> {{ session()->get('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @section('layout')

    @show
    {{-- <script src="{{asset('/bootstrap/bootstrap.bundle.min.js')}}"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

</body>

</html>
