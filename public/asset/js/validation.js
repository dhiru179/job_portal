let validate = {
    required: function(id) {
        // console.log(id)
        let inputField = $('#' + id);
        $('#' + id).next().remove();

        if ($.trim(inputField.val()) == '') {
            $('#' + id).after(`<span class="text-danger">This field is required</span>`)
            validate.is_validate = true;
        }
        return validate.is_validate;
    },
    email: function(id) {

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
    },
    mobile: (id) => {
        //  console.log(id)
        let mobilePattern = /^((\+)?(\d{2}[-]))?(\d{10}){1}?$/;
        let inputField = $('#' + id);
        $('#' + id).next().remove();

        if ($.trim(inputField.val()) == '') {
            validate.required(id);

        } else {
            if (!mobilePattern.test(inputField.val())) {
                validate.is_validate = true;
                $('#' + id).after(`<span class="text-danger">Enter Valid Mobile No.</span>`)
            } else {

                validate.is_validate = false;
                // $('#admin_email_msg').html('');
            }
        }
    },
    password: (id) => {
        let pattern = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
        let inputField = $('#' + id);
        $('#' + id).next().remove();

        if ($.trim(inputField.val()) == '') {
            validate.required(id);

        } else {
            if ($.trim(inputField.val()).length >= 6) {
                validate.is_validate = false;

            }
            // if (!pattern.test(inputField.val())) {
            //     validate.is_validate = true;
            //     $('#' + id).after(`<span class="text-danger">Enter Valid Email address</span>`)
            else {

                validate.is_validate = true;
                $('#' + id).after(`<span class="text-danger">Password length should be 6 char</span>`)
                // $('#admin_email_msg').html('');
            }
        }
    },
    cnfPassword: (pass, cnf_password) => {
        $('#' + cnf_password).next().remove();
        if ($('#' + pass).val() === $('#' + cnf_password).val()) {

            validate.is_validate = false;
        } else {
            validate.is_validate = true;
            $('#' + cnf_password).after(`<span class="text-danger">password not match</span>`)
        }
    },
    file: (obj) => {
        var fname = obj.name;
        let regex = "";
        obj.supportFile.forEach(elem => {
            regex += `${elem}|`;
        })

        var re = new RegExp(`(${regex})`)
        // console.log(re, re.test(fname))
        if (!re.test(fname)) {
            validate.is_validate = true;
            $('#' + obj.id).after(`<span class="text-danger">file type ${regex} not supported </span>`)
           
        }
    }

};