<!DOCTYPE html>
<html lang="en" dir="ltr">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Dealer_ItemDetailsPage</title>
		<link rel="stylesheet" href="<?php echo URL; ?>public/css/Common/template.css">
		<link rel="stylesheet" href="<?php echo URL; ?>public/css/Dealer/itemDetails.css">
		<script language="JavaScript" src="<?php echo URL; ?>public/js/itemdetails.js"></script>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
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
			<div class="clearfix">
				<?php
					if($this->data!=0){
				?>
					<input type='hidden' id='modelid' name='var' value='<?php echo $this->data[0]["ModelID"]; ?>'/>
					<div class="left">
						<div class="bar">
							<a href="<?php echo URL; ?>Dealer/momali"><button type="submit" name="momali">Momali</button></a>
							<a href="<?php echo URL; ?>Dealer/ferroli"><button type="submit" name="ferroli">Ferroli</button></a>
							<a href="<?php echo URL; ?>Dealer/aquaflex"><button type="submit" name="aquaflex">Aquaflex</button></a>
						</div>
						<img id="leftimg" src="data:image/jpg;base64,<?php echo base64_encode( $this->data[0]["Image"] ); ?>" width=60% height=250px/>
					</div>
					<div class="right">
						<h2><?php echo $this->data2[0]["Name"]; ?></h2>
						<p id="price" class="price"><?php echo $this->data[0]["Price"]; ?></p>
						<p>Size:</p>
						<div id="item" class="item">
							<?php
								$var=0;
								foreach($this->data as $values){
									$var++;
									if($var==1){
							?>
										<button class="btn active" id="<?php echo $values['ItemID'] ?>" onclick="changeView(this, 'data:image/jpg;base64,<?php echo base64_encode($values['Image']); ?>', <?php echo $values['Price']; ?>)"><?php echo $values["Size"]; ?></button>
										<?php continue; ?>
							<?php 	
									} 	
							?>
									<button class="btn" id="<?php echo $values['ItemID'] ?>" onclick="changeView(this, 'data:image/jpg;base64,<?php echo base64_encode($values['Image']); ?>', <?php echo $values['Price']; ?>)"><?php echo $values["Size"]; ?></button>	
							<?php
								}
							?>
						</div>
						<p>Quantity:</p>
						<input type="number" id="quantity" name="quantity" min="1" max="1000" step="1" value="1"><br/>

						<button class="cartbtn" type="submit" name="addCart" onclick="addCart()"><i class="fa fa-cart-plus" aria-hidden="true"></i> Add to Cart</button>
					</div>
				<?php   
					} else { 
						echo "No Items Found";
					}
				?>
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

			var header = document.getElementById("item");
			var btns = header.getElementsByClassName("btn");
			for (var i = 0; i < btns.length; i++) {
				btns[i].addEventListener("click", function() {
				var current = document.getElementsByClassName("active");
				current[0].className = current[0].className.replace(" active", "");
				this.className += " active";
				});
			}

			function addCart(){
				var modelid = document.getElementById("modelid").value;
				var itemid = document.getElementsByClassName("active")[0].id;
				var quantity = document.getElementById("quantity").value;
				window.location.assign("<?php echo URL; ?>Dealer/addtoCart/"+modelid+"/"+itemid+"/"+quantity);
			}
		</script>
	</body>
</html>