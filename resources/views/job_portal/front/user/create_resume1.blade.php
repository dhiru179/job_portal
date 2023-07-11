@extends('job_portal.front.layout.layout')
@section('title', 'create-resume')
{{-- @section('dash', 'active') --}}
@section('layout')

    <div class="container">
        <h5 class="text-center">Create Resume</h5>
        <div class="accordion accordion-flush" id="accordionFlushExample">
            <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingResume">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#flush-collapseResume" aria-expanded="false" aria-controls="flush-collapseResume">
                        upload Resume
                    </button>
                </h2>
                <div id="flush-collapseResume" class="accordion-collapse collapse" aria-labelledby="flush-headingResume"
                    data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">
                        <form onsubmit="return createResume(event,this)" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="slug" value="upload_resume">
                            <div class="mb-3">
                                <input type="file" class="form-control-file" name="resume_files">
                                @if ($errors->has('resume_files'))
                                <span class="text-danger">{{ $errors->first('resume_files') }}</span>
                            @endif
                            </div>
                            <div class="mb-3">
                                <input type="submit" class="btn btn-primary" value="save">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingOne">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                        Basic Info
                    </button>
                </h2>
                <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne"
                    data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">
                        <form onsubmit="return createResume(event,this)" method="POST" class="mb-3 row">
                            @csrf
                            <input type="hidden" name="slug" value="basic_info">
                            <div class="mb-3 col-4">
                                <label for="">User Name</label>
                                <input type="text" name="user" value="{{ $user->name }}" id="user"
                                    class="form-control">
                            </div>
                            <div class="mb-3 col-4">
                                <label for="">Email</label>
                                <input type="text" value="{{ $user->email }}" name="email" id="email"
                                    class="form-control">
                            </div>
                            <div class="mb-3 col-4">
                                <label for="">phone</label>
                                <input type="text" value="{{ $user->phone }}" name="phone_1" id="phone_2"
                                    class="form-control">
                            </div>
                            <div class="mb-3 col-4">
                                <label for="">phone</label>
                                <input type="text" value="" name="phone_1" id="phone_2" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label class="me-3" for="">Gender</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" id="inlineRadio1"
                                        value="male">
                                    <label class="form-check-label" for="inlineRadio1">Male</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" id="inlineRadio2"
                                        value="female">
                                    <label class="form-check-label" for="inlineRadio2">Female</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="others" id="inlineRadio3"
                                        value="option3">
                                    <label class="form-check-label" for="inlineRadio3">Others</label>
                                </div>

                            </div>
                            <div class="mb-3">
                                <label class="me-3" for="">Marital Status</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="marital" id="inlineRadio_marital_1"
                                        value="married">
                                    <label class="form-check-label" for="inlineRadio_marital_1">Married</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="marital" id="inlineRadio_marital_2"
                                        value="unmarried">
                                    <label class="form-check-label" for="inlineRadio_marital_2">UnMarried</label>
                                </div>

                            </div>
                            <div class="mb-3">
                                <label for="">Date Of Birth</label>
                                <input type="date" name="dob" id="dob" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="">Address</label>
                                <table class="table table-bordered text-center mb-3">
                                    <thead>
                                        <tr>
                                            <th scope="col">assress_type</th>
                                            <th scope="col">pincode</th>
                                            <th scope="col">address</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody_address">
                                        <tr id="tr1">
                                            <td class="text-center">
                                                <select class="form-select" name="address_type[]" id="">
                                                    <option value="permanent">permanent</option>
                                                    <option value="communication">communication</option>
                                                </select>
                                            </td>

                                            <td>
                                                <input type="text" name="pincode[]" class="form-control">
                                            </td>
                                            <td class="text-center">
                                                <textarea type="text" name="address[]" class="form-control"></textarea>
                                            </td>
                                            <td>
                                                <input type="button" class="btn btn-sm btn-primary"
                                                    onclick="addRow('address')" value="Add">
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                            <div class="mb-3">
                                <label for="">Language</label>
                                <table class="table table-bordered text-center mb-3">
                                    <thead>
                                        <tr>
                                            <th scope="col">Language</th>
                                            <th scope="col">Speak</th>
                                            <th scope="col">Read</th>
                                            <th scope="col">Write</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody_lan">
                                        <tr id="tr1">
                                            <td class="text-center">
                                                <input type="text" name="language[]" class="form-control">
                                            </td>

                                            <td>
                                                <input class="form-check-input" type="checkbox" name="speak[]"
                                                    id="inlineRadio1" onclick="" value="true">

                                            </td>
                                            <td>
                                                <input class="form-check-input" type="checkbox" name="read[]"
                                                    id="inlineRadio1" value="true">
                                            </td>
                                            <td>
                                                <input class="form-check-input" type="checkbox" name="write[]"
                                                    id="inlineRadio1" value="true">
                                            </td>
                                            <td>
                                                <input type="button" class="btn btn-sm btn-primary"
                                                    onclick="addRow('lan')" value="Add">
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                            <div class="mb-3">
                                <input type="submit" class="btn btn-primary" value="save">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingTwo">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                        Resume Headlines
                    </button>
                </h2>
                <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo"
                    data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">
                        <form onsubmit="return createResume(event,this)" method="POST" class="mb-3 row">
                            @csrf
                            <input type="hidden" name="slug" value="resume_headlines">
                            <div class="mb-3">
                                <h5>Resume headline</h5>
                                <textarea class="form-control" name="resume_headline" id="resume_headline"></textarea>
                            </div>
                            <div class="mb-3">
                                <input type="submit" class="btn btn-primary" value="Save">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingThree">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                        Add Skills
                    </button>
                </h2>
                <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree"
                    data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">
                        <form onsubmit="return createResume(event,this)" method="POST" class="mb-3 row">
                            @csrf
                            <input type="hidden" name="slug" value="resume_skills">
                            <div class="mb-3">

                                <table class="table table-bordered text-center mb-3">
                                    <thead>
                                        <tr>
                                            <th scope="col">skills</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody_skills">
                                        <tr>
                                            <td class="text-center">
                                                <input type="text" name="skills[]" class="form-control">
                                            </td>

                                            <td>
                                                <input type="button" class="btn btn-sm btn-primary"
                                                    onclick="addRow('skills')" value="Add">
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                            <div class="mb-3">
                                <input type="submit" class="btn btn-primary" value="save">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingFour">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#flush-collapseFour" aria-expanded="false" aria-controls="flush-collapseFour">
                        Basics Education
                    </button>
                </h2>
                <div id="flush-collapseFour" class="accordion-collapse collapse" aria-labelledby="flush-headingFour"
                    data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">
                        <form onsubmit="return createResume(event,this)" method="POST" class="mb-3 row">
                            @csrf
                            <input type="hidden" name="slug" value="educations">
                            <div class="mb-3">
                                <table class="table table-bordered text-center">
                                    <thead>
                                        <tr>
                                            <th scope="col">Qualification</th>
                                            <th scope="col">University/Institute</th>
                                            <th scope="col">Session</th>
                                            <th scope="col">marks/Grad</th>
                                            <th>course</th>
                                            <th>specialization</th>
                                            <th>total_marks</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody_education">
                                        <tr>
                                            <td class="text-center">
                                                <select class="form-select" name="qualification[]" id="qualification">
                                                    @foreach ($qualifications as $item)
                                                        <option value="{{ $item->id }}">{{ $item->standard }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td class="text-center">
                                                <select class="form-select" name="board[]" id="qualification">
                                                    @foreach ($boards as $item)
                                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <div class="input-group">
                                                    <input type="text" name="session_start[]" class="form-control">
                                                    <span class="input-group-text">-</span>
                                                    <input type="text" name="session_end[]" class="form-control">
                                                </div>
                                            </td>
                                            <td>
                                                <input type="text" name="marks[]" class="form-control">
                                            </td>
                                            <td>
                                                <input type="text" name="course[]" class="form-control">
                                            </td>
                                            <td>
                                                <input type="text" name="specialization[]" class="form-control">
                                            </td>
                                            <td>
                                                <input type="text" name="total_marks[]" class="form-control">
                                            </td>
                                            <td>
                                                <input type="button" class="btn btn-sm btn-primary"
                                                    onclick="addRow('education')" value="Add">
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                            <div class="mb-3">
                                <input type="submit" class="btn btn-primary" value="save">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingFive">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#flush-collapseFive" aria-expanded="false" aria-controls="flush-collapseFive">
                        Projects
                    </button>
                </h2>
                <div id="flush-collapseFive" class="accordion-collapse collapse" aria-labelledby="flush-headingFive"
                    data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">
                        <form onsubmit="return createResume(event,this)" method="POST" class="mb-3 row">
                            @csrf
                            <input type="hidden" name="slug" value="projects">
                            <div class="mb-3">
                                <h5>Projects</h5>
                                <table class="table table-bordered text-center mb-3">
                                    <thead>
                                        <tr>
                                            <th scope="col">Project Title</th>
                                            <th scope="col">Time duration</th>
                                            <th scope="col">About</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody_project">
                                        <tr>
                                            <td class="text-center">
                                                <input type="text" name="project_title[]" class="form-control">
                                            </td>
                                            <td class="text-center">
                                                <div class="d-flex">
                                                    <input type="text" name="time_taken[]" class="form-control">
                                                    <select class="form-select" name="duration_qty[]" id="">
                                                        <option value="days">days</option>
                                                        <option value="weeks">weeks</option>
                                                        <option value="months">months</option>
                                                    </select>
                                                </div>

                                            </td>
                                            <td>
                                                <textarea name="about_project" id="" class="form-control"></textarea>
                                            </td>
                                            <td>
                                                <input type="button" class="btn btn-sm btn-primary"
                                                    onclick="addRow('project')" value="Add">
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                            <div class="mb-3">
                                <input type="submit" class="btn btn-primary" value="save">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingSeven">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#flush-collapseSeven" aria-expanded="false" aria-controls="flush-collapseSeven">
                        Resume Profile Summary
                    </button>
                </h2>
                <div id="flush-collapseSeven" class="accordion-collapse collapse" aria-labelledby="flush-headingSeven"
                    data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">
                        <form onsubmit="return createResume(event,this)" method="POST" class="mb-3 row">
                            @csrf
                            <input type="hidden" name="slug" value="resume_profile_summary">
                            <div class="mb-3">
                                
                                <textarea class="form-control" name="resume_profile_summary" id="resume_profile_summary"></textarea>
                            </div>
                            <div class="mb-3">
                                <input type="submit" class="btn btn-primary" value="Save">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingSix">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#flush-collapseSix" aria-expanded="false" aria-controls="flush-collapseSix">
                        Social Profile
                    </button>
                </h2>
                <div id="flush-collapseSix" class="accordion-collapse collapse" aria-labelledby="flush-headingSix"
                    data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">
                        <form onsubmit="return createResume(event,this)" method="POST" class="mb-3 row">
                            @csrf
                            <input type="hidden" name="slug" value="social_profile">
                            <div class="mb-3">

                                <table class="table table-bordered text-center mb-3">
                                    <thead>
                                        <tr>
                                            <th scope="col">Name</th>
                                            <th scope="col">url</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody_social_profile">
                                        <tr>
                                            <td class="text-center">
                                                <input type="text" name="social_name[]" class="form-control">
                                            </td>
                                            <td class="text-center">
                                                <input type="text" name="social_url[]" class="form-control">

                                            </td>
                                            <td>
                                                <input type="button" class="btn btn-sm btn-primary"
                                                    onclick="addRow('social_profile')" value="Add">
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                            <div class="mb-3">
                                <input type="submit" class="btn btn-primary" value="save">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


    </div>
    <script>
        let count = 1;
        let objForm = {
            formHtmlEducation: (count) => {
                return `  <tr>
                            <td class="text-center">
                                <select class="form-select" name="qualification[]" id="qualification">
                                    @foreach ($qualifications as $item)
                                        <option value="{{ $item->id }}">{{ $item->standard }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td class="text-center">
                                <select class="form-select" name="board[]" id="qualification">
                                    @foreach ($boards as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <div class="input-group">
                                    <input type="text" name="session_start[]" class="form-control">
                                    <span class="input-group-text">-</span>
                                    <input type="text" name="session_end[]" class="form-control">
                                </div>
                            </td>
                            <td>
                                <input type="text" name="marks[]" class="form-control">
                            </td>
                            <td>
                                <input type="text" name="course[]" class="form-control">
                            </td>
                            <td>
                                <input type="text" name="specialization[]" class="form-control">
                            </td>
                            <td>
                                <input type="text" name="total_marks[]" class="form-control">
                            </td>
                            <td>
                                <input type="button" class="btn btn-sm btn-danger" onclick="removeRow(this)"
                                    value="del">
                            </td>
                        </tr>`;

            },
            formHtmlAddress: (count) => {
                return `   <tr id="tr1">
                                <td class="text-center">
                                    <select class="form-select" name="address_type[]" id="">
                                        <option value="permanent">permanent</option>
                                        <option value="communication">communication</option>
                                    </select>
                                </td>

                                <td>
                                    <input type="text" name="pincode[]" class="form-control">
                                </td>
                                <td class="text-center">
                                    <textarea type="text" name="address[]" class="form-control"></textarea>
                                </td>
                                <td>
                                    <input type="button" class="btn btn-sm btn-danger" onclick="removeRow(this)"
                                        value="Remove">
                                </td>
                            </tr>`;
            },
            formHtmlLanguage: (count) => {
                return `<tr id="tr1">
                                <td class="text-center">
                                    <input type="text" name="language[]" class="form-control">
                                </td>
                                
                                <td>
                                  <input class="form-check-input" type="checkbox" name="speak[]"
                                                id="inlineRadio1" onclick="" value="true">
                                              
                                 </td>
                                 <td>
                                   <input class="form-check-input" type="checkbox" name="read[]"
                                                id="inlineRadio1" value="true">
                                    </td>
                                 <td>
                                                <input class="form-check-input" type="checkbox" name="write[]"
                                                id="inlineRadio1" value="true">
                               </td>
                                <td>
                                    <input type="button" class="btn btn-sm btn-danger" onclick="removeRow(this)"
                                        value="Remove">
                                </td>
                            </tr>`;
            },
            formHtmlSkills: () => {
                return `      <tr>
                                <td class="text-center">
                                    <input type="text" name="skills[]" class="form-control">
                                </td>

                                <td>
                                    <input type="button" class="btn btn-sm btn-danger" onclick="removeRow(this)"
                                        value="del">
                                </td>
                            </tr>`;
            },
            formHtmlProject: () => {
                return ` <tr>
                            <td class="text-center">
                                <input type="text" name="project_title[]" class="form-control">
                            </td>
                            <td class="text-center">
                                <div class="d-flex">
                                    <input type="text" name="time_taken[]" class="form-control">
                                    <select class="form-select" name="duration_qty[]" id="">
                                        <option value="days">days</option>
                                        <option value="weeks">weeks</option>
                                        <option value="months">months</option>
                                    </select>
                                 </div>
                            </td>
                            <td>
                                <textarea name="about_project" id="" class="form-control"></textarea>
                            </td>
                            <td>
                                <input type="button" class="btn btn-sm btn-danger" onclick="removeRow(this)"
                                    value="del">
                             </td>
                        </tr>`;
            },
            formHtmlSocialProfile: () => {
                return `     <tr>
                            <td class="text-center">
                                <input type="text" name="social_name[]" class="form-control">
                            </td>
                            <td class="text-center">
                                <input type="text" name="social_url[]" class="form-control">
                            </td>
                            <td>
                                <input type="button" class="btn btn-sm btn-danger" onclick="removeRow(this)"
                                    value="del">
                             </td>
                        </tr>`;
            }

        }

        function addRow(slug) {
            count++;
            if (slug == "lan") {
                $('#tbody_' + slug).append(objForm.formHtmlLanguage(count));
            } else if (slug == "address") {
                $('#tbody_' + slug).append(objForm.formHtmlAddress(count));
            } else if (slug == "education") {

                $('#tbody_' + slug).append(objForm.formHtmlEducation(count));
            } else if (slug == 'skills') {
                $('#tbody_' + slug).append(objForm.formHtmlSkills());
            } else if (slug == 'project') {
                $('#tbody_' + slug).append(objForm.formHtmlProject());
            } else if (slug == 'social_profile') {
                $('#tbody_' + slug).append(objForm.formHtmlSocialProfile());
            }
        }

        function removeRow(elem) {
            $($(elem).parent()).parent().remove();
            // $('#tr' + id).remove();
        }

        function createResume(e, form) {
            validate.is_validate = false;
            // validate.required('email');
            // validate.required('password')
            if (validate.is_validate == false) {
                const url = "{{ route('users.create-resume-post') }}";
                $(form).attr('action', url);

            }
            // e.preventDefault();

        }
    </script>
@endsection
