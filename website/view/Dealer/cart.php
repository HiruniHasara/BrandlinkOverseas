<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Dealer_CartPage</title>
        <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>public/css/Common/template.css">
        <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>public/css/Dealer/cart.css">
		<link rel="stylesheet" type="text/css" href="<?php echo URL; ?>public/css/Common/alert.css">
		<script language="JavaScript" src="<?php echo URL; ?>public/js/cart.js"></script>
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
                <div class="column">
					<p>Shopping Cart</p>
					<table>
						<thead>
							<tr>
								<th style="width:25%">Iamge</th>
								<th style="width:35%">Name</th>
								<th style="width:20%">Price</th>
								<th style="width:20%">Quantity</th>
							</tr>
						</thead>
						<tbody>
                            <?php
								if($this->data!=0){
							
									$_SESSION['total']=0;
									foreach($this->data as $values){
										$_SESSION['total']=$_SESSION['total'] + ($values['details'][0]["Price"] * $values['Quantity']);
					        ?>
										<tr>
											<td><img src="data:image/jpg;base64,<?php echo base64_encode( $values['details'][0]["Image"] ); ?>" style="width:100%"/></td>
											<td>
												<?php echo $values['modelname'][0]["Name"]; ?><br/>
												Size: <?php echo $values['details'][0]["Size"]; ?>
											</td>
											<td><?php echo $values['details'][0]["Price"]; ?></td>
											<td>
												<i id="<?php echo $values['ItemID']; ?>" onclick="deleteItem(this)" class="fa fa-trash" aria-hidden="true"></i><br/>
												<button class="quantity"><?php echo $values['Quantity']; ?>  <i id="<?php echo $values['ItemID']; ?>" onclick="changeQuantity(<?php echo $values['Quantity']; ?>, <?php echo $values['details'][0]['Price']; ?>, this)" class="fas fa-sort"></i></button>
												<!-- <input type="number" name="quantity" onchange="displayabc()" min="0" max="1000" step="50" value="<?php echo $values['Quantity']; ?>"> -->
											</td>
										</tr>
                            <?php
                                	} 
								}else{
									$_SESSION['total']=0;
							?>
									<img class="empty" src="<?php echo URL; ?>public/img/empty-cart.png" />
									<a href="<?php echo URL; ?>Dealer/category"><p>Keep Shopping<p></a>
							<?php
								}
                            ?>
						</tbody>
					</table>
				</div>
				<div class="column">
					<p>Order Details</p>
					<form action="confirmOrder" method="post">
						<fieldset>
						<?php
							foreach($this->data2 as $values){
						?>
								<label>
									Name: <input type="text" name="name" size="50" value="<?php echo $values['f_name']; ?>" readonly>
								</label>
								<label>
									Address: <input type="text" name="address" size="50" value="<?php echo $values['address']; ?>" required>
								</label>
						<?php
							} 
						?>
							<input type='hidden' id='changeValue' name='var' value=0 />

							<input type='hidden' name="board" value=0>
                            <input type="checkbox" id="board" name="board" value=1 onclick="boardPopup()">
                            <label for="board"> 
                                <span>Display Board Order<span>
                            </label><br>
							<label>
								Total Amount: <input type="text" name="total" size="50" value="<?php echo $_SESSION['total']; ?>.00" readonly>
							</label>
							<input type="submit" value="Confirm Order"> 
						</fieldset>
                    </form>
                </div>
            </div>
            <div>
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
				echo '<script> $(window).ready(orderSuccess()); </script>';
			} 

			if(isset($_GET['alert']) && $_GET['alert']=='fail'){
				echo '<script> $(window).ready(orderFail()); </script>';
			}
		?>
    </body>
</html>

<!-- onChange="displayabc(value, '')" -->