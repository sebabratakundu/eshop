<?php
	require_once("../../common_files/php/database.php");

	header("Content-Type:aplication/xlsx");
	header("Content-Disposition:attachment; filename=purchase_entry.xlsx");

	echo '<table class="table table-responsive table-bordered table-hover table-striped text-center">
						<thead class="thead-dark">
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
							</tr>
						</thead>
						<tbody>';

							$get_purchase_data = "SELECT * FROM purchase";
							$purchase_response = $db -> query($get_purchase_data);
							if($purchase_response){
								if($purchase_response -> num_rows != 0){
									while($purchase_data = $purchase_response -> fetch_assoc()){
										$purchase_date = date_create($purchase_data["purchase_date"]);
										$purchase_date_format = $purchase_date -> format("d-m-Y");
										$dis_date = date_create($purchase_data["dispatch_date"]);
										$dis_date_format = $dis_date -> format("d-m-Y");
										echo "<tr>";
										echo "<td class='s-no'>";
										echo $purchase_data["id"];
										echo "</td>";

										echo "<td>";
										echo $purchase_data["product_id"];
										echo "</td>";

										echo "<td>";
										echo $purchase_data["product_title"];
										echo "</td>";

										echo "<td>";
										echo $purchase_data["quantity"];
										echo "</td>";

										echo "<td>";
										echo $purchase_data["price"];
										echo "</td>";

										echo "<td>";
										echo $purchase_data["address"];
										echo "</td>";

										echo "<td>";
										echo $purchase_data["state"];
										echo "</td>";

										echo "<td>";
										echo $purchase_data["country"];
										echo "</td>";

										echo "<td>";
										echo $purchase_data["pincode"];
										echo "</td>";

										echo "<td>";
										echo $purchase_date_format;
										echo "</td>";

										echo "<td>";
										echo $purchase_data["fullname"];
										echo "</td>";

										echo "<td>";
										echo $purchase_data["email"];
										echo "</td>";

										echo "<td>";
										echo $purchase_data["mobile"];
										echo "</td>";

										echo "<td class='status'>";
										echo $purchase_data["status"];
										echo "</td>";
										echo "</tr>";
									}
								}
							}

							echo "</tbody>";
							echo "</table>";

						?>