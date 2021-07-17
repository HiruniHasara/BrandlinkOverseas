<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Dealers</title>
    <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>public/css/Admin/div3.css">
    <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>public/css/Admin/split6.css">
    <link rel="stylesheet" href="<?php echo URL; ?>public/css/Common/template.css">
    <script language="JavaScript" src="<?php echo URL; ?>public/js/manageDealers.js"></script>
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
      <div class ="topic">
				  <h1>Manage Employee</h1>
			</div>
      <div class="left">
      <input type="text" id="search" size="50" onkeyup="search()" placeholder="search">
          <div class="content1">
              <table id="table1">
                <thead>
                    <tr>
                      <th style="width:10%"> User ID </th>
                      <th style="width:20%"> Name </th>
                      <th style="width:20%"> Email </th>
                      <th style="width:30%"> Address </th>
                      <th style="width:10%"> Telephone </th>
                      <th style="width:10%"> User Role </th>
                    </tr>
                  </thead>
                  
                  <tbody>	
              <form name="myform" id="myform" action="formActionemployee" method="POST">
                    <tr>	
                   
                    <?php

                      if($this->data!=0){
                        foreach($this->data as $values){

                        echo '<tr><td>'.$values["UserID"].'</td>';
                        echo '<td>'.$values["Name"].'</td>';
                        echo '<td>'.$values["Email"].'</td>';
                        echo '<td>'.$values["Address"].'</td>';
                        echo '<td>'.$values["Telephone"].'</td>'; 
                        echo '<td>'.$values["u_type"].'</td>'; ?>

                       </tr>
                       
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
      
       <form> 
          <fieldset>
							<label style="display:none;">
								User ID: <input type="text" name="id" id="id" size="50" value="<?=isset($this->value[0]['u_id']) ? $this->value[0]['u_id'] : '';?>">
              </label>
              <label>
								User Name: <input type="text" name="uname" id="uname" size="50" value="<?=isset($this->value[0]['u_name']) ? $this->value[0]['u_name'] : '';?>">
              </label>
              <label>
								Name: <input type="text" name="name" id="name" size="50" value="<?=isset($this->value[0]['f_name']) ? $this->value[0]['f_name'] : '';?>">
              </label>
              <label>
								Email: <input type="text" name="mail" id="mail" size="50" value="<?=isset($this->value[0]['email']) ? $this->value[0]['email'] : '';?>">
              </label>
              <label>
								Address: <input type="text" name="add" id="add" size="50" value="<?=isset($this->value[0]['address']) ? $this->value[0]['address'] : '';?>">
              </label>
              <label>
								Telephone: <input type="text" name="tp" id="tp" size="50" value="<?=isset($this->value[0]['contact']) ? $this->value[0]['contact'] : '';?>">
              </label>
              <label>
                Select User type: <select id="type" name="type">
                                        <option value="admin">Admin</option>
                                        <option value="accountant">Accountant</option>
                                        <option value="op_manager">Operational Manager</option>
                                        <option value="sales_executive">Sales Executive</option>
                                        <option value="hom">Head of Marketing</option>
                                        <option value="sales_co">Sales Co-ordinator</option>
                                  </select>
              </label>
              <label>
                Password: <input type="password" name="pw" id="pw" size="50" >
              </label>
              <div class="formbtn">
                <input type="submit" value="Add" name="add"> </input>
							  <input type="submit" value="Update" name="update"></input> 
                
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

var table = document.getElementById('table1');
                
  for(var i = 1; i < table.rows.length; i++)
  {
    table.rows[i].onclick = function()
    {
      //rIndex = this.rowIndex;
      document.getElementById("id").value = this.cells[0].innerHTML;
      document.getElementById("name").value = this.cells[1].innerHTML;
      document.getElementById("mail").value = this.cells[2].innerHTML;
      document.getElementById("add").value = this.cells[3].innerHTML;
      document.getElementById('tp').value = this.cells[4].innerHTML;;
    };
  }
</script>
    
<?php 
			if(isset($_GET['alert']) && $_GET['alert']=='success'){
				echo '<script> $(window).ready(updateSuccess()); </script>';
			} 

			if(isset($_GET['alert']) && $_GET['alert']=='fail'){
				echo '<script> $(window).ready(updateFail()); </script>';
      }

      if(isset($_GET['alert']) && $_GET['alert']=='insertsuccess'){
				echo '<script> $(window).ready(insertSuccess()); </script>';
			} 

			if(isset($_GET['alert']) && $_GET['alert']=='insertfail'){
				echo '<script> $(window).ready(insertFail()); </script>';
      }
      
      if(isset($_GET['alert']) && $_GET['alert']=='deletesuccess'){
				echo '<script> $(window).ready(deletedealer()); </script>';
			}
			
			if(isset($_GET['alert']) && $_GET['alert']=='invalid'){
				echo '<script> $(window).ready(invalid()); </script>';
			}
		?>
  </body>
</html>