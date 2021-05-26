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
						<a href="#">Books</a>
					</li>
				</ul>
			</div>
			<div class="row">


				<div class="col-md-12">
					<div class="card">
						<div class="card-header">
							<div class="d-flex align-items-center">
								<h4 class="card-title">Book Category</h4>
								<button class="btn btn-primary btn-round ml-auto" data-toggle="modal" data-target="#addNewCategory">
									<i class="fa fa-plus"></i>
									New
								</button>

								<div class="spinner-border text-primary" role="status" id="loader" style="display: none;">
									<span class="sr-only">Loading...</span>
								</div>
							</div>
						</div>

						<div class="card-header">
							<div class="d-flex align-items-center">


								<!-- Modal -->
								<div class="modal fade" id="addNewCategory" tabindex="-1" role="dialog" aria-hidden="true">
									<div class="modal-dialog" role="document">
										<div class="modal-content">
											<div class="modal-header no-bd">
												<h5 class="modal-title">
													<span class="fw-mediumbold">
														New</span>
													<span class="fw-light">
														Category
													</span>
												</h5>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
											<div class="modal-body">
												<p class="small">Create a new Book Category</p>
												<form method="POST" enctype="multipart/form-data" id="my-form">
													<div class="row">
														<div class="col-sm-12">
															<div class="form-group form-floating-label">
																<input id="categoryTitle" type="text" class="form-control input-border-bottom" required>
																<label for="inputFloatingLabel" class="placeholder">Title</label>
															</div>
														</div>
														<div class="col-md-6 pr-0">
															<div class="form-group form-floating-label">
																<input id="categoryBookNumbers" type="number" class="form-control input-border-bottom" required>
																<label for="inputFloatingLabel" class="placeholder">Number of Books</label>
															</div>
														</div>
														<div class="col-md-6">
															<div class="form-group form-floating-label">
																<input id="categoryLang" type="text" class="form-control input-border-bottom" required>
																<label for="inputFloatingLabel" class="placeholder">Languages</label>
															</div>
														</div>
														<div class="col-md-6">
															<div class="form-group form-floating-label">
																<select class="form-control input-border-bottom" id="selectUserClass" required>
																	<option value="0">Select User Class</option>
																</select>
																<label for="selectFloatingLabel" class="placeholder">User Class</label>
															</div>
														</div>
														<div class="col-md-6">
															<div class="form-group form-floating-label">
																<input id="categoryIcon" type="file" class="form-control input-border-bottom" required>
																<label for="inputFloatingLabel" class="placeholder">Icon Image</label>
															</div>
														</div>
													</div>
											</div>
											<div class="modal-footer no-bd">
												<input id="addCategory" class="btn btn-primary" type="submit" value="Submit">
												<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
											</div>


											</form>
										</div>
										<div class="spinner-border text-primary" role="status">
											<span class="sr-only">Loading...</span>
										</div>
									</div>
								</div>
							</div>
							<div class="card-body">

								<div class="row" id="books_catgeory">
									<center>
										<div class="spinner-border text-primary" role="status" id="loader" style="display: none;">
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
<!-- Atlantis JS -->
<script src="../assets/js/atlantis.min.js"></script>
<!-- Atlantis DEMO methods, don't include it in your project! -->
<script src="../assets/js/setting-demo2.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<script src="js/main.js"></script>
</body>

</html>