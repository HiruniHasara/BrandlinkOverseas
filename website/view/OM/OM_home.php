<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OM Home</title>
    <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>public/css/OM/OMhome.css">
    <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>public/css/Common/template.css">
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
        <a href="settings"><i class="fas fa-sliders-h"></i><span>Settings</span></a>
      </div>
    </div>
    <!--mobile navigation bar end-->
    <!--sidebar start-->
    <div class="sidebar">
      <div class="profile_info">
      <img src="<?php echo URL; ?>public/img/profile.png" class="mobile_profile_image" width="100px" height="100px">
        <h4>Operational Manager</h4>
      </div>
       <a href="settings"><i class="fas fa-sliders-h"></i><span>Settings</span></a>
    </div>
    <!--sidebar end-->

    <div class="content">
    <div class="container">
		<div class= "op1">
			<h3>APPROVED<br />ORDERS</h3>
			<a href="orders"><img src="<?php echo URL; ?>public/img/ap_orders.png" height="110px" width="120px"></a>
		</div>
		<div class= "op2">
			<h3>ITEM<br />STOCK</h3>
			<a href="stockMomali"><img src="<?php echo URL; ?>public/img/stock.png" height="120px" width="130px"></a>
		</div>
		<div class= "op3">
			<h3>SPARE PARTS<br />STOCK</h3>
			<a href="sparePartMomali"><img src="<?php echo URL; ?>public/img/spare.png" height="90px" width="110px"></a>
		</div>
		<div class= "op4">
			<h3>REPORT<br />GENERATION</h3>
			<a href="report"><img src="<?php echo URL; ?>public/img/report.jpg" height="120px" width="110px"></a>
		</div>
    <!-- <div class= "op5">
			<h3>Reorder<br />List</h3>
			<a href="report"><img src="<?php echo URL; ?>public/img/report.jpg" height="120px" width="110px"></a>
		</div> -->
	</div>

	 
    <div class="footercontent">
      <?php require_once(realpath(dirname(__FILE__) . '/../Common/footer.php'));?>
    </div>
    </div>
    <script type="text/javascript">
    $(document).ready(function(){
      $('.nav_btn').click(function(){
        $('.mobile_nav_items').toggleClass('active');
      });
    });
    </script>

  </body>
</html>