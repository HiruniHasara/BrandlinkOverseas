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
	  <script src="http://code.highcharts.com/modules/exporting.js"></script>
    <script src = "https://code.highcharts.com/modules/data.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
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
          <?php require_once(realpath(dirname(__FILE__) . '/../Common/header.php'));?>
          <button class="pdf_btn" id="pdf">Download PDF</button>
    </header>
    <!--header area end-->
    <?php include 'navBar.php';?>


    <div class="content">  
        <div class="clearfix">
		<form action="reportGen" method="POST">
            <div class="dropdown1">
    					<button class="dropbtn1" name="month"><i class="fa fa-sort" aria-hidden="true"></i>	Income Report
      					</button>
    					<div class="dropdown1-content1">
      						<a href="month">Monthly</a>
      						<a href="year">Annualy </a>
     					</div>
			  </div> 
		

              <!-- <div class="dropdown2">
              <a href="monthlyspare"><button class="dropbtn2" name="spare">Spare Part Stock Issue Report</button></a>
              </div>  -->
        </div>

        <div class="clearfix">
			
            <div class="date">
				<input type="date" name="date">
				<input type="date" name="date2">
                <button type="submit" name="rgen">Generate</button>
            </div>
           
		</div>
    <div class="clearfix">
    <div id="chart"> 
		<div clas="" id = "container" style = "width: 550px; height: 400px; margin: 0 auto"></div>
      <script language = "JavaScript">
         $(document).ready(function() {
            var data = {
			      table: 'table1',
			      startColumn: 0,
            endColumn: 1
            };
            var chart = {
               type: 'column'
            };
            var title = {
               text: 'Income Status within a Year'   
            };      
            var yAxis = {
               allowDecimals: false,
               title: {
                  text: 'Quantity'
               }
            };
            var tooltip = {
               formatter: function () {
                  return '<b>' + this.series.name + '</b><br/>' +
                     this.point.y + ' ' + this.point.name.toLowerCase();
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
                <table id="table1">
     					<thead>
        					<tr>

								<th style="width:15%"> Status </th>
								<th style="width:15%"> Amount </th>
								</tr>
							</thead>
							<tbody>
							<tr>	
                <?php

									//if($this->data!=0){
                  foreach($this->data as $values){
                   
				    echo '<td>'.$values["Status"].'</td>';
                    echo '<td>'.$values["totalAmount"].'</td></tr>';
                                     
                                      
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
            filename : "Annual Income Status Report.pdf",
            image: {type: 'jpeg', quantity: 0.98},
            html2canvas: {scale: 2},
            jsPDF: {unit: 'in', format: 'letter', orientation: 'portrait'}
          };
          html2pdf().from(invoice).set(opt).save();
        })
      }
    </script>
	
  </body>
</html>