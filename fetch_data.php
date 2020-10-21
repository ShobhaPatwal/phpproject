<?php

//fetch_data.php
$records_per_page = 6;
include('config.php');

if(isset($_POST["action"]))
{
	$query = "SELECT * FROM products WHERE status = '1'";
	if(isset($_POST["minimum_price"], $_POST["maximum_price"]) && !empty($_POST["minimum_price"]) && !empty($_POST["maximum_price"]))
	{
		$query .= "
		 AND product_price BETWEEN '".$_POST["minimum_price"]."' AND '".$_POST["maximum_price"]."'
		";
	}
	if(isset($_POST["category"]))
	{
		$category_filter = implode("','", $_POST["category"]);
		$query .= " AND category_id IN('".$category_filter."')
		";
	}
	if(isset($_POST["tag"]))
	{
    $tag_filter = implode("','", $_POST["tag"]);
    $query2 = "SELECT DISTINCT(product_id) FROM tags_products WHERE tag_id IN('".$tag_filter."')";
    $result2 = $conn->query($query2);
    $product_id = '';
    while ($row2 = $result2->fetch_assoc()) {
      $product_id .= $row2["product_id"].",";
    }
    $product_id = trim($product_id, ','); 
		$query .= " OR id IN('".$product_id."')
		";
	}
	if(isset($_POST["storage"]))
	{
		$storage_filter = implode("','", $_POST["storage"]);
		$query .= "
		 AND product_storage IN('".$storage_filter."')
		";
	}
    $result = $conn->query($query);
    $output = '';
    if ($result->num_rows > 0) {
        $output .= '<ul class="aa-product-catg">
        <!-- start single product item -->';
		    while ($row = $result->fetch_assoc()) {
          $output .= '<li><form action="addToCart.php" method="post">
          <input type="hidden" name="id" value="'.$row["id"].'" />
          <input type="hidden" name="quantity"  value="1" />
            <figure>
              <a class="aa-product-img" href="#"><img src="admin/images/'.$row["image"]. '"></a>
              <!--<a class="aa-add-card-btn" data-productid="' .$row['id']. '"><span class="fa fa-shopping-cart"></span>Add To Cart</a>-->
              <button type="submit" name="cart" class="aa-add-card-btn"><span class="fa fa-shopping-cart"></span>Add To Cart</button>
              <figcaption>
                <h4 class="aa-product-title"><a href="#">' .$row["name"]. '</a></h4>
                <span class="aa-product-price">$' .$row["price"]. '</span>
                <p class="aa-product-descrip">' .$row["description"]. '</p>
              </figcaption>
            </figure>                         
            <div class="aa-product-hvr-content">
              <a href="#" data-toggle="tooltip" data-placement="top" title="Add to Wishlist"><span class="fa fa-heart-o"></span></a>
              <a href="#" data-toggle="tooltip" data-placement="top" title="Compare"><span class="fa fa-exchange"></span></a>
              <a href="#" data-toggle2="tooltip" data-placement="top" title="Quick View" data-toggle="modal" data-target="#quick-view-modal"><span class="fa fa-search"></span></a>                            
            </div></form> </li>
            <!-- quick view modal -->                  
            <div class="modal fade" id="quick-view-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">                      
                  <div class="modal-body">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <div class="row">
                      <!-- Modal view slider -->
                      <div class="col-md-6 col-sm-6 col-xs-12">                              
                        <div class="aa-product-view-slider">                                
                          <div class="simpleLens-gallery-container" >
                            <div class="simpleLens-container">
                                <div class="simpleLens-big-image-container">
                                    <a class="simpleLens-lens-image" data-lens-image="img/view-slider/large/polo-shirt-1.png">
                                        <img src="admin/images/'.$row["image"]. '" class="simpleLens-big-image">
                                    </a>
                                </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- Modal view content -->
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="aa-product-view-content">
                          <h3>'.$row["name"]. '</h3>
                          <div class="aa-price-block">
                            <span class="aa-product-view-price">$' .$row["price"]. '</span>
                            <p class="aa-product-avilability">Avilability: <span>In stock</span></p>
                          </div>
                          <p>' .$row["description"]. '</p>
                          <h4>Size</h4>
                          <div class="aa-prod-quantity">
                            <form action="">
                              <select>
                                <option value="0" selected="1">1</option>
                                <option value="1">2</option>
                                <option value="2">3</option>
                                <option value="3">4</option>
                                <option value="4">5</option>
                                <option value="5">6</option>
                              </select>
                            </form>';
                            $sql1 = "SELECT * FROM categories WHERE id='".$row["category_id"]."'";
                            $result1 = $conn->query($sql1);
                            if ($result1->num_rows > 0) {
                              while ($row1 = $result1->fetch_assoc()) { $name = $row1["name"]; }}
                              $output .= '   <p class="aa-prod-category">Category: <a href="#">' .$name. '</a></p>
                          </div>
                          <div class="aa-prod-view-bottom">
                            <a href="#" class="aa-add-to-cart-btn"><span class="fa fa-shopping-cart"></span>Add To Cart</a>
                            <a href="product-detail.php?id='.$row["id"]. '" class="aa-add-to-cart-btn">View Details</a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>                        
                </div><!-- /.modal-content -->
              </div><!-- /.modal-dialog -->
            </div>
            <!-- / quick view modal -->';
        }
        $output .= '</ul>'; 
	}
	else
	{
		$output = '<h3>No Data Found</h3>';
	}
	echo $output;
}

?>