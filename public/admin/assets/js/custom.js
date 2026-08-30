/**
 *
 * You can write your JS code here, DO NOT touch the default style file
 * because it will make it harder for you to update.
 *
 */

"use strict";

NProgress.start();
NProgress.configure({
    showSpinner: false,
    trickleSpeed: 200,
    speed: 500,
});
window.addEventListener("load", () => NProgress.done());

// dropify image preview plugin
// $(".dropify").dropify({
//     messages: {
//         default: "Drag and drop a file here or click",
//         replace: "Drag and drop or click to replace",
//         remove: "Remove",
//         error: "Ooops, something wrong happended.",
//     },
// });

// // delete data by sweet alert
// $(document).ready(function () {
//     $(document).on("click", ".delete_btn", function (e) {
//         e.preventDefault();
//         var form = $(this).closest("form");

//         swal({
//             title: "Are you sure?",
//             text: "Once deleted, you will not be able to recover this imaginary file!",
//             icon: "warning",
//             buttons: true,
//             dangerMode: true,
//         }).then((willDelete) => {
//             if (willDelete) {
//                 form.submit();
//                 swal("Poof! Your imaginary file has been deleted!", {
//                     icon: "success",
//                 });
//             } else {
//                 swal("Your imaginary file is safe!");
//             }
//         });
//     });
// });

// $(document).ready(function () {
//     $("#table-1").DataTable({
//         dom: "Bfrtip",
//         buttons: [
//             { extend: "copy", text: "Copy" },
//             { extend: "csv", text: "CSV" },
//             { extend: "excel", text: "Excel" },
//             { extend: "pdf", text: "PDF" },
//             { extend: "print", text: "Print" },
//             { extend: "colvis", text: "Columns" },
//         ],
//         responsive: true,
//     });
// });



