<!DOCTYPE html>
<html lang="en" dir="ltr">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Price_ListPage</title>
		<link rel="stylesheet" href="<?php echo URL; ?>public/css/Common/template.css">
		<link rel="stylesheet" type="text/css" href="<?php echo URL; ?>public/css/SC/priceList.css">
		<link rel="stylesheet" type="text/css" href="<?php echo URL; ?>public/css/Common/alert.css">
		<script language="JavaScript" src="<?php echo URL; ?>public/js/priceList.js"></script>
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
				<div class="left">
					<div class="tab">
						<form action="priceList" method="post">
							<button type="submit" name="momali">Momali</button>
							<button type="submit" name="ferroli">Ferroli</button>
							<button type="submit" name="aquaflex">Aquaflex</button>
						</form>
					</div>
			 		<div class="bar">
						<label>
							<input type="text" id="search" name="id1" size="50" onkeyup="search()" placeholder="Search">
						</label>
					</div>
					<div class="contentIn">
						<table id="table1">
							<thead id="head">
								<tr>
									<th style="width:20%">Model ID</th>
									<th style="width:60%">Name</th>
									<th style="width:20%">Image</th>
								</tr>
							</thead>
							<tbody>
								<?php
									if($this->data!=0){
										$val=1;
										foreach($this->data as $values){
								?>
											<input type='hidden' id="modelid<?php echo $val ?>" name='var' value='<?php echo $values["ModelID"]; ?>'/>
											<input type='hidden' id="itemid<?php echo $val ?>" name='var' value='<?php echo $values["ItemID"]; ?>'/>
											<input type='hidden' id="size<?php echo $val ?>" name='var' value='<?php echo $values["Size"]; ?>'/>
											<input type='hidden' id="price<?php echo $val ?>" name='var' value='<?php echo $values["Price"]; ?>'/>
											
											<tr>
												<td><?php echo $values["ModelID"]; ?></td>
												<td><?php echo $values["Name"]; ?></td>
												<td><img src="data:image/jpg;base64,<?php echo base64_encode( $values['Image'] ); ?>" style="width:100%"/></td>
											</tr>
								<?php   
											$val++;	
										}
									} else { 
										echo "<script>document.getElementById('head').style.display = 'none';</script>";
								?>		
										<img id="nothing" src="<?php echo URL; ?>public/img/nomodels.jpg" style="width:100%"/>
							<?php	}
							?>	
							</tbody>
						</table>
					</div>
				</div>
                <div class="right">
					<div class="heading">
						<h3 id="displayid"></h3>
						<h3 id="displayname"></h3>
					</div>
					<div class="priceContent">
						<img id="empty" src="<?php echo URL; ?>public/img/nomodel.jpg" style="width:100%"/>
						<table id="myTable" class="priceTable">
	
						</table>
					</div>
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

			var length="<?php echo $this->data2; ?>";
			var table = document.getElementById('table1');
			var clickid="";
			for(var i = 1; i < table.rows.length; i++){

				table.rows[i].onclick = function(){
					document.getElementById('empty').style.display = 'none';
					clickid=this.cells[0].innerHTML;
					document.getElementById("displayid").innerHTML = this.cells[0].innerHTML;
					document.getElementById("displayname").innerHTML = this.cells[1].innerHTML;

					var Parent = document.getElementById("myTable");
					while(Parent.hasChildNodes()){
						Parent.removeChild(Parent.firstChild);
					}
			
					for(var j=1; j<=length; j++){
						if(document.getElementById("modelid"+j).value == clickid){
							var id=document.getElementById("itemid"+j).value.split(",");
							var size=document.getElementById("size"+j).value.split(",");
							var price=document.getElementById("price"+j).value.split(",");
							// var rowNo=0;
							for (var m = 0; m < id.length; m++) {
								var table = document.getElementById("myTable");
								var row = table.insertRow(0);
								var cell1 = row.insertCell(0);
								var cell2 = row.insertCell(1);
								var cell3 = row.insertCell(2);
								var cell4 = row.insertCell(3);
								
								cell1.innerHTML = id[m];
								cell2.innerHTML = size[m];
								cell3.innerHTML = `<input type="text" id='${m}' required>`;
								document.getElementById(m).setAttribute('value', price[m]);
								cell4.innerHTML = `<input type="submit" value="Update" onclick="update('${m}', '${id[m]}')">`+`<input type="reset" value="Cancel" onclick="reset('${m}', '${price[m]}')">`;
								// rowNo++;
							}
						}
					}
				};
			}
		</script>

		<?php 
			if(isset($_GET['alert']) && $_GET['alert']=='success'){
				echo '<script> $(window).ready(priceSuccess()); </script>';
			} 

			if(isset($_GET['alert']) && $_GET['alert']=='fail'){
				echo '<script> $(window).ready(priceFail()); </script>';
			}
			
			if(isset($_GET['alert']) && $_GET['alert']=='invalid'){
				echo '<script> $(window).ready(invalid()); </script>';
			}
		?>
  	</body>
</html>