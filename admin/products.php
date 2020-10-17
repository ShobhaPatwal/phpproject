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
			<h2>Manage Products</h2>
			<p id="page-intro">What would you like to do?</p>
			
			<div class="clear"></div> <!-- End .clear -->
			
			<div class="content-box"><!-- Start Content Box -->
				
				<div class="content-box-header">
					
					<h3>Products</h3>
					
					<ul class="content-box-tabs">
						<li><a href="#tab1" class="default-tab">Manage</a></li> <!-- href must be unique and match the id of target div -->
						<li><a href="#tab2">Add</a></li>
					</ul>
					
					<div class="clear"></div>
					
				</div> <!-- End .content-box-header -->
				
				<div class="content-box-content">
					
					<div class="tab-content default-tab" id="tab1"> <!-- This is the target div. id must match the href of this div's tab -->
						
						<!-- Start Notifications-->
						<?php if(isset($_SESSION['error'])) : ?>
						<div class="notification error png_bg">
							<a href="#" class="close"><img src="resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
							<div>
								<?php echo $_SESSION['error']; 
								unset($_SESSION['error']); ?>
							</div>
						</div>
						<?php endif; ?> 
							
						<?php if(isset($_SESSION['success'])) : ?>
						<div class="notification success png_bg">
							<a href="#" class="close"><img src="resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
							<div>
								<?php echo $_SESSION['success']; 
								unset($_SESSION['success']); ?>
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
									<td><input type="checkbox" name="checkbox[]" id="checkbox[]" value="<?php echo $row['id']; ?>"></td>
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
									<td>
										<!-- Icons -->
										<a href="#" title="Edit"><img src="resources/images/icons/pencil.png" alt="Edit" /></a>
										<a href="deleteProduct.php?action=remove&product_id=<?php echo $row["id"]; ?>" title="Delete"><img src="resources/images/icons/cross.png" alt="Delete" /></a> 
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
					
						<form action="addProduct.php" method="POST"  enctype="multipart/form-data">
							
							<fieldset> <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->

								<p>
									<label>Name</label>
									<input class="text-input medium-input" type="text" id="name" name="name" required/> 
								</p>
								
								<p>
									<label>Price</label>
									<input class="text-input small-input" type="text" id="price" name="price" required/> 
							    </p>

								<p>
									<label>Image</label>
									<input class="text-input small-input" type="file" id="image" name="image" required/>
								</p>
															
								<p>
									<label>Category</label>              
									<select name="category" class="small-input" required>
									<?php
									$sql = "SELECT * FROM categories";
									$result = $conn->query($sql);
									if ($result->num_rows > 0) {
										// output data of each row
										while ($row = $result->fetch_assoc()) {
									?>
										<option value="<?php echo $row['id']; ?>"><?php echo ucfirst($row['name']); ?></option>
									<?php
										}
									} 
									?>
									</select> 
								</p>

								<p class="tags">
									<label>Tags</label>
									<?php
									$sql = "SELECT * FROM tags";
									$result = $conn->query($sql);
									if ($result->num_rows > 0) {
										// output data of each row
										while ($row = $result->fetch_assoc()) {
									?>
										<input type="checkbox" name=tags[] value="<?php echo $row['id']; ?>" required/> <?php echo ucfirst($row['name']); ?>
									<?php
										}
									} 
									?>
								</p>
								

								<p>
									<label>Quantity</label>
									<input class="text-input small-input" type="number" id="quantity" name="quantity" required/> 
								</p>
								
								<p class="colors">
									<label>Colors</label>
									<?php
									$sql1 = "SELECT * FROM color";
									$result1 = $conn->query($sql1);
									if ($result1->num_rows > 0) {
										while ($row = $result->fetch_assoc()) {
									?>
										<input type="checkbox" name=color[] value="<?php echo $row['color']; ?>" required/> <?php echo ucfirst($row['color']); ?>
									<?php
										}
									} 
									?>
									<input type="checkbox" name=color[] value="black" required/> Black
									<input type="checkbox" name=color[] value="white" required/> White
									<input type="checkbox" name=colors[] value="blue" required/> Blue
									<input type="checkbox" name=color[] value="red" required/> Red
									<input type="checkbox" name=color[] value="green" required/> Green
									<input type="checkbox" name=color[] value="yellow" required/> Yellow
									<input type="checkbox" name=color[] value="orange" required/> Orange
									<input type="checkbox" name=color[] value="brown" required/> Brown
									<input type="checkbox" name=color[] value="pink" required/> Pink
									<input type="checkbox" name=color[] value="gray" required/> Gray

								</p>

								<p>
									<label>Description</label>
									<textarea class="text-input textarea wysiwyg" id="description" name="description" cols="79" rows="15" required></textarea>
								</p>
								
								<p>
									<input class="button" type="submit" value="Submit"name="submit" />
								</p>
								
							</fieldset>
							
							<div class="clear"></div><!-- End .clear -->
							
						</form>
						
						<script>
							$(function(){
								var requiredCheckboxes = $('.tags :checkbox[required]');
								requiredCheckboxes.change(function(){
									if(requiredCheckboxes.is(':checked')) {
										requiredCheckboxes.removeAttr('required');
									} else {
            							requiredCheckboxes.attr('required', 'required');
        							}
    							});
								var requiredCheckboxes1 = $('.colors :checkbox[required]');
								requiredCheckboxes1.change(function(){
									if(requiredCheckboxes1.is(':checked')) {
										requiredCheckboxes1.removeAttr('required');
									} else {
            							requiredCheckboxes1.attr('required', 'required');
        							}
    							});
							});
							
						</script>
					</div> <!-- End #tab2 -->        
					
				</div> <!-- End .content-box-content -->
				
			</div> <!-- End .content-box -->
			
			<div class="clear"></div>
			
			<?php include('footer.php'); ?>
