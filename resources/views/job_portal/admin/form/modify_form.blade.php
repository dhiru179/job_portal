@extends('job_portal.admin.layout.layout')
@section('title', 'Modify Form')
{{-- @section('dash', 'active') --}}
@section('layout')

    <div class="container">

        <div class="mt-3 col-12 row">
            <div class="col-3">
                <div id="clasified">
                    <div class="mb-3">
                        <select class="form-select" level="1" id="form_type">
                            @foreach ($category as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <input type="button" class="btn btn-sm btn-success" value="show form" onclick="showForm()">
            </div>
            <div class="col-9">
                <form id="formTable">
                    <table class="table table-bordered text-center">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">type</th>
                                <th scope="col">label</th>
                                <th scope="col">name</th>
                                <th scope="col">mandetory</th>
                                <th scope="col">Active</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="tbody">


                        </tbody>
                    </table>
                </form>
                <div class="d-flex">
                    <button class="btn btn-success mx-3" onclick="addRow()">Add</button>
                    <button class="btn btn-info mx-3" id="save">save</button>
                </div>

            </div>
        </div>
    </div>
    <script>
        let count = 1;
        let optionCount = 0;
        let input = "";
        let currentId = "";
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
        let objForm = {

            formHtml: (slug, count, elem) => {

                let optionHtml = "";
                if (elem.list != "") {
                    optionHtml = `<div class="dropdown mt-2">
                                                <div class="input-group" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <input type="text" class="form-control form-control-sm" id="option_value${count}" />
                                                    <input type="button" class="btn btn-sm btn-dark" value="Add" onclick="addOption(${count})"/>
                                                </div>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1"  id="dropdown${count}">${list}</ul>
                                          </div>`;
                }
                return `<tr id="tr${count}">
                                <td scope="row">${count}</td>
                                <td>
                                    <select form-field-id="${elem.id}" class="form-select form-select-sm" name="tagType[]" id="tag${count}" onchange="tagType(this,${count})">
                                        <option selected value="">--</option>
                                        @foreach ($type as $item)
                                            ${parseInt(elem.input_type_id)=={{ $item->id }}?`<option selected value="{{ $item->id }}">{{ $item->type }}</option>`:`<option value="{{ $item->id }}">{{ $item->type }}</option>` }
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <input type="text" class="form-control form-control-sm" value="${elem.label}" name="label[]" onkeyup="modifyLabel(event,this,${count})" id="label${count}">
                                </td>
                                <td>
                                    <input type="text" class="form-control form-control-sm" value="${elem.name}" name="attr[]"  id="attr${count}">
                                    <div id="multi_option${count}">
                                        ${optionHtml}
                                    </div>
                                </td>
                                <td>
                                    <div class="form-check form-switch d-flex justify-content-center align-items-center">
                                        <input type="checkbox" class="form-check-input" name="star[]"  id="star${count}" ${elem.is_need=='true'?'checked':""}>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-check form-switch d-flex justify-content-center align-items-center">
                                        <input type="checkbox" class="form-check-input" name="status[]"  id="status${count}" ${elem.status=='true'?'checked':""}>
                                    </div>
                                </td>
                                <td>
                                   ${elem.id!=""?`<button type="button" class="btn btn-sm btn-danger" onclick=deleteRow(${elem.id})>Delete</button>`:`<button type="button" class="btn btn-sm btn-danger" onclick=removeRow(${count})>x</button>`} 
                                </td>
                                
                         </tr>`;

            },

            post: (url, data) => {
                $.ajax({
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}",
                    },
                    url: url,
                    data: data,
                    //  contentType: 'application/json',
                    success: function(res) {
                        console.log(res);

                        if (res.status) {
                            if (res.slug == "formUpdate") {
                                alert(res.msg);
                                // window.location.reload();
                            } else if (res.slug == 'showForm') {
                                objForm.showForm(res.data, res.options);
                            } else if (res.slug == 'deleteRow') {
                                alert(res.msg);
                            } else if (res.slug == 'deleteOption') {
                                alert(res.msg);
                            }

                        }

                    },
                    error: (err) => console.log(err),
                });
            },

            showForm: (data, options) => {
                if (data.length > 0) {
                    $('#tbody').html("");
                    let tr = "";
                    let list = "";
                    let opHtml = "";
                    data.forEach((elem, index) => {
                        options.forEach((op, opIndex) => {

                            if (elem.id === op.tmp_tbl_form_field_id) {
                                list += `
                                        <li class="dropdown-item d-flex justify-content-between align-items-center input-group">
                                            <input op-id="${op.id}" type="text" class="form-control form-control-sm" value="${op.option }" onkeypress="changeOptionField(event,this)"  ondblclick="$(this).attr('readonly',false);" name="option${elem.orderby}[]" readonly="">
                                            <button type="button" class="btn btn-sm btn-warning bi bi-trash-fill" onclick="removeOption(this,${op.id})"></button>
                                            
                                        </li>`;

                            }
                        });

                        count = elem.orderby;
                        elem.list = list;
                        tr += objForm.formHtml('tr', count, elem);
                        elem.list = "";

                    })

                    $('#tbody').append(tr);
                }
            }
        }

        function addRow() {
            input = "";
            validate.is_validate = false; //set false default
            validate.required('tag' + count);
            // validate.required('label' + count);
            // validate.required('attr' + count);
            if (validate.is_validate === false) {
                count++;
                let elem = {
                    id: "",
                    form_id: "",
                    input_type_id: "",
                    is_need: "",
                    label: "",
                    name: "",
                    orderby: "",
                    status: "",
                    list: ""
                }
                $('#tbody').append(objForm.formHtml('tr', count, elem));
            }

        }

        function removeRow(id) {
            $('#tr' + id).remove();

        }


        function tagType(elem, currentCount) {
            const tag = (elem.options[elem.selectedIndex].text).trim().split(' ');
            const tagName = tag[0];
            const tagType = typeof(tag[1]) != "undefined" ? tag[1] : '';

            $('#multi_option' + currentCount).html('');
            let opHtml = `<div class="dropdown mt-2">
                            <div class="input-group" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                            <input type="text" class="form-control form-control-sm" id="option_value${currentCount}" />
                                            <input type="button" class="btn btn-sm btn-dark" value="Add" onclick="addOption(${currentCount})"/>
                                            </div>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1"  id="dropdown${currentCount}"></ul>
                                            </div>`;
            if (tagName == 'dropdown' || tagType == 'radio' || tagType == "checkbox") {

                $('#multi_option' + currentCount).append(opHtml);
            }
        };

        function modifyLabel(event, elem, count) {

            if (event.keyCode === 32) {
                input = input.trim() + "_";
            } else if (event.keyCode >= 65 && event.keyCode <= 90) {
                input += event.key;
            } else if (event.keyCode >= 96 && event.keyCode <= 106) {
                input += event.key;
            } else if (event.keyCode === 8) {
                input = input.slice(0, -1);
            } else if (event.keyCode === 189) {
                input += event.key;
            }

            $('#attr' + count).val(input.toLowerCase());
            // console.log(event.key,event.keyCode)

            return false;
        }




        function addOption(count, flag) {
            // count = String(count)
            const value = $('#option_value' + count).val();


            if (value.length > 0) {


                let html = `<li class="dropdown-item d-flex justify-content-between align-items-center input-group" >
                        <input type="text" class="form-control form-control-sm" value="${value}" onkeypress="changeOptionField(event,this)" ondblclick="$(this).attr('readonly',false);" name="option${count}[]" readonly/>
                        <button type="button" class="btn btn-sm btn-danger bi bi-trash-fill" onclick="removeOption(this,${0})"></button>
                        </li>`;
                $('#dropdown' + count).append(html);
                $('#option_value' + count).val("");
                optionCount++;
            }



        }

        const removeOption = (elem, opId) => {
            $(elem.parentNode).remove();
            if (parseInt(opId) > 0) {
                const url = "{{ url('/delete_option') }}";
                let data = {
                    slug: "deleteOption",
                    id: opId,

                }
                objForm.post(url, data);
            }

        }



        function changeOptionField(event, elem) {

            if (event.key == "Enter") {
                $(elem).attr('readonly', true);

                $('#dropdown' + count).removeClass('show');
                //    console.log(event);
            }

            return false;
        }

        function showForm() {
            validate.is_validate = false;
            validate.required('form_type');
            const url = "{{ route('admin.get-form-field') }}";
            const data = {
                slug: "showForm",
                cat_id: $('#form_type').val(),
            }
            if (validate.is_validate == false) {

                objForm.post(url, data)
            }

        }

        function deleteRow(id) {
            const url = "{{ url('/delete_custom_form') }}";
            let data = {
                slug: "deleteRow",
                id: id,

            }
            objForm.post(url, data);
        }

        $('#save').click((e) => {

            const url = "{{ route('admin.modify-form-field') }}";
            let formData = [];
            validate.is_validate = false; //set false default
            function validation(tr) {
                validate.required('form_type');
                let tdArr = $(tr).find('td')
                let orderby = parseInt($(tdArr[0]).text().trim());
                validate.required('tag' + orderby);
                // validate.required('label' + orderby);
                // validate.required('attr' + orderby);
                return validate.is_validate;
            }


            $('#tbody tr').each((i, tr) => {
                if (validation(tr) === true) return;
                let tdArr = $(tr).find('td')
                let orderby = parseInt($(tdArr[0]).text().trim());
                let tagId = $(tr).find('select').val();
                let form_field_id = $(tr).find('select').attr('form-field-id') || 0;
                let field_type = $(tr).find(`select option[value=${tagId}]`).text();
                let label_name = $(tdArr[2]).find('input').val();
                let is_need = $(tdArr[4]).find('input').is(':checked');
                let is_active = $(tdArr[5]).find('input').is(':checked');
                let newData = {
                    "id": parseInt(form_field_id),
                    "tag_id": parseInt(tagId),
                    "tag_label": label_name,
                    "is_need": is_need,
                    "orderby": orderby,
                    "status": is_active,
                }

                if (field_type == 'dropdown' || field_type == 'input checkbox' || field_type ==
                    "input radio") {
                    console.log('hit')
                    newData.options = [];
                    $(tdArr[3]).find('li').each((i, li) => {
                        $(li).find('input').val()
                        newData.options.push({
                            id: $(li).find('input').attr('op-id') || 0,
                            data: $(li).find('input').val(),
                        })
                        newData.tag_name = $('#attr' + orderby).val();
                        // console.log($(tdArr[3]).find('ul').closest('input[type=text]'));
                    })
                } else {
                    newData.tag_name = $(tdArr[3]).find('input').val()
                }

                formData.push(newData);


            })

            let data = {
                slug: "formUpdate",
                form: formData,
                cat_id: $('#form_type').val(),

            }
            console.log(data)

            objForm.post(url, data);
        })
    </script>
@endsection
