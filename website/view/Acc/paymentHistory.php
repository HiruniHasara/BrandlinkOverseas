<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment History</title>
    <link rel="stylesheet" href="<?php echo URL; ?>public/css/Acc/table1.css">
    <link rel="stylesheet" href="<?php echo URL; ?>public/css/Acc/div3.css">
    <link rel="stylesheet" href="<?php echo URL; ?>public/css/Common/template.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
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
      <label for="check">
        <i class="fas fa-bars" id="sidebar_btn"></i>
      </label>
      <div class="left_area">
        <h3>BrandLink <span>Overseas</span></h3>
      </div>
      <div class="right_area">
        <a href="../Login/log" class="logout_btn">Logout</a>
      </div>
    </header>
    <!--header area end-->
    <!--mobile navigation bar start-->
    <div class="mobile_nav">
      <div class="nav_bar">
        <i class="fa fa-bars nav_btn"></i>
      </div>
      <div class="mobile_nav_items">
      <a href=""><i class="fas fa-home"></i><span>Home</span></a>
        <a href="history"><i class="fa fa-history"></i><span>Payment History</span></a>
        <a href="report"><i class="fa fa-book"></i><span>Report Generation</span></a>
        <a href="collection"><i class="fas fa-money-bill"></i><span>Payment by SE</span></a>
        <a href="settings"><i class="fas fa-sliders-h"></i><span>Settings</span></a>
      </div>
    </div>
    <!--mobile navigation bar end-->
    <!--sidebar start-->
    <div class="sidebar">
      <div class="profile_info">
      <img src=".././public/img/Profile pic.png" class="mobile_profile_image" width="100px" height="100px">
        <h4>Accountant</h4>
      </div>
        <a href="home"><i class="fas fa-home"></i><span>Home</span></a>
        <a href="history"><i class="fa fa-history"></i><span>Payment History</span></a>
        <a href="report"><i class="fa fa-book"></i><span>Report Generation</span></a>
        <a href="collection"><i class="fas fa-money-bill"></i><span>Payment by SE</span></a>
        <a href="settings"><i class="fas fa-sliders-h"></i><span>Settings</span></a>
    </div>
    <!--sidebar end-->

    <div class="content">
    <div class="clearfix">
      <div class ="topic">
          <h1>Payment History</h1>
      </div>
    
                <div class="tab">
                    <form method="post">
                        <button type="submit" name="date">By Date</button>
                        <button type="submit" name="dealer">By Dealer</button>
                        <button type="submit" name="paid">Paid</button>
                        <button type="submit" name="unpaid">Unpaid</button>   
                    </form>
                </div>
                  
              <div class="content1">
				          <table id="table1">
                    
                        <thead>
                            <tr>
                                <th>Dealer ID</th>
                                <th>Invoice NO</th>
                                <th>Order NO</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                          <?php
                            if($this->data!=0){
                              foreach($this->data as $values){
								          ?>
										
                                <tr>
                                <td><?php echo $values["DealerID"]; ?></td>
                                  <td>
                                    <?php
                                      foreach(explode(",", $values['InvoiceNo']) as $invoice){
                                        echo $invoice;
                                        echo '<br/>';
                                      }
                                    ?>
                                  </td>
                                  <td>
                                    <?php
                                      foreach(explode(",", $values['OrderID']) as $orderid){
                                        echo $orderid;
                                        echo '<br/>';
                                      }
                                    ?>
                                  </td>
                                  <td>
                                    <?php
                                      foreach(explode(",", $values['payment']) as $pay){
                                        echo $pay;
                                        echo '<br/>';
                                      }
                                    ?>
                                  </td>
                                  <td>
                                    <?php
                                      foreach(explode(",", $values['Status']) as $status){
                                        echo $status;
                                        echo '<br/>';
                                      }
                                    ?>
                                  </td>
                                  <td>
                                    <?php
                                      foreach(explode(",", $values['IssuedDate']) as $date){
                                        echo $date;
                                        echo '<br/>';
                                      }
                                    ?>
                                  </td>
                                </tr>
                          <?php  
                              }
                            } else { 
                              echo "Nothing";
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

  </body>
</html>