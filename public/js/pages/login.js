'use strict';
$(document).ready(function() {
    $(window).on("load", function() {
        $('.preloader img').fadeOut();
        $('.preloader').fadeOut(1000);
    });
    new WOW().init();
    $('#login_validator').bootstrapValidator({
        fields: {
            member_code: {
                validators: {
                    notEmpty: {
                        message: 'El nombre de usuario es requerido'
                    },
                    regexp: {
                        regexp: /^[A-Z]{3}-\d{4}$/,
                        message: 'El nombre de usuario no es válido'
                    }
                }
            },
            password: {
                validators: {
                    notEmpty: {
                        message: 'Por favor, ingresa una contraseña'
                    }
                }
            }
        }
    });

});
