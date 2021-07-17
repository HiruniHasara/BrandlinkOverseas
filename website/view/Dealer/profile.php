<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Dealer_ProfilePage</title>
        <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>public/css/Common/template.css">
        <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>public/css/Dealer/profile.css">
        <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>public/css/Common/alert.css">
        <script language="JavaScript" src="<?php echo URL; ?>public/js/profile.js"></script>
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
                    <?php
                        if($this->data!=0){
                            foreach($this->data as $values){
					?>
                                <fieldset>
                                    <h3>Profile</h3>
                                    <p>Welcome <?php echo $values['f_name']; ?> to your profile. Edit your account settings and change your password here.</p>
                                    <div class="password" id="password"><input type="submit" value="Change Password" onclick="showContent()"></div>

                                    <form id="passwordForm" name="passwordform" action="changePassword" method="post">
                                        <div class="passwordpanel" id="passwordpanel">
                                            <label>Old Password: </label>
                                            <input type="password" name="oldpassword" size="50" required><br />

                                            <label>New Password: </label>
                                            <input type="password" name="newpassword" size="50" onkeyup="validityChecking()" required><br />
                                            <p><span id="validity"></span><p>

                                            <label>Verify Password: </label>
                                            <input type="password" name="repassword" size="50" onkeyup="pswrdMatching()" required><br />
                                            <p><span id="popup"></span><p>

                                            <div class="buttons">
                                                <input type="submit" value="Save Changes" onclick="checkform()">
                                                <input type="reset" value="Cancel" onclick="hideContent()">
                                            </div>
                                        </div>
                                    </form>

                                    <form id="bioForm" name="bioform" action="changeProfile" method="post">
                                        <label>Username: </label>
                                        <input type="text" name="username" size="50" value="<?= isset($values['u_name']) ? $values['u_name'] : $values['u_name']; ?>" required><br />

                                        <label>Name: </label>
                                        <input type="text" name="name" size="50" value="<?= isset($values['f_name']) ? $values['f_name'] : $values['f_name']; ?>" required><br />
                                        
                                        <label>Address: </label>
                                        <input type="text" name="address" size="50" value="<?= isset($values['address']) ? $values['address'] : $values['address']; ?>" required>
                                        
                                        <label>Email: </label>
                                        <input type="email" name="mail" size="50" value="<?= isset($values['email']) ? $values['email'] : $values['email']; ?>" required>
                                        
                                        <label>Telephone: </label>
                                        <input type="tel" name="telephone" size="50" value="<?= isset($values['contact']) ? $values['contact'] : $values['contact']; ?>" required>
                                    
                                        <div class="buttons">
                                            <input type="submit" value="Save Changes" onclick="checkComplete()">
                                            <input type="reset" value="Cancel">
                                        </div>
                                    </form>
                                </fieldset>
                    <?php   }
                        }
                    ?>
                    <div class="deletebtn">
                        <input type="submit" value="Delete My Account" onclick="deleteProfile()">
                    </div>
                </form>
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
				echo '<script> $(window).ready(updateSuccess()); </script>';
			} 

			if(isset($_GET['alert']) && $_GET['alert']=='fail'){
				echo '<script> $(window).ready(updateFail()); </script>';
			}

            if(isset($_GET['alert']) && $_GET['alert']=='wrong'){
				echo '<script> $(window).ready(wrongPswrd()); </script>';
			}

            if(isset($_GET['alert']) && $_GET['alert']=='faildelete'){
				echo '<script> $(window).ready(deleteFail()); </script>';
			}
		?>
    </body>
</html>