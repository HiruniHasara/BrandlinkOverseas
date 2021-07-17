<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dealer Info</title>
    <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>public/css/OM/div3.css">
    <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>public/css/OM/table1.css">
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
			 
			#input {
				background-image: url("<?php echo URL; ?>public/img/searchIcon.png");
        background-size: 20px 20px;
				background-position: 10px 10px;
				background-repeat: no-repeat;
				width: 50%;
				font-size: 16px;
				padding: 12px 20px 12px 40px;
				border: 1px solid #ddd;
				margin-left: 40px;
				margin-bottom: 12px;
			}
		</style>
    <input type="checkbox" id="check">
    <!--header area start-->
    <header>
          <?php require_once(realpath(dirname(__FILE__) . '/../Common/header.php'));?>
    </header>
    <!--header area end-->
    <?php include 'navBar.php';?>

    <div class="content">
    <div class="wrapper clearfix">
      <div class ="topic">
				<h1>Dealer Information</h1>
			</div>
		</div>

		<div class="wrapper clearfix">
			<div class="content1">
			 	<!-- <div class="searchInput"> -->
				<input type="text" id="input" onkeyup="search()" placeholder="Search for something..." title="Type in a name">
			 	<!-- </div> -->
				<table id="table1">
					<div class="sticky">
     					<thead>
							<tr>
								<th style="width:10%"> ID </th>
								<th style="width:20%"> Name </th>
								<th style="width:25%"> Address </th>
								<th style="width:25%"> Email </th>
								<th style="width:20%"> Contact Number </th>
								</tr>
						</thead>
					</div>
						<tbody id="dealer">
							<tr>
								<?php

									//if($this->data!=0){
									foreach($this->data as $values){

									echo '<tr><td>'.$values["u_id"].'</td>';	
									echo '<td>'.$values["f_name"].'</td>';
									echo '<td>'.$values["address"].'</td>';
									echo '<td>'.$values["contact"].'</td>';
									echo '<td>'.$values["email"].'</td>';
									
									//}
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
	 
	<script>
			$(document).ready(function(){
				$("#input").on("keyup", function() {
					var value = $(this).val().toLowerCase();
					$("#dealer tr").filter(function() {
					$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
					});
				});
			});
	</script>

  </body>
</html>