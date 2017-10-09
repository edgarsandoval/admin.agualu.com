"use strict";
$(document).ready(function() {
    var roles = {
        'admin'        : 'Administrador',
        'partner'      : 'Socio',
        'customer'     : 'Cliente Preferente',
    };

    var msg     = lscache.get('user').member_code + ' - ' + roles[lscache.get('user').roles[0].name];
    var name    = lscache.get('user').first_name + ' ' + lscache.get('user').last_name;
    var title   = "<span>¡Bienvenido!</span> <h5 class='text-white'>" + name + "</h5>";

    toastr.success(msg, title);
});
