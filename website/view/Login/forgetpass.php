<html>
<head>
    <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>public/css/Common/reset.css">
    <script language="JavaScript" src="<?php echo URL; ?>public/js/resetpass.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<body>
    <style>
		body {
  		background-image: url("<?php echo URL; ?>public/img/loginback.jpg");
  		background-size: cover;
  		background-position: top center;
  		}
	</style>
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4 form">
                <form action="checkmail" method="POST" autocomplete="">
                    <h2 class="text-center">Forgot Password</h2>
                    <p class="text-center">Enter your email address</p>
                    <div class="form-group">
                        <input class="form-control" type="email" name="email" placeholder="Enter email address">
                    </div>
                    <div class="form-group">
                        <input class="form-control button" id="btn" type="submit" name="check-email" value="Continue">
                    </div>
                </form>
            </div>
        </div>
    </div>
    

    
</body>
<?php 
	if(isset($_GET['alert']) && $_GET['alert']=='noMail'){
	    echo '<script> $(window).ready(MailNot()); </script>';
	} 

	?>
  </body>
</html>