<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Not Eligible List</title>
    <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>public/css/OM/div3.css">
    <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>public/css/OM/table1.css">
    <link rel="stylesheet" href="<?php echo URL; ?>public/css/Common/template.css">
	<script language="JavaScript" src="<?php echo URL; ?>public/js/notEligible.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
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
				<h1>Not Eligible Dealers</h1>
			</div>
		</div>

		<div class="clearfix">
			<div class="content1">
				<!-- <div class="searchInput"> -->
				<input type="text" id="input" onkeyup="search()" placeholder="Search for something..." title="Type in a name">
			 	<!-- </div> -->
				<table id="table1">
     					<thead>
        					<tr>
								<th style="width:10%"> Dealer_id </th>
								<th style="width:20%"> Name </th>
								<th style="width:30%"> Address </th>
								<th style="width:20%"> Contact Number </th>
								<th style="width:20%"> Option </th>
								</tr>
							</thead>
							<tbody id="list">
								
								<tr>
                  
								<!-- <form name="notelligible" id="noteligible" action="notelligible"  method="POST" enctype="multipart/form-data"> -->
								<?php

                                //if($this->data!=0){
                                foreach($this->data as $values){

                                echo '<tr><td>'.$values["u_id"].'</td>';	
                                echo '<td>'.$values["f_name"].'</td>';
                                echo '<td>'.$values["address"].'</td>';
                                echo '<td>'.$values["contact"].'</td>'; ?>
                                <td> 
										<div class="option">
											
											<button type="submit" name="delete" id="<?php echo $values['OrderID']?>" onclick="deleteDealer(this)"><i class="fa fa-trash" aria-hidden="true"></i>Delete</button>
											
										</div>
									</td>
                                <?php
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
  function deleteDealer(clickedbutton){
    // var itemid = document.getElementById('delete').value;
  var oid=clickedbutton.id;
  swal({
    title: "Are you sure?",
    text: "This action will make this dealer eligible to proceed order.",
    buttons: true,
    dangerMode: true,
    closeOnClickOutside: false,
})
.then((willDelete) => {
    if (willDelete) {
        window.location.assign("notelligible/"+oid);
    }
});
}

			$(document).ready(function(){
				$("#input").on("keyup", function() {
					var value = $(this).val().toLowerCase();
					$("#list tr").filter(function() {
					$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
					});
				});
			});
	</script>

<?php

if(isset($_GET['alert']) && $_GET['alert']=='eligiblesuccess'){
  echo '<script> $(window).ready(Success()); </script>';
}
if(isset($_GET['alert']) && $_GET['alert']=='eligiblefail'){
  echo '<script> $(window).ready(Fail()); </script>';
}
?>

  </body>
</html>