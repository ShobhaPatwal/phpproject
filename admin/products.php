<?php include('header.php'); ?>
    <?php include('sidebar.php'); ?>
	<?php
	$message = '';
	if (isset($_POST['submit'])) {
	$name = isset($_POST['name'])?$_POST['name']:'';
	$price = isset($_POST['price'])?$_POST['price']:'';
	$category = isset($_POST['category'])?$_POST['category']:'';
	$tags = implode(',', $_POST['tags']);
	$description = isset($_POST['description'])?$_POST['description']:'';
	$image = $_FILES['image']['name'];
	$tmp_name = $_FILES['image']['tmp_name'];
	$location = "images/";
	//$location = "../img/". $category ."/";
	if (!move_uploaded_file($tmp_name,$location.$image)) {
		$errors[] = array('input'=>'file', 'msg'=>'Sorry, there was an error uploading your file.');
	}
	//check product already exists
	$checkProduct = checkProduct($name);
	//add product
	$addProduct = addProduct($name, $price, $image, $category, $tags, $description);
    

} 

?>	
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
						<?php  if (sizeof($errors) > 0) : foreach ($errors as $error) : ?>
						<div class="notification error png_bg">
						    <a href="#" class="close"><img src="resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
						    <div>
							   <?php echo $error['msg']; ?>
						    </div>
					    </div>
						<?php endforeach;  endif; ?>
						<?php if (isset($_SESSION['success'])) : ?>
						<div class="notification success png_bg">
							<a href="#" class="close"><img src="resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
							<div><?php echo $_SESSION['success']; unset($_SESSION['success']); ?></div>
						</div>
					    <?php endif; ?>
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
									<td><input type="checkbox" /></td>
									<td><?php echo $row['id'];?></td>
									<td class="product"><img src="images/<?php echo $row["image"]; ?>" class="cart-item-image" /><?php echo $row['name'];?></td>
									<td>$<?php echo $row['price'];?></td>
									<td><?php echo $row['category_id'];?></td>
									<td><?php echo $row['tag_id'];?></td>
									<td><?php echo $row['description'];?></td>
									<td>
										<!-- Icons -->
										 <a href="#" title="Edit"><img src="resources/images/icons/pencil.png" alt="Edit" /></a>
										 <a href="products.php?action=remove&product_id=<?php echo $row["id"]; ?>" title="Delete"><img src="resources/images/icons/cross.png" alt="Delete" /></a> 
										 <a href="#" title="Edit Meta"><img src="resources/images/icons/hammer_screwdriver.png" alt="Edit Meta" /></a>
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
					
						<form action="products.php" method="POST"  enctype="multipart/form-data">
							
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
										<option value="men">Men</option>
										<option value="women">Women</option>
										<option value="kids">Kids</option>
										<option value="electronics">Electronics</option>
										<option value="sports">Sports</option>
									</select> 
								</p>

								<p class="tags">
									<label>Tags</label>
									<input type="checkbox" name=tags[] value="fashion" required/> Fashion
									<input type="checkbox" name=tags[] value="ecommerce" required/> Ecommerce
									<input type="checkbox" name=tags[] value="shop" required/> Shop
									<input type="checkbox" name=tags[] value="handbag" required/> Hand Bag
									<input type="checkbox" name=tags[] value="laptop" required/> Laptop
									<input type="checkbox" name=tags[] value="headphone" required/> Headphone
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
							});
							
						</script>
					</div> <!-- End #tab2 -->        
					
				</div> <!-- End .content-box-content -->
				
			</div> <!-- End .content-box -->
			
			<div class="clear"></div>
			
			<?php include('footer.php'); ?>
