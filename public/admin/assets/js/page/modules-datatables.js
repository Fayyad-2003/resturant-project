"use strict";

$("[data-checkboxes]").each(function () {
    var me = $(this),
        group = me.data("checkboxes"),
        role = me.data("checkbox-role");

    me.change(function () {
        var all = $(
                '[data-checkboxes="' +
                    group +
                    '"]:not([data-checkbox-role="dad"])'
            ),
            checked = $(
                '[data-checkboxes="' +
                    group +
                    '"]:not([data-checkbox-role="dad"]):checked'
            ),
            dad = $(
                '[data-checkboxes="' + group + '"][data-checkbox-role="dad"]'
            ),
            total = all.length,
            checked_length = checked.length;

        if (role == "dad") {
            if (me.is(":checked")) {
                all.prop("checked", true);
            } else {
                all.prop("checked", false);
            }
        } else {
            if (checked_length >= total) {
                dad.prop("checked", true);
            } else {
                dad.prop("checked", false);
            }
        }
    });
});

// $("#table-1").dataTable({
//   "columnDefs": [
//     { "sortable": false, "targets": [2,3] }
//   ]
// });

$(document).ready(function () {
    $("#table-1").DataTable({
        dom: "Bfrtip",
        buttons: [
            { extend: "copy", text: "Copy" },
            { extend: "csv", text: "CSV" },
            { extend: "excel", text: "Excel" },
            { extend: "pdf", text: "PDF" },
            { extend: "print", text: "Print" },
            { extend: "colvis", text: "Columns" },
        ],
        responsive: true,
    });
});

$("#table-2").dataTable({
    columnDefs: [{ sortable: false, targets: [0, 2, 3] }],
});
