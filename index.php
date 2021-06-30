<?php
	require_once("common_files/php/database.php");
	$root = "http://www.".ROOT."/eshop";
?>

<!DOCTYPE html>
<html lang="en-US">
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="common_files/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="common_files/css/animate.css">
<link rel="stylesheet" type="text/css" href="common_files/css/style.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
<head>
	<title>eshop</title>
</head>
<script type="text/javascript" src="common_files/js/jquery.min.js"></script>
<script type="text/javascript" src="common_files/js/popper.min.js"></script>
<script type="text/javascript" src="common_files/js/bootstrap.js"></script>
<script type="text/javascript" src="pages/js/index.js"></script>
<body class="bg-light" style="font-family: Raleway;">

<!-- start navbar coding -->

<?php
	include_once("assets/php/nav.php");
?>

<!-- end navbar coding -->

<!--start header coding-->

<div class="container-fluid p-0 carousel-box" style="margin-top:65px;">
	<div class="carousel slide" data-ride="carousel" id="product-slider">
	<ul class="carousel-indicators">
		<li data-target="#product-slider" data-slide-to="0" class="active"></li>
		<li data-target="#product-slider" data-slide-to="1"></li>
		<li data-target="#product-slider" data-slide-to="2"></li>
	</ul>
	<div class="carousel-inner">
		<?php
			$check_showcase = "SELECT * FROM header_showcase";
			$check_response = $db -> query($check_showcase);
			if($check_response){
				while ($data = $check_response -> fetch_assoc()) {
					$title_image = "data:image/png;base64,".base64_encode($data["title_photo"]);
					$title_color = $data["title_color"];
					$title_size = $data["title_size"];
					$subtitle_color = $data["subtitle_color"];
					$subtitle_size = $data["subtitle_size"];
					$h_align = $data["h_align"];
					$v_align = $data["v_align"];
					$text_align = "";
					if($h_align == "flex-start" || $h_align == "flex-end"){
						$text_align = "text-left";
					}
					else if($h_align == "flex-center"){
						$text_align = "text-center";
					}
					echo "<div class='carousel-item carousel-item-control'>";
					echo "<img src='".$title_image."' class='w-100'>";
					echo "<div class='carousel-caption ".$text_align." h-100 d-flex' style='justify-content:".$h_align."; align-items:".$v_align."'>";
					echo "<div>";
					echo "<h1 style='color:".$title_color."; font-size:".$title_size.";'>".$data['title_text']."</h1>";
					echo "<h4 style='color:".$subtitle_color.";font-size:".$subtitle_size."'>".$data['subtitle_text']."</h4>";
					echo "<div>".$data['btn_data']."</div>";
					echo "</div>";
					echo "</div>";
					echo "</div>";
				}
			}

		?>
	</div>
	<a href="#product-slider" class="carousel-control-prev" data-slide="prev">
		<span class="carousel-control-prev-icon"></span>
	</a>
	<a href="#product-slider" class="carousel-control-next" data-slide="next">
		<span class="carousel-control-next-icon"></span>
	</a>
</div>
</div>

<!-- end header coding -->

<!--start category showcase coding -->

<div class="container py-3 animated zoomIn" id="category-showcase">
	<h1 class="text-center py-5" style="font-family: sans-serif;">CATEGORY SHOWCASE</h1>
	<div class="row py-5">
		<?php
			$get_category_showcase = "SELECT * FROM category_showcase";
			$category_showcase_response = $db -> query($get_category_showcase);
			$top_left_pic = "";
			$top_left_label = "";
			$bottom_left_pic = "";
			$bottom_left_label = "";
			$center_pic = "";
			$center_label = "";
			$top_right_pic = "";
			$top_right_label = "";
			$bottom_right_pic = "";
			$bottom_right_label = "";

			if($category_showcase_response){
				while($category_showcase_data = $category_showcase_response -> fetch_assoc()){
					$img = "data:image/png;base64,".base64_encode($category_showcase_data["image"]);
					if($category_showcase_data["direction"] == "top-left"){
						$top_left_pic = $img;
						$top_left_label = $category_showcase_data["lable"];
					}
					else if($category_showcase_data["direction"] == "bottom-left"){
						$bottom_left_pic = $img;
						$bottom_left_label = $category_showcase_data["lable"];
					}
					else if($category_showcase_data["direction"] == "center"){
						$center_pic = $img;
						$center_label = $category_showcase_data["lable"];
					}
					else if($category_showcase_data["direction"] == "top-right"){
						$top_right_pic = $img;
						$top_right_label = $category_showcase_data["lable"];
					}
					else{
						$bottom_right_pic = $img;
						$bottom_right_label = $category_showcase_data["lable"];
					}
				}

				echo '<div class="col-md-4">
					<div class="position-relative mb-3">
					<button class="btn btn-danger shadow-lg w-50 py-2" style="position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);z-index:1000">'.$top_left_label.'</button>
					<img src="'.$top_left_pic.'" class="shadow-sm rounded" width="100%">
					</div>
					<div class="position-relative mb-3">
					<button class="btn btn-warning shadow-lg w-50 py-2" style="position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);z-index:1000">'.$bottom_left_label.'</button>
					<img src="'.$bottom_left_pic.'" class="shadow-sm rounded" width="100%">
					</div>
				</div>';

				echo '<div class="col-md-4">
					<div class="position-relative mb-3">
					<button class="btn btn-dark shadow-lg w-50 py-2" style="position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);z-index:1000">'.$center_label.'</button>
					<img src="'.$center_pic.'" class="rounded" width="100%">
					</div>
				</div>';

				echo '<div class="col-md-4">
					<div class="position-relative mb-3">
					<button class="btn btn-success shadow-lg w-50 py-2" style="position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);z-index:1000">'.$top_right_label.'</button>
					<img src="'.$top_right_pic.'" class="shadow-sm rounded" width="100%">
					</div>
					<div class="position-relative mb-3">
					<button class="btn btn-primary shadow-lg w-50 py-2" style="position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);z-index:1000">'.$bottom_right_label.'</button>
					<img src="'.$bottom_right_pic.'" class="shadow-sm rounded" width="100%">
					</div>
				</div>';
			}

		?>
	</div>
</div>

<!-- end category showcase coding-->

<!-- start items show coding -->

<div class="container-fluid">
	<h4 class="text-center">PRODUCTS FOR YOU</h4>
	<div class="row">
		<?php
			$get_product_data = "SELECT * FROM product ORDER BY RAND() LIMIT 12";
			$product_response = $db -> query($get_product_data);
			if($product_response){
				while($products_data = $product_response -> fetch_assoc()){
					$product_id = $products_data["id"];
					echo "<div class='col-md-3 py-5' align='center'>";
					echo "<div class='card shadow-sm'>";
					echo "<img src='".$products_data['thumb_pic']."' width='100%'>";
					echo "<div class='position-absolute w-100 text-white product-hover-details' style='height:0;top:0;left:0;background:rgba(0,0,0,0.5);'>";
					echo "<div class='product-detail-box w-100 h-100 d-none'>";
					echo "<h5>".$products_data['product_name']."</h5>";
					$one_rating = [];
					$two_rating = [];
					$three_rating = [];
					$four_rating = [];
					$five_rating = [];

					$get_rating = "SELECT * FROM purchase WHERE product_id='$product_id' AND rating <>0";
					$rating_response = $db -> query($get_rating);
					if($rating_response){
						if($rating_response -> num_rows != 0){
							while($rating_data = $rating_response -> fetch_assoc()){
								if($rating_data["rating"] == 1){
									array_push($one_rating,1);
								}
								else if($rating_data["rating"] == 2){
									array_push($two_rating, 2);
								}
								else if($rating_data["rating"] == 3){
									array_push($three_rating, 3);
								}
								else if($rating_data["rating"] == 4){
									array_push($four_rating, 4);
								}
								else if($rating_data["rating"] == 5){
									array_push($five_rating, 5);
								}
							}

							$one_count = count($one_rating);
							$two_count = count($two_rating);
							$three_count = count($three_rating);
							$four_count = count($four_rating);
							$five_count = count($five_rating);

							$all_count = [$one_count,$two_count,$three_count,$four_count,$five_count];
							$max = 0;
							for($i=0;$i<count($all_count);$i++){
								if($all_count[$i] > $max){
									$max = $all_count[$i];
								}
							}

							if($max == $one_count){
								for($i=0;$i<1;$i++){
									echo "<i class='fa fa-star text-warning'></i>";
								}

								$rest_star = 5-1;
								for($i=0;$i<$rest_star;$i++){
									echo "<i class='fa fa-star-o text-warning'></i>";
								}
							}
							else if($max == $two_count){
								for($i=0;$i<2;$i++){
									echo "<i class='fa fa-star text-warning'></i>";
								}

								$rest_star = 5-2;
								for($i=0;$i<$rest_star;$i++){
									echo "<i class='fa fa-star-o text-warning'></i>";
								}
							}
							else if($max == $three_count){
								for($i=0;$i<3;$i++){
									echo "<i class='fa fa-star text-warning'></i>";
								}

								$rest_star = 5-3;
								for($i=0;$i<$rest_star;$i++){
									echo "<i class='fa fa-star-o text-warning'></i>";
								}
							}
							else if($max == $four_count){
								for($i=0;$i<4;$i++){
									echo "<i class='fa fa-star text-warning'></i>";
								}

								$rest_star = 5-4;
								for($i=0;$i<$rest_star;$i++){
									echo "<i class='fa fa-star-o text-warning'></i>";
								}
							}
							else if($max == $five_count ){
								for($i=0;$i<5;$i++){
									echo "<i class='fa fa-star text-warning'></i>";
								}
							}
						}
					}
					echo "<p style='color:#E83350;'>".$products_data['brand']."</p>";
					echo "<p>Price : <i class='fa fa-rupee'></i>".$products_data['price']."</p>";
					echo $products_data['description'];
					echo "</div>";
					echo "</div>";
					echo "<div class='btn-group'>";
					echo "<button class='btn text-white border-0 font-weight-bold shadow-sm add-to-cart-btn py-3 rounded-0' product-id='".$products_data['id']."' product-title='".$products_data['product_name']."' product-price='".$products_data['price']."' qty='1' product-brand = '".$products_data['brand']."' product-pic='".$products_data['thumb_pic']."' style='background:#E83350;'><i class='fa fa-shopping-cart pr-2'></i> Add to Cart</button>";
					echo "<button class='btn text-white border-0 shadow-sm buy-btn py-3 rounded-0' product-id='".$products_data['id']."' product-title='".$products_data['product_name']."' product-price='".$products_data['price']." qty='1' ' product-brand = '".$products_data['brand']."' product-pic='".$products_data['thumb_pic']."' style='background:#2B2B52;'><i class='fa fa-shopping-bag'></i></button>";
					echo "</div>";
					echo "</div>";
					echo "</div>";
				}
			}
		?>
	</div>
</div>

<!-- end items show coding -->

<?php



?>

<!-- start footer coding -->

<?php
	include_once("assets/php/footer.php");
?>

<!-- end footer coding -->


<script type="text/javascript">

	const ROOT_URL = "<?= $root;?>";

	//carousel active item coding

	$(document).ready(function(){
		var carousel_active_item = document.querySelector(".carousel-item-control");
		$(carousel_active_item).addClass("active");
	});
</script>
</body>
</html>
