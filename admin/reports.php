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
                        <h2 class="text-white pb-2 fw-bold">Dashboard</h2>
                        <h5 class="text-white op-7 mb-2">Espace Madiba Panel</h5>
                    </div>

                </div>
            </div>
        </div>
        <div class="page-inner mt--5">



            <div class="row" style="display: block;">
                <div class="col-md-12">
                    <div class="card">

                        <div class="card-body">
                            <div>
                                <h2 class="text-black pb-2 fw-bold">Espace madiba</h2>
                                <h5 class="text-black op-7 mb-2">Borrowed Books Report</h5>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="container">
                            <center>
                                    <div class="spinner-border text-primary" role="status" id="loaderAllBooks" style="display: none;">
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                </center>
                                <div class="collapse" style="display: block;">
                                    <div class="table-responsive">
                                        <table id="all_books_table_history" class="display nowrapr" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>Book Profile</th>
                                                    <th>Names</th>
                                                    <th>Address</th>
                                                    <th>Phone</th>                                            
                                                    <th>Client Class</th>
                                                    <th>Book Title</th>
                                                    <th>Author</th>
                                                    <th>Book Status</th>
                                                    <th>Detail</th>
                                              

                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                <th>Book Profile</th>
                                                <th>Names</th>
                                                    <th>Address</th>
                                                    <th>Phone</th>                                            
                                                    <th>Client Class</th>
                                                    <th>Book Title</th>
                                                    <th>Author</th>
                                                    <th>Book Status</th>
                                                    <th>Detail</th>
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
    </div>
    <?php include './includes/footer.php';  ?>
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

<!-- Modal -->
<div class="modal fade" id="showDetailBorrowed" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header no-bd">
                <h5 class="modal-title">
                    <span class="fw-mediumbold">
                        Borrowed Book</span>
                    <span class="fw-light">
                        Detail
                    </span>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="singleInfoDetail">
                <center>
                    <div class="spinner-border text-primary" role="status" id="loaderSingleDetailBorrow" style="display: none;">
                        <span class="sr-only">Loading...</span>
                    </div>
                </center>
              
            </div>
        </div>
    </div>
</div>
</div>