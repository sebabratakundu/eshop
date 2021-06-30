<?php
	require_once("common_files/php/database.php");

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
<script type="text/javascript" src="pages/js/index.js"></script>
<body style="background: #f8f8f8;font-family: Raleway;">

<!-- start navbar coding -->

<?php
	include_once("assets/php/nav.php");
?>

<!-- end navbar coding -->

<!--start 404 coding-->

<div class="container" style="margin-top:100px;">
	<div class="jumbotron text-center" style="border-left: 5px solid #2B2B52;">
		<h1 class="font-weight-bold" style="font-size:80px;">ERROR 404</h1>
		<p>Page not found !!</p>
	</div>
</div>

<!-- end 404 coding -->

<!-- start footer coding -->

<?php
	include_once("assets/php/footer.php");
?>

<!-- end footer coding -->


<script type="text/javascript">
</script>
</body>
</html>
