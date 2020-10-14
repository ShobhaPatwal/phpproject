<?php include('header.php'); ?>
    <?php include('sidebar.php'); ?>
		
		<div id="main-content"> <!-- Main Content Section with everything -->
			
			<noscript> <!-- Show a notification if the user has disabled javascript -->
				<div class="notification error png_bg">
					<div>
						Javascript is disabled or is not supported by your browser. Please <a href="http://browsehappy.com/" title="Upgrade to a better browser">upgrade</a> your browser or <a href="http://www.google.com/support/bin/answer.py?answer=23852" title="Enable Javascript in your browser">enable</a> Javascript to navigate the interface properly.
					</div>
				</div>
			</noscript>
			
			<!-- Page Head -->
			<h2>Manage Categories</h2>
			<p id="page-intro">What would you like to do?</p>
			
			<div class="clear"></div> <!-- End .clear -->
			
			<div class="content-box"><!-- Start Content Box -->
				
				<div class="content-box-header">
					
					<h3>Categories</h3>
					
					<ul class="content-box-tabs">
						<li><a href="#tab1" class="default-tab">Manage</a></li> <!-- href must be unique and match the id of target div -->
						<li><a href="#tab2">Add</a></li>
					</ul>
					
					<div class="clear"></div>
					
				</div> <!-- End .content-box-header -->
				
				<div class="content-box-content">
					
					<div class="tab-content default-tab" id="tab1"> <!-- This is the target div. id must match the href of this div's tab -->
						
						<div class="notification attention png_bg">
							<a href="#" class="close"><img src="resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
							<div>
								This is a Content Box. You can put whatever you want in it. By the way, you can close this notification with the top-right cross.
							</div>
						</div>
						<table>
							<thead>
								<tr>
									<th><input class="check-all" type="checkbox"></th>
									<th>Category Id</th>
									<th>Category Name</th>
									<th>Action</th>
								</tr>							
							</thead>
												
							<tfoot>
								<tr>
									<td colspan="6">
										<div class="bulk-actions align-left">
											<select name="dropdown">
												<option value="option1">Choose an action...</option>
												<option value="option2">Edit</option>
												<option value="option3">Delete</option>
											</select>
											<a class="button" href="#">Apply to selected</a>
										</div>
																		
										<div class="pagination">
											<a href="#" title="First Page">« First</a><a href="#" title="Previous Page">« Previous</a>
											<a href="#" class="number" title="1">1</a>
											<a href="#" class="number" title="2">2</a>
											<a href="#" class="number current" title="3">3</a>
											<a href="#" class="number" title="4">4</a>
											<a href="#" title="Next Page">Next »</a><a href="#" title="Last Page">Last »</a>
										</div> <!-- End .pagination -->
										<div class="clear"></div>
									</td>
								</tr>
							</tfoot>
												
							<tbody>
								<?php
								$sql1 = "SELECT * FROM categories";
								$result = $conn->query($sql1);
								if ($result->num_rows > 0) {
									// output data of each row
									while ($row = $result->fetch_assoc()) {
								?>

								<tr class="alt-row">
									<td><input type="checkbox"></td>
									<td><?php echo $row['id'];?></td>
									<td><?php echo $row['name'];?></td>
									<td>
										<!-- Icons -->
										<a href="#" title="Edit"><img src="resources/images/icons/pencil.png" alt="Edit"></a>
										<a href="#" title="Delete"><img src="resources/images/icons/cross.png" alt="Delete"></a> 
										<a href="#" title="Edit Meta"><img src="resources/images/icons/hammer_screwdriver.png" alt="Edit Meta"></a>
									</td>
								</tr>
										
								<?php
									}
								} 
								?>
							</tbody>
													
                        </table>
                    
						
					</div> <!-- End #tab1 -->
					
					<div class="tab-content" id="tab2">
						<!-- Start Notifications 
						<div class="notification success png_bg">
							<a href="#" class="close"><img src="resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
							<div>
								Category is added.
							</div>
						</div>
						 End Notifications -->
						<form id="addCategory">
							
							<fieldset> <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
								
								<p>
									<label>Category Name</label>
									<input class="text-input small-input" type="text" id="category" name="category" required/> 
								</p>
							
								<p>
									<input class="button" type="submit" value="Submit" />
								</p>
								
							</fieldset>
							
							<div class="clear"></div><!-- End .clear -->
							
						</form>

           

						
					</div> <!-- End #tab2 -->  
					
				</div> <!-- End .content-box-content -->
				
			</div> <!-- End .content-box -->
			
			<div class="clear"></div>
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
			<script>
				$(document).ready(function(){
					$("#addCategory").on("submit", function(event){
						event.preventDefault();
						var categoryName = $("#category").val();
						console.log(categoryName);
						$.ajax({
							method: "POST",
							url: "addCategory.php",
							data: { categoryName: categoryName }
						})
						.done(function( msg ) {
							$("#tab2").html(msg);
						});
					});
				});
			</script>
			

			
			<?php include('footer.php'); ?>
