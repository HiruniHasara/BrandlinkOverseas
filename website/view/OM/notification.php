<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stock</title>
    <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>public/css/OM/div3.css">
    <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>public/css/OM/notification.css">
    <link rel="stylesheet" href="<?php echo URL; ?>public/css/Common/template.css">
    <script language="JavaScript" src="<?php echo URL; ?>public/js/sparepartStock.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" charset="utf-8"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.js"></script>
    
  </head>
  <body>
  
  <style>
	 		body {
       			background-color: white;
                background-image: url("<?php echo URL; ?>public/img/homeback.jpg");
	 		}
       .blue {
        background-color: #FF6347;
     }
		</style>
    <input type="checkbox" id="check">
    <!--header area start-->
    <header>
          <?php require_once(realpath(dirname(__FILE__) . '/../Common/header.php'));?>
          <button class="pdf_btn" id="pdf">Download PDF</button>
    </header>
    <!--header area end-->
    <?php include 'navBar.php';?>


    <div class="content">
    <div class="clearfix">
    <!-- <div id="chart"> -->
    <div class ="topic">
		<h1>Reorder List</h1>
	</div>
     
            <div class="content1">
            <div class="bar">
				 	<div class="f1">
					 	<input type=button id="momali" name="momali" value="Momali"></input>
						<input type=button id="ferroli" name="ferroli" value="Ferroli"></input>
						<input type=button id="aqua" name="aqua" value="Aquaflex"></input>
                        <input type=button id="all" name="all" value="All"></input>
					</div>
          </div>
          <div id="chart">
              <table id="table1">
                <thead>
                    <tr>
                      <th style="display:none;"> Category </th>
                      <th> Model ID </th>
                      <th> Item ID </th>
                      <th> Size </th>
                      <th> Quantity </th>
                      <th> Price </th>
                      <th> Image </th>
                      <th> Reorder Level </th>
                    </tr>
                  </thead>
                  
                  <tbody id="stock"  style="background-color: #FF6347;">	
                    <tr>	
                    <?php
                    //if($this->data!=0){
                        foreach($this->data as $values){
                        echo '<td style="display:none;">'.$values["Category"].'</td>';
                        echo '<td>'.$values["ModelID"].'</td>';
                        echo '<td>'.$values["ItemID"].'</td>';	
                        echo '<td>'.$values["Size"].'</td>';
                        echo '<td class="qty">'.$values["Quantity"].'</td>';
                        echo '<td>'.$values["Price"].'</td>';
                    ?>
                        <td><img src="data:image/jpg;base64,<?php echo base64_encode($values["Image"])?>" style="width:100px;height:100px;"/></td>
                      <?php  
                      echo '<td>'.$values["ReorderLevel"].'</td>';
                       ?>
                       </tr>
            
                       <?php
                        }
                    //}

                    ?>
                    <!-- </tr> -->
                  </tbody>
              </table>
            </div>
      
      
      
            
                    </div>		
		   
    </div>
  
	
    <div class="footercontent">
      <?php require_once(realpath(dirname(__FILE__) . '/../Common/footer.php'));?>
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

<!-- <script type="text/javascript">
  var rows = document.getElementById("table1").getElementsByTagName("tbody")[0].getElementsByTagName("tr");

    // loops through each row
    for (i = 0; i < rows.length; i++) {
      cells = rows[i].getElementsByTagName('td');
      if (cells[4].innerHTML <= cells[7].innerHTML){
        rows[i].className = "blue";
      }
 }
</script> -->

<script>
      window.onload = function(){
        document.getElementById("pdf").addEventListener("click",()=>{
          const invoice = this.document.getElementById("chart");
          console.log(invoice);
          console.log(window);
          var opt = {
            margin : 0.5,
            filename : "Stock Reorder List.pdf",
            image: {type: 'jpeg', quantity: 1},
            html2canvas: {scale: 2},
            jsPDF: {unit: 'in', format: 'letter', orientation: 'portrait'}
          };
          html2pdf().from(invoice).set(opt).save();
        })
      }
</script>

    
  <?php
if(isset($this->alert) && $this->alert=='success'){
  echo '<script> $(window).ready(addSuccess()); </script>';
}
if(isset($this->alert) && $this->alert=='fail'){
  echo '<script> $(window).ready(addFail()); </script>';
}
if(isset($this->alert) && $this->alert=='updatesuccess'){
  echo '<script> $(window).ready(updateSuccess()); </script>';
}
if(isset($this->alert) && $this->alert=='updatefail'){
  echo '<script> $(window).ready(updateFail()); </script>';
}
if(isset($this->alert) && $this->alert=='deletesuccess'){
  echo '<script> $(window).ready(deleteSuccess()); </script>';
}
if(isset($this->alert) && $this->alert=='deletefail'){
  echo '<script> $(window).ready(deleteFail()); </script>';
}
if(isset($this->alert) && $this->alert=='searchFail'){
  echo '<script> $(window).ready(searchFail()); </script>';
}
    //} 
  ?>
</body>
</html>