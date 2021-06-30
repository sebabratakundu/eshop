<?php
	$title_photo = $_FILES["title_photo"];
	$image = "data:image/png;base64,".base64_encode(file_get_contents($title_photo["tmp_name"]));
	$page_data = json_decode($_POST["page_data"]);
	$text_data = $page_data[0];
	$h_align = $page_data[1];
	$v_align = $page_data[2];
	$text_align = "";
	if($h_align == "center"){
		$text_align = "text-center";
	}
	else if($h_align == "flex-start" || $h_align == "flex-end"){
		$text_align = "text-left";
	}
?>

<!DOCTYPE html>
<html lang="en-US">
<head>
	<link rel="stylesheet" type="text/css" href="../common_files/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="../common_files/css/animate.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/index.css">
	<link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
	<title>preview page</title>
</head>
<script type="text/javascript" src="../common_files/js/jquery.min.js"></script>
<script type="text/javascript" src="../common_files/js/popper.min.js"></script>
<script type="text/javascript" src="../common_files/js/bootstrap.js"></script>
<body>
	<div class="carousel">
		<div class="carousel-inner">
			<div class="carousel-item active">
				<img src="<?php echo $image;?>" class="w-100">
				<div class="carousel-caption <?php echo $text_align;?> d-flex h-100" style="justify-content: <?php echo $h_align;?>;align-items: <?php echo $v_align;?>">
					<div>
						<?php
							echo $text_data;
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>