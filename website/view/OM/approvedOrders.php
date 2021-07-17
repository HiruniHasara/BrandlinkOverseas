<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Approved Orders</title>
    <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>public/css/OM/div3.css">
    <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>public/css/OM/table2.css">
    <link rel="stylesheet" href="<?php echo URL; ?>public/css/Common/template.css">
    <script language="JavaScript" src="<?php echo URL; ?>public/js/approveorders.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" charset="utf-8"></script>
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"> </script>
    
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
				margin-left: 25px;
				margin-bottom: 12px;
      }
      
      .selected{
        font-weight:bold;
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
    <div class="clearfix">
      <div class ="topic">
				<h1>Approved Orders</h1>
			</div>
		</div>

		<div class="wrapper clearfix">
		  <div class="content1">
        <!-- <div class="searchInput"> -->
				<input type="text" id="input" onkeyup="search()" placeholder="Search for orders..." title="Type in a name">
         <!-- </div> -->
        
				<table id="table">
     					<thead id="head">
        			  <tr id="head">	
                    <th style="width:5%" > Order ID </th>
                    <th style="width:10%"> Name </th>
                    <!-- <th style="width:10%"> Contact No </th> -->
                    <th style="width:5%" name="ItemID"> Item ID </th>
                    <th style="width:40%" name="Items"> Items </th>
                    <th style="width:5%" name="Quantity"> Quantity </th>
                    <th style="width:5%"> Total Amount </th>
                    <th class="align" style="width:10%"> Option </th>
                </tr>  

								 
							</thead>
							<tbody id="orders">

                  <?php
                    
                    //if($this->data!=0){
                      foreach($this->data as $values){
                        ?>
                      <tr>
                      <form action="operationStock" method="POST">
                        <td><?php echo $values["OrderID"];?></td>
                        <td><?php echo $values["f_name"];?></td>
                        <!-- <td><?php echo $values["contact"];?></td>  -->
                     
                      <td><?php echo $values["id"];?></td>
                      <td class="cross"><?php echo $values["name"]; ?></td>
                      <td><?php echo $values["quantity"];?></td>
                        
                        <td><?php echo $values["TotalAmount"];?></td>
                        <td>
                          <input type="text" name="keyToIssue" value="<?php echo $values['OrderID']?>" hidden>
                          <button type="submit" name="invoice" id="invoice">Issue Invoice</button>
                        </td>
                      </form>
                  </tr>
                    <?php //} 
                  }
                  ?>
               
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
					$("#orders tr").filter(function() {
					$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
					});
				});
			});
	  </script>

    <?php

    if(isset($_GET['alert']) && $_GET['alert']=='stocksuccess'){
      echo '<script> $(window).ready(stockSuccess()); </script>';
    }
    if(isset($_GET['alert']) && $_GET['alert']=='stockfail'){
      echo '<script> $(window).ready(stockFail()); </script>';
    }
    if(isset($_GET['alert']) && $_GET['alert']=='success'){
      echo '<script> $(window).ready(mailSuccess()); </script>';
    }
    if(isset($_GET['alert']) && $_GET['alert']=='fail'){
      echo '<script> $(window).ready(mailFail()); </script>';
     }
    ?>

  </body>
</html>