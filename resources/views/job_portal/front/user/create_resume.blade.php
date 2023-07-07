@extends('job_portal.front.layout.layout')
@section('title', 'create-resume')
{{-- @section('dash', 'active') --}}
@section('layout')
    <div class="container">
        <form class="mt-5 col-6 offset-3" action="">
            <h5 class="text-center">Create Resume</h5>
            <div class="mb-3 row">
                <h5>Basic Info</h5>
                <div class="mb-3 col-4">
                    <label for="">User Name</label>
                    <input type="text" name="user" id="user" class="form-control">
                </div>
                <div class="mb-3 col-4">
                    <label for="">Email</label>
                    <input type="text" name="email" id="email" class="form-control">
                </div>
                <div class="mb-3 col-4">
                    <label for="">phone</label>
                    <input type="text" name="phone" id="phone" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="me-3" for="">Gender</label>
                       <div class="form-check form-check-inline">
                           <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1"
                               value="option1">
                           <label class="form-check-label" for="inlineRadio1">Male</label>
                       </div>
                       <div class="form-check form-check-inline">
                           <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2"
                               value="option2">
                           <label class="form-check-label" for="inlineRadio2">Female</label>
                       </div>
                       <div class="form-check form-check-inline">
                           <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3"
                               value="option3">
                           <label class="form-check-label" for="inlineRadio3">Others</label>
                       </div>
                   
               </div>
               <div class="mb-3">
                <label for="">Date Of Birth</label>
                <input type="date" name="dob" id="dob" class="form-control">
            </div>
            <div class="mb-3">
                <label for="">Address</label>
                <textarea name="address" id="address" class="form-control"></textarea>
            </div>
            </div>
            <div class="mb-3">
                <h5>Resume headline</h5>
               
                <textarea class="form-control" name="resume_headline" id="resume_headline"></textarea>
            </div>
            <div class="mb-3">
                <h5>Skills</h5>
              
                <input type="text" class="form-control">
            </div>

            <div class="mb-3">
                <h5>Basic Education</h5>
                <table class="table table-bordered text-center">
                    <thead>
                        <tr>

                            <th scope="col">Education</th>
                            <th scope="col">University/Institute</th>
                            <th scope="col">Session</th>
                            <th scope="col">Grad</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="tbody">
                        <tr id="tr1">
                            <td class="text-center">
                                <input type="text" class="form-control">
                            </td>
                            <td class="text-center">
                                <input type="text" class="form-control">
                            </td>
                            <td>
                                <input type="text" class="form-control">
                            </td>
                            <td>
                                <input type="text" class="form-control">
                            </td>
                            <td>
                                <input type="button" class="btn btn-sm btn-primary" onclick="addRow()" value="Add">
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>
            
            <div class="mb-3">
                <input type="button" class="btn btn-success" id="submit" value="submit">
            </div>
        </form>
    </div>
    <script>
        let count = 1;
        let objForm = {
            formHtml: (count) => {
                return `<tr id="tr${count}">
                        <td class="text-center">
                            <input type="text" class="form-control">
                        </td>
                        <td class="text-center">
                            <input type="text" class="form-control">
                        </td>
                        <td>
                            <input type="text" class="form-control">
                        </td>
                        <td>
                            <input type="text" class="form-control">
                        </td>
                        <td>
                            <input type="button" class="btn btn-sm btn-danger" onclick="removeRow(${count})" value="Del">
                        </td>
                        </tr>`;
            }
        }

        function addRow() {
            count++;
            $('#tbody').append(objForm.formHtml(count));
        }

        function removeRow(id) {
            
            $('#tr' + id).remove();
        }
    </script>
@endsection
