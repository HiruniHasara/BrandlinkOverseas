<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stock</title>
    <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>public/css/OM/div3.css">
    <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>public/css/OM/item.css">
    <link rel="stylesheet" href="<?php echo URL; ?>public/css/Common/template.css">
    <script language="JavaScript" src="<?php echo URL; ?>public/js/itemStock.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" charset="utf-8"></script>
    
  </head>
  <body onload="alternate('table1')">
  
  <style>
	 		body {
       			background-color: white;
                background-image: url("<?php echo URL; ?>public/img/homeback.jpg");
	 		}
       .red {
        background-color: #FF6347;
     }
		</style>
    <input type="checkbox" id="check">
    <!--header area start-->
    <header>
    <?php include 'headerStock.php';?>
    </header>
    <!--header area end-->
    <?php include 'navBar.php';?>

    <div class="content">
    <div class="clearfix">
    <div class ="topic">
				<h1>Add Item</h1>
			</div>
     
      <div class="left">
      
      <?php
            if($this->value!=0){
                foreach($this->value as $value){
        ?>
            <form action="operationItem"  method="POST" enctype="multipart/form-data">
            <button type="submit" class="btn1" name="back" value="<?php echo $value['Category']?>">Back</button>
            <?php
                }
              }?>
            
      
            <div class="content1">
           
              
              <table id="table1" class="colorMe">
                <thead>
                    <tr>
                      <th> Item ID </th>
                      <th> Size </th>
                      <th> Quantity </th>
                      <th> Price </th>
                      <th> Image </th>
                      <th> Delete </th>
                    </tr>
                  </thead>
                  
                  <tbody id="tbody">	
                
                    <!-- <tr class="class">	 -->
                    <?php

                    if($this->data!=0){
                        foreach($this->data as $values){
                        echo '<tr class="class"><td>'.$values["ItemID"].'</td>';	
                        echo '<td>'.$values["Size"].'</td>';
                        echo '<td class="qty" id="tt">'.$values["Quantity"].'</td>';
                        echo '<td>'.$values["Price"].'</td>';
                    ?>
                        <td><img src="data:image/jpg;base64,<?php echo base64_encode($values["Image"])?>" style="width:100px;height:100px;"/></td>
                        <td>
                         <!-- <button class="btn" id="<?php echo $values['ItemID']?>" name="<?php echo $values['ModelID']?>" onclick="deleteItem(this)"><i class="fas fa-trash-alt"></i></button> -->
                         <button class="btn" id="delete" name="delete" ><i class="fas fa-trash-alt"></i></button>
                        </td></tr>
                      <?php  
                       
                        }
                    }
                    ?>
                      </tr>
                  </tbody>
              </table>
            </div>
      </div>
      
      <div class="right">
      
        
        <?php
            if($this->value!=0){
                foreach($this->value as $value){
        ?>
        <form> 
        <fieldset>        
            <label>
              Model ID:  <input type="text" name="id" id="id" value="<?php echo $value['ModelID']?>" readonly>
            </label>
            <label>
              Model Name:  <input type="text" name="name" id="name" value="<?php echo $value['Name']?>" readonly>
            </label>
           <?php 
            } 
            } ?>
            <label>
          Item ID:<input type="text" name="item" id="item" onkeyup="filterid()" size="50">
            </label>
            <label>
			    Size: <input type="text" name="size" id="size" onkeyup="filtersize()" size="50">
            </label>
            <label>
			    Quantity: <input type="text" name="quantity" id="quantity" onkeyup="filterqty()" size="50">
            </label>
            <label>
			    Price: <input type="text" name="price" id="price" onkeyup="filterprice()" size="50">
            </label>
            <label>
				  Item Image: <input type="file" name="image" id="image" size="50" onchange="loadfile(event)">
            </label>
              <div class="preview">
                <img id="file" name ="file" id="file" width="100px" height="100px">
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

<script type="text/javascript">
  var rows = document.getElementById("table1").getElementsByTagName("tbody")[0].getElementsByTagName("tr");
    // loops through each row
    for (i = 0; i < rows.length; i++) {
      cells = rows[i].getElementsByTagName('td');
      if (cells[2].innerHTML <= 50){
        rows[i].className = "red";        
      }
 }
</script>

<script>

// function deleteItem(clickedbutton){
//     // var id = document.getElementById('delete').value;
//     // var id = document.getElementById('delete').value1;
//   var itemid=clickedbutton.id;
//   var id=clickedbutton.name;
//   swal({
//     title: "Are you sure?",
//     text: "This action will remove this item from your stock.",
//     buttons: true,
//     dangerMode: true,
//     closeOnClickOutside: false,
// })
// .then((willDelete) => {
//     if (willDelete) {
//         window.location.assign("deleteStockItem/"+id+"/"+itemid);
//     }
// });
// }

var table = document.getElementById('table1');
                
  for(var i = 1; i < table.rows.length; i++)
  {
    table.rows[i].onclick = function()
    {
      //rIndex = this.rowIndex;
      document.getElementById("item").value = this.cells[0].innerHTML;
      document.getElementById("size").value = this.cells[1].innerHTML;
      document.getElementById("quantity").value = this.cells[2].innerHTML;
      document.getElementById("price").value = this.cells[3].innerHTML;
      document.getElementById('file').setAttribute('src',this.cells[4].childNodes[0].src);
    };
  }

  function filterid() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("item");
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

function filtersize() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("size");
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

function filterqty() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("quantity");
  filter = input.value.toUpperCase();
  table = document.getElementById("table1");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[2];
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

function filterprice() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("price");
  filter = input.value.toUpperCase();
  table = document.getElementById("table1");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[3];
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