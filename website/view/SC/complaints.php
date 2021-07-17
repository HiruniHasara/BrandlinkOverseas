<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>ComplaintsPage</title>
        <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>public/css/Common/template.css">
        <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>public/css/SC/complaints.css">
        <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>public/css/Common/alert.css">
        <script language="JavaScript" src="<?php echo URL; ?>public/js/scComplaint.js"></script>
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
            <h3>Complaints</h3>
            <div class="clearfix">
                <div class="bar">
                    <?php
                        if($this->data2!=0){
                            $orderin=0;
                            $servicein=0;
                            $otherin=0;
                            foreach($this->data2 as $values2){
                                if($values2['Type']=='order complaint'){
                                    $orderin=1;
                    ?>
                                    <a href="#order"><button type="submit" name="order">Order Complaints - <?php echo $values2['Count']; ?></button></a>
                    <?php       }
                            }
                            if($orderin==0){ 
                    ?>
                                <a href="#order"><button type="submit" name="order">Order Complaints - 0</button></a>
                    <?php   }

                            foreach($this->data2 as $values2){
                                if($values2['Type']=='service complaint'){
                                    $servicein=1;
                    ?>
                                    <a href="#service"><button type="submit" name="service">Service Complaints - <?php echo $values2['Count']; ?></button></a>
                    <?php       }
                            }
                            if($servicein==0){ 
                    ?>
                                <a href="#service"><button type="submit" name="service">Service Complaints - 0</button></a>
                    <?php   }

                            foreach($this->data2 as $values2){
                                if($values2['Type']=='other'){
                                    $otherin=1;
                    ?>
                                    <a href="#other"><button type="submit" name="other">Other - <?php echo $values2['Count']; ?></button></a>
                    <?php       }
                            }
                            if($otherin==0){ 
                    ?>
                                    <a href="#other"><button type="submit" name="other">Other - 0</button></a>
                    <?php   }
                        }
                    ?>
                </div>
                <div class="contentIn">
                    <?php
                        if($this->data!=0){
                            foreach($this->data2 as $values2){
                                if($values2['Type']=='order complaint' && $values2['Count']>0){
                    ?>
                                    <h4 id="order">Order Complaints</h4>
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th style="width:15%">Dealer ID</th>
                                                    <th style="width:40%">Complaint</th>
                                                    <th style="width:35%">Photo</th>
                                                    <th style="width:10%">Option</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    foreach($this->data as $values){
                                                        if($values["Type"]=="order complaint"){
                                                ?>
                                                            <tr>
                                                                <td><?php echo $values['DealerID']; ?></td>
                                                                <td><?php echo $values['Complaint']; ?></td>
                                                                <td>
                                                            <?php   if($values['Photo'] != ""){ ?>
                                                                        <a href="data:image/jpg;base64,<?php echo base64_encode( $values['Photo'] ); ?>" download>
                                                                            <img src="data:image/jpg;base64,<?php echo base64_encode( $values['Photo'] ); ?>" style="width:25%"/>
                                                                        </a>
                                                            <?php   }else{
                                                                        echo "-";
                                                                    } ?>  
                                                                </td>
                                                                <td><button onclick="forward(<?php echo $values['ComplaintID']; ?>, <?php echo $values['DealerID']; ?>)"><i class="fa fa-arrow-right" aria-hidden="true"></i>Forward to SE</button></td>
                                                            </tr>
                                                <?php 
                                                        }
                                                    }  
                                                ?>
                                            </tbody>
                                        </table>
                                        <br/>
                        <?php   } 
                            }
                        ?>

                        <?php
                            foreach($this->data2 as $values2){
                                if($values2['Type']=='service complaint' && $values2['Count']>0){
                        ?>
                                    <h4 id="service">Service Complaints</h4>
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th style="width:15%">Dealer ID</th>
                                                    <th style="width:40%">Complaint</th>
                                                    <th style="width:35%">Photo</th>
                                                    <th style="width:10%">Option</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    foreach($this->data as $values){
                                                        if($values["Type"]=="service complaint"){
                                                ?>
                                                            <tr>
                                                                <td><?php echo $values['DealerID']; ?></td>
                                                                <td><?php echo $values['Complaint']; ?></td>
                                                                <td>
                                                            <?php   if($values['Photo'] != ""){ ?>
                                                                        <a href="data:image/jpg;base64,<?php echo base64_encode( $values['Photo'] ); ?>" download>
                                                                            <img src="data:image/jpg;base64,<?php echo base64_encode( $values['Photo'] ); ?>" style="width:25%"/>
                                                                        </a>
                                                            <?php   }else{
                                                                        echo "-";
                                                                    } ?>  
                                                                </td>
                                                                <td><a href="notify"><button><i class="fas fa-envelope"></i> Notify</button></a></td>
                                                            </tr>
                                                <?php 
                                                        }
                                                    }  
                                                    
                                                ?>
                                            </tbody>
                                        </table>
                                        <br/>
                        <?php   } 
                            } 
                        ?>

                        <?php
                            foreach($this->data2 as $values2){
                                if($values2['Type']=='other' && $values2['Count']>0){
                        ?>
                                    <h4 id="other">Other</h4>
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th style="width:15%">Dealer ID</th>
                                                    <th style="width:40%">Complaint</th>
                                                    <th style="width:35%">Photo</th>
                                                    <th style="width:10%">Option</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    foreach($this->data as $values){
                                                        if($values["Type"]=="other"){
                                                ?>
                                                            <tr>
                                                                <td><?php echo $values['DealerID']; ?></td>
                                                                <td><?php echo $values['Complaint']; ?></td>
                                                                <td>
                                                            <?php   if($values['Photo'] != ""){ ?>
                                                                        <a href="data:image/jpg;base64,<?php echo base64_encode( $values['Photo'] ); ?>" download>
                                                                            <img src="data:image/jpg;base64,<?php echo base64_encode( $values['Photo'] ); ?>" style="width:25%"/>
                                                                        </a>
                                                        <?php   }else{
                                                                        echo "-";
                                                                    } ?>  
                                                                </td>
                                                                <td><a href="notify"><button><i class="fas fa-envelope"></i> Notify</button></a></td>
                                                            </tr>
                                                <?php 
                                                        }
                                                    }    
                                                ?>
                                            </tbody>
                                        </table>
                    <?php 
                                } 
                            }
                        } else { ?>
                            <img id="nothing" src="<?php echo URL; ?>public/img/nocomplaint.png" style="width:100%"/>
                    <?php    }
                    ?>
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

        <?php
            if(isset($_GET['alert']) && $_GET['alert']=='fail'){
				echo '<script> $(window).ready(forwardFail()); </script>';
			}
        ?>
    </body>
</html>