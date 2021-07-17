<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Dealer_ComplaintPage</title>
        <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>public/css/Common/template.css">
        <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>public/css/Dealer/complaint.css">
        <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>public/css/Common/alert.css">
        <script language="JavaScript" src="<?php echo URL; ?>public/js/complaint.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" charset="utf-8"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <style>
	 		body {
				background-color: white;
				background-image: url("<?php echo URL; ?>public/img/homeback.jpg");
	 		}
		</style>
    </head>
    <body>
        <input type="checkbox" id="check">
		<header>
			<?php require_once(realpath(dirname(__FILE__) . '/../Common/header.php'));?>
		</header>
		<?php include 'navBar.php';?>

        <div class="content">
            <div class="clearfix">
                <form id="complaintForm" name="complaintform" action="sendComplaint" method="post" enctype="multipart/form-data">
                    <fieldset>
                        Please select the complaint type: <br/>
                        <div class="radiogrp">
                            <input type="radio" id="order" name="complaintType" value="order complaint" onclick="changeContent()" required>
                            <label for="order">Order/Damage Complaint</label>
                            <input type="radio" id="service" name="complaintType" value="service complaint" onclick="hideDetails()" required>
                            <label for="service">Service Complaint</label>
                            <input type="radio" id="other" name="complaintType" value="other" onclick="hideDetails()" required>
                            <label for="other">Other</label><br /><br />
                        </div>

                        <div id="details">
                            <label class="set">Invoice No.: </label>
                            <input type="text" name="invoiceno" size="50">
                            
                            <label class="set">Brand: </label>
                            <input type='hidden' name="momali" value=0>
                            <input type="checkbox" id="momali" name="momali" value="momali">
                            <label for="momali">Momali</label>
                            <input type='hidden' name="ferroli" value=0>
                            <input type="checkbox" id="ferroli" name="ferroli" value="ferroli">
                            <label for="ferroli">Ferroli</label>
                            <input type='hidden' name="aquaflex" value=0>
                            <input type="checkbox" id="aquaflex" name="aquaflex" value="aquaflex">
                            <label for="aquaflex">Aquaflex</label><br> 
                        </div>

                        <div class="photo">
                            <label class="set">Photos (Optional): </label>
                            <input type="file" id="img" name="img" accept="image/*" multiple>
                            <br />
                        </div>
                        <label class="set">Complaint: </label>
                        <textarea name="complaint" placeholder="Enter your complaint here..." required></textarea>
                        
                        <input type="submit" value="Send" onclick="checkform()">
                    </fieldset>
                </form>
            </div>
            <div>
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
				echo '<script> $(window).ready(sendingSuccess()); </script>';
			} 

			if(isset($_GET['alert']) && $_GET['alert']=='fail'){
				echo '<script> $(window).ready(sendingFail()); </script>';
			}

            if(isset($_GET['alert']) && $_GET['alert']=='notimg'){
				echo '<script> $(window).ready(onlyImg()); </script>';
			}
		?>
    </body>
</html>