<?php include './includes/header.php'; ?>
<?php include './includes/sidebar.php'; ?>
<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Espace Madiba</h4>
                <ul class="breadcrumbs">
                    <li class="nav-home">
                        <a href="index.php">
                            <i class="flaticon-home"></i>
                        </a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>


                    <li class="nav-item">
                        <a href="#">Subscriptions</a>
                    </li>
                </ul>
            </div>
            <div class="row">


                <div class="col-md-12">
                    <div class="alert alert-warning" role="alert" id="warningInfoCategory" style="display: none;">
                        <p>No Data saved yet please? <span style="
                  color: #6c757d;
     font-weight: 800;
      "> click on new category button to save a new </span></p>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-left">
                                <h4 class="card-title">Subscriptions History</h4>
                            </div>
                            <div class="d-flex align-items-center">

                                <button class="btn btn-primary btn-round ml-auto" data-toggle="modal" data-target="#addNewEvent">
                                    <i class="fa fa-plus"></i>
                                    New Subscription
                                </button>
                            </div>

                        </div>
                        <div class="card-body">

                            <div class="tab-content mt-2 mb-3" id="pills-without-border-tabContent">
                                <div class="tab-pane fade show active" id="pills-user-category-nobd" role="tabpanel" aria-labelledby="pills-home-tab-nobd">


                                    <div class="tab-pane fade show active" id="pills-user-category-nobd" role="tabpanel" aria-labelledby="pills-home-tab">
                                        <div class="row" id="all_user_categories" style="margin-top: 30px;;">
                                            <center>
                                                <div class="spinner-border text-primary" role="status" id="loaderUserCategory" style="display: none;">
                                                    <span class="sr-only">Loading...</span>
                                                </div>
                                            </center>
                                        </div>
                                    </div>


                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <?php include './includes/footer.php'; ?>

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
<script src="../assets/js/plugin/datatables/datatables.min.js"></script>
<!-- Atlantis JS -->
<script src="../assets/js/atlantis.min.js"></script>
<!-- Atlantis DEMO methods, don't include it in your project! -->
<script src="../assets/js/setting-demo2.js"></script>

<script src="js/main.js"></script>
</body>

</html>


<!-- Modal -->
<div class="modal fade" id="addNewEvent" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header no-bd">
                <h5 class="modal-title">
                    <span class="fw-mediumbold">
                        New</span>
                    <span class="fw-light">
                        User Subscription
                    </span>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="small">Create new User Subscription</p>
                <form id="newUserCategoryForm">
                    <div class="row">
                        <div class="col-md-6 pr-0">
                            <div class="form-group ">
                                <label>Title</label>
                                <input id="userCatTitle" type="text" class="form-control" placeholder="fill title" required>
                                <span style="color: red;display:none;" id="subscriptionTitleValid">Title should not be empty</span>
                            </div>
                        </div>
                        <div class="col-md-6 pr-0">
                            <div class="form-group ">
                                <label>Membership fees</label>
                                <input id="userCatMembershipFees" type="number" class="form-control" placeholder="fill membership fees" required>
                                <span style="color: red; display:none;" id="subscriptionFeesValid">Fees should not be empty</span>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer no-bd">
                        <input type="submit" id="addNewUserCat" class="btn btn-primary" value="Save">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>

                    <center>
                        <div class="spinner-border text-primary" role="status" id="loaderAddUserCategory" style="display: none;">
                            <span class="sr-only">Loading...</span>
                        </div>
                    </center>

                </form>
            </div>

        </div>
    </div>
</div>


<!-- Modal Update User Category -->
<div class="modal fade" id="updateNewUserCat" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header no-bd">
                <h5 class="modal-title">
                    <span class="fw-mediumbold">
                        Update</span>
                    <span class="fw-light">
                        User Subscription
                    </span>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="small">Update User Subscription</p>
                <form id="updateUserCategoryForm">
                </form>
            </div>

        </div>
    </div>
</div>


<!-- Modal user class -->
<div class="modal fade" id="addClass" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header no-bd">
                <h5 class="modal-title">
                    <span class="fw-mediumbold">
                        New</span>
                    <span class="fw-light">
                        User Class
                    </span>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="small">Create new User Class</p>
                <form id="newUserClassForm">
                    <div class="row">
                        <div class="col-md-6 pr-0">
                            <div class="form-group form-group-default">
                                <label>Title</label>
                                <input id="userClassTitle" type="text" class="form-control" placeholder="fill title">
                            </div>
                        </div>
                        <div class="col-md-6 pr-0">
                            <div class="form-group form-group-default">
                                <div class="form-group form-floating-label">
                                    <select class="form-control input-border-bottom" id="selectUserCategory" required>
                                        <option value="0">Select User Category</option>

                                    </select>
                                    <label for="selectFloatingLabel" class="placeholder">User Category</label>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 pr-0">
                            <div class="form-group form-group-default">
                                <label>Age Range</label>
                                <input id="userClassAge" type="text" class="form-control" placeholder="fill age">
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer no-bd">
                        <input type="submit" id="addNewUserClassButton" class="btn btn-primary" value="Save">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                    <center>
                        <div class="spinner-border text-primary" role="status" id="loaderAddUserClass" style="display: none;">
                            <span class="sr-only">Loading...</span>
                        </div>
                    </center>
                </form>
            </div>

        </div>
    </div>
</div>