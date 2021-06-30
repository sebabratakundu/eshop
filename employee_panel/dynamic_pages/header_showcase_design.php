<?php
require_once("../../common_files/php/database.php");
echo '<div class="row p-5">
				<div class="bg-light col-md-4 rounded shadow-sm p-4">
					<form class="header-showcase-form">
						<div class="form-group">
							<label for="choose-title-image" class="h6">Title Image  <span style="font-size: 12px;">200kb (1920*978)</span></label>
							<div class="custom-file">
								<input type="file" class="custom-file-input" name="title-image" required="required" id="choose-title-image">
								<label class="custom-file-label" for="choose-title-image">Choose file</label>
							</div>
						</div>
						<div class="form-group">
							<label for="title-text" class="h6">Title text (<span style="font-size: 12px;" class="title-text-count">0</span><span style="font-size: 12px;">/40)</span></label>
							<textarea class="form-control border-blue" rows="1" required="required" maxlength="40" id="title-text"></textarea>
						</div>
						<div class="form-group">
							<label for="subtitle-text" class="h6">Subtitle text (<span style="font-size: 12px;" class="subtitle-text-count">0</span><span style="font-size: 12px;">/100)</span></label>
							<textarea class="form-control border-blue" rows="4" required="required" maxlength="100" id="subtitle-text"></textarea>
						</div>
						<div class="form-group">
							<label for="create-btn" class="h6">Create buttons</label>
							<i class="fa fa-trash delete-btn-icon close d-none"></i>
							<div id="create-btn" class="input-group mb-3">
								<input type="url" name="btn-url" class="form-control border-blue btn-url" placeholder="https://google.com">
								<input type="text" name="btn-name" class="form-control border-blue btn-name" placeholder="button-1">
							</div>
							<div class="input-group mb-3">
								<div class="input-group-prepend">
									<span class="input-group-text">Bg color</span>
								</div>
								<input type="color" name="btn-bgcolor" class="form-control border-left-0 border-right-0 btn-bgcolor">
								<div class="input-group-prepend">
									<span class="input-group-text border-left-0 border-right-0">Text color</span>
								</div>
								<input type="color" name="btn-textcolor" class="form-control border-left-0 btn-textcolor">
							</div>
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text">Size</span>
								</div>
								<select class="form-control border-left-0 border-right-0 btn-size" name="btn-size">
										<option value="16px">small</option>
										<option value="20px">medium</option>
										<option value="24px">large</option>
									</select>
								<div class="input-group-append">
									<span class="input-group-text bg-danger text-white border-danger add-btn" style="cursor: pointer;">Add</span>
								</div>
							</div>
						</div>
						<div class="form-group">
							<button class="btn btn-dark shadow-sm add-showcase-btn" type="submit">Add showcase</button>
							<button class="btn btn-primary shadow-sm float-right preview-btn" type="button">Preview</button>
						</div>
						<div class="form-group">
							<label for="edit-header-showcase" class="h6">Edit header showcase</label>
							<i class="fa fa-trash delete-header-showcase-icon close d-none"></i>
							<select class="form-control" id="edit-header-showcase" name="edit-header-showcase">
								<option>Choose showcase</option>'; ?>
								<?php
									$get_data = "SELECT id FROM header_showcase";
									$get_response = $db -> query($get_data);
									$count = 0;
									if($get_response){
										while ($id_data = $get_response -> fetch_assoc()) {
											$id = $id_data["id"];
											$count += 1;
											echo "<option value='".$id."'>".$count."</option>";
										}
									}

								?>
							<?php
								
							echo '</select>
						</div>
					</form>
				</div>
				<div class="col-md-1"></div>
				<div class="bg-light col-md-7 showcase-preview rounded shadow-sm p-3 position-relative d-flex" style="height: 400px;">
					<div class="title-box">
						<h1 class="showcase-title target-text">Title</h1>
						<h4 class="showcase-subtitle target-text">subtitle</h4>
						<div class="btn-box"></div>
					</div>
					<div class="showcase-formatting bg-dark p-3 d-flex justify-content-around align-items-center">
						<button class="btn btn-danger position-relative color-btn">Font Color<input type="color" name="color-picker" id="color-picker" class="position-absolute"></button>
						<input type="range" name="font-size" min="100" max="500" class="font-size-slider">
						<button class="btn btn-danger dropdown-toggle" data-toggle="dropdown">
							<span>Alignment</span>
							<div class="dropdown-menu w-25">
								<span class="dropdown-item alignment" align-position="h" align-value="flex-start">LEFT</span>
								<span class="dropdown-item alignment" align-position="h" align-value="center">CENTER</span>
								<span class="dropdown-item alignment" align-position="h" align-value="flex-end">RIGHT</span>
								<span class="dropdown-item alignment" align-position="v" align-value="flex-start">TOP</span>
								<span class="dropdown-item alignment" align-position="v" align-value="center">V-CENTER</span>
								<span class="dropdown-item alignment" align-position="v" align-value="flex-end">BOTTOM</span>
							</div>
						</button>
					</div>
				</div>
			</div>';?>