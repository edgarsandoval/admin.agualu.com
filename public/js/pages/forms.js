'use strict';
$(document).ready(function() {
    $('#role-form').bootstrapValidator({
        fields: {
            name: {
                validators: {
                    notEmpty: {
                        message: 'Ingresa un nombre'
                    },
                    regexp: {
                           regexp: /^[a-zA-Z y]+$/,
                           message: 'La entrada no es un nombre válido'
                       }
                }
            },
        }
    }).on('success.form.bv', function(e) {
        e.preventDefault();
        swal({
            title: "Success.",
            text: "Successfully Added",
            type: "success",
            allowOutsideClick: false
        }).then(function() {
            location.reload();
        });
    });;
});
