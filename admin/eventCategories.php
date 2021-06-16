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
						<a href="#" class="btn btn-white btn-border btn-round mr-2" data-toggle="modal" data-target="#addNewEvent"> New Event</a>
						<a href="#" class="btn btn-secondary btn-round"data-toggle="modal" data-target="#addNewEventCat">New Category</a>
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
									<h4 class="card-title">Events History</h4>
									<button class="btn btn-primary btn-round ml-auto" data-toggle="modal" data-target="#addNewEvent">
										<i class="fa fa-plus"></i>
										New
									</button>
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
												<p class="small">Create a new event information</p>
												<form enctype="multipart/form-data" id="my-form-event">
													<div class="row">
														<div class="col-sm-12">
															<div class="form-group ">
																<label>title</label>
																<input id="evTitle" type="text" class="form-control" placeholder="fill title">
															</div>
														</div>
														<div class="col-md-6 pr-0">
															<div class="form-group ">
																<label>Event Category</label>
																<select class="form-control" id="evCategory">
																	<option value="0">Select Category</option>
																</select>

															</div>
														</div>
														<div class="col-md-6">
															<div class="form-group ">
																<label>location</label>
																<input id="eveLocation" type="text" class="form-control" placeholder="fill location">
															</div>
														</div>
														<div class="col-md-6 pr-0">
															<div class="form-group ">
																<label>Time</label>
																<input id="evTime" type="text" class="form-control" placeholder="fill time">
															</div>
														</div>
														<div class="col-md-6">
															<div class="form-group ">
																<label>Date</label>
																<input id="eveDate" type="date" class="form-control" placeholder="fill date">
															</div>
														</div>
														<div class="col-md-6 pr-0">
															<div class="form-group ">
																<label>Is Free</label>
																<select class="form-control" id="evFree">
																	<option value="0">No</option>
																	<option value="0">Yes</option>
																</select>

															</div>
														</div>


														<div class="col-md-6">
															<div class="form-group ">
																<label>Price</label>
																<input id="evePrice" type="number" class="form-control" placeholder="fill price">
															</div>
														</div>
														<div class="col-md-6">
															<div class="form-group ">
																<label>Available Places</label>
																<input id="eveAvailable_places" type="number" class="form-control" placeholder="fill places">
															</div>
														</div>
														<div class="col-md-6">
															<div class="form-group ">
																<label>Caption Image</label>
																<input id="evIcon" type="file" class="form-control" placeholder="fill places">
															</div>
														</div>
														<div class="col-md-6">
															<div class="form-group ">
																<label>Description</label>
																<textarea name="" id="evdescription" cols="40" rows="10"></textarea>
															</div>
														</div>
													</div>
												</form>
											</div>
											<div class="modal-footer no-bd">
												<button type="button" id="addNewEvent" class="btn btn-primary">Add</button>
												<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
												<center>
													<div class="spinner-border text-primary" role="status" id="loaderAllEvents">
														<span class="sr-only">Loading...</span>
													</div>
												</center>
											</div>
										</div>
									</div>
								</div>

								<center>
									<div class="spinner-border text-primary" role="status" id="loaderAllEvents" style="display: none;">
										<span class="sr-only">Loading...</span>
									</div>
								</center>

								<div class="table-responsive">
									<table id="allEvents" class="display table table-striped table-hover">
										<thead>
											<tr>
												<th>image</th>
												<th>title</th>
												<th>description</th>
												<th>location</th>
												<th>time</th>
												<th>date</th>
												<th>price</th>
												<th>available places</th>
												<th style="width: 20%">Action</th>
											</tr>
										</thead>
										<tfoot>
											<tr>
												<th>image</th>
												<th>title</th>
												<th>description</th>
												<th>location</th>
												<th>time</th>
												<th>date</th>
												<th>price</th>
												<th>available places</th>
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