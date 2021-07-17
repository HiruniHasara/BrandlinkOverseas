<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Orders</title>
    <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>public/css/OM/div3.css">
	<link rel="stylesheet" type="text/css" href="<?php echo URL; ?>public/css/SE/form1.css">
    <link rel="stylesheet" href="<?php echo URL; ?>public/css/Common/template.css">
    <script language="JavaScript" src="<?php echo URL; ?>public/js/newOrders.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
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
    <header>
          <?php require_once(realpath(dirname(__FILE__) . '/../Common/header.php'));?>
    </header>
    <!--header area end-->
    <?php include 'navBar.php';?>

    <div class="content">
	<div class="wrapper clearfix">
            <div class ="topic">
				<h1>New Orders</h1>
			</div>
		</div>
		
	<div class="wrapper clearfix">
    <table id=table>
      <tr>
        <div class="form">
            <form action="orderform" name="form" method="POST" enctype="multipart/form-data">
            <label> Dealer ID: <input id="dId" type="text" name="dId" value="<?=isset($this->datas[0]['u_id']) ? $this->datas[0]['u_id'] : '';?>">
            <input type="submit" name="retrive" value="Find"></input>
            </label> 
            <br>
            <label> Name: <input id="name" type="text" name="name" size="50" value="<?=isset($this->datas[0]['f_name']) ? $this->datas[0]['f_name'] : '';?>"></label> 
            <label> Address: <input id="address" type="text" name="adress" size="50" value="<?=isset($this->datas[0]['address']) ? $this->datas[0]['address'] : '';?>"></label> 
            <label> Total: <input id="sum" type="text" name="sum" readonly>
            <input type="submit" name="checkout" value="Place Order"></input>
            </label> 
          <div class="bar">
				 	<div class="f1">
					 	<input type=button id="momali" name="momali" value="Momali"></input>
						<input type=button id="ferroli" name="ferroli" value="Ferroli"></input>
						<input type=button id="aqua" name="aqua" value="Aquaflex"></input>
            <input type=button id="all" name="all" value="All"></input>
					</div>
          </div>
        
            
                <div class="wrapper clearfix">
                
                    <table id="table1">
                    
                                <tbody id="stock">
                                <div class="contentIn">
                                
                                <label>
                                  Search for Item: <input type="text" name="input" id="input" onkeyup="search()">
                                </label>
                               
    </tr>                               	
                                        <?php

                                        //if($this->data!=0){
                                            foreach($this->data as $values){
                                        ?>
                                       
                                       <tr>
                                            <td style="width:5%"> 
                                                <input type="checkbox" id="box" name="chk1[]" class="label" value="<?php echo $values['ItemID']?>">
                                            </td>
                                            <td style="width:5%">
                                                <label for="box" disabled>ID<?php echo $values["ItemID"]; ?></label>
                                            </td>
                                            <td style="display:none";>
                                                <label for="box" name="modelid" id="modelid"><?php echo $values["ModelID"]; ?></label>
                                            </td>
                                            <td style="width:5%">
                                                <label for="box" name="itemname" id="itemname"><?php echo $values["Name"]; ?></label>
                                            </td>
                                            <td style="display:none";>
                                                <label for="box" name="cat" id="cat"><?php echo $values["Category"]; ?></label>
                                            </td>
                                            <td style="width:5%">
                                                <label for="box"><?php echo $values["Size"]; ?></label>
                                            </td>
                                            <td style="width:30%">
                                                <input type="text" name="price" id="price" class="price" value="<?php echo $values["Price"]; ?>" size="70" readonly></input>
                                            </td>
                                            <td style="width:5%">
                                                <input type="number" id="quantity" name="number[]" class="quantity" min="0" step="5" onchange= "add_to_total(this)" disabled>
                                            </td>
                                            <td style="width:15%">
                                              <img id="file" name ="file" id="file" width="50px" height="50px" value= <img src="data:image/jpg;base64,<?php echo base64_encode($values["Image"])?>">
                                            </td>
                                            <td style="width:30%">
                                                <input type="text" name="total" id="total" class="total" size="80" onchange="calculateSum(this)" readonly></input>
                                            </td>
                                          
                                    </div>
                                        <?php    
                                            //}
                                        }

                                        ?>
                                        </tr>
                                
                                    </tbody>
                                      </table>
                  
                
                </div>
           
           
              </form> 
                       
                   
            
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

<script>
  $("#momali").click(function () {
    var rows = $("#stock").find("tr").hide();
    rows.filter(":contains('Momali')").show();
 });
 $("#ferroli").click(function () {
    var rows = $("#stock").find("tr").hide();
    rows.filter(":contains('Ferroli')").show();
 });
 $("#aqua").click(function () {
    var rows = $("#stock").find("tr").hide();
    rows.filter(":contains('Aquaflex')").show();
 });
 $("#all").click(function () {
    var rows = $("#stock").find("tr").hide();
    rows.filter(":contains('Aquaflex')").show();
    rows.filter(":contains('Momali')").show();
    rows.filter(":contains('Ferroli')").show();
 });
</script>

<script>
			$(document).ready(function(){
				$("#input").on("keyup", function() {
					var value = $(this).val().toLowerCase();
					$("#table1 tr").filter(function() {
					$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
					});
				});
			});

  function add_to_total(el){
  var parent = $(el).closest('tr');
  var price = parent.find('.price').val() == "" ? 1 : parent.find('.price').val();
  var qty = parent.find('.quantity').val() == "" ? 1 : parent.find('.quantity').val();
  var total = price * qty;
  parent.find('.total').val(total);

  calculateSum();
}
  //enable/disable all except checkboxes, based on the row is checked or not
  $('tr td:first-child input[type="checkbox"]').click( function() {
   $(this).closest('tr').find(":input:not(:first)").attr('disabled', !this.checked);

});

//empty the input fields when the checkbox checked is
  $('.label').change(function(){
    var isChecked = this.checked;
    if(!isChecked) {
        $(this).parents("tr:eq(0)").find(".quantity").val('');
        $(this).parents("tr:eq(0)").find(".total").val('');

        calculateSum();       
    }
  });

  $(document).ready(function () {
            //iterate through each textboxes and add keyup
            //handler to trigger sum event
            $(".total").each(function () {
                $(".total").change(function () {
                    calculateSum();
                });
            });
        });

        function calculateSum() {
            var sum = 0;
            //iterate through each textboxes and add the values
            $(".total").each(function () {
                //add only if the value is number
                if (!isNaN($(this).val()) && $(this).val().length != 0) {
                    sum += parseFloat(this.value);
                }
            });
            $("#sum").val(sum);
        }
</script> 

<?php

if(isset($_GET['alert']) && $_GET['alert']=='success'){
  echo '<script> $(window).ready(orderSuccess()); </script>';
}
if(isset($_GET['alert']) && $_GET['alert']=='fail'){
  echo '<script> $(window).ready(orderFail()); </script>';
}
if(isset($_GET['alert']) && $_GET['alert']=='searchFail'){
  echo '<script> $(window).ready(searchFail()); </script>';
}

?>  

  </body>
</html>