<?php
require("../../common_files/php/database.php");
$select_categories = "SELECT category_name FROM category";
$category_obj = $db -> query($select_categories);

$categories = [];
$i;

if($category_obj){
	while($category_array = $category_obj -> fetch_assoc()){
		array_push($categories, $category_array['category_name']);
	} 
}

echo '<div class="row p-5">
				<div class="col-md-4 bg-light p-4 rounded shadow-sm">
					<h5 class="font-monsserat">CREATE BRAND
						<i class="fa fa-circle-o-notch close fa-spin d-none brand-loader" style="font-size: 15px;"></i>
					</h5>
					<hr>
					<form class="create-brand-form">
						<select class="form-control my-3 border-0 border-blue select-brand-category">
						<option>Choose category</option>';

						for($i=0;$i<count($categories);$i++){
							echo "<option>".$categories[$i]."</option>";
						}

						echo '</select>
						<input type="text" name="brand" placeholder="Nokia" class="form-control brand-input border-0 border-blue my-3" required="required">
						<div class="add-brand-input-box"></div>
						<button class="btn btn-dark add-brand-btn" type="button"><i class="fa fa-plus"></i> Add field</button>
						<button class="btn btn-danger create-brand-btn" type="submit"> Create</button>
						<div class="brand-notice-box my-3"></div>
					</form>
				</div>
				<div class="col-md-2"></div>
				<div class="col-md-6 rounded shadow-sm bg-light p-4">
					<h5 class="font-monsserat">BRAND LIST
					<i class="fa fa-circle-o-notch close fa-spin d-none brand-list-loader" style="font-size: 15px;"></i>
					</h5>
					<hr>
					<select class="form-control my-3 border-0 border-blue choose-brand-category">
						<option>Choose category</option>';
						for($i=0;$i<count($categories);$i++){
							echo "<option>".$categories[$i]."</option>";
						}
					echo '</select>
					<div class="list-group brand-list-box"></div>
				</div>
			</div>
			<div class="progress bg-light shadow-sm d-none">
				<div class="progress-bar bg-dark progress-bar-striped progress-bar-animated"></div>
			</div>
			';

?>