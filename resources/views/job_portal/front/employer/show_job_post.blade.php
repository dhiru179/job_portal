@extends('job_portal.front.layout.layout_emp')
@section('title', 'ad-post')
{{-- @section('dash', 'active') --}}
@section('layout')

    <div class="container">
        <div class="mt-5 col-8 offset-2">
            <form class="row mb-5" action="" id="form">
                <input type="hidden" name="post_id" value="{{ !empty($post->id) ? $post->id : '' }}">
                <div class="mb-3 col-6">
                    <label for="">Job Title</label>
                    <input type="text" id="job_title" value="{{ !empty($post->job_title) ? $post->job_title : '' }}"
                        name="job_title" class="form-control">
                </div>
                <div class="mb-3 col-6">
                    <label for="">No Of Opening</label>
                    <input type="number" id="vacancy"
                        value="{{ !empty($post->no_of_vacancy) ? $post->no_of_vacancy : '' }}" name="vacancy"
                        class="form-control">
                </div>
                <div class="mb-3">
                    <label for="">Select Job city</label>
                    <div class="row">
                        <div class="col-4">
                            {{-- <div class="">
                    <input type="text" class="form-select search-select" placeholder="select country">
                </div> --}}

                            <select class="form-select country" name="" id="country" step="0">
                                <option class="text-muted" value="">select country</option>
                                @foreach ($countries as $country)
                                    @if (!empty($user->country_id) && $country->id == $user->country_id)
                                        <option selected value="{{ $country->id }}">{{ $country->name }}</option>
                                    @endif
                                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                                @endforeach
                            </select>

                        </div>
                        <div class="col-4">
                            <select name="" id="state" step="0" class="form-select state">

                                <option class="text-muted" value="">select states</option>


                            </select>

                        </div>
                        <div class="col-4">
                            <select name="city" id="city" step="0" class="form-select city">

                                <option class="text-muted" value="">select city</option>


                            </select>

                        </div>
                    </div>
                    <div id="append-location">

                        @if (isset($job_post_city) && count($job_post_city) > 0)
                            @foreach ($job_post_city as $item)
                                <input type="button" data-id="{{ $item->id }}"
                                    class="btn btn-success me-1 my-1 btn-sm " value="{{ $item->name }}">
                            @endforeach
                        @endif
                    </div>
                    {{-- <div class="mb-3">
                    <label for="">Link Google Map</label>
                    <input type="text" id="g_map" name="g_map" class="form-control">
                </div> --}}
                </div>



                <div class="mb-3">
                    <label for="">Salary Range</label>
                    <div class="input-group">
                        <input type="number" class="form-control" id="min_salary"
                            value="{{ !empty($post->min_salary) ? $post->min_salary : '' }}" name="min_salary">
                        <span class="input-group-text">To</span>
                        <input type="number" class="form-control" id="max_salary"
                            value="{{ !empty($post->max_salary) ? $post->max_salary : '' }}" name="max_salary">
                    </div>

                </div>


                <div class="mb-3">
                    <div class="" id="skils_box">

                    </div>
                    <label for="">Skills</label>
                    <input type="text" class="form-control" onkeyup="addSkills(event)" id="add-skills"
                        placeholder="Skills">
                    <div id="append-skills">
                        @if (isset($job_post_skill) && count($job_post_skill) > 0)
                            @foreach ($job_post_skill as $item)
                                <input type="button" data-id="{{ $item->id }}" 
                                    class="btn btn-success me-1 my-1 btn-sm" value="{{ $item->skill }}">
                            @endforeach
                        @endif
                    </div>
                </div>
                <div class="mb-3">

                    <label for="">Heighest Qualification</label>
                    <select class="form-select" name="qualification" id="qualification">
                        @foreach ($education as $item)
                            @if (!empty($post->education_standard_id) && $post->education_standard_id == $item->id)
                                <option selected value="{{ $item->id }}">{{ $item->standard }}</option>
                            @endif
                            <option value="{{ $item->id }}">{{ $item->standard }}</option>
                        @endforeach
                    </select>

                </div>

                <div class="mb-3">
                    <label for="">Experience</label>
                    <div class="input-group">
                        <input type="number" class="form-control" min="0" max="50" step="0.5"
                            id="experience" value="{{ !empty($post->experience) ? $post->experience : '' }}"
                            name="experience">
                        <span class="input-group-text">Years</span>

                    </div>

                </div>

                <div class="mb-3">
                    <label for="">Gender</label>
                    <select name="gender" id="gender" class="form-select">
                        @if (!empty($post->gender))
                            <option selected value="{{ $post->gender }}">{{ ucfirst($post->gender) }}</option>
                        @endif
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                        <option value="both">Both</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="">Job Descriptions</label>
                    <textarea col="3" rows="3" name="description" id="description" class="form-control">{{ !empty($post->gender) ? $post->job_descriptions : '' }}</textarea>
                </div>
                
            </form>
        </div>
    </div>

@endsection
