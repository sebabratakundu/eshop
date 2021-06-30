<?php
	require_once("common_files/databases/database.php");
	include_once("common_files/php/database.php");

	$root = "http://www.".ROOT."/eshop";
?>


<!DOCTYPE html>
<html lang="en-US">
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="common_files/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="common_files/css/animate.css">
<link rel="stylesheet" type="text/css" href="employee_panel/css/index.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
<head>
	<title>eshop</title>
</head>
<script type="text/javascript" src="common_files/js/jquery.min.js"></script>
<script type="text/javascript" src="common_files/js/popper.min.js"></script>
<script type="text/javascript" src="common_files/js/bootstrap.js"></script>
<body style="background: #f8f8f8;font-family: Raleway;">

<!-- start navbar coding -->

<?php
	include_once("assets/php/nav.php");
?>

<!-- end navbar coding -->

<!-- start terms and conditions coding -->

<div class="container rounded shadow-lg p-5 text-justify" style="margin-top: 120px;">
	<h4>TERMS & CONDITIONS</h4>
	<hr>
	<?php
		echo $branding_details["terms_policy"];
	?>
</div>

<!-- end terms and conditions coding -->

<!-- start footer coding -->

<?php
	include_once("assets/php/footer.php");
?>

<!-- end footer coding -->

</body>
</html>
