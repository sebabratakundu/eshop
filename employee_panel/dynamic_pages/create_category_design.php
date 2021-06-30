<?php
echo '
<div class="row p-5">
				<div class="col-md-4 bg-light p-4 rounded shadow-sm add-category-box">
					<h5 class="font-monsserat">CREATE CATEGORY
						<i class="fa fa-circle-o-notch fa-spin close d-none category-loader" style="font-size: 15px;"></i>
					</h5>
					<hr>
					<form class="create-category-form">
						<input type="text" name="category" placeholder="Mobiles" class="form-control input border-0 border-blue my-3" required="required">
						<div class="add-category-input-box"></div>
						<button class="btn btn-dark add-category-btn shadow-sm" type="button"><i class="fa fa-plus"></i> Add field</button>
						<button class="btn btn-danger create-category-btn shadow-sm" type="submit"> Create</button>
						<div class="category-notice-box my-3"></div>
					</form>
				</div>
				<div class="col-md-2"></div>
				<div class="col-md-6 rounded shadow-sm bg-light p-4 category-list-box">
					<h5 class="font-monsserat">CATEGORY LIST</h5>
					<hr>
					<div class="list-group category-list"></div>
				</div>
			</div>';

?>