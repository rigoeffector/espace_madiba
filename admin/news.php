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

						<a href="#" class="btn btn-secondary btn-round" data-toggle="modal" data-target="#addNewEventCat">Post </a>
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
									<h4 class="card-title">News History</h4>

								</div>
							</div>
							<div class="card-body">

								<center>
									<div class="spinner-border text-primary" role="status" id="loaderdeNewsPOST" style="display: none;">
										<span class="sr-only">Loading...</span>
									</div>
								</center>
						
							
								<div class="table-responsive">
									<table id="allNewInfo" class="display table table-striped table-hover">
										<thead>
											<tr>

												<th>Caption</th>
												<th>title</th>
												<th>Summary</th>
												<th style="width: 20%">Action</th>
											</tr>
										</thead>
										<tfoot>
											<tr>
												<th>Caption</th>
												<th>title</th>
												<th>Summary</th>
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
						Post
					</span>
				</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<p class="small">Create new post</p>
				<form id="newPost">
					<div class="row">
						<div class="col-md-12 pr-0">
							<div class="form-group ">
								<label>Title</label>
								<input id="newsTtile" type="text" class="form-control" placeholder="fill title">
							</div>
						</div>
						<div class="col-md-12 pr-0">
                            <div class="form-group ">
                                <label>Caption</label>
                                <input id="newsCaption" type="file" class="form-control" placeholder="fill author">
                            </div>
                        </div>
						<div class="col-md-12 pr-0">
							<div class="form-group">
								<label for="exampleFormControlTextarea1">Description</label>
								<textarea class="form-control" id="newsDescription" rows="3"></textarea>
							</div>
						</div>


					</div>
					<div class="modal-footer no-bd">
						<input type="submit" id="addNewsInfo" class="btn btn-primary" value="Save">
						<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
					</div>

					<center>
						<div class="spinner-border text-primary" role="status" id="loaderNews" style="display:none;">
							<span class="sr-only">Loading...</span>
						</div>
					</center>

				</form>
			</div>

		</div>
	</div>
</div>


<!-- Modal Update User Category -->
<div class="modal fade" id="updateEventCat" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header no-bd">
				<h5 class="modal-title">
					<span class="fw-mediumbold">
						Update</span>
					<span class="fw-light">
						Event Category
					</span>
				</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<p class="small">Update Event Category</p>
				<form id="updateEventCategoryForm">
				</form>
			</div>

		</div>
	</div>
</div>