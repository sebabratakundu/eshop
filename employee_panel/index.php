<?php
	require_once("../common_files/php/database.php");
	$get_brand_name = "SELECT brand_name FROM branding";
	$response = $db -> query($get_brand_name);
	if($response){
		if($response -> num_rows != 0){
			$brand = $response -> fetch_assoc();
			$brand_name = $brand["brand_name"];
		}
	}
?>

<!DOCTYPE html>
<html>
<link rel="stylesheet" type="text/css" href="../common_files/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="../common_files/css/animate.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="css/index.css">
<link href="https://fonts.googleapis.com/css?family=Montserrat&family=PT+sans&display=swap" rel="stylesheet">
<head>
	<title>eshop</title>
</head>
<script type="text/javascript" src="../common_files/js/jquery.min.js"></script>
<script type="text/javascript" src="../common_files/js/popper.min.js"></script>
<script type="text/javascript" src="../common_files/js/bootstrap.js"></script>
<script type="text/javascript" src="js/index.js"></script>
<body>
	<div class="container-fluid">
		<div class="sidebar shadow-lg font-pt-sans">
			<h1 class="text-white text-center"><i class="fa fa-user-circle-o"></i></h1>
			<h6 class="text-white text-center text-uppercase"><?php echo $brand_name; ?></h6>
			<hr>
			<button class="btn w-100 text-left branding-detail-btn mb-2 collapse-li active mt-3" style="padding: 10px;" page-link="branding_details_design.php">
				<i class="fa fa-photo text-primary pr-2"></i>
				Branding details
			</button>
			<button class="btn w-100 text-left delivery-location-btn mb-2 collapse-li" style="padding: 10px;" page-link="delivery_location_design.php">
				<i class="fa fa-map-marker text-danger pr-2"></i>
				Delivery Location
			</button>
			<button class="btn w-100 text-left sales-report-btn mb-2 collapse-li" style="padding: 10px;" page-link="sales_report_design.php">
				<i class="fa fa-bar-chart text-info pr-2"></i>
				Sales Report
			</button>
			<button class="btn w-100 text-left keyword-planner-btn mb-2 collapse-li" style="padding: 10px;" page-link="keyword_planner_design.php">
				<i class="fa fa-file-text-o pr-2" style="color:#8B78E6;"></i>
				Keyword Planner
			</button>
			<button class="btn w-100 text-left text-white homepage-design-btn mb-2" style="padding: 10px;">
				<i class="fa fa-home text-warning pr-2"></i>
				Home Design
				<i class="fa fa-angle-down close mt-1"></i>
			</button>
			<ul class="homepage-design-ul bg-light rounded collapse mb-2" style="font-size: 14px">
				<li class="collapse-li" page-link="header_showcase_design.php">Header showcase</li>
				<li class="collapse-li" page-link="category_showcase_design.php">Category showcase</li>
			</ul>
			<button class="btn w-100 text-white text-left stock-update-btn mb-2" style="padding: 10px;">
				<i class="fa fa-shopping-cart text-success pr-2"></i>
				Stock update
				<i class="fa fa-angle-down close mt-1"></i>
			</button>
			<ul class="stock-update-ul bg-light rounded collapse" style="font-size: 14px">
				<li class="collapse-li" page-link="create_category_design.php">Create Category</li>
				<li class="collapse-li" page-link="create_brand_design.php">Create brand</li>
				<li class="collapse-li" page-link="create_products_design.php">Create Products</li>
			</ul>
		</div>
		<div class="page">
		</div>
		<div class="container">
			<div class="modal fade" id="send-noti-modal">
				<div class="modal-dialog modal-lg">
					<div class="modal-content border-0 shadow-sm font-monsserat">
						<div class="modal-header bg-dark text-white">
							<h4 class="modal-title">Do you want to send notification ?</h4>
						</div>
						<div class="modal-body">
							<div class="btn-group shadow-sm float-left">
								<button class="btn btn-danger">Subscribers</button>
								<button class="btn btn-dark">
									<?php
										$get_subscribers = "SELECT COUNT(id) AS result FROM subscriber";
										$subscriber_response = $db -> query($get_subscribers);
										if($subscriber_response){
											if($subscriber_response -> num_rows !=0){
												$no_of_subs = $subscriber_response -> fetch_assoc();
												echo $no_of_subs["result"];
											}
											else{
												echo "0";
											}
										}
									?>
								</button>
							</div>
							<button class="btn btn-info shadow-sm float-right send-noti-btn">Send</button>
						</div>
						<div class="modal-footer bg-dark text-white">
							<span class="d-block mx-auto">ESHOP Notification</span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script type="text/javascript">
	</script>
</body>
</html>