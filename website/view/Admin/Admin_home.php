<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Home</title>
    <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>public/css/Admin/adminHome.css">
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
        <a href="#"><i class="fas fa-sliders-h"></i><span>Settings</span></a>
      </div>
    </div>
    <!--mobile navigation bar end-->
    <!--sidebar start-->
    <div class="sidebar">
      <div class="profile_info">
      <img src="<?php echo URL; ?>public/img/profile.png" class="mobile_profile_image" width="100px" height="100px">
        <h4>Admin</h4>
      </div>
       <a href="settings"><i class="fas fa-sliders-h"></i><span>Settings</span></a>
    </div>
    <!--sidebar end-->

    <div class="content">
    <div class="container">
		<div class= "op1">
			<h3>MANAGE<br />USERS</h3>
			<ul>
  				<li><a href="employees">Manage Employee<br /><i class="fa fa-user-plus" aria-hidden="true"></i></a></li>
  				<li><a href="ManageDealers">Manage Dealers<br /><i class="fa fa-users" aria-hidden="true"></i></a></li>
  		</ul>
		</div>
		<div class= "op2">
			<h3>PENDING<br />DEALERS</h3>
			<a href="pendingDealers"><img src="<?php echo URL; ?>public/img/pending user.png" height="130px" width="130px"></a>
		</div>
		<div class= "op3">
			<h3>REPORT<br />GENERATION</h3>
			<a href="report"><img src="<?php echo URL; ?>public/img/report.jpg" height="130px" width="130px"></a>
		</div>
	  </div>
   <div>
				<?php require_once(realpath(dirname(__FILE__) . '/../Common/footer.php'));?>
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