<?php include('header.php');?>
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
			<h2>Welcome <?php echo $_SESSION['userdata']['username']; ?></h2>
			<p id="page-intro">What would you like to do?</p>
			
			<div class="clear"></div> <!-- End .clear -->
			
			<div class="content-box"><!-- Start Content Box -->
				
				<div class="content-box-header">
					
					<h3>Products</h3>
					
					<div class="clear"></div>
					
				</div> <!-- End .content-box-header -->
				
				<div class="content-box-content">
					
					<div class="tab-content default-tab" id="tab1"> <!-- This is the target div. id must match the href of this div's tab -->

						<table>
							
							<thead>
								<tr>
								   <th><input class="check-all" type="checkbox" /></th>
								   <th>Product Id</th>
								   <th>Product Name</th>
								   <th>Price</th>
								   <th>Category</th>
								   <th>Tags</th>
								   <th>Description</th>
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
											<a href="#" title="First Page">&laquo; First</a><a href="#" title="Previous Page">&laquo; Previous</a>
											<a href="#" class="number" title="1">1</a>
											<a href="#" class="number" title="2">2</a>
											<a href="#" class="number current" title="3">3</a>
											<a href="#" class="number" title="4">4</a>
											<a href="#" title="Next Page">Next &raquo;</a><a href="#" title="Last Page">Last &raquo;</a>
										</div> <!-- End .pagination -->
										<div class="clear"></div>
									</td>
								</tr>
							</tfoot>
						 
							<tbody>
							    <?php
								$sql = "SELECT * FROM products";
								$result = $conn->query($sql);
								if ($result->num_rows > 0) {
									// output data of each row
									while ($row = $result->fetch_assoc()) {
								?>
								<tr>
									<td><input type="checkbox" /></td>
									<td><?php echo $row['id'];?></td>
									<td class="product"><img src="images/<?php echo $row["image"]; ?>" class="cart-item-image" /><?php echo $row['name'];?></td>
									<td>$<?php echo $row['price'];?></td>
									<?php 
									$category_id = $row['category_id'];
									$query1 = "SELECT name FROM categories WHERE id='$category_id'";
									$result1 = $conn->query($query1) or die($conn->error);
									if ($row1 = $result1->fetch_assoc()) :  ?>
									<td><?php echo $row1['name'];
									endif;
									?></td>
									<?php 
									$query2 = "SELECT tag_id FROM tags_products WHERE product_id='" .$row["id"]. "'";
									$result2 = $conn->query($query2) or die($conn->error);  ?>
									<td>
									<?php 
									$tags = '';
									while ($row2 = $result2->fetch_assoc()) {  
										$query3 = "SELECT name FROM tags WHERE id='" .$row2["tag_id"]. "'";
										$result3 = $conn->query($query3) or die($conn->error);
										$row3 = $result3->fetch_assoc();  
										$tags .= $row3['name'] . ','; 
									}
									$tags = trim($tags, ',');    // remove trailing comma
                                    echo $tags;
									?>
									</td>
									<td><?php echo $row['description'];?></td>
								</tr>
								<?php
									}
								} 
								?>
							</tbody>
							
						</table>
						
					</div> <!-- End #tab1 -->
					
				</div> <!-- End .content-box-content -->
				
			</div> <!-- End .content-box -->
			
			<div class="clear"></div>
			
			<?php include('footer.php'); ?>
