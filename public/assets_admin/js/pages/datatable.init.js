"use strict";

$(document).ready(function() {
    $("#datatable").DataTable();

    var a = $("#datatable-buttons").DataTable({
        lengthChange: false,
        buttons: ["copy", "print"]
    });

    $("#key-table").DataTable({
        keys: true
    });

    $("#responsive-datatable").DataTable();

    $("#selection-datatable").DataTable({
        select: {
            style: "multi"
        }
    });

    $("#alternative-page-datatable").DataTable({
        pagingType: "full_numbers"
    });

    $("#scroll-vertical-datatable").DataTable({
        scrollY: "350px",
        scrollCollapse: true,
        paging: false
    });

    $("#scroll-horizontal-datatable").DataTable({
        scrollX: true
    });

    $("#complex-header-datatable").DataTable({
        columnDefs: [{
            visible: false,
            targets: -1
        }]
    });

    $("#row-callback-datatable").DataTable({
        createdRow: function(a, e, t) {
            if (15e4 < +e[5].replace(/[\$,]/g, "")) {
                $("td", a).eq(5).addClass("text-danger");
            }
        }
    });

    $("#state-saving-datatable").DataTable({
        stateSave: true
    });

    $("#fixed-columns-datatable").DataTable({
        scrollY: 300,
        scrollX: true,
        scrollCollapse: true,
        paging: false,
        fixedColumns: true
    });

    $("#fixed-header-datatable").DataTable({
        responsive: true
    });

    a.buttons().container().appendTo("#datatable-buttons_wrapper .col-md-6:eq(0)");

    $("#datatable_length select[name*='datatable_length']").addClass("form-select form-select-sm");
    $("#datatable_length select[name*='datatable_length']").removeClass("custom-select custom-select-sm");
    $(".dataTables_length label").addClass("form-label");
});
