// start stock update btn and hompage design btn collapse coding

$(document).ready(function(){
	$('.stock-update-btn').click(function(){
		$('.stock-update-ul').collapse('toggle');
	});

	$('.homepage-design-btn').click(function(){
		$('.homepage-design-ul').collapse('toggle');
	});
});

// end stock update btn and homepage design btn collapse coding

//start dynamic page request coding

$(document).ready(function(){
	var active_link = $('.active').attr("page-link");
	page_request(active_link);
	$('.collapse-li').each(function(){
		$(this).click(function(){
			var request_url = $(this).attr('page-link');
			page_request(request_url);
		});
	});
});

//start active tab coding

$(document).ready(function(){
	$('.collapse-li').each(function(){
		$(this).click(function(){
			var length = $('.collapse-li').length;
			var i;
			for(i=0;i<length;i++){
				$('.collapse-li').removeClass('active');
			}
			$(this).addClass('active');
		});
	});
});

//end active tab coding

function page_request(request_url){
	$.ajax({
		type : "POST",
		url : "dynamic_pages/"+request_url,
		xhr : function(){
			var request = new XMLHttpRequest();
			request.onprogress = function(event){
				var percentage = Math.floor((event.loaded/event.total)*100);
				$('.progress').removeClass('d-none');
				$('.progress-bar').css({
					width : percentage+"%"
				});

				$('.progress-bar').html(percentage+"%");
			}

			return request;
		},
		cache : false,
		beforeSend : function(){
			$('.progress').removeClass('d-none');
		},
		success : function(response){
			$(".page").html(response);

			if(request_url == "header_showcase_design.php"){
				header_showcase();
			}

			if(request_url == "branding_details_design.php"){
				branding_details();
			}

			if(request_url == "create_category_design.php"){
				category_list();
			}

			if(request_url == "category_showcase_design.php"){
				category_showcase();
			}

			if(request_url == "delivery_location_design.php"){
				delivery_location();
			}

			if(request_url == "sales_report_design.php"){
				sales_report();
			}

			if(request_url == "keyword_planner_design.php"){
				keyword_planner();
			}

			//add category coding

			$(".add-category-btn").click(function(){
				var placeholder = $(".input:first").attr("placeholder");
				var input = document.createElement('INPUT');
				var remove_icon = document.createElement("I");
				var input_box = document.createElement('DIV');
				input.type = "text";
				input.className = "form-control input border-0 border-blue my-3";
				input.placeholder = placeholder;
				input.required = "required";
				remove_icon.className = "fa fa-times-circle remove-input-icon";
				input_box.className = "input-box";
				input_box.appendChild(input);
				input_box.appendChild(remove_icon);
				$('.add-category-input-box').append(input_box);
				remove_icon.onclick = function(){
					var parent = this.parentElement;
					parent.remove();

				}
			});

			//create category coding

			$(".create-category-btn").click(function(event){
				event.preventDefault();
				var input = [];
				var input_length = $(".input").length;
				var i;
				for(i=0;i<input_length;i++){
					input[i] = document.getElementsByClassName('input')[i].value;
				}
				var J_obj = JSON.stringify(input);
				$.ajax({
					type : "POST",
					url : "php/create_category.php",
					data : {
						category_data : J_obj
					},
					cache : false,
					beforeSend:function(){
						$('.category-loader').removeClass('d-none');
					},
					success : function(response){
						$('.category-loader').addClass('d-none');
						if(response.trim() == "success"){
							var notice = document.createElement("DIV");
							notice.className = "alert alert-success animated fadeIn faster";
							notice.innerHTML = "<b>"+response+"</b>";
							$(".notice-box").html(notice);
							setTimeout(function(){
								$(".notice-box").html('');
								$(".create-category-form").trigger('reset');
								$('.category-list-ul').html('');
								category_list();
							},3000);
						}
						else{
							var notice = document.createElement("DIV");
							notice.className = "alert alert-warning animated fadeIn faster";
							notice.innerHTML = "<b>"+response+"</b>";
							$(".category-notice-box").html(notice);
							setTimeout(function(){
								$(".notice-box").html('');
								$(".create-category-form").trigger('reset');
							},3000);
						}
					}
				});
			});

			// add brand coding		
			
			$(".add-brand-btn").click(function(){
				var placeholder = $(".brand-input:first").attr("placeholder");
				var input = document.createElement('INPUT');
				var remove_icon = document.createElement("I");
				var input_box = document.createElement('DIV');
				input.type = "text";
				input.className = "form-control brand-input border-0 border-blue my-3";
				input.placeholder = placeholder;
				input.required = "required";
				remove_icon.className = "fa fa-times-circle remove-input-icon";
				input_box.className = "input-box";
				input_box.appendChild(input);
				input_box.appendChild(remove_icon);
				$('.add-brand-input-box').append(input_box);
				remove_icon.onclick = function(){
					var parent = this.parentElement;
					parent.remove();

				}
			});

			//create brand coding

			$(".create-brand-btn").click(function(event){
				event.preventDefault();
				if($('.select-brand-category').val() == "Choose category"){
					var notice = document.createElement("DIV");
					notice.className = "alert alert-warning animated fadeIn faster";
					notice.innerHTML = "<b>Please select any category</b>";
					$(".brand-notice-box").html(notice);
					setTimeout(function(){
						$(".brand-notice-box").html('');
						$(".create-brand-form").trigger('reset');
					},3000);
				}
				else{
					var input = [];
					var input_length = $(".brand-input").length;
					var i;
					for(i=0;i<input_length;i++){
						input[i] = document.getElementsByClassName('brand-input')[i].value;
					}
					var J_obj = JSON.stringify(input);
					$.ajax({
						type : "POST",
						url : "php/create_brand.php",
						data : {
							category : $('.select-brand-category').val(),
							brands_data : J_obj
						},
						cache : false,
						beforeSend:function(){
							$('.brand-loader').removeClass('d-none');
						},
						success : function(response){
							$('.brand-loader').addClass('d-none');
							if(response.trim() == "success"){
								var notice = document.createElement("DIV");
								notice.className = "alert alert-success animated fadeIn faster";
								notice.innerHTML = "<b>"+response+"</b>";
								$(".brand-notice-box").html(notice);
								setTimeout(function(){
									$(".brand-notice-box").html('');
									$(".create-brand-form").trigger('reset');
									$('.brand-list-ul').html('');
								},3000);
							}
							else{
								var notice = document.createElement("DIV");
								notice.className = "alert alert-warning animated fadeIn faster";
								notice.innerHTML = "<b>"+response+"</b>";
								$(".brand-notice-box").html(notice);
								setTimeout(function(){
									$(".brand-notice-box").html('');
									$(".create-brand-form").trigger('reset');
								},3000);
							}
						}
					});
				}
			});

			// show brand list coding

			$('.choose-brand-category').on('change',function(){
				var choosen_category = $(this).val();
				var all_options = $(this).html().replace("<option>Choose category</option>").replace("<option>"+choosen_category+"</option>");
				$.ajax({
					type : "POST",
					url : "php/show_brands.php",
					data : {
						category : choosen_category
					},
					beforeSend:function(){
						$(".brand-list-loader").removeClass("d-none");
					},
					success : function(response){
						$(".brand-list-loader").addClass("d-none");
						if(response.trim() != "brands are not created in this category"){
							var brand_obj = JSON.parse(response);
							var table = document.createElement('TABLE');
							var thead = document.createElement("THEAD");
							var tbody = document.createElement("TBODY");
							table.className = "table table-striped table-bordered text-center";
							var tr_head = document.createElement('TR');
							var id_th = document.createElement('TH');
							var category_th = document.createElement('TH');
							var brand_th = document.createElement('TH');
							var edit_th = document.createElement("TH");
							var delete_th = document.createElement("TH");

							id_th.innerHTML = "Id";
							category_th.innerHTML = "Category";
							brand_th.innerHTML = "Brand Name";
							edit_th.innerHTML = "Edit";
							delete_th.innerHTML = "Delete";

							tr_head.append(id_th);
							tr_head.append(category_th);
							tr_head.append(brand_th);
							tr_head.append(edit_th);
							tr_head.append(delete_th);
							thead.append(tr_head);
							table.append(thead);
							table.append(tbody);
							var i;
							for(i=0;i<brand_obj.length;i++){
								var id = brand_obj[i].id;
								var category = brand_obj[i].category;
								var brand = brand_obj[i].brand_name;
								var tr = document.createElement("TR");
								var id_td = document.createElement("TD");
								var category_td = document.createElement("TD");
								var brand_td = document.createElement("TD");
								var edit_td = document.createElement("TD");
								var delete_td = document.createElement("TD");
								id_td.innerHTML = id;
								category_td.innerHTML = "<select class='form-control edit-category-select' disabled='disabled'><option>"+category+"</option>"+all_options+"</select>";
								brand_td.innerHTML = brand;
								edit_td.innerHTML = "<i class='fa fa-edit brand-edit-icon' brand_name='"+brand+"' category_name='"+category+"'></i><i class='fa fa-save brand-save-icon d-none' brand_name='"+brand+"' category_name='"+category+"'></i>";
								delete_td.innerHTML = "<i class='fa fa-trash brand-delete-icon' brand_name='"+brand+"' category_name='"+category+"'></i>";
								tr.append(id_td);
								tr.append(category_td);
								tr.append(brand_td);
								tr.append(edit_td);
								tr.append(delete_td);
								tbody.append(tr);
								$(".brand-list-box").html(table);

								// delete brand coding

								$(".brand-delete-icon").each(function(){
									var parent = this.parentElement.parentElement;
									$(this).click(function(){
										var confirmation = confirm("are you sure ?");
										if(confirmation){
											var category_name = $(this).attr("category_name");
											var brand_name = $(this).attr("brand_name");
											$.ajax({
												type : "POST",
												url : "php/delete_brand.php",
												data : {
													category : category_name,
													brand : brand_name
												},
												cache : false,
												beforeSend : function(){
													$(".brand-list-loader").removeClass("d-none");
												},
												success : function(response){
													$(".brand-list-loader").removeClass("d-none");
													if(response.trim() == "delete success"){
														parent.remove();
													}
													else{
														var brand_notice = document.createElement("DIV");
														brand_notice.className = "alert alert-warning";
														brand_notice.innerHTML = "<b>"+response+"</b>";
														$(".brand-list-box").html(brand_notice);
													}
												}
											});
										}
									});
								});

								//edit brand coding

								$(".brand-edit-icon").each(function(){
									var parent = this.parentElement.parentElement;
									$(this).click(function(){
										var edit_icon = this;
										$(edit_icon).addClass("d-none");
										var tds = parent.getElementsByTagName("TD");
										var select = tds[1].getElementsByClassName("edit-category-select")[0];
										var save_icon = tds[3].getElementsByClassName("brand-save-icon")[0];
										var delete_icon = tds[4].getElementsByClassName("brand-delete-icon")[0];
										$(save_icon).removeClass("d-none");
										select.disabled = false;
										tds[2].contentEditable = true;
										tds[2].focus();
										
										save_icon.onclick = function(){
											var previous_category_name = $(this).attr("category_name");
											var previous_brand_name = $(this).attr("brand_name");
											var category_name = select.value;
											var brand_name = tds[2].innerHTML;
											$.ajax({
												type : "POST",
												url : "php/update_brand.php",
												data : {
													previous_category : previous_category_name,
													previous_brand : previous_brand_name,
													category : category_name,
													brand : brand_name
												},
												cache : false,
												beforeSend : function(){
													$(".brand-list-loader").removeClass("d-none");
												},
												success : function(response){
													$(".brand-list-loader").addClass("d-none");
													if(response.trim() == "update success"){
														$(save_icon).addClass("d-none");
														$(edit_icon).removeClass("d-none");
														select.disabled = true;
														tds[2].contentEditable = false;
														$(save_icon).attr("category_name",category_name);
														$(save_icon).attr("brand_name",brand_name);

														$(edit_icon).attr("category_name",category_name);
														$(edit_icon).attr("brand_name",brand_name);

														$(delete_icon).attr("category_name",category_name);
														$(delete_icon).attr("brand_name",brand_name);

													}
													else{
														alert(response);
													}
												}
											});
										}

									});
								});
							}
						}
						else{
							var brand_notice = document.createElement("DIV");
							brand_notice.className = "alert alert-warning";
							brand_notice.innerHTML = "<b>"+response+"</b>";
							$(".brand-list-box").html(brand_notice);
						}
					}
				});
			});

			//create product coding

			$(".product-form").submit(function(event){
				event.preventDefault();
				var options = $("#select-brand option");
				var cat_name = "";
				var i;
				for(i=0;i<options.length;i++){
					if(options[i].innerHTML == $("#select-brand").val()){
						cat_name = $(options[i]).attr("cat-name");
					}
				}
				$.ajax({
					type : "POST",
					url : "php/create_product.php?category="+cat_name,
					data : new FormData(this),
					processData : false,
					contentType : false,
					cache : false,
					xhr : function(){
						var request = new XMLHttpRequest();
						request.onprogress = function(event){
							var percentage = Math.floor((event.loaded/event.total)*100);
							$(".product-progress .progress-bar").css({
								width : percentage+"%"
							});

							$(".product-progress .progress-bar").html(percentage+"%");
						}

						return request;
					},
					beforeSend : function(){
						$(".product-loader").removeClass("d-none");
						$(".product-progress").removeClass("d-none");
					},
					success : function(response){
						$(".product-loader").addClass("d-none");
						if(response.trim() == "success"){
							$(".product-progress .progress-bar").css({
								width : "0%"
							});
							$(".product-progress .progress-bar").html("");
							$(".product-progress").addClass("d-none");
							$(".product-form").trigger('reset');

							//show new product notification

							setTimeout(function(){
								$("#send-noti-modal").modal();

								//start send notification to subscriber coding

								$(".send-noti-btn").click(function(){
									$.ajax({
										type : "POST",
										url : "php/send_notification.php",
										beforeSend : function(){
											$(".send-noti-btn").html("Please wait...");
										},
										success : function(response){
											if(response.trim() == "success"){
												$(".send-noti-btn").html("Success");
											}
										}
									});
								});

								//end send notification to subscriber coding
							},1000);
						}
						else{
							var product_notice = document.createElement("DIV");
							product_notice.className = "alert alert-warning";
							product_notice.innerHTML = "<b>"+response+"</b>";
							$(".product-notice-box").html(product_notice);
							setTimeout(function(){
								$(".product-notice-box").html('');
							},3000);
						}
					}
				});
			});
		}
	});
}

//end dynamic page request coding

//start category list coding

$(document).ready(function(){
	category_list();
});


function category_list(){
	$(".category-list").html('');
	$.ajax({
		type : "POST",
		url : "php/category_list.php",
		success : function(response){
			var j_obj = JSON.parse(response);
			var ul = document.createElement('UL');
			ul.className = "p-0 m-0";
			var i;
			for(i=0;i<j_obj.length;i++){
				var category_data = j_obj[i];
				var id = category_data.id;
				var category = category_data.category_name;
				var li = document.createElement('LI');
				var btn_box = document.createElement('DIV');
				var id_btn = document.createElement('BUTTON');
				var category_span = document.createElement("SPAN");
				var edit_btn = document.createElement('BUTTON');
				var delete_btn = document.createElement("BUTTON");
				li.className = "list-group-item my-2 border-0 shadow-sm";
				btn_box.className = "btn-group float-right";
				id_btn.className = "btn btn-dark shadow-sm";
				edit_btn.className = "btn bg-warning shadow-sm";
				delete_btn.className = "btn btn-danger shadow-sm";
				id_btn.innerHTML = id;
				category_span.innerHTML = "<b>"+category+"</b>";
				category_span.style.display = "inline-block";
				category_span.style.padding = "10px";
				edit_btn.innerHTML = "<i class='fa fa-edit category-edit-icon'></i><i class='fa fa-save d-none category-save-icon'></i>";
				delete_btn.innerHTML = "<i class='fa fa-trash category-delete-icon'></i>";
				li.append(id_btn);
				li.append(category_span);
				btn_box.append(edit_btn);
				btn_box.append(delete_btn);
				li.append(btn_box);
				ul.append(li);

				//edit category coding

				edit_btn.onclick = function(){
					var parent = this.parentElement.parentElement;
					var span = parent.getElementsByTagName('SPAN')[0];
					var id = parent.getElementsByTagName('BUTTON')[0];
					span.contentEditable = true;
					span.focus();
					var save_icon = this.getElementsByClassName('category-save-icon')[0];
					var edit_icon = this.getElementsByClassName('category-edit-icon')[0];
					$(save_icon).removeClass('d-none');
					$(edit_icon).addClass('d-none');
					save_icon.onclick = function(){
						var changed_category = span.getElementsByTagName("B")[0];
						$.ajax({
							type : "POST",
							url : "php/update_category.php",
							data : {
								changed_category : changed_category.innerHTML.trim(),
								id : id.innerHTML.trim()
							},
							success : function(response){
								if(response.trim() == "update success"){
									$(save_icon).addClass('d-none');
									$(edit_icon).removeClass('d-none');
									span.contentEditable = false;
								}
								else{
									alert(response);
								}
							}
						});
					}
				}

				//edit category onchange coding

				//delete category coding

				delete_btn.onclick = function(){
					var li = this.parentElement.parentElement;
					var id = li.getElementsByTagName('BUTTON')[0];
					var confirmation = confirm("are you sure");
					if(confirmation){
						$.ajax({
							type : "POST",
							url : "php/delete_category.php",
							data : {
								id : id.innerHTML.trim()
							},
							success : function(response){
								if(response.trim() == "delete success"){
									li.remove();
								}
								else{
									alert(response);
								}
							}
						});
					}

				}
			}

			$(".category-list").html(ul);
		}
	});
}

//end category list coding

function branding_details(){
		// caracter count coding
	$(document).ready(function(){
		function count(element_id,count_text){
			$("#"+element_id).on("input",function(){
				var length = $(this).val().length;
				$("."+count_text).html(length);
			});
		}

		count("about-us","about-us-count");
		count("cookies-policy","cookie-count");
		count("privacy-policy","privacy-count");
		count("terms-and-conditions","terms-count");
	});

	//form data submit coding

	$(document).ready(function(){
		$(".branding-form").submit(function(event){
			event.preventDefault();
			var brand_logo_upload_btn = document.querySelector("#choose-brand-logo");
			var logo_size;
			if(brand_logo_upload_btn.value == ""){
				logo_size = 0;
			}
			else{
				logo_size = brand_logo_upload_btn.files[0].size;
			}

			if(logo_size<200000){
				$.ajax({
					type : "POST",
					url : "php/branding_data.php",
					data : new FormData(this),
					processData : false,
					contentType : false,
					cache : false,
					beforeSend : function(){
						alert("plese wait...");
					},
					success : function(response){
						console.log(response);
					}
				});
			}
			else{
				alert("please upload photo less than 200kb");
			}
		});
	});

	//branding details control coding

	$(document).ready(function(){
		$.ajax({
			type : "POST",
			url : "php/check_branding_table.php",
			success : function(response){
				if(response.trim() == "no data"){
					alert(response);
				}
				else{
					var json_obj = JSON.parse(response.trim());
					$("#brand-name").val(json_obj[0].brand_name);
					$("#domain-name").val(json_obj[0].domain_name);
					$("#email").val(json_obj[0].email);
					$("#social-media").val(json_obj[0].facebook_url);
					$("#twitter").val(json_obj[0].twitter_url);
					$("#address").val(json_obj[0].address);
					$("#phone").val(json_obj[0].phone);
					$("#about-us").val(json_obj[0].about_us);
					$("#privacy-policy").val(json_obj[0].privacy_policy);
					$("#cookies-policy").val(json_obj[0].cookie_policy);
					$("#terms-and-conditions").val(json_obj[0].terms_policy);
					$(".branding-form input,.branding-form textarea,.branding-form button").prop("disabled",true);

					//edit branding coding

					$(".edit-branding-btn").click(function(){
						$(".branding-form input,.branding-form textarea,.branding-form button").prop("disabled",false);
					});
				}
			}
		})
	});

}

//start header showcase coding

function header_showcase(){
	$(document).ready(function(){
			$(".target-text").each(function(){
				$(this).click(function(event){
					var target_text = event.target;
					var index_no = $(target_text).index();
					sessionStorage.setItem("index",index_no);
					var i;
					for(i=0;i< $(".target-text").length;i++){
						$(".target-text").css({
							border : "0",
							boxShadow : "none",
							padding : "0",
						});
					}

					$(target_text).css({
						border : "1px solid #33AACC",
						boxShadow : "0px 0px 3px #33AACC",
						padding : "10px",
						width : "fit-content"
					});

					$(target_text).on("dblclick",function(){
						for(i=0;i< $(".target-text").length;i++){
							$(".target-text").css({
								border : "0",
								boxShadow : "none",
								padding : "0",
							});
						}
					});
				});
			});

			//start coloring text coding

			$("#color-picker").on("change",function(){
				var color = this.value;
				var ind_no = sessionStorage.getItem("index");
				var showcase_text = document.getElementsByClassName("target-text")[ind_no];
				showcase_text.style.color = color;
				$(".color-btn").css({
					background : color,
					border : "1px solid "+color
				});
			});

			//start font size coding

			$(".font-size-slider").on("input",function(){
				var font_size = this.value;
				var ind_no = sessionStorage.getItem("index");
				var showcase_text = document.getElementsByClassName("target-text")[ind_no];
				showcase_text.style.fontSize = font_size+"%";
			});

			//start alignment coding

			$(".alignment").each(function(){
				$(this).click(function(){
					var align_position = $(this).attr("align-position");
					var align_value = $(this).attr("align-value");
					if(align_position == "h"){
						$(".showcase-preview").css({
							justifyContent : align_value
						});
					}
					else if(align_position == "v"){
						$(".showcase-preview").css({
							alignItems : align_value
						});
					}
				});
			});
		});

		//start title image upload coding
		$(document).ready(function(){
			$("#choose-title-image").on("change",function(){
				var file = this.files[0];
				if(file.size < 200000){
					var blob_url = URL.createObjectURL(file);
					var image = new Image();
					image.src = blob_url;
					image.onload = function(){
						var o_width = image.width;
						var o_height = image.height;
						if(o_width == 1920 && o_height == 978){
							image.style.width = "100%";
							image.style.position = "absolute";
							image.style.top = "0";
							image.style.left = "0";
							$(".showcase-preview").append(image);
						}
						else{
							alert("please upload 1920*978 photo");
						}
					}

				}
				else{
					alert("please upload photo less than 200kb");
				}
			});
		});

		//start title and subtitle text count and rewrite coding

		$(document).ready(function(){
			function text_count(element,count_element,rewrite_texts){
				$("#"+element).on("input",function(){
					var count = $(this).val().length;
					$("."+rewrite_texts).html($(this).val());
					$("."+count_element).html(count);
				});
			}

			text_count("title-text","title-text-count","showcase-title");
			text_count("subtitle-text","subtitle-text-count","showcase-subtitle");
		});

		//start add showcase coding

		$(document).ready(function(){
			var default_showcase = $(".showcase-preview").html();
			$(".header-showcase-form").submit(function(event){
				event.preventDefault();
				var showcase_title = document.querySelector(".showcase-title");
				var showcase_subtitle = document.querySelector(".showcase-subtitle");
				var file = document.querySelector("#choose-title-image").files[0];

				var title_font_size = "";
				var subtitle_font_size = "";
				var title_color = "";
				var subtitle_color = "";
				var h_align = "";
				var v_align = "";

				//font size

				if(showcase_title.style.fontSize == ""){
					title_font_size = "300%";
				}
				else{
					title_font_size = showcase_title.style.fontSize;
				}

				if(showcase_subtitle.style.fontSize == ""){
					subtitle_font_size = "200%";
				}
				else{
					subtitle_font_size = showcase_subtitle.style.fontSize;
				}

				//color

				if(showcase_title.style.color == ""){
					title_color = "black";
				}
				else{
					title_color = showcase_title.style.color;
				}

				if(showcase_subtitle.style.color == ""){
					subtitle_color = "black";
				}
				else{
					subtitle_color = showcase_subtitle.style.color;
				}

				//alignment

				var flex_box = document.querySelector(".showcase-preview");
				if(flex_box.style.justifyContent == ""){
					h_align = "flex-start";
				}
				else{
					h_align = flex_box.style.justifyContent;
				}

				if(flex_box.style.alignItems == ""){
					v_align = "flex-start";
				}
				else{
					v_align = flex_box.style.alignItems;
				}

				css_data = {
					title_color : title_color,
					subtitle_color : subtitle_color,
					title_size : title_font_size,
					subtitle_size : subtitle_font_size,
					h_align : h_align,
					v_align : v_align,
					title_text : showcase_title.innerHTML,
					subtitle_text : showcase_subtitle.innerHTML,
					btn_data : $(".btn-box").html().trim(),
					options : $("#edit-header-showcase").val().trim() 
				}

				var form_data = new FormData();
				form_data.append("file_data",file);
				form_data.append("css_data",JSON.stringify(css_data));

				$.ajax({
					type : "POST",
					url : "php/add_showcase.php",
					data : form_data,
					processData : false,
					contentType : false,
					cache : false,
					beforeSend : function(){
						$(".add-showcase-btn").html("Please wait...");
					},
					success : function(response){
						if(response.trim() == "success"){
							$(".add-showcase-btn").html("Add showcase");
							$(".showcase-preview").html(default_showcase);
							$(".header-showcase-form").trigger("reset");
						}
						else if(response.trim() == "update success"){
							$(".add-showcase-btn").html("Add showcase");
							$(".add-showcase-btn").removeClass("btn-danger");
							$(".add-showcase-btn").addClass("btn-dark");
							$(".showcase-preview").html(default_showcase);
							$(".header-showcase-form").trigger("reset");
						}
						else{
							console.log(response);
						}
					}
				});
			});
		});

		//start create button coding

		$(document).ready(function(){
			$(".add-btn").click(function(){
				var btn_url = $(".btn-url").val();
				var btn_name = $(".btn-name").val();
				var btn_color = $(".btn-bgcolor").val();
				var btn_txtcolor = $(".btn-textcolor").val();
				var btn_size = $(".btn-size").val();

				var btn = document.createElement("BUTTON");
				var a = document.createElement("A");
				btn.className = "btn mr-2 showcase-btn";
				btn.style.background = btn_color;
				a.href = btn_url;
				a.innerHTML = btn_name;
				a.style.color = btn_txtcolor;
				a.style.fontSize = btn_size;
				btn.append(a);

				var btn_box = document.querySelector(".btn-box");
				var btns = btn_box.getElementsByTagName("BUTTON");
				var btn_count = btns.length;
				if(btn_count == 0 || btn_count == 1){
					$(".btn-box").append(btn);
				}
				else{
					alert("only two buttons are allowed");
				}
			});
		});

		//start preview showcase coding

		$(document).ready(function(){
			$(".preview-btn").click(function(){
				var title_photo = document.querySelector("#choose-title-image").files[0];
				var flex_box = document.querySelector(".showcase-preview");
				h_align = "";
				v_align = "";
				if(flex_box.style.justifyContent == ""){
					h_align = "flex-start";
				}
				else{
					h_align = flex_box.style.justifyContent;
				}

				if(flex_box.style.alignItems == ""){
					v_align = "flex-start";
				}
				else{
					v_align = flex_box.style.alignItems;
				}

				var page_data = [$(".title-box").html().trim(),h_align,v_align];
				var form_data = new FormData();
				form_data.append("title_photo",title_photo);
				form_data.append("page_data",JSON.stringify(page_data));
				$.ajax({
					type : "POST",
					url : "php/preview.php",
					data : form_data,
					processData : false,
					contentType : false,
					cache : false,
					success : function(response){
						var page_window = window.open("about:blank");
						page_window.document.open();
						page_window.document.write(response);
						page_window.document.close();
					}
				});
			});
		});

		// start edit showcase coding

		$(document).ready(function(){
			var default_showcase = $(".showcase-preview").html();
			$("#edit-header-showcase").on("change",function(){
				if($(this).val() != "Choose showcase"){
					var id = $(this).val();
					$.ajax({
						type : "POST",
						url : "php/edit_showcase.php",
						data : {
							id : id
						},
						success : function(response){
							$("#choose-title-image").removeAttr("required");
							$(".add-showcase-btn").html("Save");
							$(".add-showcase-btn").removeClass("btn-dark");
							$(".add-showcase-btn").addClass("btn-danger");
							$(".delete-header-showcase-icon").removeClass("d-none");
							
							// delete header showcase 

							$(".delete-header-showcase-icon").click(function(){
								var confirm = window.confirm("are you sure ? ");
								if(confirm){
									$.ajax({
									type : "POST",
									url : "php/delete_header_showcase.php",
									data : {
										id : $("#edit-header-showcase").val()
									},
									beforeSend : function(){
										$(".delete-header-showcase-icon").removeClass("fa fa-trash");
										$(".delete-header-showcase-icon").addClass("fa fa-circle-o-notch fa-spin");
									},
									success : function(response){
										var deleted_showcase = $("#edit-header-showcase").val();
										if(response.trim() == "success"){
											$(".delete-header-showcase-icon").removeClass("fa fa-circle-o-notch fa-spin");
											$(".delete-header-showcase-icon").addClass("fa fa-trash d-none");
											$(".showcase-preview").html(default_showcase);
											if(!$(".delete-btn-icon").hasClass("d-none")){
												$(".delete-btn-icon").addClass("d-none");
											}
											$(".header-showcase-form").trigger("reset");
											var op = $("#edit-header-showcase option");
											op[0].selected = "selected";
											var i;
											for(i=0;i<op.length;i++){
												if(op[i].value == deleted_showcase){
													op[i].remove();
												}
											}
										}
										else{
											alert(response);	
										}
									}
								});				
								}
							});

							var showcase_data_obj = JSON.parse(response.trim());
							var image = document.createElement("IMG");
							image.src = showcase_data_obj[0];
							image.style.width = "100%";
							image.style.position = "absolute";
							image.style.top = "0";
							image.style.left = "0";
							$(".showcase-preview").append(image);
							$(".showcase-preview").css({
								justifyContent : showcase_data_obj[7],
								alignItems : showcase_data_obj[8]
							});
							$(".showcase-title").html(showcase_data_obj[1]);
							$(".showcase-title").css({
								color : showcase_data_obj[2],
								fontSize : showcase_data_obj[3]
							});

							$(".showcase-subtitle").html(showcase_data_obj[4]);
							$(".showcase-subtitle").css({
								color : showcase_data_obj[5],
								fontSize : showcase_data_obj[6]
							});

							$(".btn-box").html(showcase_data_obj[9]);

							$("#title-text").val(showcase_data_obj[1]);
							$("#subtitle-text").val(showcase_data_obj[4]);

							//edit showcase btn

							$(".showcase-btn").each(function(){
								$(this).click(function(event){
									$(".delete-btn-icon").removeClass("d-none");
									sessionStorage.setItem("btn_index",$(this).index());
									event.preventDefault();
									var url = $(this).children().attr("href");
									var name = $(this).children().html();
									$(".btn-url").val(url);
									$(".btn-name").val(name);
									
									//btn bg color

									var bgcolor = $(this).css("backgroundColor").replace("rgb(","").replace(")","");
									var bg_rgb = bgcolor.split(",");
									var i;
									var bg_color_code = "";
									for(i=0;i<bg_rgb.length;i++){
										var hex = Number(bg_rgb[i]).toString(16);
										bg_color_code += hex.length == 1 ? "0"+hex : hex;
									}

									$(".btn-bgcolor").val("#"+bg_color_code);

									//btn text color

									var textcolor = $(this).children().css("color").replace("rgb(","").replace(")","");
									var text_rgb = textcolor.split(",");
									var text_color_code = "";
									for(i=0;i<text_rgb.length;i++){
										var hex = Number(text_rgb[i]).toString(16);
										text_color_code += hex.length == 1 ? "0"+hex : hex;
									}

									$(".btn-textcolor").val("#"+text_color_code);

									//btn size 

									var btn_size = $(this).children().css("fontSize");
									var op = $(".btn-size option")
									for(i=0;i<op.length;i++){
										if(op[i].value == btn_size){
											op[i].selected = "selected";
										}
									}


								});
							});

							//edit btn text

							$(".btn-name").on("input",function(){
								var btn_index = sessionStorage.getItem("btn_index");
								var btn = document.getElementsByClassName("showcase-btn")[btn_index];
								btn.getElementsByTagName("A")[0].innerHTML = this.value;
							});

							// edit btn link

							$(".btn-url").on("input",function(){
								var btn_index = sessionStorage.getItem("btn_index");
								var btn = document.getElementsByClassName("showcase-btn")[btn_index];
								btn.getElementsByTagName("A")[0].href = this.value;
							});

							//edit btn bg color

							$(".btn-bgcolor").on("change",function(){
								var btn_index = sessionStorage.getItem("btn_index");
								var btn = document.getElementsByClassName("showcase-btn")[btn_index];
								btn.style.backgroundColor = this.value;
							});

							//edit btn text color

							$(".btn-textcolor").on("change",function(){
								var btn_index = sessionStorage.getItem("btn_index");
								var btn = document.getElementsByClassName("showcase-btn")[btn_index];
								btn.getElementsByTagName("A")[0].style.color = this.value;
							});

							//edit btn size

							$(".btn-size").on("change",function(){
								var btn_index = sessionStorage.getItem("btn_index");
								var btn = document.getElementsByClassName("showcase-btn")[btn_index];
								btn.getElementsByTagName("A")[0].style.fontSize = this.value;
							});

							//delete btn 

							$(".delete-btn-icon").on("click",function(){
								var btn_index = sessionStorage.getItem("btn_index");
								var btn = document.getElementsByClassName("showcase-btn")[btn_index];
								var confirm = window.confirm("are you sure ? ");
								if(confirm){
									btn.remove();
									$(".btn-url,.btn-name").val('');
									$(".btn-bgcolor,.btn-textcolor").val("#000000");
									var op = $(".btn-size option");
									op[0].selected = "selected";
									$(".delete-btn-icon").addClass("d-none");
								}

							});

						}
					});
				}
				else{
					$("#choose-title-image").attr("required","required");
					$(".add-showcase-btn").html("Add showcase");
					$(".add-showcase-btn").removeClass("btn-danger");
					$(".add-showcase-btn").addClass("btn-dark");
					$(".showcase-preview").html(default_showcase);
					$(".header-showcase-form").trigger("reset");
					$(".delete-header-showcase-icon").addClass("d-none");
				}
			});
		});
}

function category_showcase(){
	// start category showcase coding
		$(document).ready(function(){
			$(".upload-btn").each(function(){
				$(this).on("change",function(){
					var upload_btn = this;
					var file = this.files[0];
					var url = URL.createObjectURL(file);
					var text_input = this.parentElement.parentElement.getElementsByTagName("INPUT")[1];
					var upload_img = this.parentElement.parentElement.parentElement.getElementsByTagName("IMG")[0];
					var set_btn = this.parentElement.parentElement.getElementsByClassName("set-btn")[0];
					var original_width = upload_img.naturalWidth;
					var original_height = upload_img.naturalHeight;
					var image = new Image();
					image.src = url;
					image.onload = function(){
						var uploaded_width = image.width;
						var uploaded_height = image.height;
						if(original_width == uploaded_width && original_height == uploaded_height){
							text_input.oninput = function(){
								if(this.value.length >= 1){
									set_btn.disabled = false;
									set_btn.onclick = function(){
										var formdata = new FormData();
										formdata.append("photo",file);
										formdata.append("text",text_input.value);
										formdata.append("photo_pos",$(upload_img).attr("img-pos"));
										$.ajax({
											type : "POST",
											url : "php/category_showcase.php",
											data : formdata,
											processData : false,
											contentType : false,
											cache : false,
											beforeSend : function(){
												set_btn.innerHTML = "Please wait...";
											},
											success : function(response){
												if(response.trim() == "success" || response.trim() == "update success"){
													set_btn.innerHTML = "SET";
													upload_img.src = url;
													$(upload_btn.parentElement.parentElement).addClass("d-none");
													upload_img.ondblclick = function(){
														$(upload_btn.parentElement.parentElement).removeClass("d-none");
													}
												}
												else{
													alert(response);
												}
											}
										});
									}
								}
								else{
									set_btn.disabled = true;
								}
							}
						}
						else{
							alert("not matched");
						}
					}
				});
			});
		});


		//show category showcase by default

		$(document).ready(function(){
			var img = $("img");
			var i;
			for(i=0;i<img.length;i++){
				if(img[i].src.indexOf("base64") != -1){
					var set_btn = img[i].parentElement.getElementsByClassName("set-btn")[0];
					set_btn.disabled = false;
					$(set_btn).each(function(){
						$(this).click(function(){
							set_btn = this;
							var inputs = this.parentElement.getElementsByTagName("INPUT");
							var previous_img = this.parentElement.parentElement.getElementsByTagName("IMG")[0];
							var file = inputs[0].files[0];
							var url = previous_img.src;
							if(inputs[0].value != ""){
								url = URL.createObjectURL(file);
							}
							var formdata = new FormData();
							formdata.append("photo",file);
							formdata.append("text",inputs[1].value);
							formdata.append("photo_pos",$(previous_img).attr("img-pos"));
							$.ajax({
								type : "POST",
								url : "php/category_showcase.php",
								data : formdata,
								processData : false,
								contentType : false,
								cache : false,
								beforeSend : function(){
									set_btn.innerHTML = "Please wait...";
								},
								success : function(response){
									if(response.trim() == "success" || response.trim() == "update success"){
										set_btn.innerHTML = "SET";
										previous_img.src = url;
										$(set_btn.parentElement).addClass("d-none");
										previous_img.ondblclick = function(){
											$(set_btn.parentElement).removeClass("d-none");
										}
									}
									else{
										alert(response);
									}
								}
							});
						});
					});
				}
			}
		});
}

//start delivery location coding

function delivery_location(){
	//get state coding

		$(document).ready(function(){
			$(".choose-country").on("change",function(){
				$(".choose-state").html('');
				var option = $(".choose-country option");
				var i;
				for(i=0;i<option.length;i++){
					if(option[i].innerHTML == $(".choose-country").val()){
						var country_id = $(option[i]).attr("country-id");
						$.ajax({
							type : "POST",
							url : "php/get_states.php",
							data : {
								country_id : country_id
							},
							success : function(response){
								var states_obj = JSON.parse(response.trim());
								var i;
								for(i=0;i<states_obj.length;i++){
									var option = "<option state-id='"+states_obj[i].id+"'>"+states_obj[i].name+"</option>";
									$(".choose-state").append(option);
								}


							}
						});
					}
				}
			});
		});

		//get city coding

		$(document).ready(function(){
			$(".choose-state").on("change",function(){
				$(".choose-city").html('');
				var option = $(".choose-state option");
				var i;
				for(i=0;i<option.length;i++){
					if(option[i].innerHTML == $(".choose-state").val()){
						var state_id = $(option[i]).attr("state-id");
						$.ajax({
							type : "POST",
							url : "php/get_city.php",
							data : {
								state_id : state_id
							},
							success : function(response){
								var city_obj = JSON.parse(response.trim());
								var i;
								for(i=0;i<city_obj.length;i++){
									var option = "<option>"+city_obj[i].name+"</option>";
									$(".choose-city").append(option);
								}


							}
						});
					}
				}
			});
		});

		
		//get pincode coding

		$(document).ready(function(){
			$(".choose-city").on("change",function(){
				var city = $(this).val();
				$.ajax({
					type : "GET",
					url : "https://api.postalpincode.in/postoffice/"+city,
					success : function(response){
						var length = response[0].PostOffice.length-1;
						$("#pincode").val(response[0].PostOffice[length].Pincode);
					}
				});
			});
		});		

		//set location form coding

		$(document).ready(function(){
			$(".set-location-form").submit(function(event){
				event.preventDefault();
				$.ajax({
					type : "POST",
					url : "php/set_location.php",
					data : new FormData(this),
					processData : false,
					contentType : false,
					cache : false,
					success : function(response){
						alert(response);
					}
				});
			});
		});
}

//start sales report coding

function sales_report(){

		//delivery coding

		$(document).ready(function(){
			$(".dispatch-btn").each(function(){
				$(this).click(function(){
					var dispatch_btn = this;
					var order_id = $(this).attr("order-id");
					var product_title = $(this).attr("product-title");
					var price = $(this).attr("price");
					var fullname = $(this).attr("fullname");
					var address = $(this).attr("address");
					var email = $(this).attr("email");
					var mobile = $(this).attr("mobile");
					var qty = $(this).attr("qty");
					$.ajax({
						type : "POST",
						url : "php/dispatch.php",
						data : {
							order_id : order_id,
							product_title : product_title,
							price : price,
							fullname : fullname,
							address : address,
							email : email,
							mobile : mobile,
							qty : qty
						},
						beforeSend : function(){
							$(dispatch_btn).html("Please wait...");
						},
						success : function(response){
							if(response.trim() == "success"){
								$(dispatch_btn).html("Order Dispatched");
								$(dispatch_btn).attr("disabled","disabled");

								// show no of items dispatch when all items are dispatched

								var item_no = Number(sessionStorage.getItem("count"))+1;
								sessionStorage.setItem("count",item_no);
								$(".dis-all").html(item_no+" item dispatched");
								var s_no = Number($(".s-no").length);
								if(s_no == item_no){
									$(".dis-all").html("Complete");
									sessionStorage.removeItem("count");
									setTimeout(function(){
										$(".dis-all").html("Dispatch All");
									},2000);
								}

							}
							else{
								$(dispatch_btn).html("Dispatch");
							}
						}
					});
				});
			});
		});

		//dispatch all product coding

		$(document).ready(function(){
			$(".dis-all").click(function(){
				var dispatch_all_btns = $(".dispatch-btn");
				var status = $(".status");
				var i,massage = "";
				for(i=0;i<status.length;i++){
					if(status[i].innerHTML == "processing"){
						for(i=0;i<dispatch_all_btns.length;i++){
							dispatch_all_btns[i].click();
							massage = "Please wait...";
						}
					}
					else if(status[i].innerHTML == "Dispatched"){
						massage = "No Item";
					}
				}

				$(this).html(massage);
			});
		});

		//download details in xls and pdf format coding

		$(document).ready(function(){
			$(".download-format").on("change",function(){
				if($(this).val() == "xls"){
					window.location = "php/export_as_xls.php";
				}
				else if($(this).val() == "pdf"){
					window.location = "php/dompdf.php";
				}

			});
		});

		//sort sales coding

		$(document).ready(function(){
			$(".sort-by").on("change",function(){
				var sort_value = $(this).val();
				$.ajax({
					type : "POST",
					url : "php/sort_sales.php",
					data : {
						sort_value : sort_value
					},
					success : function(response){
						if(response.trim() != "No sales found !!"){
							var table = document.createElement("TABLE");
							table.className = "table table-responsive table-bordered table-hover table-striped text-center";
							table.innerHTML = "<thead class='thead-dark'><tr><th>S/No</th><th>Product ID</th><th>Title</th><th>Quantity</th><th>Price</th><th>address</th><th>State</th><th>Country</th><th>Pincode</th><th>Purchase date</th><th>Customer Name</th><th>Username</th><th>Mobile</th><th>Status</th><th>Action</th></tr></thead>";
							$(".sales-table").html(table);

							var sales_data_obj = JSON.parse(response.trim());
							var i;
							for(i=0;i<sales_data_obj.length;i++){
								var tr = document.createElement("TR");
								var s_no_td = document.createElement("TD");
								s_no_td.innerHTML = sales_data_obj[i].id;
								tr.append(s_no_td);

								var product_id_td = document.createElement("TD");
								product_id_td.innerHTML = sales_data_obj[i].product_id;
								tr.append(product_id_td);

								var title_td = document.createElement("TD");
								title_td.innerHTML = sales_data_obj[i].product_title;
								tr.append(title_td);

								var qty_td = document.createElement("TD");
								qty_td.innerHTML = sales_data_obj[i].quantity;
								tr.append(qty_td);

								var price_td = document.createElement("TD");
								price_td.innerHTML = sales_data_obj[i].price;
								tr.append(price_td);

								var address_td = document.createElement("TD");
								address_td.innerHTML = sales_data_obj[i].address;
								tr.append(address_td);

								var state_td = document.createElement("TD");
								state_td.innerHTML = sales_data_obj[i].state;
								tr.append(state_td);

								var country_td = document.createElement("TD");
								country_td.innerHTML = sales_data_obj[i].country;
								tr.append(country_td);

								var pincode_td = document.createElement("TD");
								pincode_td.innerHTML = sales_data_obj[i].pincode;
								tr.append(pincode_td);
								table.append(tr);

								var purchase_td = document.createElement("TD");
								purchase_td.innerHTML = sales_data_obj[i].purchase_date;
								tr.append(purchase_td);

								var customer_td = document.createElement("TD");
								customer_td.innerHTML = sales_data_obj[i].fullname;
								tr.append(customer_td);

								var email_td = document.createElement("TD");
								email_td.innerHTML = sales_data_obj[i].email;
								tr.append(email_td);

								var mobile_td = document.createElement("TD");
								mobile_td.innerHTML = sales_data_obj[i].mobile;
								tr.append(mobile_td);

								var status_td = document.createElement("TD");
								status_td.innerHTML = sales_data_obj[i].status;
								tr.append(status_td);

								if(sales_data_obj[i].status == "processing"){
									var action_td = document.createElement("TD");
									var button = document.createElement("BUTTON");
									button.className = "btn btn-primary dispatch-btn";
									$(button).attr("order-id",sales_data_obj[i].id);
									$(button).attr("product-title",sales_data_obj[i].product_title);
									$(button).attr("fullname",sales_data_obj[i].fullname);
									$(button).attr("address",sales_data_obj[i].address);
									$(button).attr("email",sales_data_obj[i].email);
									$(button).attr("mobile",sales_data_obj[i].mobile);
									$(button).attr("qty",sales_data_obj[i].quantity);
									$(button).attr("price",sales_data_obj[i].price);

									button.innerHTML = "Dispatch";
									action_td.append(button);
									tr.append(action_td);

									button.onclick = function(){

										var dispatch_btn = this;
										var order_id = $(this).attr("order-id");
										var product_title = $(this).attr("product-title");
										var price = $(this).attr("price");
										var fullname = $(this).attr("fullname");
										var address = $(this).attr("address");
										var email = $(this).attr("email");
										var mobile = $(this).attr("mobile");
										var qty = $(this).attr("qty");
										$.ajax({
											type : "POST",
											url : "php/dispatch.php",
											data : {
												order_id : order_id,
												product_title : product_title,
												price : price,
												fullname : fullname,
												address : address,
												email : email,
												mobile : mobile,
												qty : qty
											},
											beforeSend : function(){
												$(dispatch_btn).html("Please wait...");
											},
											success : function(response){
												if(response.trim() == "success"){
													$(dispatch_btn).html("Order Dispatched");
													$(dispatch_btn).attr("disabled","disabled");

													// show no of items dispatch when all items are dispatched

													var item_no = Number(sessionStorage.getItem("count"))+1;
													sessionStorage.setItem("count",item_no);
													$(".dis-all").html(item_no+" item dispatched");
													var s_no = Number($(".s-no").length);
													if(s_no == item_no){
														$(".dis-all").html("Complete");
														sessionStorage.removeItem("count");
														setTimeout(function(){
															$(".dis-all").html("Dispatch All");
														},2000);
													}

												}
												else{
													$(dispatch_btn).html("Dispatch");
												}
											}
										});
									}
								}
								else if(sales_data_obj[i].status == "Dispatched"){
									var action_td = document.createElement("TD");
									var button = document.createElement("BUTTON");
									button.className = "btn btn-danger";
									$(button).attr("order-id",sales_data_obj[i].id);
									$(button).attr("product-title",sales_data_obj[i].product_title);
									$(button).attr("fullname",sales_data_obj[i].fullname);
									$(button).attr("address",sales_data_obj[i].address);
									$(button).attr("email",sales_data_obj[i].email);
									$(button).attr("mobile",sales_data_obj[i].mobile);
									$(button).attr("qty",sales_data_obj[i].quantity);
									$(button).attr("price",sales_data_obj[i].price);

									button.innerHTML = "Already Dispatched on "+sales_data_obj[i].dispatch_date;
									action_td.append(button);
									tr.append(action_td);
								}

								table.append(tr);
							}
						}
						else{
							alert(response.trim());
						}
					}
				});
			});
		});
}

//end sales report coding

//start keyword planner coding

function keyword_planner(){
	//start category keyword setting coding

		$(document).ready(function(){
			$(".keyword-form").submit(function(event){
				event.preventDefault();
				if($("#p-keyword").val() != "Choose primary keyword"){
					$.ajax({
						type : "POST",
						url : "php/keyword.php",
						data : new FormData(this),
						processData : false,
						contentType : false,
						cache : false,
						beforeSend : function(){
							$(".update-keyword-btn").html("Please wait...");
							$(".update-keyword-btn").attr("disabled","disabled");
						},
						success : function(response){
							if(response.trim() == "success"){
								$(".update-keyword-btn").html("Success");
								setTimeout(function(){
									$(".update-keyword-btn").html("Update");
									$(".update-keyword-btn").attr("disabled",false);
									$(".keyword-form").trigger("reset");
								},2000);
							}
							else{
								alert(response);
							}
						}
					});
				}
				else{
					alert("Please choose any primary keyword");
				}
			});
		});

		//end category keyword setting coding

		//start show category s_keyword in textarea coding

		$(document).ready(function(){
			$("#p-keyword").on("change",function(){
				if($(this).val() != "Choose primary keyword"){
					$.ajax({
						type : "POST",
						url : "php/show_s_keyword.php",
						data : {
							p_keyword : $(this).val()
						},
						success : function(response){
							$("#s-keyword").val(response.trim());
						}
					});
				}
			});
		});

		//end show category s_keyword in textarea coding

		//start show brand s_keyword in textarea coding

		$(document).ready(function(){
			$("#brand-p-keyword").on("change",function(){
				if($(this).val() != "Choose primary keyword"){
					$.ajax({
						type : "POST",
						url : "php/show_s_keyword.php",
						data : {
							p_keyword : $(this).val()
						},
						success : function(response){
							$("#brand-s-keyword").val(response.trim());
						}
					});
				}
			});
		});

		//end show brand s_keyword in textarea coding

		//start show product s_keyword in textarea coding

		$(document).ready(function(){
			$("#product-p-keyword").on("change",function(){
				if($(this).val() != "Choose primary keyword"){
					$.ajax({
						type : "POST",
						url : "php/show_s_keyword.php",
						data : {
							p_keyword : $(this).val()
						},
						success : function(response){
							$("#product-s-keyword").val(response.trim());
						}
					});
				}
			});
		});

		//end show product s_keyword in textarea coding

		//start copy failed category keyword coding

		$(document).ready(function(){
			$(".failed-cat-keyword-btn").click(function(){
				var failed_keywords = "";
				$(".failed-keyword").each(function(){
					failed_keywords += $(this).text()+", ";
				});

				$("#s-keyword").val(failed_keywords);
			});
		});

		//end copy failed category keyword coding

		//start copy failed brand keyword coding

		$(document).ready(function(){
			$(".failed-brand-keyword-btn").click(function(){
				var failed_keywords = "";
				$(".failed-keyword").each(function(){
					failed_keywords += $(this).text()+", ";
				});

				$("#brand-s-keyword").val(failed_keywords);
			});
		});

		//end copy failed brand keyword coding

		//start copy failed product keyword coding

		$(document).ready(function(){
			$(".failed-product-keyword-btn").click(function(){
				var failed_keywords = "";
				$(".failed-keyword").each(function(){
					failed_keywords += $(this).text()+", ";
				});

				$("#product-s-keyword").val(failed_keywords);
			});
		});

		//end copy failed product keyword coding

		//start show brand coding

		$(document).ready(function(){
			$("#brand-category").on("change",function(){
				if($(this).val() != "Choose category"){
					$.ajax({
						type : "POST",
						url : "php/show_brands.php",
						data : {
							category : $(this).val() 
						},
						success : function(response){
							if(response.trim() != "brands are not created in this category"){
								$("#brand-p-keyword").html("");
								var brand_obj = JSON.parse(response.trim());
								var i;
								for(i=0;i<brand_obj.length;i++){
									var option = document.createElement("OPTION");
									option.innerHTML = brand_obj[i].brand_name;
									$("#brand-p-keyword").append(option);
								}
							}
						}
					});
				}
			});
		});

		//end show brand coding

		//start brand keyword setting coding

		$(document).ready(function(){
			$(".brand-keyword-form").submit(function(event){
				event.preventDefault();
				if($("#brand-p-keyword").val() != "Choose primary keyword"){
					$.ajax({
						type : "POST",
						url : "php/keyword.php",
						data : new FormData(this),
						processData : false,
						contentType : false,
						cache : false,
						beforeSend : function(){
							$(".update-brand-keyword-btn").html("Please wait...");
							$(".update-brand-keyword-btn").attr("disabled","disabled");
						},
						success : function(response){
							if(response.trim() == "success"){
								$(".update-brand-keyword-btn").html("Success");
								setTimeout(function(){
								$(".update-brand-keyword-btn").html("Update");
								$(".update-brand-keyword-btn").attr("disabled",false);
								$(".brand-keyword-form").trigger("reset");
								},2000);
							}
						}
					});
				}
				else{
					alert("Please choose any primary keyword");
				}
			});
		});

		//end brand keyword setting coding

		//start show brand coding

		$(document).ready(function(){
			$("#product-category").on("change",function(){
				if($(this).val() != "Choose category"){
					$.ajax({
						type : "POST",
						url : "php/show_brands.php",
						data : {
							category : $(this).val() 
						},
						success : function(response){
							if(response.trim() != "brands are not created in this category"){
								$("#product-brand").html("");
								var brand_obj = JSON.parse(response.trim());
								var i;
								for(i=0;i<brand_obj.length;i++){
									var option = document.createElement("OPTION");
									option.innerHTML = brand_obj[i].brand_name;
									$("#product-brand").append(option);
								}
							}
						}
					});
				}
			});
		});

		//end show brand coding

		//start show product coding

		$(document).ready(function(){
			$("#product-brand").on("change",function(){
				if($(this).val() != "Choose brand"){
					$.ajax({
						type : "POST",
						url : "php/show_products.php",
						data : {
							brand : $(this).val() 
						},
						success : function(response){
							if(response.trim() != "No such product avilable in this brand"){
								$("#product-p-keyword").html("");
								var product_obj = JSON.parse(response.trim());
								var i;
								for(i=0;i<product_obj.length;i++){
									var option = document.createElement("OPTION");
									option.innerHTML = product_obj[i].product_name;
									$("#product-p-keyword").append(option);
								}
							}
						}
					});
				}
			});
		});

		//end show product coding

		//start product keyword setting coding

		$(document).ready(function(){
			$(".product-keyword-form").submit(function(event){
				event.preventDefault();
				if($("#product-p-keyword").val() != "Choose primary keyword"){
					$.ajax({
						type : "POST",
						url : "php/keyword.php",
						data : new FormData(this),
						processData : false,
						contentType : false,
						cache : false,
						beforeSend : function(){
							$(".update-product-keyword-btn").html("Please wait...");
							$(".update-product-keyword-btn").attr("disabled","disabled");
						},
						success : function(response){
							if(response.trim() == "success"){
								$(".update-product-keyword-btn").html("Success");
								setTimeout(function(){
								$(".update-product-keyword-btn").html("Update");
								$(".update-product-keyword-btn").attr("disabled",false);
								$(".product-keyword-form").trigger("reset");
								},2000);
							}
						}
					});
				}
				else{
					alert("Please choose any primary keyword");
				}
			});
		});

		//end product keyword setting coding

		//start delete updated keyword coding

		$(document).ready(function(){
			$(".delete-updated-keyword-btn").click(function(){
				var delete_keywords = [];
				$(".failed-keyword").each(function(i){
					delete_keywords[i] = $(this).text().trim();
				});

				$.ajax({
					type : "POST",
					url : "php/delete_keywords.php",
					data : {
						keywords : JSON.stringify(delete_keywords)
					},
					success : function(response){
						alert(response);
					}
				});
			});
		});

		//end delete updated keyword coding
}

//end keyword planner coding