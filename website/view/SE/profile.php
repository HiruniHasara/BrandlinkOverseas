<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>ProfilePage</title>
        <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>public/css/Common/template.css">
        <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>public/css/Acc/profile.css">
        <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>public/css/Common/alert.css">
        <script language="JavaScript" src="<?php echo URL; ?>public/js/profileOM.js"></script>
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
                        //if($this->data!=0){
                            foreach($this->data as $values){
					?>
                                <fieldset>
                                    <h3>Profile</h3>
                                    <p>Welcome <?php echo $values['Name']; ?> to your profile. Edit your account settings and change your password here.</p>
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
                                                <button type="submit" name="Pchange" value="<?php echo $values["u_name"]?>">Save Changes</button>
                                                <input type="reset" value="Cancel" onclick="hideContent()">
                                            </div>
                                        </div>
                                    </form>

                                    <form id="bioForm" name="bioform" action="changeProfile" method="post">
                                        <label>Username: </label>
                                        <input type="text" name="username" size="50" value="<?= isset($values['u_name']) ? $values['u_name'] : $values['u_name']; ?>" required><br />

                                        <label>Name: </label>
                                        <input type="text" name="name" size="50" value="<?= isset($values['Name']) ? $values['Name'] : $values['Name']; ?>" required><br />
                                        
                                        <label>Address: </label>
                                        <input type="text" name="address" size="50" value="<?= isset($values['Address']) ? $values['Address'] : $values['Address']; ?>" required>
                                        
                                        <label>Email: </label>
                                        <input type="email" name="mail" size="50" value="<?= isset($values['Email']) ? $values['Email'] : $values['Email']; ?>" required>
                                        
                                        <label>Telephone: </label>
                                        <input type="tel" name="telephone" size="50" value="<?= isset($values['Telephone']) ? $values['Telephone'] : $values['Telephone']; ?>" required>
                                    
                                        <div class="buttons">
                                            <input type="submit" name="save" value="Save Changes">
                                            <input type="reset" value="Cancel">
                                        </div>
                                    </form>
                                </fieldset>
                    <?php   }
                        //}
                    ?>
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

<script>
  window.onload = function() {
    document.getElementById("passwordpanel").style.display = 'none';
}

function showContent(){
    document.getElementById("password").style.display = "none";
    document.getElementById("passwordpanel").style.display = "block";
}

function hideContent(){
    document.getElementById("password").style.display = "block";
    document.getElementById("passwordpanel").style.display = "none";
}

function validityChecking(){
    var lowerCaseLetters = /[a-z]/g;
    var upperCaseLetters = /[A-Z]/g;
    var numbers = /[0-9]/g;

    if (document.passwordform.newpassword.value.match(lowerCaseLetters) && document.passwordform.newpassword.value.match(upperCaseLetters) && document.passwordform.newpassword.value.match(numbers) && document.passwordform.newpassword.value.length>=8){
        document.getElementById('validity').style.color = 'green';
        document.getElementById('validity').innerHTML = 'strong password';
    }else {
        document.getElementById('validity').style.color = 'red';
        document.getElementById('validity').innerHTML = 'weak password';
    }
}

function pswrdMatching(){
    if (document.passwordform.newpassword.value == document.passwordform.repassword.value){
        document.getElementById('popup').style.color = 'green';
        document.getElementById('popup').innerHTML = 'matching';
    }else {
        document.getElementById('popup').style.color = 'red';
        document.getElementById('popup').innerHTML = 'not matching';
    }
}


</script>

<?php 
           if(isset($_GET['alert']) && $_GET['alert']=='profilesuccess'){
            echo '<script> $(window).ready(proSuccess()); </script>';
          }
          if(isset($_GET['alert']) && $_GET['alert']=='profilefail'){
            echo '<script> $(window).ready(proFail()); </script>';
          }
          if(isset($_GET['alert']) && $_GET['alert']=='passsuccess'){
            echo '<script> $(window).ready(passSuccess()); </script>';
          }
          if(isset($_GET['alert']) && $_GET['alert']=='passfail'){
            echo '<script> $(window).ready(passFail()); </script>';
          }
          if(isset($_GET['alert']) && $_GET['alert']=='mismatched'){
            echo '<script> $(window).ready(mismatched()); </script>';
          }
?>


    </body>
</html>