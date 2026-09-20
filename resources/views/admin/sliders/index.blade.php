@extends('admin.layouts.master')

@section('content')
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <title>All Slider List</title>

        <!-- Styles -->
        <link rel="stylesheet" href="backend/assets/modules/datatables/datatables.min.css">
        <link rel="stylesheet" href="backend/assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">
    </head>

    <body>

        <section class="section">
            <div class="section-header">
                <h1 class="text-capitalize">slider</h1>
            </div>

            <div class="section-body">
                <div class="row mt-sm-4">
                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="card card-danger">

                            <div class="card-header d-flex items-center justify-content-between">
                                <h4 class="text-capitalize">list of sliders</h4>
                                <a href="#" class="btn btn-primary text-capitalize">
                                    <i class="far fa-check-circle"></i> create slider
                                </a>
                            </div>

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped w-full" id="table-1" style="width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Title</th>
                                                <th>Heading</th>
                                                <th>Offer</th>
                                                <th>Background Image</th>
                                                <th>Image</th>
                                                <th>Status</th>
                                                <th style="width: 20%">Action</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <!-- Example static row (replace with real data) -->
                                            <tr>
                                                <td>1</td>
                                                <td>Sample Title</td>
                                                <td>Sample Heading</td>
                                                <td>50% OFF</td>
                                                <td>
                                                    <img src="path/to/bg_image.jpg" width="35" height="35"
                                                        title="bg image">
                                                </td>
                                                <td>
                                                    <img src="path/to/image.jpg" width="35" height="35"
                                                        title="image">
                                                </td>
                                                <td>
                                                    <div class="badge badge-success">Active</div>
                                                </td>
                                                <td>
                                                    <a href="#" class="btn btn-dark" title="deactive">
                                                        <i class="fas fa-arrow-down"></i>
                                                    </a>

                                                    <a href="#" class="btn btn-primary">
                                                        <i class="fas fa-eye"></i>
                                                    </a>

                                                    <a href="#" class="btn btn-warning">
                                                        <i class="fas fa-edit"></i>
                                                    </a>

                                                    <button class="btn btn-danger delete_btn">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </td>
                                            </tr>

                                            <!-- Duplicate rows as needed -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Scripts -->
        <script src="backend/assets/modules/datatables/datatables.min.js"></script>
        <script src="backend/assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
        <script src="backend/assets/modules/datatables/Select-1.2.4/js/dataTables.select.min.js"></script>
        <script src="backend/assets/js/page/modules-datatables.js"></script>
        <script src="backend/assets/modules/sweetalert/sweetalert.min.js"></script>
        <script src="backend/assets/js/page/modules-sweetalert.js"></script>

        <script>
            // delete data by sweet alert
            document.addEventListener("DOMContentLoaded", function() {
                document.querySelectorAll(".delete_btn").forEach(function(btn) {
                    btn.addEventListener("click", function(e) {
                        e.preventDefault();

                        swal({
                            title: "Are you sure?",
                            text: "Once deleted, you will not be able to recover this file!",
                            icon: "warning",
                            buttons: true,
                            dangerMode: true,
                        }).then((willDelete) => {
                            if (willDelete) {
                                swal("Deleted!", {
                                    icon: "success"
                                });
                            } else {
                                swal("Your file is safe!");
                            }
                        });
                    });
                });
            });
        </script>

    </body>

    </html>
@endsection
