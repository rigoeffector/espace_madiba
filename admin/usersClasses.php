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
                        <a href="#">Users</a>
                    </li>
                </ul>
            </div>
            <div class="row">


                <div class="col-md-12">
                    <div class="alert alert-warning" role="alert" id="warningInfoClassCategory" style="display: none;">
                        <p>No Data saved yet please? make sure you have saved user category before you <span style="
                  color: #6c757d;
     font-weight: 800;
      "> click on new class button to add new class</span></p>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Users class histroy</h4>

                        </div>
                        <div class="card-body">
                            <!-- <ul class="nav nav-pills nav-secondary nav-pills-no-bd" id="pills-tab-without-border" role="tablist">
                              
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-profile-tab-nobd" data-toggle="pill" href="#pills-user-class-nobd" role="tab" aria-controls="pills-profile-nobd" aria-selected="false">User Classes</a>
                                </li>

                            </ul> -->
                            <ul class="nav nav-pills nav-secondary nav-pills-no-bd" id="pills-tab-without-border" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="pills-user-category-tab-nobd" data-toggle="pill" href="#pills-user-class-nobd" role="tab" aria-controls="pills-profile-nobd" aria-selected="true">User Classes</a>
                                </li>


                            </ul>
                            <div class="tab-content mt-2 mb-3" id="pills-without-border-tabContent">

                                <div class="tab-pane fade show active" id="pills-user-class-nobd" role="tabpanel" aria-labelledby="pills-profile-tab-nobd">
                                    <div class="d-flex align-items-center">

                                        <button class="btn btn-primary btn-round ml-auto" data-toggle="modal" data-target="#addClass">
                                            <i class="fa fa-plus"></i>
                                            New class
                                        </button>

                                    </div>
                                    <div class="tab-pane fade show active" id="pills-user-class-nobd" role="tabpanel" aria-labelledby="pills-home-tab">
                                        <center>
                                            <div class="spinner-border text-primary" role="status" id="loaderUserClasses">
                                                <span class="sr-only">Loading...</span>
                                            </div>
                                        </center>
                                        <div class="row" id="all_user_classes" style="margin-top: 30px;;">
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
                            <div class="form-group form-group-default">
                                <label>Title</label>
                                <input id="userCatTitle" type="text" class="form-control" placeholder="fill title">
                            </div>
                        </div>
                        <div class="col-md-6 pr-0">
                            <div class="form-group form-group-default">
                                <label>Membership fees</label>
                                <input id="userCatMembershipFees" type="number" class="form-control" placeholder="fill membership">
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
                            <div class="form-group ">
                                <label>Title</label>
                                <input id="userClassTitle" type="text" class="form-control" placeholder="fill title">
                                <span id="userclassTitleValid" style="color: red; display:none;">Title shoudld not be empty</span>
                            </div>
                        </div>
                        <div class="col-md-6 pr-0">
                            <div class="form-group ">
                                <div class="form-group form-floating-label">
                                    <select class="form-control " id="selectUserCategory" required style="margin-top: 23px;">
                                        <option value="0">Select User Category</option>

                                    </select>
                                    <span id="usercategoryClassValid" style="color: red;display:none;">User category shoudld not be empty</span>
                                    <label for="selectFloatingLabel" class="placeholder">User Category</label>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 pr-0">
                            <div class="form-group ">
                                <label>Age Range</label>
                                <input id="userClassAge" type="text" class="form-control" placeholder="fill age">
                                <span id="userclassAgeRangeValid" style="color: red;display:none;">Age range shoudld not be empty</span>
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



<!-- Modal update user class -->
<div class="modal fade" id="editUserClass" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header no-bd">
                <h5 class="modal-title">
                    <span class="fw-mediumbold">
                        Update</span>
                    <span class="fw-light">
                        User Class
                    </span>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="small">Update User Class</p>
                <center>
                    <div class="spinner-border text-primary" role="status" id="loaderSingleUserClass" style="display: none;">
                        <span class="sr-only">Loading...</span>
                    </div>
                </center>
                <form id="updateUserClass">

                </form>
            </div>

        </div>
    </div>
</div>