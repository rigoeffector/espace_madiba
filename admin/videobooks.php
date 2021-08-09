<?php include './includes/header.php';  ?>




<!-- Sidebar -->
<?php include './includes/sidebar.php';  ?>
<!-- End Sidebar -->

<div class="main-panel">
    <div class="content">
        <div class="panel-header bg-primary-gradient">
            <div class="page-inner py-5">
                <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                    <div>
                        <h2 class="text-white pb-2 fw-bold">Dashboard/Video Books</h2>
                        <h5 class="text-white op-7 mb-2">Espace Madiba Panel</h5>
                    </div>
                    <div class="ml-md-auto py-2 py-md-0">

                        <a href="#" class="btn btn-secondary btn-round" data-toggle="modal" data-target="#addNewVideo">New Video</a>
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
                                    <h4 class="card-title">Video Tutorials  History</h4>

                                </div>
                            </div>
                            <div class="card-body">

                                <center>
                                    <div class="spinner-border text-primary" role="status" id="viewVideoLoader" style="display: none;">
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                </center>
                                <center>
                                    <div class="spinner-border text-primary" role="status" id="loaderDeleteVideo" style="display: none;">
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                </center>
                                
                                <div class="alert alert-warning" role="alert" id="warningInfoEventsCat" style="display:none;">
                                    <p>No Data saved yet please? make sure you have saved event category before you <span style="
                  color: #6c757d;
     font-weight: 800;
      "> click on new button to add new event</span></p>
                                </div>
                                <div class="table-responsive">
                                    <table id="allVideoInfo" class="display table table-striped table-hover">
                                        <thead>
                                            <tr>

                                                <th>title</th>
                                                <th>User Class</th>
                                                <th>Summary </th>
                                                <th>Age range</th>
                                                <th>Video</th>

                                                <th style="width: 20%">Action</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>title</th>                                            
                                                <th>User Class</th>
                                                <th>Summary</th>
                                                <th>Age range</th>
                                                <th>Video</th>
                                                <th style="width: 20%">Action</th>
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

        // Add Row
        // $('#allEvents').DataTable({
        // 	"pageLength": 5,
        // });

        // var action = '<td> <div class="form-button-action"> <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task"> <i class="fa fa-edit"></i> </button> <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Remove"> <i class="fa fa-times"></i> </button> </div> </td>';

        // $('#addRowButton').click(function() {
        // 	$('#allEvents').dataTable().fnAddData([
        // 		$("#addName").val(),
        // 		$("#addPosition").val(),
        // 		$("#addOffice").val(),
        // 		action
        // 		]);
        // 	$('#addRowModal').modal('hide');

        // });
    });
</script>
</body>

</html>






<!-- Modal -->
<div class="modal fade" id="addNewVideo" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header no-bd">
                <h5 class="modal-title">
                    <span class="fw-mediumbold">
                        New</span>
                    <span class="fw-light">
                        Video Book
                    </span>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="small">Create new video</p>
                <form id="newVideoForm">
                    <div class="row">
                        <div class="col-md-12 pr-0">
                            <div class="form-group ">
                                <label>Title</label>
                                <input id="videoTitle" type="text" class="form-control" placeholder="fill title">
                            </div>
                        </div>
                        <!-- <div class="col-md-6 pr-0">
                            <div class="form-group ">
                                <label>Author</label>
                                <input id="videoAuthor" type="text" class="form-control" placeholder="fill author">
                            </div>
                        </div> -->
                        <div class="col-md-12 pr-0">
                            <div class="form-group ">
                                <label>Video File</label>
                                <input id="videoFile" type="file" class="form-control" placeholder="fill author">
                            </div>
                        </div>



                        <div class="col-md-12 pr-0">

                            <div class="form-group ">
                                <label for="selectFloatingLabel" class="placeholder">This video is for ?</label>
                                <select class="form-control input-border-bottom" id="selectUserClass" required>
                                    <option value="0">Select User Class</option>
                                </select>

                            </div>

                        </div>
                        <!-- <div class="col-md-12 pr-0">

                            <div class="form-group ">
                                <label for="selectFloatingLabel" class="placeholder">User Category</label>
                                <select class="form-control input-border-bottom" id="selectUserCategory" required>
                                    <option value="0">Select User Category</option>
                                </select>

                            </div>

                        </div> -->
                        <!-- <div class="col-md-12 pr-0">

                            <div class="form-group ">
                                <label for="selectFloatingLabel" class="placeholder">Book Category</label>
                                <select class="form-control input-border-bottom" id="selectBookCategory" required>
                                    <option value="0">Select Book Category</option>
                                </select>

                            </div>

                        </div> -->

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="comment">Summary</label>
                                <textarea class="form-control" id="summaryVideo" rows="5">

							</textarea>
                            </div>
                        </div>


                    </div>
                    <div class="modal-footer no-bd">
                        <input type="submit" id="addNewVideo" class="btn btn-primary" value="Save">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>

                    <center>
                        <div class="spinner-border text-primary" role="status" id="loaderVideo" style="display:none;">
                            <span class="sr-only">Loading...</span>
                        </div>
                    </center>

                </form>
            </div>

        </div>
    </div>
</div>


