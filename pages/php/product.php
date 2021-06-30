<?php
	require_once("../../common_files/php/database.php");
	$category = $_GET["cat_name"];
?>


<!DOCTYPE html>
<html lang="en-US">
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="http://localhost/bom/php/eshop/common_files/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="http://localhost/bom/php/eshop/common_files/css/animate.css">
<link rel="stylesheet" type="text/css" href="http://localhost/bom/php/eshop/employee_panel/index.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
<head>
	<title>eshop</title>
</head>
<script type="text/javascript" src="http://localhost/bom/php/eshop/common_files/js/jquery.min.js"></script>
<script type="text/javascript" src="http://localhost/bom/php/eshop/common_files/js/popper.min.js"></script>
<script type="text/javascript" src="http://localhost/bom/php/eshop/common_files/js/bootstrap.js"></script>
<script type="text/javascript" src="http://localhost/bom/php/eshop/pages/js/index.js"></script>
<body style="background: #f8f8f8;font-family: Raleway;">

<!-- start navbar coding -->

<?php
	include_once("../../assets/php/nav.php");
?>

<!-- end navbar coding -->

<!-- start product coding -->

<div class="container-fluid" style="margin-top: 80px;">
	<a href="#"><?php echo $category; ?></a>
	<div class="row mt-2">
		<div class="col-md-3">
			<div class="bg-white p-4 shadow-sm" align="center">
				<h5 class="font-weight-bold">Filter by Brand</h5>
				<div class="btn-group-vertical shadow-sm mb-3">
					<?php
						$get_brands = "SELECT * FROM brands WHERE category='$category'";
						$brands_response = $db -> query($get_brands);
						if($brands_response){
							if($brands_response -> num_rows != 0){
								
								echo "<button class='btn btn-dark filter-btn' cat-name='".$category."' brand-name='all'>All</button>";

								while($brands = $brands_response -> fetch_assoc()){
									echo "<button class='btn btn-dark filter-btn' cat-name='".$category."' brand-name='".$brands["brand_name"]."'>".$brands["brand_name"]."</button>";
								}
							}
						}

					?>
				</div>

				<h5 class="font-weight-bold">Filter by Price</h5>
				<div class="btn-group-vertical shadow-sm mb-3">
					<button class="btn btn-dark pt-2"><input type="number" name="min-price" placeholder="min price" class="form-control min-price"></button>
					<button class="btn btn-dark pb-2"><input type="number" name="max-price" placeholder="max price" class="form-control max-price"></button>
					<button class="btn btn-danger py-2 price-filter-btn" cat-name="<?php echo $category; ?>">Get product</button>
				</div>
				<h5 class="font-weight-bold">Sort by</h5>
				<select class="form-control sort-by">
					<option value="recomended">Recomended</option>
					<option value="high">High to low</option>
					<option value="low">Low to high</option>
					<option value="new">Newest</option>
				</select>
			</div>
		</div>
		<div class="col-md-9">
			<div class="bg-white p-4 shadow-sm product-box d-flex"></div>
		</div>
	</div>
</div>

<!-- end product coding -->

<!-- start footer coding -->

<?php
	include_once("../../assets/php/footer.php");
?>

<!-- end footer coding -->

<script>
</script>
</body>
</html>
