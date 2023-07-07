@extends('job_portal.front.layout.layout')
@section('title', 'Job Portal')
{{-- @section('dash', 'active') --}}
@section('layout')

    <div class="container">

        <div class="my-3 col-8 offset-2">
            <form action="" method="">
                <div class="d-flex mb-3">
                    <input type="search" class="form-control me-1" name="keyword" id="">
                    <input type="submit" class="btn btn-success" value="Seacrh">
                </div>
                <div class="d-flex mb-3">
                    <div class="mb-3 col-4">
                        <select class="form-select" name="" id="">
                            <option value="">Search by Company</option>
                            @foreach ($employers as $item)
                                <option value="{{ $item->id }}">{{ $item->company_name }}</option>
                            @endforeach

                        </select>
                    </div>
                    <div class="mb-3 col-4">

                    </div>
                    <div class="mb-3 col-4">

                    </div>
                </div>
            </form>

        </div>
        <div class="d-flex">
            <div class="col-3">
                <form id="filter" action="{{ route('landing_page') }}" method="GET">
                <div class="">
                    <h5>Company</h5>
                    <div>
                        @foreach ($employers as $item)
                            <div class="form-check">
                                <input class="form-check-input" onclick="selectFilter(this)" type="checkbox"
                                    value="{{ $item->id }}" name="elem_id[]" id="defaultCheck{{ $item->id }}">
                                <label class="form-check-label" for="defaultCheck{{ $item->id }}">
                                    {{ $item->company_name }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="mb-3">
                    <h5>Location</h5>
                </div>
                <div class="mb-3">
                    <h5>Skills</h5>
                </div>
                <div class="mb-3">
                    <h5>Salary</h5>
                    <div>
                        <input type="range" class="form-range w-75" min="0" max="5" id="customRange2">
                    </div>
                </div>
                <div class="mb-3">
                    <h5>Experience</h5>
                    <div class="">
                        <input type="range" class="form-range w-75 " min="0" max="30" id="customRange2">
                        <div class="d-flex justify-content-between w-75 ">
                            <span>0</span>
                            <span>30</span>
                        </div>
                    </div>
                </div>
            </form>
            </div>
            <div class="mb-3 col-6">
                <div>
                    @foreach ($result as $key => $item)
                        <div class="card mb-3">
                            <div class="card-body">
                                <h5 class="card-title">{{ $item->job_title }}</h5>
                                <h6 class="card-subtitle mb-2 text-muted">{{ $item->skill }}</h6>

                                <div class="d-flex justify-content-between">
                                    <div class="d-flex align-items-center justify-content-center">
                                        <h6 class="m-0 text-muted">salary : </h6><span>
                                            {{ $item->min_salary }}-{{ $item->max_salary }}</span>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-center">
                                        <h6 class="m-0 text-muted">Experience : </h6><span> {{ $item->experience }}</span>
                                    </div>

                                    <h6></h6>
                                </div>
                                <p class="card-text">{{ $item->job_descriptions }}</p>
                                @guest
                                    <div class="d-flex justify-content-between">
                                        <div class="d-flex align-items-center ">
                                            <h6 class="m-0 text-muted">Company : </h6><span>
                                                {{ $item->company_name }}</span>
                                        </div>
                                        <div>
                                            <a href="{{ route('users.login') }}" class="card-link btn btn-dark">Login to
                                                Apply</a>
                                        </div>
                                    </div>
                                @endguest
                                @auth
                                    <div class="d-flex justify-content-between">
                                        <div class="d-flex align-items-center ">
                                            <h6 class="m-0 text-muted">Company : </h6><span>
                                                {{ $item->company_name }}</span>
                                        </div>

                                        @if ($item->job_status != '' && $item->user_id == auth()->user()->id)
                                            <div class="d-flex justify-content-end" id="job_status_{{ $item->id }}">
                                                @if ($item->job_status == 'Save')
                                                    <input type="button" class="card-link  btn btn-secondary" value="Saved" />
                                                    <input type="button" class="card-link btn btn-dark" apply_job=""
                                                        onclick="applyJob('{{ $item->id }}','{{ $item->emp_id }}','Applied')"
                                                        value="Apply Job" />
                                                @else
                                                    <input type="button" class="card-link btn btn-secondary"
                                                        value="Job Applied" />
                                                @endif
                                            </div>
                                        @else
                                            <div class="d-flex justify-content-end" id="job_status_{{ $item->id }}">
                                                <input type="button" class="card-link btn btn-primary" save_job=""
                                                    onclick="applyJob('{{ $item->id }}',{{ $item->emp_id }},'Save')"
                                                    value="Save Job" />
                                                <input type="button" class="card-link btn btn-dark" apply_job=""
                                                    onclick="applyJob('{{ $item->id }}','{{ $item->emp_id }}','Applied')"
                                                    value="Apply Job" />
                                            </div>
                                        @endif
                                    </div>
                                @endauth

                            </div>
                        </div>
                    @endforeach

                </div>
                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-end">
                        <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                        </li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#">Next</a>
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="col-3">

            </div>
        </div>

    </div>
    <script type="text/javascript">
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
                            } else if (res.slug == "jobStatus") {

                                objForm.jobStatus(data.job_status, data.post_id);
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
            },
            jobStatus: (job_status, post_id) => {

                if (job_status == "Save") {
                    let html = ` <input type="button" class="card-link  btn btn-secondary" value="Saved" />`;
                    let save_job_btn = $(`#job_status_${post_id} [save_job]`);
                    save_job_btn.replaceWith(html);

                } else if (job_status == "Applied") {
                    let apply_job_btn = $(`#job_status_${post_id}`);
                    let html = `<input type="button" class="card-link btn btn-secondary" value="Job Applied" />`;
                    apply_job_btn.html(html);
                }
            }
        }

        @auth

        function applyJob(post_id, emp_id, status) {
            const url = "{{ route('users.apply-job') }}";
            const data = {
                user_id: "{{ auth()->user()->id }}",
                post_id: post_id,
                emp_id: emp_id,
                job_status: status,
                slug: "jobStatus"
            }
            console.log(data);
            // objForm.jobStatus(data.job_staus, data.post_id);
            objForm.post(url, data);
        }
        @endauth

        function selectFilter(elem) {
            
            $('#filter').submit();
           
        }
    </script>
@endsection
