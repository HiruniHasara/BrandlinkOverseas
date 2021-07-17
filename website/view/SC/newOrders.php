<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>New_OrdersPage</title>
        <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>public/css/Common/template.css">
        <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>public/css/SC/newOrders.css">
        <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>public/css/Common/alert.css">
		    <script language="JavaScript" src="<?php echo URL; ?>public/js/neworders.js"></script>
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
            <h3>New Orders</h3>
            <div class="clearfix">
                <table>
                    <thead id="head">
                        <tr>
                            <th style="width:10%">Order NO.</th>
                            <th style="width:10%">Dealer ID</th>
                            <th style="width:40%">Items</th>
                            <th style="width:10%">Quantity</th>
                            <th style="width:10%">Availability</th>
                            <th class="align" style="width:20%">Options</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
									      if($this->data!=0){
                          $num=0;
		  								    foreach($this->data as $values){
                            $itemcount=0;
								    ?>
                            <tr>
                                <td><?php echo $values['OrderID']; ?></td>
                                <td><?php echo $values['DealerID']; ?></td>
                                <td class="cross">
                                  <?php
                                    $id=explode(",", $values['ItemID']);
                                    $var=0;
                                    foreach(explode(",", $values['modelname']) as $names){ 
                                  ?>
                                        <span id="<?php echo $values['OrderID']; ?><?php echo $id[$var]; ?>">
                                  <?php
                                          echo $names;
                                          echo " - "; 
                                          echo $id[$var];
                                  ?></span>
                                        <i id="<?php echo $id[$var]; ?>" onclick="unavailable(this, <?php echo $values['OrderID']; ?>, <?php echo $num; ?>, <?php echo $values['DealerID']; ?>)" onmouseover="hoverIn(this, <?php echo $values['OrderID']; ?>)" onmouseout="hoverOut(this, <?php echo $values['OrderID']; ?>)" class="fa fa-times-circle" aria-hidden="true"></i>
                                        <br/>
                                  <?php
                                        $var++;
                                    }
                                  ?>
                                </td> 
                                <td>
                                  <?php
                                    foreach(explode(",", $values['Quantity']) as $quantity){
                                      $itemcount++;
                                      echo $quantity;
                                      echo '<br/>';
                                    }
                                  ?>
                                  <input type="hidden" id="<?php echo $num; ?>,<?php echo $values['OrderID']; ?>" value="<?php echo $itemcount; ?>" >
                                </td>
                                <td>
                                  <?php
                                    $availability=0;
                                    $unavailability=0;
                                    $stockquantity=explode(",", $values['stockquantity']);
                                    $needquantity=explode(",", $values['Quantity']);
                                    $i=0;

                                    foreach(explode(",", $values['ItemID']) as $itemid){
                                      if($itemid != "DB"){
                                        $check=0;
                                        if($this->data2!=0){

                                          foreach($this->data2 as $values2){
                                            if($itemid==$values2['ItemID']){
                                              if( ($stockquantity[$i] - ($values2['tobeIssued']+$needquantity[$i])) >= 0 ){
                                                echo "Available";
                                                echo '</br>';
                                                $check=1;
                                                $availability=1;
                                                break;
                                              }else{
                                                echo "Unvailable";
                                                echo '</br>';
                                                $check=1;
                                                $unavailability=1;
                                                break;
                                              }
                                            }
                                          }
                                          if($check==1){
                                            $i++;
                                            continue;
                                          }else{
                                            if( ($stockquantity[$i] - $needquantity[$i]) >= 0){
                                              echo "Available";
                                              $availability=1;
                                              echo '</br>';
                                            }else{
                                              echo "Unavailable";
                                              $unavailability=1;
                                              echo '</br>';
                                            }
                                            $i++;
                                          }

                                        }else{
                                          if( ($stockquantity[$i] - $needquantity[$i]) >= 0){
                                            echo "Available";
                                            $availability=1;
                                            echo '</br>';
                                          }else{
                                            echo "Unavailable";
                                            $unavailability=1;
                                            echo '</br>';
                                          }
                                          $i++;
                                        } 
                                      }else{
                                        echo "Available";
                                        $availability=1;
                                        echo '</br>';
                                      }
                                    }
                                  ?>
                                  <input type="hidden" id="<?php echo $values['OrderID']; ?>" value="<?php echo $unavailability; ?>" >
                                  <input type="hidden" id="<?php echo $num; ?>" value="<?php echo $availability; ?>" >
                                </td>
                                <td>
                                  <div class="option">
                                    <button onclick="forwardOrder(<?php echo $values['OrderID']; ?>, <?php echo $this->data3[$num]['deletecount']; ?>)"><i class="fa fa-arrow-right" aria-hidden="true"></i>Forward</button>
                                    <button onclick="deleteOrder(<?php echo $values['OrderID']; ?>, <?php echo $num; ?>, <?php echo $values['DealerID']; ?>)"><i class="fa fa-trash" aria-hidden="true"></i>Delete</button>
                                    <button onclick="message(<?php echo $values['OrderID']; ?>, <?php echo $values['DealerID']; ?>, <?php echo $this->data3[$num]['deletecount']; ?>)" class="btnfloat"><i class="fa fa-envelope" aria-hidden="true"></i>Message</button>
                                  </div>
                                </td>
                            </tr>
                    <?php 
                            $num++;
                          }
                        }else{
                    ?>
                          <script>document.getElementById('head').style.display = 'none';</script>
                          <img id="nothing" src="<?php echo URL; ?>public/img/noorders.png" style="width:100%"/>
                    <?php }  
                    ?>  
                    </tbody>
                </table>
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
                echo '<script> $(window).ready(forwardSuccess()); </script>';
            } 

            if(isset($_GET['alert']) && $_GET['alert']=='fail'){
                echo '<script> $(window).ready(forwardFail()); </script>';
            }

            if(isset($_GET['alert']) && $_GET['alert']=='removefail'){
              echo '<script> $(window).ready(removeFail()); </script>';
            }

            if(isset($_GET['alert']) && $_GET['alert']=='deletesuccess'){
              echo '<script> $(window).ready(deleteSuccess()); </script>';
            } 

            if(isset($_GET['alert']) && $_GET['alert']=='deletefail'){
                echo '<script> $(window).ready(deleteFail()); </script>';
            }
		    ?>
    </body>
</html>