<?php
	session_start();
?>
<?php include('../partials/header.php') ?>
<?php include('../partials/nav.php') ?>
	<div class="container">
		<br>
		<div class="row">
			<div class="col-5">
				<div class="row">
					<div class="col-12 text-left mt-4">
						<div class="card">
							<h6 class="card-header">Actions</h6>
							<div class="card-body">
								<div class="row">
									<div class="col-4"><button class='btn btn-primary upload_temp form-control'  type="button"><i class="fas fa-book-open"></i> Upload</button></div>
									<div class="col-4"><button class='btn btn-warning update_temp form-control'  type="button"><i class="fas fa-edit"></i> Update</button></div>
									<div class="col-4"><button class='btn btn-info compute_temp form-control'    type="button"><i class="fas fa-calculator"></i> Compute</button></div>
								</div>
							</div>
						</div>
					</div>

					<div class="col-12 mt-5">
						<div class="row text-center">
							<div class="col-lg-12">
								<h5 class='text-center'>Students OverAll Grades Results</h5>
								<small class='text-center'>(Tap to view)</small>
							</div>
							<div class="col-lg-12 mx-0">
								<img class="quarter_overall" data-toggle="tooltip" title="View Quarter 1 Summary" data-quarter='1' src="../assets/img/icons/cal1-hover.png" height="60" width="60" alt=""> 
								<img class="quarter_overall" data-toggle="tooltip" title="View Quarter 2 Summary" data-quarter='2' src="../assets/img/icons/cal2-hover.png" height="60" width="60" alt="">
								<img class="quarter_overall" data-toggle="tooltip" title="View Quarter 3 Summary" data-quarter='3' src="../assets/img/icons/cal3-hover.png" height="60" width="60" alt="">
								<img class="quarter_overall" data-toggle="tooltip" title="View Quarter 4 Summary" data-quarter='4' src="../assets/img/icons/cal4-hover.png" height="60" width="60" alt="">
							</div>
						</div>
					</div>

					
					

					<div class="col-12 mt-3">
						<?php 
							if(isset($_SESSION["error"])){
								?>
									<div class="alert alert-danger" role="alert">
										Error : <?php echo $_SESSION["error"]; ?>
									</div>
								<?php
								unset($_SESSION["error"]);
							}
							
							if(isset($_SESSION["success"])){
								?>
									<div class="alert alert-success" role="alert">
										<?php echo $_SESSION["success"]; ?>
									</div>
								<?php
								unset($_SESSION["success"]);
							}

							if(isset($_SESSION["success_compute"])){
								?>
									<div class="alert alert-info" role="alert">
										Averages : <br>
										<?php 
											$count = 0;
											foreach ($_SESSION["success_compute"] as $details) { 
												echo  ++$count . '. ' . $details['name'] . ' ' . number_format($details['f_grade'], 2) . '<br>' ; 
											}
										?>
									</div>
								<?php
								unset($_SESSION["success_compute"]);
							}

							if(isset($_SESSION["success_update"])){
								?>
									<div class="alert alert-warning" role="warning">
										<?php echo $_SESSION["success_update"]; ?>
									</div>
								<?php
								unset($_SESSION["success_update"]);
							}
						?>
					</div>

					
				</div>
			</div>

			<div class="col-7">

				<div class="employee_card text-center">
				<h5>User Records</h5>

					<div class="row">
						<?php
							// var_dump(($crud->getUsers()));
							if ($crud->getUsers() != false){ 
								foreach ($crud->getUsers() as $index => $student) {
									?>
										
										<div class="col-lg-4">
											<div class="card card_user my-2" style="width: 12rem;">
											<div class="del_user delete" data-id="<?php echo $student['id'] ?>">
											</div>
											
												<?php
													if(rand(1,2)==rand(1,2)) {
														?>
															<img class="img_card_custom" src="../assets/img/icons/malecasual.png" height="150" width="175" alt="Card image cap">
														<?php
													} else {
														?>
															<img class="img_card_custom" src="../assets/img/icons/femalecorp.PNG" height="150" width="175" alt="Card image cap">
														<?php
													}
												?>
												<div class="card-body">
													<p style="margin-top: -18px; margin-left:7px;"><strong><?php echo $student['full_name'] ?></strong></p>
													<h6 class="info_card text-center"><em>Quarter Grades:</em></h6>
													<div class="row text-center">
														<div class="col-lg-12 mx-0">
															<img class="quarter" data-toggle="tooltip" title="Tap to view Quarter 1 Grades" data-quarter='1' data-id="<?php echo $student['id'] ?>" src="../assets/img/icons/cal1.png" height="30" width="30" alt=""> 
															<img class="quarter" data-toggle="tooltip" title="Tap to view Quarter 2 Grades" data-quarter='2' data-id="<?php echo $student['id'] ?>" src="../assets/img/icons/cal2.png" height="30" width="30" alt="">
															<img class="quarter" data-toggle="tooltip" title="Tap to view Quarter 3 Grades" data-quarter='3' data-id="<?php echo $student['id'] ?>" src="../assets/img/icons/cal3.png" height="30" width="30" alt="">
															<img class="quarter" data-toggle="tooltip" title="Tap to view Quarter 4 Grades" data-quarter='4' data-id="<?php echo $student['id'] ?>" src="../assets/img/icons/cal4.png" height="30" width="30" alt="">
														</div>
													</div>
												</div>
											</div>
										</div>
									<?php 
								}
							} else {
								?>
									<div class="col-12">
										<div class="alert alert-dark" role="alert">
										No records found
										</div>
									</div>

								<?php
							}
						?>
					</div>
				</div>
			</div>
		</div>	
		
	</div>

	<div class="modal fade" id="quarter_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header text-center">
					<h5 id='quarter_middle'>Quarter </h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body text-left">
					<div id="result_container"></div>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="quarter_over_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header text-center">
					<h5 id='quarter_middle_overall'>Quarter </h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body text-left">
				<table class="table table-striped">
						<thead>
							<tr>
								<th scope="col">Name</th>
								<th scope="col">Year</th>
								<th scope="col">Homework Average Grade</th>
								<th scope="col">Test Average Grade</th>
								<th scope="col">Final Grade</th>
							</tr>
						</thead>
						<tbody id="result_summary_container">
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	
	<div class="modal fade" id="upload_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-sm" role="document">
			<div class="modal-content">
				<div class="modal-header text-center">
					<h5 id='quarter_middle'>Quarter </h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body text-left">
					<form action="../controller/upload_endpoint.php" method="post" enctype="multipart/form-data">
						<div class="form-group">
							<label for="exampleFormControlFile1">Select text file to upload: </label>
							<input type="file" name="fileToUpload" id="fileToUpload" required>
						</div>
	
						
						<div class="modal-footer">
							<input class='btn btn-primary'  type="submit" value="Proceed" name="upload">
							<input class='btn btn-secondary'  type="submit" value="Close" data-dismiss="modal" name="compute">
						</div>
					</form>	
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="update_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-sm" role="document">
			<div class="modal-content">
				<div class="modal-header text-center">
					<h5 id='quarter_middle'>Quarter </h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body text-left">
					<form action="../controller/update_endpoint.php" method="post" enctype="multipart/form-data">
						<div class="form-group">
							<label for="exampleFormControlFile1">Select text file to upload: </label>
							<input type="file" name="fileToUpload" id="fileToUpload" required>
						</div>
	
						
						<div class="modal-footer">
							<input class='btn btn-warning'  type="submit" value="Proceed" name="upload">
							<input class='btn btn-secondary'  type="submit" value="Close" data-dismiss="modal" name="compute">
						</div>
					</form>	
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="compute_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-sm" role="document">
			<div class="modal-content">
				<div class="modal-header text-center">
					<h5 id='quarter_middle'>Quarter </h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body text-left">
					<form action="../controller/compute_endpoint.php" method="post" enctype="multipart/form-data">
						<div class="form-group">
							<label for="exampleFormControlFile1">Select text file to upload: </label>
							<input type="file" name="fileToUpload" id="fileToUpload" required>
						</div>
	
						
						<div class="modal-footer">
							<input class='btn btn-info'  type="submit" value="Proceed" name="upload">
							<input class='btn btn-secondary'  type="submit" value="Close" data-dismiss="modal" name="compute">
						</div>
					</form>	
				</div>
			</div>
		</div>
	</div>

<?php include('../partials/footer.php') ?>



