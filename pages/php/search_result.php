<?php
	require_once("../../common_files/php/database.php");
	//user loged in or not coding

	if(empty($_COOKIE["_ua_"])){
		header("Location:http://localhost/bom/php/eshop/signin.php");
		exit;
	}

	$keyword = $_GET["search"];

?>


<!DOCTYPE html>
<html lang="en-US">
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="http://localhost/bom/php/eshop/common_files/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="http://localhost/bom/php/eshop/common_files/css/animate.css">
<link rel="stylesheet" type="text/css" href="http://localhost/bom/php/eshop/common_files/css/style.css">
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

<!-- start show search item coding -->

<div class="container-fluid" style="margin-top: 80px;margin-bottom: 80px;">
	<div class="row">
	<?php
		$get_product = "SELECT * FROM product WHERE product_name LIKE '%$keyword%' LIMIT 12";
		$product_response = $db -> query($get_product);
		if($product_response){
			if($product_response -> num_rows !=0){
				while($product_data = $product_response -> fetch_assoc()){
					$product_id = $product_data["id"];
					echo "<div class='col-md-3 py-5' align='center'>";
					echo "<div class='card shadow-sm'>";
					echo "<img src='../".$product_data['thumb_pic']."' width='100%'>";
					echo "<div class='position-absolute w-100 h-100 text-white py-5 d-none product-hover-details' style='top:0;left:0;background:rgba(43,43,82,0.5);'>";
					echo "<h5>".$product_data['product_name']."</h5>";
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
					echo "<p style='color:#E83350;'>".$product_data['brand']."</p>";
					echo "<p>Price : <i class='fa fa-rupee'></i>".$product_data['price']."</p>";
					echo $product_data['description'];
					echo "</div>";
					echo "<div class='btn-group'>";
					echo "<button class='btn text-white border-0 font-weight-bold shadow-sm add-to-cart-btn py-3 rounded-0' product-id='".$product_data['id']."' product-title='".$product_data['product_name']."' product-price='".$product_data['price']."' qty='1' product-brand = '".$product_data['brand']."' product-pic='".$product_data['thumb_pic']."' style='background:#E83350;'><i class='fa fa-shopping-cart pr-2'></i> Add to Cart</button>";
					echo "<button class='btn text-white border-0 shadow-sm buy-btn py-3 rounded-0' product-id='".$product_data['id']."' product-title='".$product_data['product_name']."' product-price='".$product_data['price']."' qty='1' product-brand = '".$product_data['brand']."' product-pic='".$product_data['thumb_pic']."' style='background:#2B2B52;'><i class='fa fa-shopping-bag'></i></button>";
					echo "</div>";
					echo "</div>";
					echo "</div>";

				}
			}
			else{
				$get_product = "SELECT * FROM product WHERE brand LIKE '%$keyword%' LIMIT 12";
				$product_response = $db -> query($get_product);
				if($product_response){
					if($product_response -> num_rows !=0){
						while($product_data = $product_response -> fetch_assoc()){
							$product_id = $product_data["id"];
							echo "<div class='col-md-3 py-5' align='center'>";
							echo "<div class='card shadow-sm'>";
							echo "<img src='../".$product_data['thumb_pic']."' width='100%'>";
							echo "<div class='position-absolute w-100 h-100 text-white py-5 d-none product-hover-details' style='top:0;left:0;background:rgba(43,43,82,0.5);'>";
							echo "<h5>".$product_data['product_name']."</h5>";
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
							echo "<p style='color:#E83350;'>".$product_data['brand']."</p>";
							echo "<p>Price : <i class='fa fa-rupee'></i>".$product_data['price']."</p>";
							echo $product_data['description'];
							echo "</div>";
							echo "<div class='btn-group'>";
							echo "<button class='btn text-white border-0 font-weight-bold shadow-sm add-to-cart-btn py-3 rounded-0' product-id='".$product_data['id']."' product-title='".$product_data['product_name']."' product-price='".$product_data['price']."' qty='1' product-brand = '".$product_data['brand']."' product-pic='".$product_data['thumb_pic']."' style='background:#E83350;'><i class='fa fa-shopping-cart pr-2'></i> Add to Cart</button>";
							echo "<button class='btn text-white border-0 shadow-sm buy-btn py-3 rounded-0' product-id='".$product_data['id']."' product-title='".$product_data['product_name']."' product-price='".$product_data['price']."' qty='1' product-brand = '".$product_data['brand']."' product-pic='".$product_data['thumb_pic']."' style='background:#2B2B52;'><i class='fa fa-shopping-bag'></i></button>";
							echo "</div>";
							echo "</div>";
							echo "</div>";

						}
					}
					else{
						$get_product = "SELECT * FROM product WHERE category LIKE '%$keyword%' LIMIT 12";
						$product_response = $db -> query($get_product);
						if($product_response){
							if($product_response -> num_rows !=0){
								while($product_data = $product_response -> fetch_assoc()){
									$product_id = $product_data["id"];
									echo "<div class='col-md-3 py-5' align='center'>";
									echo "<div class='card shadow-sm'>";
									echo "<img src='../".$product_data['thumb_pic']."' width='100%'>";
									echo "<div class='position-absolute w-100 h-100 text-white py-5 d-none product-hover-details' style='top:0;left:0;background:rgba(43,43,82,0.5);'>";
									echo "<h5>".$product_data['product_name']."</h5>";
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
									echo "<p style='color:#E83350;'>".$product_data['brand']."</p>";
									echo "<p>Price : <i class='fa fa-rupee'></i>".$product_data['price']."</p>";
									echo $product_data['description'];
									echo "</div>";
									echo "<div class='btn-group'>";
									echo "<button class='btn text-white border-0 font-weight-bold shadow-sm add-to-cart-btn py-3 rounded-0' product-id='".$product_data['id']."' product-title='".$product_data['product_name']."' product-price='".$product_data['price']."' qty='1' product-brand = '".$product_data['brand']."' product-pic='".$product_data['thumb_pic']."' style='background:#E83350;'><i class='fa fa-shopping-cart pr-2'></i> Add to Cart</button>";
									echo "<button class='btn text-white border-0 shadow-sm buy-btn py-3 rounded-0' product-id='".$product_data['id']."' product-title='".$product_data['product_name']."' product-price='".$product_data['price']."' qty='1' product-brand = '".$product_data['brand']."' product-pic='".$product_data['thumb_pic']."' style='background:#2B2B52;'><i class='fa fa-shopping-bag'></i></button>";
									echo "</div>";
									echo "</div>";
									echo "</div>";

								}
							}
							else{
								$get_keyword = "SELECT * FROM keyword WHERE s_keyword LIKE '%$keyword%'";
								$keyword_response = $db -> query($get_keyword);
								if($keyword_response){
									if($keyword_response -> num_rows != 0){
										$keyword_data = $keyword_response -> fetch_assoc();
										$p_keyword = $keyword_data["p_keyword"];

										//find p_keywords and search

										$get_product = "SELECT * FROM product WHERE category LIKE '%$p_keyword%' OR brand LIKE '%$p_keyword%' OR product_name LIKE '%$p_keyword%' LIMIT 12";
										$product_response = $db -> query($get_product);
										if($product_response){
											if($product_response -> num_rows !=0){
												while($product_data = $product_response -> fetch_assoc()){
													$product_id = $product_data["id"];
													echo "<div class='col-md-3 py-5' align='center'>";
													echo "<div class='card shadow-sm'>";
													echo "<img src='../".$product_data['thumb_pic']."' width='100%'>";
													echo "<div class='position-absolute w-100 h-100 text-white py-5 d-none product-hover-details' style='top:0;left:0;background:rgba(43,43,82,0.5);'>";
													echo "<h5>".$product_data['product_name']."</h5>";
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
													echo "<p style='color:#E83350;'>".$product_data['brand']."</p>";
													echo "<p>Price : <i class='fa fa-rupee'></i>".$product_data['price']."</p>";
													echo $product_data['description'];
													echo "</div>";
													echo "<div class='btn-group'>";
													echo "<button class='btn text-white border-0 font-weight-bold shadow-sm add-to-cart-btn py-3 rounded-0' product-id='".$product_data['id']."' product-title='".$product_data['product_name']."' product-price='".$product_data['price']."' qty='1' product-brand = '".$product_data['brand']."' product-pic='".$product_data['thumb_pic']."' style='background:#E83350;'><i class='fa fa-shopping-cart pr-2'></i> Add to Cart</button>";
													echo "<button class='btn text-white border-0 shadow-sm buy-btn py-3 rounded-0' product-id='".$product_data['id']."' product-title='".$product_data['product_name']."' product-price='".$product_data['price']."' qty='1' product-brand = '".$product_data['brand']."' product-pic='".$product_data['thumb_pic']."' style='background:#2B2B52;'><i class='fa fa-shopping-bag'></i></button>";
													echo "</div>";
													echo "</div>";
													echo "</div>";

												}
											}
										}
									}
									else{
										//store failed keywords

										$check_table = "SELECT * FROM failed_keyword";
										$table_response = $db -> query($check_table);
										if($table_response){
											$insert_data = "INSERT INTO failed_keyword(failed_keyword)
												VALUES('$keyword')";
												if($db -> query($insert_data)){
													echo "<div class='col-md-12 px-5'>";
													echo "<div class='jumbotron rounded shadow-sm text-center' style='border-left:5px solid #2B2B52'>
														<h1><i class='fa fa-shopping-cart text-primary'></i> Product not found !!</h1>;
														</div>";
													echo "</div>";
												}
										}
										else{
											$create_table = "CREATE TABLE failed_keyword(
											id INT(11) NOT NULL AUTO_INCREMENT,
											failed_keyword MEDIUMTEXT,
											status VARCHAR(50) DEFAULT 'pending',
											PRIMARY KEY(id)	
											)";

											if($db -> query($create_table)){
												$insert_data = "INSERT INTO failed_keyword(failed_keyword)
												VALUES('$keyword')";
												if($db -> query($insert_data)){
													echo "<div class='col-md-12 px-5'>";
													echo "<div class='jumbotron rounded shadow-sm text-center' style='border-left:5px solid #2B2B52'>
														<h1><i class='fa fa-shopping-cart text-primary'></i> Product not found !!</h1>;
														</div>";
													echo "</div>";
												}
											}
										}
									}
								}
							}
						}
					}
				}
			}
		}
	?>
	</div>
</div>

<!-- end show search item coding -->

<!-- start footer coding -->

<?php
	include_once("../../assets/php/footer.php");
?>

<!-- end footer coding -->

<script>
</script>
</body>
</html>
