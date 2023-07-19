@extends('job_portal.front.layout.layout')
@section('title', 'user apply job')
{{-- @section('dash', 'active') --}}
@section('layout')

    <div class="container">
        <table class="mt-3 table table-bordered">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Job title</th>
                    {{-- <th scope="col">Skill</th> --}}
                    <th scope="col">Job status</th>
                    <th scope="col">Applyed / Save Job </th>
                    <th width="100" scope="col">Contact</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($result as $key => $item)
                    <tr>
                        <th scope="row">{{ $key + 1 }}</th>
                        <td>{{ $item->job_title }}</td>
                        {{-- <td>{{ $item->skill }}</td> --}}
                        <td>Active</td>
                        <td>{{ $item->job_status }}</td>
                        <td>

                        </td>
                    </tr>
                @endforeach


            </tbody>
        </table>
    </div>
@endsection
