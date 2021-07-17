<!DOCTYPE html>
<html lang="en" dir="ltr">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Dealer_HomePage</title>
		<link rel="stylesheet" type="text/css" href="<?php echo URL; ?>public/css/Common/template.css">
        <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>public/css/Dealer/Dealerhome.css">
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
			<h1>Trending Items</h1>
        	<div class="contentIn">
				<?php
					if($this->data!=0){
						foreach($this->data as $values){
				?>
							<div class="card">
								<a href="details/<?php echo $values["ModelID"]; ?>">
									<img src="data:image/jpg;base64,<?php echo base64_encode( $values["Image"] ); ?>" style="width:100%"/>
								</a>	
								<h3><?php echo $values["Name"]; ?></h3>
								<div class="cart">
									<h3><?php echo $values["Price"]; ?></h3>
									<a href="details/<?php echo $values["ModelID"]; ?>">
										<button><i class="fa fa-shopping-cart" aria-hidden="true"></i> Shop Now</button> 
									</a>
								</div>
							</div>
				<?php 	}
					}else{
						echo "No trending items";
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
		</script>
	</body>
</html>

