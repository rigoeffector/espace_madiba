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
                        <h5 class="text-white op-7 mb-2">Espace Madiba Panel/All Users</h5>
                    </div>
                    <!-- <div class="ml-md-auto py-2 py-md-0">

                        <button class="btn btn-primary btn-round ml-auto" data-toggle="modal" data-target="#addNewBook">
                            <i class="fa fa-plus"></i>
                            New Book
                    </div> -->
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
                                    <h4 class="card-title">Registered Users History</h4>

                                </div>
                            </div>
                            <div class="card-body">
                             

                                <center>
                                    <div class="spinner-border text-primary" role="status" id="loaderUser" style="display: block;">
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                </center>

                                <div class="table-responsive">
                                    <table id="all_users_table"  class="display nowrapr" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Fname</th>
                                                <th>Lname</th>
                                                <th>Address</th>
                                                <th>Phone</th>
                                                <th>Fees</th>
                                                <th>Paid membership</th>
                                                <th>User Class</th>
                                                <th>Email</th>
                                                <th>Age</th>
                                               
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>Fname</th>
                                                <th>Lname</th>
                                                <th>Address</th>
                                                <th>Phone</th>
                                                <th>Fees</th>
                                                
                                                <th>Paid membership</th>
                                                <th>User Class</th>
                                                <th>Email</th>
                                                <th>Age</th>
                                                
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

