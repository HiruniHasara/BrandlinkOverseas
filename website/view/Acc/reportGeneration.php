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
    <!-- <div class="left"> -->
    <div id = "container" style = "width: 500px; height: 400px; margin: 0 auto">
    </div>

		<script>
    // Build the chart
    Highcharts.chart('container', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Current Invoice Categorization'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        accessibility: {
            point: {
                valueSuffix: '%'
            }
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: false
                },
                showInLegend: true
            }
        },
        series: [{
            name: 'Count',
            colorByPoint: true,
            data: [
                <?php
                $data = '';
                if ($this->data->num_rows>0){
                    while ($row = $this->data->fetch_object()){
                        $data.='{ name:"'.$row->Status.'",y:'.$row->total.'},';
                    }
                }
                echo $data;
                ?>
            ]
        }]
    });
</script>
  <!-- </div> -->

<!-- <div class="right">
<div id = "container2" style = "width: 500px; height: 400px; margin: 0 auto">
    </div>

		<script>
    // Build the chart
    Highcharts.chart('container2', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Current Stock according to categories'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        accessibility: {
            point: {
                valueSuffix: '%'
            }
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: false
                },
                showInLegend: true
            }
        },
        series: [{
            name: 'Popularity',
            colorByPoint: true,
            data: [
                <?php
                $data = '';
                if ($this->value->num_rows>0){
                    while ($row = $this->value->fetch_object()){
                        $data.='{ name:"'.$row->Category.'",y:'.$row->TotalQuantity.'},';
                    }
                }
                echo $data;
                ?>
            ]
        }]
    });
</script>
  </div> -->
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
	
  </body>
</html>