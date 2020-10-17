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
			<h2>Manage Orders</h2>
			<p id="page-intro">What would you like to do?</p>
			
			<div class="clear"></div> <!-- End .clear -->
			
			<div class="content-box"><!-- Start Content Box -->
				
				<div class="content-box-header">
					
					<h3>Orders</h3>
					<div class="clear"></div>
					
				</div> <!-- End .content-box-header -->
				
				<div class="content-box-content">
					
					<div class="tab-content default-tab" id="tab1"> <!-- This is the target div. id must match the href of this div's tab -->
					    <?php if(isset($_SESSION['error'])) : ?>
						<!-- Start Notifications-->
						<div class="notification error png_bg">
							<a href="#" class="close"><img src="resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
							<div>
							<?php echo $_SESSION['error']; 
								unset($_SESSION['error']); ?>
							</div>
						</div>
						<?php endif; ?> 
						<?php if(isset($_SESSION['message'])) : ?>
						<div class="notification success png_bg">
							<a href="#" class="close"><img src="resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
							<div>
								<?php echo $_SESSION['message']; 
								unset($_SESSION['message']); ?>
							</div>
						</div>
						<?php endif; ?> 
						<!-- End Notifications -->
						<form action="deleteOrder.php" method="POST">
							<table>
								<thead>
									<tr>
										<th><input class="check-all" type="checkbox" /></th>
										<th>Order Id</th>
										<th>Total Price</th>
										<th>Status</th>
										<th>Date Time</th>
										<th>Action</th>
									</tr>							
								</thead>
													
								<tfoot>
									<tr>
										<td colspan="6">
											<div class="bulk-actions align-left">
												<select name="dropdown">
													<option value="option1">Choose an action...</option>
													<option value="option2">Delete</option>
												</select>
												<input class="button" name="delete" type="submit" value="Apply to selected">
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
								$sql = "SELECT * FROM orders";
								$result = $conn->query($sql);
								if ($result->num_rows > 0) {
									// output data of each row
									while ($row = $result->fetch_assoc()) {
								?>

								<tr class="alt-row">
								    <td><input type="checkbox" name="checkbox[]" id="checkbox[]" value="<?php echo $row['id']; ?>"></td>
									<td><?php echo $row['id'];?></td>
									<td>$<?php echo $row['total'];?></td>
									<td><?php echo $row['status'];?></td>
									<td><?php $datetime = new DateTime($row['datetime']);
									 echo $datetime->format('d-m-Y h:i:sA'); ?></td>
									<td>
										<!-- Icons -->
										<a href="viewOrder.php?order_id=<?php echo $row["id"]; ?>" title="View Order"><img src="resources/images/icons/paper_content_pencil_48.png" width="20px" height="20px" alt="View order"></a> 
										<a href="deleteOrder.php?action=remove&order_id=<?php echo $row["id"]; ?>" title="Delete"><img src="resources/images/icons/cross.png" alt="Delete"></a> 
									</td>
								</tr>
										
								<?php
									}
								} 
								?>

								</tbody>
														
							</table>
						</form>
						
					</div> <!-- End #tab1 --> 
					
				</div> <!-- End .content-box-content -->
				
			</div> <!-- End .content-box -->
			
			<div class="clear"></div>
			<?php include('footer.php'); ?>
