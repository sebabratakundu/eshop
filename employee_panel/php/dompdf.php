<?php
// include autoloader
require_once('../../dompdf/autoload.inc.php');
require_once("../../common_files/php/database.php");

$design = "<html><body>
<table border='1' width='100%' style='text-align:center;border-collapse:collapse;'>
<caption style='font-size:30px;font-weight:bold;margin-bottom:20px;'>Sales Report</caption>
<thead>
	<tr>
		<th>S/No</th>
		<th>Product ID</th>
		<th>Title</th>
		<th>Quantity</th>		
		<th>Price</th>
		<th>Address</th>
		<th>State</th>
		<th>Country</th>
		<th>Pincode</th>
		<th>Purchase date</th>
		<th>Customer Name</th>
		<th>Username</th>
		<th>Mobile</th>
		<th>Status</th>
		<th>Dispatch_date</th>
	</tr>
</thead>
<tbody>";

$get_purchase_data = "SELECT * FROM purchase";
	$purchase_response = $db -> query($get_purchase_data);
	if($purchase_response){
		if($purchase_response -> num_rows != 0){
			while($purchase_data = $purchase_response -> fetch_assoc()){
				$purchase_date = date_create($purchase_data["purchase_date"]);
				$purchase_date_format = $purchase_date -> format("d-m-Y");
				$dis_date = date_create($purchase_data["dispatch_date"]);
				$dis_date_format = $dis_date -> format("d-m-Y");

				$design .= "<tr>
				<td>".$purchase_data['id']."</td>
				<td>".$purchase_data['product_id']."</td>
				<td>".$purchase_data['product_title']."</td>
				<td>".$purchase_data['quantity']."</td>
				<td>".$purchase_data['price']."</td>
				<td>".$purchase_data['address']."</td>
				<td>".$purchase_data['state']."</td>
				<td>".$purchase_data['country']."</td>
				<td>".$purchase_data['pincode']."</td>
				<td>".$purchase_date_format."</td>
				<td>".$purchase_data['fullname']."</td>
				<td>".$purchase_data['email']."</td>
				<td>".$purchase_data['mobile']."</td>
				<td>".$purchase_data['status']."</td>
				<td>".$dis_date_format."</td>
				</tr>";
			}
		}
	}

$design .= "</tbody>
</table>
</body></html>";
 
// reference the Dompdf namespace
use Dompdf\Dompdf;

// instantiate and use the dompdf class
$dompdf = new Dompdf();
$dompdf->loadHtml($design);

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'landscape');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream();

?>