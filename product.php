<?php 
$title = "Products";
include('header.php');
// for pagination purposes
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$records_per_page = 6;
 
?> 
        <!-- catg header banner section -->
        <section id="aa-catg-head-banner">
            <img src="img/fashion/fashion-header-bg-8.jpg" alt="fashion img">
            <div class="aa-catg-head-banner-area">
                <div class="container">
                    <div class="aa-catg-head-banner-content">
                        <h2>Fashion</h2>
                        <ol class="breadcrumb">
                            <li><a href="index.php">Home</a></li>         
                            <li class="active">Product</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>
        <!-- / catg header banner section -->

  <!-- product category -->
  <section id="aa-product-category">
    <div class="container">
      <div class="row">
        <div class="col-lg-9 col-md-9 col-sm-8 col-md-push-3">
          <div class="aa-product-catg-content">
            <div class="aa-product-catg-head">
              <div class="aa-product-catg-head-left">
                <form action="" class="aa-sort-form">
                  <label for="">Sort by</label>
                  <select name="">
                    <option value="1" selected="Default">Default</option>
                    <option value="2">Name</option>
                    <option value="3">Price</option>
                    <option value="4">Date</option>
                  </select>
                </form>
                <form action="" class="aa-show-form">
                  <label for="">Show</label>
                  <select name="">
                    <option value="1" selected="12">12</option>
                    <option value="2">24</option>
                    <option value="3">36</option>
                  </select>
                </form>
              </div>
              <div class="aa-product-catg-head-right">
                <a id="grid-catg" href="#"><span class="fa fa-th"></span></a>
                <a id="list-catg" href="#"><span class="fa fa-list"></span></a>
              </div>
            </div>
            <div class="aa-product-catg-body">
              

            </div>

            <div class="aa-product-catg-pagination">
              <nav>
              <ul class="pagination">
              <?php 
                $page_query = "SELECT * FROM products";
                $page_result = $conn->query($page_query);
                $total_records = $page_result->num_rows;
                $total_pages = ceil($total_records/$records_per_page);
                $display = ($page-1)*$records_per_page;
                for ($page=1; $page<= $total_pages; $page++)
                {
                  echo "<li><a href='product.php?page=".$page."'>".$page."</a></li>";
                }
                ?>
                </ul>
               <span id="display" style="display:none;"><?php echo $display; ?></span>
              </nav>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-4 col-md-pull-9">
          <aside class="aa-sidebar">
            <!-- single sidebar -->
            <div class="aa-sidebar-widget">
                <h3>Category</h3>
                <ul class="aa-catg-nav">
                <?php
                $sql = "SELECT * FROM categories";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                  // output data of each row
                  while ($row = $result->fetch_assoc()) {
                    ?>
                        <li><label><input type="checkbox" class="common_selector category" value="<?php echo $row['id']; ?>"  > <?php echo $row['name']; ?></label></li>
                        <?php
                    }
                } 
                ?>
                </ul>
            </div>
            <!-- single sidebar -->
            <div class="aa-sidebar-widget">
                <h3>Tags</h3>
                <div class="tag-cloud">
                <?php
			          $sql = "SELECT * FROM tags";
				        $result = $conn->query($sql);
				        if ($result->num_rows > 0) {
					        // output data of each row
					        while ($row = $result->fetch_assoc()) {
                ?>
                    <a href="#"><label><input type="checkbox" class="common_selector tag" value="<?php echo $row['id']; ?>"  > <?php echo ucfirst($row['name']); ?></label></a>
               <?php
				          }
				        } 
				        ?>
                </div>
            </div>
            <!-- single sidebar -->
            <div class="aa-sidebar-widget">
              <h3>Shop By Price</h3>              
              <!-- price range -->
              <div class="aa-sidebar-price-range">
               <form action="">
                  <div id="skipstep" class="noUi-target noUi-ltr noUi-horizontal noUi-background">
                  </div>
                  <span id="skip-value-lower" class="example-val">30.00</span>
                 <span id="skip-value-upper" class="example-val">100.00</span>
                 <button class="aa-filter-btn" type="submit">Filter</button>
               </form>
              </div>              

            </div>
            <!-- single sidebar -->
            <div class="aa-sidebar-widget">
              <h3>Shop By Color</h3>
              <div class="aa-color-tag">
              <?php
                $sql1 = "SELECT * FROM color";
                $result1 = $conn->query($sql1);
                if ($result1->num_rows > 0) {
                  // output data of each row
                  while ($row1 = $result1->fetch_assoc()) {
                    ?>
                      <a class="aa-color-<?php echo strtolower($row1['color']); ?>" href="#"><input type="checkbox" style="opacity:0;" class="common_selector color" value="<?php echo $row1['color']; ?>"  > </a>
                      <?php
                    }
                } 
                ?>
              </div>                            
            </div>
            <!-- single sidebar -->
            <div class="aa-sidebar-widget">
              <h3>Recently Views</h3>
              <div class="aa-recently-views">
                <ul>
                  <li>
                    <a href="#" class="aa-cartbox-img"><img alt="img" src="img/woman-small-2.jpg"></a>
                    <div class="aa-cartbox-info">
                      <h4><a href="#">Product Name</a></h4>
                      <p>1 x $250</p>
                    </div>                    
                  </li>
                  <li>
                    <a href="#" class="aa-cartbox-img"><img alt="img" src="img/woman-small-1.jpg"></a>
                    <div class="aa-cartbox-info">
                      <h4><a href="#">Product Name</a></h4>
                      <p>1 x $250</p>
                    </div>                    
                  </li>
                   <li>
                    <a href="#" class="aa-cartbox-img"><img alt="img" src="img/woman-small-2.jpg"></a>
                    <div class="aa-cartbox-info">
                      <h4><a href="#">Product Name</a></h4>
                      <p>1 x $250</p>
                    </div>                    
                  </li>                                      
                </ul>
              </div>                            
            </div>
            <!-- single sidebar -->
            <div class="aa-sidebar-widget">
              <h3>Top Rated Products</h3>
              <div class="aa-recently-views">
                <ul>
                  <li>
                    <a href="#" class="aa-cartbox-img"><img alt="img" src="img/woman-small-2.jpg"></a>
                    <div class="aa-cartbox-info">
                      <h4><a href="#">Product Name</a></h4>
                      <p>1 x $250</p>
                    </div>                    
                  </li>
                  <li>
                    <a href="#" class="aa-cartbox-img"><img alt="img" src="img/woman-small-1.jpg"></a>
                    <div class="aa-cartbox-info">
                      <h4><a href="#">Product Name</a></h4>
                      <p>1 x $250</p>
                    </div>                    
                  </li>
                   <li>
                    <a href="#" class="aa-cartbox-img"><img alt="img" src="img/woman-small-2.jpg"></a>
                    <div class="aa-cartbox-info">
                      <h4><a href="#">Product Name</a></h4>
                      <p>1 x $250</p>
                    </div>                    
                  </li>                                      
                </ul>
              </div>                            
            </div>
          </aside>
        </div>
       
      </div>
    </div>
  </section>
  <!-- / product category -->
<style>
#loading
{
	text-align:center; 
	background: url('loader.gif') no-repeat center; 
	height: 150px;
}
</style>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(document).ready(function(){

    filter_data();

    function filter_data()
    {
        $('.aa-product-catg-body').html('<div id="loading" style="" ></div>');
        var action = 'fetch_data';
        var display = $('#display').text();
        var minimum_price = $('#hidden_minimum_price').val();
        var maximum_price = $('#hidden_maximum_price').val();
        var category = get_filter('category');
        var tag = get_filter('tag');
        var color = get_filter('color');
        $.ajax({
            url:"fetch_data.php",
            method:"POST",
            data:{action:action, display:display, minimum_price:minimum_price, maximum_price:maximum_price, category:category, tag:tag, color:color},
            success:function(data){
                $('.aa-product-catg-body').html(data);
            }
        });
    }

    function get_filter(class_name)
    {
        var filter = [];
        $('.'+class_name+':checked').each(function(){
            filter.push($(this).val());
        });
        return filter;
    }

    $('.common_selector').click(function(){
        filter_data();
    });   

    $('#price_range').slider({
        range:true,
        min:1000,
        max:65000,
        values:[1000, 65000],
        step:500,
        stop:function(event, ui)
        {
            $('#price_show').html(ui.values[0] + ' - ' + ui.values[1]);
            $('#hidden_minimum_price').val(ui.values[0]);
            $('#hidden_maximum_price').val(ui.values[1]);
            filter_data();
        }
    });
    /* $("body").on( "click", ".aa-add-card-btn", function(){
   alert( "Triggred by"); 
   console.log('ff');
      var productId = $(this).data("productid");
      $.ajax({
        method: "POST",
        url: "addToCart.php",
        data: { id: productId, quantity: '1' }
      })
      .done(function( msg ) {
        $("#shopping-cart").html(msg);
      });  
      });  */

});
</script> 
  <!-- Subscribe section -->
  <section id="aa-subscribe">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="aa-subscribe-area">
            <h3>Subscribe our newsletter </h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ex, velit!</p>
            <form action="" class="aa-subscribe-form">
              <input type="email" name="" id="" placeholder="Enter your Email">
              <input type="submit" value="Subscribe">
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- / Subscribe section -->

        <?php include('footer.php');