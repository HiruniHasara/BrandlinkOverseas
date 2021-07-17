<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>StockPage</title>
        <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>public/css/Common/template.css">
		<link rel="stylesheet" type="text/css" href="<?php echo URL; ?>public/css/SC/stock.css">
		<link rel="stylesheet" type="text/css" href="<?php echo URL; ?>public/css/Common/alert.css">
		<script language="JavaScript" src="<?php echo URL; ?>public/js/stock.js"></script>
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
				<div class="tab">
					<form action="stock" method="post">
						<button type="submit" name="momali">Momali</button>
						<button type="submit" name="ferroli">Ferroli</button>
						<button type="submit" name="aquaflex">Aquaflex</button>
					</form>
				</div>
				<div class="bar">
					<label>
						<!-- Search: <input type="text" id="search" name="search" size="50" onkeyup="search()" > -->
						<input type="text" id="search" name="search" size="50" onkeyup="search()" placeholder="Search">
					</label>
				</div>
				<div class="details">
					<label>No. of models: <?php echo $this->data3[0]['count']; ?></lable>
					<label>No.of total items: <?php echo $this->data2; ?></label>
				</div>
				<div class="contentIn">
					<table  id="table1">
						<thead>
							<tr>
								<th style="width:15%">Model ID</th>
								<th style="width:40%">Name</th>
								<th style="width:15%">Item ID</th>
								<th style="width:15%">Size</th>
								<th style="width:15%">Quantity</th>
							</tr>
						</thead>
						<tbody>
							<?php
								if($this->data!=0){
									foreach($this->data as $values){
							?>
										<tr>
											<td><?php echo $values["ModelID"]; ?></td>
											<td><?php echo $values["Name"]; ?></td>
											<td><?php echo $values["ItemID"]; ?></td>
											<td><?php echo $values["Size"]; ?></td>
											<td class="align"><?php echo $values["Quantity"]; ?></td>
										</tr>
							<?php   }
								} else { 
									echo "No Items Found";
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