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
                    <div class="ml-md-auto py-2 py-md-0">
                        <a href="#" class="btn btn-white btn-border btn-round mr-2">Add New Event</a>
                        <a href="#" class="btn btn-secondary btn-round">Add New Book</a>
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
                                <h5 class="text-black op-7 mb-2">Reports</h5>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="container">
                                <div class="collapse"  style="display: block;">
                                    <form class="navbar-left navbar-form nav-search mr-md-12" style="display: block; margin-bottom: 50px;">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <button type="submit" class="btn btn-search pr-1">
                                                    <i class="fa fa-search search-icon"></i>
                                                </button>
                                            </div>
                                            <input type="text" placeholder="Search any document ..." class="form-control">
                                            <br>
                                            <br>
                                        </div>
                                    </form>
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