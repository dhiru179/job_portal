@extends('job_portal.front.layout.layout_emp')
@section('title', 'employer post-list')
{{-- @section('dash', 'active') --}}
@section('layout')

    <div class="container">
        <table class="mt-3 table table-bordered">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Job title</th>
                    <th scope="col">Skill</th>
                    <th width="100" scope="col">Handle</th>
                </tr>
            </thead>
            <tbody >
                @foreach ($post as $key => $item)
                <tr>
                    <th scope="row">{{$key+1}}</th>
                    <td>{{ $item->job_title }}</td>
                    <td>{{ $item->skill }}</td>
                    <td>
                        <div class="">
                            <a href="{{route('employers.job-post-edit',$item->id)}}" class="btn btn-primary btn-sm">Edit</a>
                            <a href="{{route('employers.job-post-view',$item->id)}}" class="btn btn-dark btn-sm">View</a>
                            {{-- <a href="{{route('employers.job-post-edit',$item->id)}}" class="btn btn-danger btn-sm">Delete</a> --}}
                        </div>
                    </td>
                </tr>
           
            @endforeach
               

            </tbody>
        </table>
    </div>
@endsection
