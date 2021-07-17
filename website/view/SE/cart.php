<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Orders</title>
    <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>public/css/OM/div3.css">
	<link rel="stylesheet" type="text/css" href="<?php echo URL; ?>public/css/SE/form1.css">
    <link rel="stylesheet" href="<?php echo URL; ?>public/css/Common/template.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" charset="utf-8"></script>
  </head>
  <body>
  <style>
	 		body {
       			background-color: white;
                background-image: url("<?php echo URL; ?>public/img/homeback.jpg");
	 		}
		</style>
    <input type="checkbox" id="check">
    <!--header area start-->
    <header>
      <label for="check">
        <i class="fas fa-bars" id="sidebar_btn"></i>
      </label>
      <div class="left_area">
        <h3>BrandLink <span>Overseas</span></h3>
      </div>
      <div class="right_area">
        <a href="../Login/log" class="logout_btn">Logout</a>
      </div>
    </header>
    <!--header area end-->
    <!--mobile navigation bar start-->
    <div class="mobile_nav">
      <div class="nav_bar">
        <i class="fa fa-bars nav_btn"></i>
      </div>
      <div class="mobile_nav_items">
        <a href="home"><i class="fas fa-home"></i><span>Home</span></a>
        <a href="dealer"><i class="fa fa-address-book" ></i><span>Dealer Info</span></a>
        <a href="notEligible"><i class="fa fa-info-circle"></i><span>Not Eligible List</span></a>
        <a href="newOrder"><i class="fa fa-shopping-cart"></i><span>New Orders</span></a>
        <a href="payment"><i class="fa fa-money-bill"></i><span>Collected Payments</span></a>
        <a href="complaint><i class="fa fa-exclamation-circle"></i><span>Complaints to Check</span></a>
        <a href="settings"><i class="fas fa-sliders-h"></i><span>Settings</span></a>
      </div>
    </div>
    <!--mobile navigation bar end-->
    <!--sidebar start-->
    <div class="sidebar">
      <div class="profile_info">
      <img src=".././public/img/Profile pic.png" class="mobile_profile_image" width="100px" height="100px">
        <h4>Sales Executive</h4>
      </div>
        <a href="home"><i class="fas fa-home"></i><span>Home</span></a>
        <a href="dealer"><i class="fa fa-address-book" ></i><span>Dealer Info</span></a>
        <a href="notEligible"><i class="fa fa-info-circle"></i><span>Not Eligible List</span></a>
        <a href="newOrder"><i class="fa fa-shopping-cart"></i><span>New Orders</span></a>
        <a href="payment"><i class="fa fa-money-bill"></i><span>Collected Payments</span></a>
        <a href="complaint"><i class="fa fa-exclamation-circle"></i><span>Complaints to Check</span></a>
        <a href="settings"><i class="fas fa-sliders-h"></i><span>Settings</span></a>
    </div>
    <!--sidebar end-->
   
   
        <input type="checkbox" id="check">
		<header>
			<?php require_once(realpath(dirname(__FILE__) . '/../Common/header.php'));?>
		</header>
		<?php include 'navBar.php';?>
  
        <div class="content">
            <div class="clearfix">
                <div class="column">
					<p>Shopping Cart</p>
					<table>
						<thead>
							<tr>
								<th style="width:25%">Iamge</th>
								<th style="width:35%">Name</th>
								<th style="width:20%">Price</th>
								<th style="width:20%">Quantity</th>
							</tr>
						</thead>
						<tbody>
                            <?php
                                foreach($this->data as $values){
					        ?>
                                    <tr>
                                        <td><img src="data:image/jpg;base64,<?php echo base64_encode( $values['details'][0]["Image"] ); ?>" style="width:100%"/></td>
                                        <td><?php echo $values['details'][0]["ItemName"]; ?></td>
                                        <td><?php echo $values['details'][0]["Price"]; ?></td>
                                        <td><input type="number" name="quantity" onChange="displayabc(value, '')" min="0" max="1000" step="50" value="<?php echo $values['amount']; ?>"></td>
                                    </tr>
                            <?php
                                } 
                            ?>
						</tbody>
					</table>
				</div>
				<div class="column">
					<p>Order Details</p>
					<form>
						<fieldset>
							<label>
								Name: <input type="text" name="name" size="50">
							</label>
							<label>
								Address: <input type="text" name="address" size="50">
                            </label>
                            <input type="checkbox" id="board" name="board" value="displayboard">
                            <label for="board"> 
                                <span>Display Board Order<span>
                            </label><br>
							<label>
								Total Amount: <input type="text" name="total" size="50" readonly>
							</label>
							<input type="submit" value="Confirm Order"> 
						</fieldset>
                    </form>
                </div>
            </div>
            <div class="footercontent">
                <?php require_once(realpath(dirname(__FILE__) . '/../Common/footer.php'));?>
            </div>
        </div>
    
        <!-- <script type="text/javascript">
			$(document).ready(function(){
				$('.nav_btn').click(function(){
					$('.mobile_nav_items').toggleClass('active');
				});
			});
		</script> -->
    </body>
</html>