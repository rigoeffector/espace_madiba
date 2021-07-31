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

			<div class="row">
				<div class="col-md-12">
					<div class="col-md-12">
						<div class="card">

							<div class="card-body">

								<div class="container">
									<div class="row">
										<div class="col-md-8">
											<h4>Admin Profile Information</h4>
											<div class="col-md-12">
												<!-- <div class="avatar-xl">
													<img src="<?php echo  $_SESSION['admin']; ?>" alt="..." class="avatar-img rounded-circle">
												</div> -->
											</div>

											<ul>
												<li>Role: <?php echo  $_SESSION['admin']; ?></li>
												<li>Username: <?php echo  $_SESSION['admin']; ?></li>
											</ul>

										</div>
										<div class="col-md-4">
											<h4>Update Admin Information</h4>
											<form method="POST" enctype="multipart/form-data" id="my-admin_update_info">
												<div class="col-md-12">
													<div class="form-group ">
														<input type="text" id="adminId" hidden value="<?php echo  $_SESSION['adminId']; ?>">
														<label for="inputFloatingLabel" class="placeholder">Profile Image</label>
														<input id="admin_profile" type="file" class="form-control input-border-bottom" required>

													</div>
												</div>
												<div class="col-md-12">
													<div class="form-group ">
														<label for="inputFloatingLabel" class="placeholder">Username</label>
														<input id="admin_username" type="text" class="form-control input-border-bottom" required>

													</div>
												</div>
												<div class="col-md-12">
													<div class="form-group ">
														<label for="inputFloatingLabel" class="placeholder">Password</label>
														<input id="admin_password" type="password" class="form-control input-border-bottom" required>

													</div>
												</div>
												<div class="col-md-12">
													<div class="form-group ">
														<label for="inputFloatingLabel" class="placeholder">Confirm Password</label>
														<input id="admin_Conf_password" type="password" class="form-control input-border-bottom" required>
														<span id="match-pswwd" style="color: red; display:none;">Passwords are not matching</span>
														<span id="matching-pswwd" style="color: green; display:none;">Passwords are matching</span>
													</div>
												</div>
												<div class="col-md-12">
													<div class="form-group ">
														<input id="updateAdmin" class="btn btn-primary" type="submit" value="Update">
													</div>
												</div>
											</form>

										</div>

									</div>
								</div>



								<center>
									<div class="spinner-border text-primary" role="status" id="updateAdminLoader" style="display:none;">
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
<div class="modal fade" id="addNewEventCat" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header no-bd">
				<h5 class="modal-title">
					<span class="fw-mediumbold">
						New</span>
					<span class="fw-light">
						Event Category
					</span>
				</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<p class="small">Create new event category</p>
				<form id="newUserCategoryForm">
					<div class="row">
						<div class="col-md-12 pr-0">
							<div class="form-group ">
								<label>Title</label>
								<input id="eventCatTitle" type="text" class="form-control" placeholder="fill title">
							</div>
						</div>


					</div>
					<div class="modal-footer no-bd">
						<input type="submit" id="addNewEventCat" class="btn btn-primary" value="Save">
						<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
					</div>

					<center>
						<div class="spinner-border text-primary" role="status" id="loaderNewEventCat" style="display:none;">
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



<!-- View Singlw Information -->


<div class="modal fade" id="singleEventInfo" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header no-bd">
				<h5 class="modal-title">
					<span class="fw-mediumbold">
						Event</span>
					<span class="fw-light">
						Information
					</span>
				</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<center>
					<div class="spinner-border text-primary" role="status" id="loaderSingleEvent" style="display: none;">
						<span class="sr-only">Loading...</span>
					</div>
				</center>
				<p class="small" id="titleEvent"></p>
				<div id="singleInfo"></div>

			</div>

		</div>
	</div>
</div>