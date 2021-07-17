<!DOCTYPE html>
<html lang="en">
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
            <form action="<?php echo URL; ?>Login/passUpdate" method="POST" autocomplete="off">
                <h2 class="text-center">New Password</h2>
                    <div class="form-group">
                        <input class="form-control" type="password" name="password" placeholder="Create new password" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="password" name="cpassword" placeholder="Confirm your password" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control button" type="submit" name="change-password" value="Change">
                        <input type="hidden" name="id" value='<?= isset($this->id) ? $this->id : ''; ?>'>
                    </div>
                </form>
            </div>
        </div>
    </div>       
</body>
</html>