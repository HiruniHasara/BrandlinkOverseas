<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reports</title>
    <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>public/css/Admin/div3.css">
    <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>public/css/OM/report2.css">
    <link rel="stylesheet" href="<?php echo URL; ?>public/css/Common/template.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" charset="utf-8"></script>
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
			<a href="report"><button class="dropbtn1" name="sales"><i class="fa fa-sort" aria-hidden="true"></i>	Sales Report
      					</button></a>
    					<div class="dropdown1-content1">
      						<a href="month">Monthly</a>
      						<a href="annualy">Annualy </a>
     					</div>
			  </div> 
		

              <div class="dropdown2">
              <a href="complaintreport"><button class="dropbtn2" name="spare">Complaints Report</button></a>
    					<!-- <div class="dropdown2-content2">
      						<a href="monthlyspare">Monthly</a>
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

		<div class="clearfix">
    <div class="left">
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
            text: 'Sales Categorization'
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
            name: 'Quantity',
            colorByPoint: true,
            data: [
                <?php
                $data = '';
                if ($this->data->num_rows>0){
                    while ($row = $this->data->fetch_object()){
                        $data.='{ name:"'.$row->Type.'",y:'.$row->total.'},';
                    }
                }
                echo $data;
                ?>
            ]
        }]
    });
</script>
  </div>
	

	<div class="right">
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
            text: 'Currently Available Orders Categorization'
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
                        $data.='{ name:"'.$row->Status.'",y:'.$row->total.'},';
                    }
                }
                echo $data;
                ?>
            ]
        }]
    });
</script>
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

  </body>
</html>