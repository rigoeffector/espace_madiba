<?php include './includes/header.php';  ?>




<!-- Sidebar -->
<?php include './includes/sidebar.php';  ?>
<!-- End Sidebar -->

<div class="main-panel">
    <div class="content">
        <div class="panel-header bg-secondary-gradient">
            <div class="page-inner py-5">
                <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                    <div>
                        <h2 class="text-white pb-2 fw-bold">Dashboard</h2>
                        <h5 class="text-white op-7 mb-2">Espace Madiba Panel/All Books</h5>
                    </div>
                   
                </div>
            </div>
        </div>
        <div class="page-inner mt--5">

            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex align-items-center">
                                    <h4 class="card-title">Books History</h4>

                                </div>
                            </div>
                            <div class="card-body">
                                <!-- Modal -->
                             

                                <center>
                                    <div class="spinner-border text-primary" role="status" id="loaderAllBooks" style="display: none;">
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                </center>
                                <center>
                                    <div class="spinner-border text-primary" role="status" id="delSingleBook" style="display: none;">
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                </center>

                                <div class="table-responsive">
                                    <table id="all_books_by_cat_table" class="display table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th>Icon</th>
                                                <th>Title</th>
                                                <th>Numbers</th>
                                                <th>Authors</th>
                                                <th>Languages</th>
                                                <th>Category</th>
                                                <th>Class/Age</th>
                                                <th>Availability</th>
                                       
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>Icon</th>
                                                <th>Title</th>
                                                <th>Numbers</th>
                                                <th>Authors</th>
                                                <th>Languages</th>
                                                <th>Category</th>
                                                <th>Class/Age</th>
                                                <th>Availability</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>




        </div>
    </div>
    <?php include './includes/footer.php';  ?>
</div>

</div>
<!--   Core JS Files   -->
<script src="../assets/js/core/jquery.3.2.1.min.js"></script>
<script src="../assets/js/core/popper.min.js"></script>
<script src="../assets/js/core/bootstrap.min.js"></script>
<!-- jQuery UI -->
<script src="../assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
<script src="../assets/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>

<!-- jQuery Scrollbar -->
<script src="../assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
<!-- Datatables -->
<script src="../assets/js/plugin/datatables/datatables.min.js"></script>
<!-- Atlantis JS -->
<script src="../assets/js/atlantis.min.js"></script>
<!-- Atlantis DEMO methods, don't include it in your project! -->
<script src="../assets/js/setting-demo2.js"></script>
<script src="js/main.js"></script>
<script>
    $(document).ready(function() {
        $('#basic-datatables').DataTable({});

        $('#multi-filter-select').DataTable({
            "pageLength": 5,
            initComplete: function() {
                this.api().columns().every(function() {
                    var column = this;
                    var select = $('<select class="form-control"><option value=""></option></select>')
                        .appendTo($(column.footer()).empty())
                        .on('change', function() {
                            var val = $.fn.dataTable.util.escapeRegex(
                                $(this).val()
                            );

                            column
                                .search(val ? '^' + val + '$' : '', true, false)
                                .draw();
                        });

                    column.data().unique().sort().each(function(d, j) {
                        select.append('<option value="' + d + '">' + d + '</option>')
                    });
                });
            }
        });

        // // Add Row
        // $('#all_books_table').DataTable({
        //     "pageLength": 5,
        // });



        var action = '<td> <div class="form-button-action"> <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task"> <i class="fa fa-edit"></i> </button> <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Remove"> <i class="fa fa-times"></i> </button> </div> </td>';

        $('#addRowButton').click(function() {
            $('#all_books_table').dataTable().fnAddData([
                $("#addName").val(),
                $("#addPosition").val(),
                $("#addOffice").val(),
                action
            ]);
            $('#addRowModal').modal('hide');

        });
    });
</script>
</body>

</html>


<!-- Modal create Book -->
<div class="modal fade" id="addNewBook" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header no-bd">
                <h5 class="modal-title">
                    <span class="fw-mediumbold">
                        New</span>
                    <span class="fw-light">
                        Book
                    </span>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="small">Create a new Book </p>
                <form method="POST" enctype="multipart/form-data" id="my-form-add-book">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group ">
                                <label for="inputFloatingLabel" class="placeholder">Title</label>
                                <input id="bookTitle" type="text" class="form-control input-border-bottom" required>

                            </div>
                        </div>
                        <div class="col-md-6 pr-0">
                            <div class="form-group ">
                                <label for="inputFloatingLabel" class="placeholder">Number of Books</label>
                                <input id="bookNumbers" type="number" class="form-control input-border-bottom" required>

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group ">
                                <label for="inputFloatingLabel" class="placeholder">Authors</label>
                                <input id="authors" type="text" class="form-control input-border-bottom" required>

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group ">
                                <label for="inputFloatingLabel" class="placeholder">Icon Image</label>
                                <input id="bookIcon" type="file" class="form-control input-border-bottom" required>

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group ">
                                <label for="selectFloatingLabel" class="placeholder">User Class</label>
                                <select class="form-control input-border-bottom" id="selectUserClass" required>
                                    <option value="0">Select User Class</option>
                                </select>

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group ">
                                <label for="selectFloatingLabel" class="placeholder">Book Category</label>
                                <select class="form-control input-border-bottom" id="selectBookCategory" required>
                                    <option value="0">Select Book Category</option>
                                </select>

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group ">
                                <label for="inputFloatingLabel" class="placeholder">Languages</label>
                                <input id="bookLang" type="text" class="form-control input-border-bottom" required>

                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="comment">Summary</label>
                                <textarea class="form-control" id="summary" rows="5">

							</textarea>
                            </div>
                        </div>


                    </div>
            </div>
            <div class="modal-footer no-bd">
                <input id="addBook" class="btn btn-primary" type="submit" value="Add">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
            <center>
                <div class="spinner-border text-primary" role="status" id="loaderAddBook" style="display: none;">
                    <span class="sr-only">Loading...</span>
                </div>
            </center>

            </form>
        </div>

    </div>
</div>



<!-- Modal view single  Book -->
<div class="modal fade" id="viewSingleBook" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header no-bd">
                <h5 class="modal-title">
                    <span class="fw-mediumbold">
                        Book</span>
                    <span class="fw-light">
                        Details
                    </span>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="small" id="book_title"> </p>
                <div id="book_detail_div">

                </div>
            </div>

        </div>
    </div>
</div>

<!-- update single book  -->

<div class="modal fade" id="updateSingleBook" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header no-bd">
                <h5 class="modal-title">
                    <span class="fw-mediumbold">
                        Update</span>
                    <span class="fw-light">
                        Book
                    </span>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="small">Update Book </p>
                <form method="POST" enctype="multipart/form-data" id="my-form-update-book">
                    <center>
                        <div class="spinner-border text-primary" role="status" id="loadersingleBookInfoForm" style="display: none;">
                            <span class="sr-only">Loading...</span>\n' +
                        </div>
                    </center>
                </form>
            </div>

        </div>
    </div>


    <!-- ends update single book  -->