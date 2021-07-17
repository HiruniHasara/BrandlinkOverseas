<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Notify_DealersPage</title>
        <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>public/css/Common/template.css">
        <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>public/css/SC/notifyDealers.css">
        <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>public/css/Common/alert.css">
		<script language="JavaScript" src="<?php echo URL; ?>public/js/notify.js"></script>
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
                <fieldset>
                    <form action="getName" method="post">
                        <label>Dealer ID.: </label>
                        <input type="text" class="idInput" name="id" size="50" value='<?= isset($this->data[0]['u_id']) ? $this->data[0]['u_id'] : ''; ?>'>
                        <button class="searchbtn" type="submit"><i class="fa fa-search"></i></button><br/>
                    </form>
                    <form action="<?php echo URL; ?>SC/sendMail" method="post">
                        <input type='hidden' name='mail' value='<?= isset($this->data[0]['email']) ? $this->data[0]['email'] : ''; ?>'/>
                        <input type='hidden' name='orderid' value='<?= isset($this->id) ? $this->id : ''; ?>'/> 

                        <label>Dealer Name: </label>
                        <input type="text" name="name" size="50" value='<?= isset($this->data[0]['f_name']) ? $this->data[0]['f_name'] : ''; ?>'>
                        
                        <label>Message: </label>
                        <textarea name="message" placeholder="Enter your message here..." required><?= isset($this->content) ? $this->content : ''; ?></textarea>
                        
                        <input type="submit" value="Send">
                    </form>
                </fieldset>   
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
                echo '<script> $(window).ready(sendSuccess()); </script>';
            } 

            if(isset($_GET['alert']) && $_GET['alert']=='fail'){
                echo '<script> $(window).ready(sendFail()); </script>';
            }

			if(isset($_GET['alert']) && $_GET['alert']=='invalid'){
				echo '<script> $(window).ready(invalid()); </script>';
			}
		?>
    </body>
</html>