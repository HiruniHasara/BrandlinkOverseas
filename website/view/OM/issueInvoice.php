<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Issue Invoice</title>
    <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>public/css/OM/div3.css">
    <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>public/css/OM/split.css">
    <link rel="stylesheet" href="<?php echo URL; ?>public/css/Common/template.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" charset="utf-8"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.js"></script>
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
    <!-- <button type="submit" name="pdf" id="pdf">Download PDF</button>
    <div class="wrapper clearfix" id="html2pdf"> -->
    
      <div class ="topic">
      
      <form name="info" id="info" action="sendinvoice"  method="POST">
				<h1>Invoice</h1>
			</div>
    <!-- </div> -->
    
    
    

        <div class="clearfix">
            <div class="left">
              <!-- <div class="#">
                <h3>Brandlink Overseas Company</h3>
                <p>No 125/D, Kalalgoda, Pannipitiya, Sri Lanka</p>
                <p>0094(0)777282324</p>
                <p>branklink@slt.lk</p>
              </div>  -->
                <form>
                      <fieldset>
                      <?php
                      //if($this->data==1) {
                        foreach($this->value as $values){
                      ?>
                        <label>
                          Order ID: <input type="text" name="oid" size="50" value="<?php echo $values['OrderID']?>">
                        </label>
                        <label>
                          Ordered Date: <input type="text" name="odate" size="50" value="<?php echo $values['Date']?>">
                        </label>
                        <label>
                          Dealer Name: <input type="text" name="name" size="50" value="<?php echo $values['f_name']?>">
                        </label>
                        <label>
                          Address: <input type="text" name="address" size="50" value="<?php echo $values['address']?>">
                        </label>
                        <label>
                          Email: <input type="text" name="email" size="50" value="<?php echo $values['email']?>">
                        </label>
                        <label>
                          Telephone: <input type="text" name="tel" size="50" value="<?php echo $values['contact']?>">
                        </label>
                        <textarea name="body" style="display:none;">
                        <table border='1' style='border-collapse:collapse'>
                        <th style="width:25%">Item Name</th>
                        <th style="width:25%">Item Size</th>
                        <th style="width:25%">Quantity</th>
                        <th style="width:25%">Price</th>
                        
                        <?php

                        //if($this->data!=0){
                        foreach($this->data as $value){

                                      echo '<tr style="text-align:center"><td>'.$value["Name"].'</td>';
                                      echo '<td>'.$value["Size"].'</td>';	
                                      echo '<td>'.$value["Quantity"].'</td>';
                                      echo '<td>'.$value["Amount"].'</td></tr>';
  
                        }
                        //}

                        ?></table></textarea>
                        <label>
                          Total: <input type="text" name="total" size="50" value="<?php echo $values['TotalAmount']?>">
                        </label>
                        <div class="formbtn">
                          <input type="submit" name="invoice" value="Send Invoice">
                        </div>
                      <?php
                        }
                      //}
                      ?>
                      </fieldset>
                      <!-- </form> -->
                  
              </div>

            <div class="right">
                
                  <div class="content1">
                  <?php $month = date('m');
                        $day = date('d');
                        $year = date('Y');
                        $today = $year . '-' . $month . '-' . $day;
                  ?>
                  <input type="date" id="date" name="date" value="<?php echo $today; ?>">
                  
				            <table name="table1" id="table1">
                                <thead>
                                <tr>
                                  <th style="width:30%">Model ID</th>
                                  <th style="width:30%">Item Name</th>
                                  <th style="width:30%">Item Size</th>
                                  <th style="width:40%">Quantity</th>
                                  <th style="width:30%">Price</th>
                                </tr>
                              </thead>
                                <tbody>
                                <tr>	
                                  <?php

                                    //if($this->data!=0){
                                      foreach($this->data as $values){
                                      echo '<tr><td>'.$values["ModelID"].'</td>';
                                      echo '<td>'.$values["Name"].'</td>';
                                      echo '<td>'.$values["Size"].'</td>';	
                                      echo '<td>'.$values["Quantity"].'</td>';
                                      echo '<td>'.$values["Amount"].'</td>';
                                     
                                      
                                      }
                                    //}

                                  ?>
                                </tr>
                                       
                                </tbody>
                            </table> 
                            
                        </div>
                    </div>
                    </form>
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

    <!-- <script>
      window.onload = function(){
        document.getElementById("pdf").addEventListener("click",()=>{
          const invoice = this.document.getElementById("html2pdf");
          console.log(invoice);
          console.log(window);
          var opt = {
            // margin : 1,
            filename : "invoice.pdf",
            image: {type: 'jpeg', quantity: 0.98},
            html2canvas: {scale: 2},
            jsPDF: {unit: 'in', format: 'letter', orientation: 'portrait'}
          };
          html2pdf().from(invoice).set(opt).save();
        })
      }
    </script> -->

    <!-- <script>
      if(window.history.replaceState){
        window.history.replaceState(null, null, window.location.href);
      }
    </script> -->

  </body>
</html>