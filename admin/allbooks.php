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
                    <div class="ml-md-auto py-2 py-md-0">

                        <button class="btn btn-primary btn-round ml-auto" data-toggle="modal" data-target="#addNewBook">
                            <i class="fa fa-plus"></i>
                            New Book
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
                                <div class="modal fade" id="addNewEvent" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header no-bd">
                                                <h5 class="modal-title">
                                                    <span class="fw-mediumbold">
                                                        New</span>
                                                    <span class="fw-light">
                                                        Event
                                                    </span>
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p class="small">Create a new event with full</p>
                                                <form>
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <div class="form-group form-group-default">
                                                                <label>Name</label>
                                                                <input id="addName" type="text" class="form-control" placeholder="fill name">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 pr-0">
                                                            <div class="form-group form-group-default">
                                                                <label>Position</label>
                                                                <input id="addPosition" type="text" class="form-control" placeholder="fill position">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group form-group-default">
                                                                <label>Office</label>
                                                                <input id="addOffice" type="text" class="form-control" placeholder="fill office">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="modal-footer no-bd">
                                                <button type="button" id="addRowButton" class="btn btn-primary">Add</button>
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

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
                                    <table id="all_books_table"  class="display nowrapr" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Icon</th>
                                                <th>Title</th>
                                                <th>Availble</th>
                                                <th>Taken</th>
                                                <th>Authors</th>
                                                <th>Languages</th>
                                                <th>Category</th>
                                                <th>Class/Age</th>
                                                <th>Availability</th>
                                                <th style="width: 10%">Action</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>Icon</th>
                                                <th>Title</th>
                                                <th>Availble</th>
                                                <th>Taken</th>
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
<script src="../assets/js/plugin/datatables/datatables.min.js"></script>
<script src="../assets/js/plugin/datatables/dataTables.buttons.min.js"></script>
<script src="../assets/js/plugin/datatables/jszip.min.js"></script>
<script src="../assets/js/plugin/datatables/pdfmake.min.js"></script>
<script src="../assets/js/plugin/datatables/vfs_fonts.js"></script>
<script src="../assets/js/plugin/datatables/buttons.html5.min.js"></script>
<script src="../assets/js/plugin/datatables/buttons.print.min.js"></script>


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
</div>

<!-- ends update single book  -->

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header no-bd">
                <h5 class="modal-title">
                    <span class="fw-mediumbold">
                        Update</span>
                    <span class="fw-light">
                        Book returned
                    </span>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="updateBookSform">
                <center>
                    <div class="spinner-border text-primary" role="status" id="updateBSloader" style="display: none;">
                        <span class="sr-only">Loading...</span>
                    </div>
                </center>
                <div class="row">

                    <div class="col-md-12 pr-0">
                        <div class="row">
                            <div class="col-md-8 pr-0">
                                <div class="form-group ">
                                    <label>Search people by phone...</label>
                                    <input id="searchPhonetxt" type="text" class="form-control" placeholder="Enter phone number">
                                    <span id="userphoneValidSh" style="color:red; display:none;">Enter user phone number please</span>
                                </div>
                            </div>
                            <div class="col-md-4 pr-0">
                                <div class="form-group ">
                                    <button type="button" id="searchCustomer" style="margin-top: 30px;" class="btn btn-icon btn-round btn-primary">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <input id="bookIdNow" type="text" class="form-control" hidden readonly>

                    </div>
                    <div class="col-md-12 pr-0" id="userPhoneNumber" style=" display:none;">
                        <div class="form-group ">
                            <label> Number of book returned</label>
                            <input id="booksBorrowedNm" type="number" class="form-control" placeholder=" number">
                        </div>
                    </div>
                    <br>
                    <div class="col-md-12 pr-0">
                        <hr>

                        <div class="col-md-12 pr-0" id="responseToUpdate">

                        </div>
                    </div>

                    <div class="col-md-12 pr-0">
                        <div class="form-group ">
                            <input id="updateBookSTS" class="btn btn-primary" type="submit" value="save changes">
                        </div>
                    </div>
                </div>
                <center>
                    <div class="spinner-border text-primary" role="status" id="loadupdateBSloader" style="display:none;">
                        <span class="sr-only">Loading...</span>
                    </div>
                </center>
            </div>
        </div>
    </div>
</div>
</div>

<script>
    $('#all_books_table').DataTable({
    dom: 'Blfrtip',
    buttons: [
      {
        extend: 'pdf',
        footer: false,
        exportOptions: {
          columns: [1, 2, 3, 4, 5, 6, 7, 8]
        }
      },
      {
        extend: 'csv',
        footer: false,
        exportOptions: {
          columns: [1, 2, 3, 4, 5, 6, 7, 8]
        }

      },
      {
        extend: 'excel',
        footer: false,
        exportOptions: {
          columns: [1, 2, 3, 4, 5, 6, 7, 8]
        }
      }
    ]
  });
</script>