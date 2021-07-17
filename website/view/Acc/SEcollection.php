<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SE Collections</title>
    <link rel="stylesheet" href="<?php echo URL; ?>public/css/Acc/div3.css">
    <link rel="stylesheet" href="<?php echo URL; ?>public/css/Acc/acc.css">
    <link rel="stylesheet" href="<?php echo URL; ?>public/css/Common/template.css">
    <script language="JavaScript" src="<?php echo URL; ?>public/js/paymentConfirm.js"></script>
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
				<h1>Payment By SE</h1>
			</div>
		</div>
    
            <div class="clearfix">
              <div class="content1">
				        <table id="table1">
                    <thead>
                        <tr>
                            <th style="width:20%">Invoice NO.</th>
                            <th style="width:20%">Dealer</th>
                            <th style="width:20%">Amount</th>
                            <th style="width:20%">Date</th>
                            <th style="width:20%">Confirmation</th>
                        </tr>
                    </thead>
                    <tbody>

                         <?php
                         foreach($this->value as $values){
                            echo '<tr><td>'.$values["InvoiceNo"].'</td>';	
                            echo '<td>'.$values["f_name"].'</td>';
                            
                            foreach($this->date  as $date){
                              if($date['InvoiceNo']==$values['InvoiceNo']){
                                if($date['diff']>90){
                                  echo '<td>'.$values["Amount"].'</td>';
                                }else{
                                  echo '<td>'.$values["Discount"].'</td>';
                                }
                              }
                            }
	
                            echo '<td>'.$values["PaymentDate"].'</td>'; ?>
                            <td><button id="<?php echo $values["InvoiceNo"]?>" onclick="confirmPayment(this)"><i class="fas fa-check"></i>Confirm</i></button></td>
                            </tr>
                            <?php
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
       function confirmPayment(clickedbutton){
    // var itemid = document.getElementById('delete').value;
  var ino=clickedbutton.id;
  swal({
    title: "Are you sure?",
    text: "This action will confirm this payment is complete.",
    buttons: true,
    dangerMode: true,
    closeOnClickOutside: false,
})
.then((willUpdate) => {
    if (willUpdate) {
        window.location.assign("confirmPayment/"+ino);
    }
});
}
    </script>

<?php

if(isset($_GET['alert']) && $_GET['alert']=='success'){
  echo '<script> $(window).ready(paymentSuccess()); </script>';
}
if(isset($_GET['alert']) && $_GET['alert']=='fail'){
  echo '<script> $(window).ready(paymentFail()); </script>';
}
?>

  </body>
</html>