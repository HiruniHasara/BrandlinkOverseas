<!DOCTYPE html>
<html lang="en" dir="ltr">
	<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Dealer_OrderHistoryPage</title>
		<link rel="stylesheet" type="text/css" href="<?php echo URL; ?>public/css/Common/template.css">
        <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>public/css/Dealer/orderHistory.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" charset="utf-8"></script>
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
            <h3>Order History</h3>
        	<div class="clearfix">
                <div class="bar">
                    <?php
                        if($this->data2!=0){
                            $ongoingin=0;
                            $count=0;
                            foreach($this->data2 as $values2){
                                if($values2['Status']=='Ordered' OR $values2['Status']=='Pending' OR $values2['Status']=='Approved'){
                                    $ongoingin=1;
                                    $count=$count+$values2['Count'];
                                }
                            }
                            if($ongoingin==0){ 
                    ?>
                                <a href="#ongoing"><button type="submit" name="ongoing">Ongoing Orders -  0</button></a>
                    <?php   }else{ ?>
                                <a href="#ongoing"><button type="submit" name="ongoing">Ongoing Orders - <?php echo $count; ?></button></a>
                    <?php   }
                        }else{
                    ?>
                            <a href="#ongoing"><button type="submit" name="ongoing">Ongoing Orders -  0</button></a>
                    <?php        
                        }
                    ?>

                    <?php
                        if($this->data3!=0){
                            $unpaidin=0;
                            $paidin=0;
                            foreach($this->data3 as $values3){
                                if($values3['Status']=='Not Paid'){
                                    $unpaidin=1;
                    ?>
                                    <a href="#unpaid"><button type="submit" name="unpaid">Unpaid Orders - <?php echo $values3['Count']; ?></button></a>
                    <?php       }
                            }
                            if($unpaidin==0){ 
                    ?>
                                <a href="#unpaid"><button type="submit" name="unpaid">Unpaid Orders - 0</button></a>
                    <?php   }

                            foreach($this->data3 as $values3){
                                if($values3['Status']=='Paid'){
                                    $paidin=1;
                    ?>
                                    <a href="#paid"><button type="submit" name="paid">Paid Orders - <?php echo $values3['Count']; ?></button></a>
                    <?php       }
                            }
                            if($paidin==0){ 
                    ?>
                                <a href="#paid"><button type="submit" name="paid">Paid Orders - 0</button></a>
                    <?php   }
                        }else{
                    ?> 
                            <a href="#unpaid"><button type="submit" name="unpaid">Unpaid Orders - 0</button></a>
                            <a href="#paid"><button type="submit" name="paid">Paid Orders - 0</button></a>
                    <?php }
                    ?>
                </div>
                <div class="contentIn">
                    <?php
                        if($this->data!=0){
                            if($this->data2[0]['Count']>0 OR $this->data2[1]['Count']>0 OR $this->data2[3]['Count']>0){
                    ?>
                            <h4 id="ongoing">Ongoing Orders</h4>
                                <table>
                                    <thead>
                                        <tr>
                                            <th style="width:10%">Order NO.</th>
                                            <th style="width:50%">Items</th>
                                            <th style="width:15%">Quantity</th>
                                            <th style="width:15%">Amount</th>
                                            <th style="width:10%">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            foreach($this->data as $values){
                                                if($values["Status"]=="Ordered" OR $values["Status"]=="Pending" OR $values["Status"]=="Approved"){
                                        ?>
                                                    <tr>
                                                        <td><?php echo $values['OrderID']; ?></td>
                                                        <td>
                                                            <?php
                                                                $id=explode(",", $values['ItemID']);
                                                                $var=0;
                                                                foreach(explode(",", $values['modelname']) as $names){
                                                                    echo $names;
                                                                    echo " - "; 
                                                                    echo $id[$var];
                                                                    echo '<br/>';
                                                                    $var++;
                                                                }
                                                            ?>
                                                        </td>
                                                        <td class="alignment">
                                                            <?php
                                                                foreach(explode(",", $values['Quantity']) as $quantity){
                                                            ?>
                                                                    <?php echo $quantity; ?><br/>
                                                            <?php
                                                                }
                                                            ?>
                                                        </td>
                                                        <td class="alignment"><?php echo $values['TotalAmount']; ?></td>
                                                        <td><?php echo $values['Status']; ?></td>
                                                    </tr>
                                        <?php 
                                                }
                                            }  
                                        ?>
                                    </tbody>
                                </table>
                                <br/>
                    <?php  }   ?>

                        <?php
                            if($this->data3[0]['Count']>0){
                        ?>
                            <h4 id="unpaid">Unpaid Orders</h4>
                                <table>
                                    <thead>
                                        <tr>
                                            <th style="width:10%">Order NO.</th>
                                            <th style="width:10%">Invoice NO.</th>
                                            <th style="width:30%">Items</th>
                                            <th style="width:10%">Quantity</th>
                                            <th style="width:10%">Amount</th>
                                            <th style="width:10%">Discount</th>
                                            <th style="width:10%">Discount dueDate</th>
                                            <th style="width:10%">Pay now</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            foreach($this->data as $values){
                                                if($values["Status"]=="Not Paid"){
                                        ?>
                                                    <tr>
                                                        <td><?php echo $values['OrderID']; ?></td>
                                                        <td><?php echo $values['InvoiceNo']; ?></td>
                                                        <td>
                                                            <?php
                                                                $id=explode(",", $values['ItemID']);
                                                                $var=0;
                                                                foreach(explode(",", $values['modelname']) as $names){
                                                                    echo $names;
                                                                    echo " - "; 
                                                                    echo $id[$var];
                                                                    echo '<br/>';
                                                                    $var++;
                                                                }
                                                            ?>
                                                        </td>
                                                        <td class="alignment">
                                                            <?php
                                                                foreach(explode(",", $values['Quantity']) as $quantity){
                                                            ?>
                                                                    <?php echo $quantity; ?><br/>
                                                            <?php
                                                                }
                                                            ?>
                                                        </td>
                                                        <td class="alignment"><?php echo $values['TotalAmount']; ?></td>
                                                        <td><?php echo $values['Discount']; ?></td>
                                                        <td><?php echo $values['Discountdue']; ?></td>
                                                        <td><a href="#"><button class="btn"><i class="fa fa-money" aria-hidden="true"></i> Pay Now</button></a></td>
                                                    </tr>
                                        <?php 
                                                }
                                            }  
                                            
                                        ?>
                                    </tbody>
                                </table>
                                <br/>
                    <?php } ?>

                        <?php
                            if($this->data3[1]['Count']>0){
                        ?>
                            <h4 id="paid">Paid Orders</h4>
                                <table>
                                    <thead>
                                        <tr>
                                            <th style="width:10%">Order NO.</th>
                                            <th style="width:10%">Invoice NO.</th>
                                            <th style="width:50%">Items</th>
                                            <th style="width:15%">Quantity</th>
                                            <th style="width:15%">Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            foreach($this->data as $values){
                                                if($values["Status"]=="Paid"){
                                        ?>
                                                    <tr>
                                                        <td><?php echo $values['OrderID']; ?></td>
                                                        <td><?php echo $values['InvoiceNo']; ?></td>
                                                        <td>
                                                            <?php
                                                                $id=explode(",", $values['ItemID']);
                                                                $var=0;
                                                                foreach(explode(",", $values['modelname']) as $names){
                                                                    echo $names;
                                                                    echo " - "; 
                                                                    echo $id[$var];
                                                                    echo '<br/>';
                                                                    $var++;
                                                                }
                                                            ?>
                                                        </td>
                                                        <td class="alignment">
                                                            <?php
                                                                foreach(explode(",", $values['Quantity']) as $quantity){
                                                            ?>
                                                                    <?php echo $quantity; ?><br/>
                                                            <?php
                                                                }
                                                            ?>
                                                        </td>
                                                        <td class="alignment"><?php echo $values['TotalAmount']; ?></td>
                                                    </tr>
                                        <?php 
                                                }
                                            }    
                                        ?>
                                    </tbody>
                                </table>
                    <?php 
                            } 
                        } else {
                    ?>
                            <img id="history" class="history" src="<?php echo URL; ?>public/img/history.png" style="width:100%"/> 
                    <?php
                        }
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
	</body>
</html>