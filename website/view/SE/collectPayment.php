<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Collected Payments</title>
    <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>public/css/OM/div3.css">
    <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>public/css/SE/form2.css">
    <script language="JavaScript" src="<?php echo URL; ?>public/js/collectPayment.js"></script>
    <link rel="stylesheet" href="<?php echo URL; ?>public/css/Common/template.css">
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
				<h1>Collected Payments</h1>
			</div>
		</div>
        
        
		<div class="form">
      <fieldset>
            <form id="payform" name="payform" action="pay" method="POST">
                <div class="row">
                    <div class="col-25">
                    <label for="invoice">Invoice No</label>
                    </div>
                    <div class="col-75">
                    <input type="text" id="invoice" name="InvoiceNo" value="<?=isset($this->value[0]['InvoiceNo']) ? $this->value[0]['InvoiceNo'] : '';?>">
                    <input type="submit" name="find" value="Find">
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                    <label for="id">Dealer id</label>
                    </div>
                    <div class="col-75">
                    <input type="text" id="id" name="deaerId" value="<?=isset($this->value[0]['DealerID']) ? $this->value[0]['DealerID'] : '';?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                    <label for="amount">Amount</label>
                    </div>
                    <div class="col-75">
                    
                    <input type="text" id="amount" name="amount" value="<?=isset($this->value[0]['total']) ? $this->value[0]['total'] : '';?>">
                   
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                    <label for="name">Dealer Name</label>
                    </div>
                    <div class="col-75">
                    <input type="text" id="name" name="name" value="<?=isset($this->value[0]['f_name']) ? $this->value[0]['f_name'] : '';?>">
                    </div>
                </div>
                <?php $month = date('m');
                        $day = date('d');
                        $year = date('Y');
                        $today = $year . '-' . $month . '-' . $day;
                  ?>
                <div class="row">
                    <div class="col-25">
                    <label for="date">Date</label>
                    </div>
                    <div class="col-75">
                    <input type="date" id="date" name="date" value="<?php echo $today; ?>">
                    <input type="checkbox" id="copy" name="check" value="1">
                    <label for="copy"> Send a copy to HOM</label>
                    </div>
                </div>
                
                <div class="row">
                <div class="lastbtn">
                    <input type="submit" name="update" value="Submit">
                    </div>
                </div>
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

if(isset($_GET['alert']) && $_GET['alert']=='fail'){
  echo '<script> $(window).ready(searchFail()); </script>';
}
if(isset($_GET['alert']) && $_GET['alert']=='paycopysuccess'){
  echo '<script> $(window).ready(payCopySuc()); </script>';
}
if(isset($_GET['alert']) && $_GET['alert']=='paycopyfail'){
  echo '<script> $(window).ready(payCopyFail()); </script>';
}
if(isset($_GET['alert']) && $_GET['alert']=='paysuccess'){
  echo '<script> $(window).ready(paySuc()); </script>';
}
if(isset($_GET['alert']) && $_GET['alert']=='payfail'){
  echo '<script> $(window).ready(payFail()); </script>';
}

?>
  </body>
</html>