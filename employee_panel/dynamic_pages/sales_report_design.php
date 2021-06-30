<?php
	require_once("../../common_files/php/database.php");

 echo '<div class="row p-5">
				<div class="col-md-12 bg-light rounded shadow-sm p-4 d-flex justify-content-between">
					<div class="btn-group shadow-sm">
						<button class="btn btn-dark">Sort By</button>
						<button class="btn btn-dark">
							<select class="form-control sort-by">
								<option>All</option>
								<option value="today-sale">Today\'s Sales</option>
								<option value="old-sale">Old Sales</option>
								<option value="new-sale">New Sales</option>
								<option value="processing">Processing</option>
								<option value="Dispatched">Dispatched</option>
								<option value="returned">Returned</option>
							</select>
						</button>
						<button class="btn btn-primary dis-all">Dispatch All</button>
					</div>
					<div class="btn-group shadow-sm">
						<button class="btn btn-dark">Export To</button>
						<button class="btn btn-dark">
							<select class="form-control download-format" name="export-format">
								<option>Choose format</option>
								<option value="pdf">PDF</option>
								<option value="xls">xls</option>
							</select>
						</button>
					</div>
				</div>
			</div>
			<div class="row p-5">
				<div class="col-md-12 p-4 bg-light shadow-sm rounded sales-table">
					<table class="table table-responsive table-bordered table-hover table-striped text-center">
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
								<th>Action</th>
							</tr>
						</thead>
						<tbody>'; ?>

							<?php
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

										echo "<td>";
										if($purchase_data["status"] == "processing"){
											echo "<button class='btn btn-primary dispatch-btn' order-id='".$purchase_data['id']."' product-title='".$purchase_data['product_title']."' fullname='".$purchase_data['fullname']."' address='".$purchase_data['address']."' email='".$purchase_data['email']."' mobile='".$purchase_data['mobile']."' qty='".$purchase_data['quantity']."' price='".$purchase_data['price']."'>Dispatch</button>";
										}
										else if($purchase_data["status"] == "Dispatched"){
											echo "<button class='btn btn-danger' order-id='".$purchase_data['id']."' product-title='".$purchase_data['product_title']."' fullname='".$purchase_data['fullname']."' address='".$purchase_data['address']."' email='".$purchase_data['email']."' mobile='".$purchase_data['mobile']."' qty='".$purchase_data['quantity']."' price='".$purchase_data['price']."'>Already Dispatched on ".$dis_date_format."</button>";
										}
										echo "</td>";
										echo "</tr>";
									}
								}
								else{
									echo "table is empty !!";
								}
							}
							else{
								echo "purchase table not created";
							}

						?>

						<?php
						echo '</tbody>
					</table>
				</div>
			</div>'; ?>