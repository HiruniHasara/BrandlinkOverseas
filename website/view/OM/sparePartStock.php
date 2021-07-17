<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stock</title>
    <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>public/css/OM/div3.css">
    <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>public/css/OM/split6.css">
    <link rel="stylesheet" href="<?php echo URL; ?>public/css/Common/template.css">
    <script language="JavaScript" src="<?php echo URL; ?>public/js/sparepartStock.js"></script>
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
          <?php require_once(realpath(dirname(__FILE__) . '/../Common/header.php'));?>
    </header>
    <!--header area end-->
    <?php include 'navBar.php';?>


    <div class="content">
    <div class="clearfix">
      <div class="left">
            <div class="tab">
              <form method="post">
                <a href="sparePartMomali" target="_self"><input type=button name="momali" value="Momali"></input></a>
                <a href="sparePartFerroli" target="_self"><input type=button name="ferroli" value="Ferroli"></input></a>
                <a href="sparePartAqua" target="_self"><input type=button name="aquaflex" value="Aquaflex"></input></a>
              </form>
            </div>
            <div class="content1">
              <table id="table1">
                <thead>
                    <tr>
                      <th> Item ID </th>
                      <th> Name </th>
                      <th> Quantity </th>
                      <th> Unit Price </th>
                      <th> Item Image </th>
                      <th> Delete </th>
                    </tr>
                  </thead>
                  
                  <tbody>	
                  
                  <tr>
                   
                    <?php

                      if($this->data!=0){
                        foreach($this->data as $values){

                        echo '<td>'.$values["itemNo"].'</td>';	
                        echo '<td>'.$values["name"].'</td>';
                        echo '<td>'.$values["quantity"].'</td>';
                        echo '<td>'.$values["unitPrice"].'</td>'; ?>
                        <td><img src="data:image/jpg;base64,<?php echo base64_encode($values["photo"])?>" style="width:100px;height:100px;"/></td>
                        <td>
                         <button class="btn" id="<?php echo $values['itemNo']?>" onclick="deleteItem(this)"><i class="fas fa-trash-alt"></i></button>
                        </td></tr>
                       
                      <?php 
                        }
                      }

                    ?>
                  
                  </tbody>
              </table>
            </div>
      </div>
      
      <div class="right">
      
      <form name="myform" id="myform" action="operationSMomali"  method="POST" enctype="multipart/form-data">
          <fieldset>
							<label>
								Item ID: <input type="text" name="id" id="id" onkeyup="filterid()" size="50" value="<?=isset($this->value[0]['itemNo']) ? $this->value[0]['itemNo'] : '';?>">
              </label>
              <button type="submit" name="search"><i class="fa fa-search" aria-hidden="true"></i> Search</button><br/>
              <label>
								Item Name: <input type="text" name="name" id="name" onkeyup="filtername()" size="50" value="<?=isset($this->value[0]['name']) ? $this->value[0]['name'] : '';?>">
              </label>
              <label>
								Quantity: <input type="text" name="quantity" id="quantity" size="50" value="<?=isset($this->value[0]['quantity']) ? $this->value[0]['quantity'] : '';?>">
              </label>
              <label>
								Unit Price: <input type="text" name="price" id="price" size="50" value="<?=isset($this->value[0]['unitPrice']) ? $this->value[0]['unitPrice'] : '';?>">
              </label>
              <label>
								Item Image: <input type="file" name="image" id="image" size="50" onchange="loadfile(event)">
              </label>
              <div class="preview">
                <img id="file" name ="file" id="file" width="100px" height="100px" value= <img src="data:image/jpg;base64,<?=isset($this->value[0]['photo']) ? base64_encode($this->value[0]['photo']) : '';?>">
                  <script type="text/javascript">
                    function loadfile(event){
                      var output=document.getElementById('file');
                      output.src=URL.createObjectURL(event.target.files[0]);
                    };
                  </script>
              </div> 

              <div class="formbtn">
							<input type="submit" value="Add" name="add" onclick = "return validate();"></input>
                <input type="submit" value="Update" name="update" onclick = "return validate();"></input> 
              </div>
              <div class="formbtn">
                <input type="submit" value="Delete" name="delete"> </input>
                <input type="submit" value="Clear" name="clear"></input>
              </div>
             
          </fieldset>
        </form>
        </form>      
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

function deleteItem(clickedbutton){

  var itemid=clickedbutton.id;
  swal({
    title: "Are you sure?",
    text: "This action will remove this item from your stock.",
    buttons: true,
    dangerMode: true,
    closeOnClickOutside: false,
})
.then((willDelete) => {
    if (willDelete) {
        window.location.assign("deletefunctionS/"+itemid);
    }
});
}

var table = document.getElementById('table1');
                
  for(var i = 1; i < table.rows.length; i++)
  {
    table.rows[i].onclick = function()
    {
      //rIndex = this.rowIndex;
      document.getElementById("id").value = this.cells[0].innerHTML;
      document.getElementById("name").value = this.cells[1].innerHTML;
      document.getElementById("quantity").value = this.cells[2].innerHTML;
      document.getElementById("price").value = this.cells[3].innerHTML;
      document.getElementById('file').setAttribute('src',this.cells[4].childNodes[0].src);
    };
  }
    

function filtername() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("name");
  filter = input.value.toUpperCase();
  table = document.getElementById("table1");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}

function filterid() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("id");
  filter = input.value.toUpperCase();
  table = document.getElementById("table1");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}
</script>
    
  <?php

  if(isset($_GET['alert']) && $_GET['alert']=='success'){
    echo '<script> $(window).ready(addSuccess()); </script>';
  }
  if(isset($_GET['alert']) && $_GET['alert']=='fail'){
    echo '<script> $(window).ready(addFail()); </script>';
  }
  if(isset($_GET['alert']) && $_GET['alert']=='updatesuccess'){
    echo '<script> $(window).ready(updateSuccess()); </script>';
  }
  if(isset($_GET['alert']) && $_GET['alert']=='updatefail'){
    echo '<script> $(window).ready(updateFail()); </script>';
  }
  if(isset($_GET['alert']) && $_GET['alert']=='deletesuccess'){
    echo '<script> $(window).ready(deleteSuccess()); </script>';
  }
  if(isset($_GET['alert']) && $_GET['alert']=='deletefail'){
    echo '<script> $(window).ready(deleteFail()); </script>';
  }
  if(isset($_GET['alert']) && $_GET['alert']=='searchFail'){
    echo '<script> $(window).ready(searchFail()); </script>';
  }
  
  ?>
  </body>
</html>