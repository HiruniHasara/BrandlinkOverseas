<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reports</title>
    <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>public/css/OM/div3.css">
    <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>public/css/OM/report2.css">
    <link rel="stylesheet" href="<?php echo URL; ?>public/css/Common/template.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" charset="utf-8"></script>
	<script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
      <script src = "https://code.highcharts.com/highcharts.js"></script> 
      <script src = "https://code.highcharts.com/modules/data.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.js"></script>
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
      <!-- <div class="pdf_btn">
      <button class="pdf_btn" id="pdf">Download</button>
       </div> -->
      <div class="right_area">
        <a href="../Login/log" class="logout_btn">Logout</a>
        <button class="pdf_btn" id="pdf">Download PDF</button>
      </div>  
    </header>
    <!--header area end-->
    <!--mobile navigation bar start-->
    <div class="mobile_nav">
      <div class="nav_bar">
        <i class="fa fa-bars nav_btn"></i>
      </div>
      <div class="mobile_nav_items">
	  	<a href="home"><i class="fas fa-home"></i><span>Home</span></a>
        <a href="ManageDealers"><i class="fa fa-address-book"></i><span>Manage Dealers</span></a>
        <a href="employees"><i class="fa fa-users"></i><span>Manage Employee</span></a>
        <a href="pendingDealers"><i class="fa fa-user"></i><span>Pending Dealers</span></a>
        <a href="report"><i class="fa fa-file"></i><span>Reports</span></a>
        <a href="settings"><i class="fas fa-sliders-h"></i><span>Settings</span></a>
      </div>
    </div>
    <!--mobile navigation bar end-->
    <!--sidebar start-->
    <div class="sidebar">
      <div class="profile_info">
      <img src=".././public/img/Profile pic.png" class="mobile_profile_image" width="100px" height="100px">
        <h4>Admin</h4>
      </div>
        <a href="home"><i class="fas fa-home"></i><span>Home</span></a>
        <a href="ManageDealers"><i class="fa fa-address-book"></i><span>Manage Dealers</span></a>
        <a href="employees"><i class="fa fa-users"></i><span>Manage Employee</span></a>
        <a href="pendingDealers"><i class="fa fa-user"></i><span>Pending Dealers</span></a>
        <a href="report"><i class="fa fa-file"></i><span>Reports</span></a>
        <a href="settings"><i class="fas fa-sliders-h"></i><span>Settings</span></a>
    </div>
    <!--sidebar end-->

    <div class="content">  
        <div class="clearfix">
        
		<form action="reportGen" method="POST">
    
            <div class="dropdown1">
            <button class="dropbtn1" name="sales"><i class="fa fa-sort" aria-hidden="true"></i>Sales Report
      					</button>
    					<div class="dropdown1-content1">
      						<a href="month">Monthly</a>
      						<a href="annualy">Annualy </a>
     					</div>
			  </div> 
		

              <div class="dropdown2">
              <a href="complaintreport"><button class="dropbtn2" name="spare">Complaints Report</button></a>
      					<!-- </button>
    					<div class="dropdown2-content2">
      						<a href="#">Monthly</a>
      						<a href="#">Annualy </a>
     					</div> -->
              </div> 
        </div>

        <div class="clearfix">
			
            <div class="date">
				<input type="date" name="date">
				<input type="date" name="date2">
                <button type="submit" name="rgen">Generate</button>
            </div>
           
            <!-- <div class="date1">
                <input type="date" id="date1" name="date1">
                <input type="button" value="Generate1">
            </div> -->
			
        </div>
		<div id="chart"> 
		<div clas="" id = "container" style = "width: 550px; height: 400px; margin: 0 auto"></div>
      <script language = "JavaScript">
         $(document).ready(function() {
            var data = {
			   table: 'table1',
			   startColumn: 2,
            	endColumn: 3
            };
            var chart = {
               type: 'column'
            };
            var title = {
               text: 'Sales within a Month'   
            };      
            var yAxis = {
               allowDecimals: false,
               title: {
                  text: 'Total Sales'
               }
            };
            var tooltip = {
               formatter: function () {
                  return '<b>' + this.series.name + '</b><br/>Sales Amount:' + 
                     this.point.y + ' <br/>Item ID:' + this.point.name.toLowerCase();
               }
            };
            var credits = {
               enabled: false
            };  
            var json = {};   
            json.chart = chart; 
            json.title = title; 
            json.data = data;
            json.yAxis = yAxis;
            json.credits = credits;  
            json.tooltip = tooltip;  
            $('#container').highcharts(json);
         });
      </script>

        <div class="clearfix">
            <div class="content1">
                <table id="table1" class="highchart w3-table-all" data-graph-contaoner-before="1" data-graph-type="column" style="margin-top:20px;">
     					<thead>
        					<tr>
                                <th style="width:15%"> Model ID </th>
                                <th style="width:15%"> Item </th>
                                <th style="width:15%"> Item ID </th>
                                <th style="width:15%"> Total Sales </th>
								</tr>
							</thead>
							<tbody>
							<tr>	
                <?php

									//if($this->data!=0){
                  foreach($this->data as $values){
				    echo '<tr><td>'.$values["ModelID"].'</td>';
                    echo '<td>'.$values["Name"].'</td>';
                    echo '<td>'.$values["ItemID"].'</td>';
                    echo '<td>'.$values["Total"].'</td></tr>';
                                     
                                      
                  }
									//}

                ?>
              <!-- </tr> -->
								
						</tbody>
					</table>
                </div>
			</div>
			
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
      window.onload = function(){
        document.getElementById("pdf").addEventListener("click",()=>{
          const invoice = this.document.getElementById("chart");
          console.log(invoice);
          console.log(window);
          var opt = {
            // margin : 1,
            filename : "Sales within a Year.pdf",
            image: {type: 'jpeg', quantity: 0.98},
            html2canvas: {scale: 2},
            jsPDF: {unit: 'in', format: 'letter', orientation: 'portrait'}
          };
          html2pdf().from(invoice).set(opt).save();
        })
      }
</script>

    <script>
      if(window.history.replaceState){
        window.history.replaceState(null, null, window.location.href);
      }
    </script>
	
  </body>
</html>