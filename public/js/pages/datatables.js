'use strict';
$(document).ready(function() {
    var table = $('.dataTable');
    table.DataTable({
        dom: "<'text-right'B><f>lr<'table-responsive't><'row'<'col-md-5 col-12'i><'col-md-7 col-12'p>>",
        buttons: [],
        language: {
            url: 'DatatablesSpanish.json'
        }
    });
    var tableWrapper = $("#editable_table_wrapper");
    tableWrapper.find(".dataTables_length select").select2({
        showSearchInput: false //hide search box with special css class
    }); // initialize select2 dropdown
    $("#editable_table_wrapper .dt-buttons .btn").addClass('btn-secondary').removeClass('btn-default');
    $(".dataTables_wrapper").removeClass("form-inline");
    $(".dataTables_paginate .pagination").addClass("float-right");


    $('.btn-delete').click(function(event) {
        event.preventDefault();
        event.stopPropagation();

        if(!confirm('¿Esta seguro que desea eliminar este registro?'))
            return;

        var row 	= $(this).parents('tr');
        var id 		= row.data('id');
        var form 	= $('.form-delete');

        var url 	= form.attr('action').replace(':ID', id);
        var data 	= form.serialize();

        row.fadeOut();

        $.post(url, data, function(response) {
            if(response.status)
                toastr.success(response.message, '¡Exito!');
            else {
                toastr.error(response.message, '¡Error!');
                row.fadeIn();
            }
        });
    });
});
