<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Dealers</title>
    <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>public/css/Admin/div3.css">
    <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>public/css/Admin/table1.css">
    <link rel="stylesheet" href="<?php echo URL; ?>public/css/Common/template.css">
    <script language="JavaScript" src="<?php echo URL; ?>public/js/pendingDealers.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
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
        <a href="ManageDealers"><i class="fa fa-address-book"></i><span>Manage Dealers</span></a>
        <a href="employees"><i class="fa fa-users"></i><span>Manage Employee</span></a>
        <a href="pendingDealers"><i class="fa fa-user"></i><span>Pending Dealers</span></a>
        <a href="report"><i class="fa fa-file"></i><span>Reports</span></a>
        <a href="settings"><i class="fas fa-sliders-h"></i><span>Settings</span></a>
      </div>
    </div>
    <!--mobile navigation bar end-->
    <!--sidebar start-->
    <div class="sidebar">
      <div class="profile_info">
      <img src=".././public/img/Profile pic.png" class="mobile_profile_image" width="100px" height="100px">
        <h4>Admin</h4>
      </div>
      <a href="home"><i class="fas fa-home"></i><span>Home</span></a>
        <a href="ManageDealers"><i class="fa fa-address-book"></i><span>Manage Dealers</span></a>
        <a href="employees"><i class="fa fa-users"></i><span>Manage Employee</span></a>
        <a href="pendingDealers"><i class="fa fa-user"></i><span>Pending Dealers</span></a>
        <a href="report"><i class="fa fa-file"></i><span>Reports</span></a>
        <a href="settings"><i class="fas fa-sliders-h"></i><span>Settings</span></a>
    </div>
    <!--sidebar end-->

    <div class="content">
    <div class="wrapper clearfix">
      <div class ="topic">
				<h1>Pending Dealers</h1>
			</div>
		</div>

		<div class="wrapper clearfix">
    <input type="text" id="search" size="50" onkeyup="search()" placeholder="search">
			<div class="content1">
				<table id="table1">
     					<thead>
        					<tr>
								<th style="width:10%"> Dealer ID </th>
								<th style="width:20%"> Name </th>
								<th style="width:20%"> Address </th>
								<th style="width:20%"> Email </th>
                <th style="width:10%"> Contact Number </th>
                <th style="width=10%">Option</th>
								</tr>
							</thead>
							<tbody>
              <?php
								// echo '<script type="text/javascript">clrRows();</script>';
									if($this->data!=0){
										foreach($this->data as $values){
								?>
												<tr>
													<td><?php echo $values["UserID"]; ?></td>
													<td><?php echo $values["Name"]; ?></td>
													<td><?php echo $values["Address"]; ?></td>
                          <td><?php echo $values["Email"]; ?></td>
                          <td><?php echo $values["Telephone"]; ?></td>
                          <td>
                          <a href="requestAcc/<?php echo $values["UserID"];?>"><button name="approve" class="btn"><i class="fa fa-check"></i>Approve</button></a>
                          <a href="rejectAcc/<?php echo $values["UserID"];?>"><button name="reject" class="btn"><i class="fa fa-times"></i>Reject</button></a></td>
												</tr>
								<?php       }
										} else { 
											echo "Dealers Not Found";
										}
								?>
							</tr>
						</tbody>
				</table>
				
			</div>
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
<?php 
			if(isset($_GET['alert']) && $_GET['alert']=='success'){
				echo '<script> $(window).ready(AcceptSuccess()); </script>';
			} 

			if(isset($_GET['alert']) && $_GET['alert']=='fail'){
				echo '<script> $(window).ready(AcceptFail()); </script>';
      }

      if(isset($_GET['alert']) && $_GET['alert']=='rejectsuccess'){
				echo '<script> $(window).ready(RejectSuccess()); </script>';
			} 

			if(isset($_GET['alert']) && $_GET['alert']=='rejectfail'){
				echo '<script> $(window).ready(RejectFail()); </script>';
      }
      
		?>
  </body>
</html>