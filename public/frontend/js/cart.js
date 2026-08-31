// $(document).ready(function () {
//     //     // seet alert
//     const Toast = Swal.mixin({
//         toast: true,
//         position: "top-end",
//         customClass: {
//             popup: "colored-toast",
//         },
//         showConfirmButton: false,
//         timer: 3500,
//         timerProgressBar: true,
//     });

//     //     // seet alert end

//     $(document).on("submit", ".cart_form", function (e) {
//         e.preventDefault();
//         var formData = $(this).serialize();

//         $.ajax({
//             type: "POST",
//             url: route("add.to.cart"),
//             data: formData,
//             dataType: "json",
//             success: function (response) {
//                 // seet alert
//                 Toast.fire({
//                     icon: "success",
//                     title: response,
//                 });
//                 // seet alert end
//             },
//         });
//     });
// });
