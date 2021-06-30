// start add to cart coding

function add_to_cart() {
	$(document).ready(function () {
		$(".add-to-cart-btn").each(function () {
			$(this).click(function () {
				var add_to_cart_btn = this;
				var all_cookies = document.cookie.split(";");
				var i;
				var find_user = "";
				for (i = 0; i < all_cookies.length; i++) {
					var key_value = all_cookies[i].split("=");
					if (key_value[0].trim() == "_ua_") {
						find_user += "user loged in";
					}
					else {
						find_user += "login please";
					}
				}

				if (find_user.indexOf("user loged in") != -1) {
					var product_id = $(this).attr("product-id");
					var product_title = $(this).attr("product-title");
					var product_price = $(this).attr("product-price");
					var product_qty = $(this).attr("qty");
					var product_brand = $(this).attr("product-brand");
					var product_pic = $(this).attr("product-pic");
					$.ajax({
						type: "POST",
						url: ROOT_URL+"/eshop/pages/php/cart.php",
						data: {
							product_id: product_id,
							product_title: product_title,
							product_price: product_price,
							product_qty: product_qty,
							product_brand: product_brand,
							product_pic: product_pic
						},
						beforeSend: function () {
							$(add_to_cart_btn).html("Please wait...");
							$(add_to_cart_btn).attr("disabled", "disabled");
						},
						success: function (response) {
							$(add_to_cart_btn).html("<i class='fa fa-shopping-cart px-2'></i>Add to Cart");
							$(add_to_cart_btn).attr("disabled", false);
							if (response.trim() == "success") {
								if ($(".cart-item-count-box").prop("nodeName") != undefined) {
									var item_count = Number($(".cart-item-count-box span").html().trim());
									item_count++;
									$(".cart-item-count-box span").html(item_count);
								}
								else {
									var cart_count_box = document.createElement("DIV");
									var span = document.createElement("SPAN");
									cart_count_box.style.position = "absolute";
									cart_count_box.className = "text-white text-center cart-item-count-box";
									cart_count_box.style.background = "#E83350";
									cart_count_box.style.width = "20px";
									cart_count_box.style.height = "20px";
									cart_count_box.style.borderRadius = "50%";
									cart_count_box.style.zIdex = "1000";
									cart_count_box.style.left = "35px";
									cart_count_box.style.top = "-5px";
									span.style.display = "block";
									span.style.fontSize = "13px";
									span.style.fontWeight = "bold";
									span.innerHTML = "1";
									$(cart_count_box).append(span);
									$(".cart-item-link").append(cart_count_box);
								}
							}
							else {
								alert(response);
							}
						}
					});
				}
				else {
					window.location = ROOT_URL+"/eshop/signin";
				}
			});
		});
	});
}

add_to_cart();

// end add to cart coding

//delete cart item coding

$(document).ready(function () {
	$(".delete-item-btn").each(function () {
		$(this).click(function () {
			var delete_item_price = Number($(this).attr("price"));
			var delete_item_qty = Number($(this).attr("qty"));
			var delete_btn = this;
			var delete_icon = this.getElementsByTagName("I")[0];
			var product_id = $(this).attr("product-id");
			$.ajax({
				type: "POST",
				url: ROOT_URL+"/eshop/pages/php/delete_cart_item.php",
				data: {
					product_id: product_id
				},
				beforeSend: function () {
					$(delete_icon).removeClass("fa fa-trash");
					$(delete_icon).addClass("fa fa-circle-o-notch fa-spin");
				},
				success: function (response) {
					if (response.trim() == "delete success") {
						var media_box = delete_btn.parentElement.parentElement.parentElement;
						$(media_box).remove();
						var price = Number($(".price").text());
						var qty = Number($(".product-qty").text());
						var total_price = Number($(".total-price").text());
						price = price - delete_item_price;
						qty = qty - delete_item_qty;
						total_price = total_price - delete_item_price;

						$(".price").html("<i class='fa fa-rupee'></i>" + price);
						$(".product-qty").html(qty);
						$(".total-price").html("<i class='fa fa-rupee'></i>" + total_price);

						var item_count = Number($(".cart-item-count-box span").html().trim());
						item_count--;
						if (item_count != 0) {
							$(".cart-item-count-box span").html(item_count);
						}
						else {
							$(".cart-item-count-box").remove();
						}
					}
					else {
						alert(response);
					}
				}
			});
		});
	});
});

// start buy product coding

function buy_product() {
	$(document).ready(function () {
		$(".buy-btn").each(function () {
			$(this).click(function () {
				var product_id = $(this).attr("product-id");
				window.location = ROOT_URL+"/eshop/buy_now/" + btoa(product_id);
			});
		});
	});
}

buy_product();

//start place order coding

$(document).ready(function () {
	$(".purchase-btn").click(function () {
		var pay_mode = $("input[name=pay-mode]:checked").val();
		if (pay_mode) {
			var product_id = $(this).attr("product-id");
			var product_title = $(this).attr("product-title");
			var product_brand = $(this).attr("product-brand");
			var product_price = $(this).attr("product-price");
			var product_quantity = $(".qty").val();
			if (pay_mode == "online") {
				window.location = ROOT_URL+"/eshop/online_payment/" + btoa(product_id) + "/" + btoa(product_title) + "/" + btoa(product_brand) + "/" + btoa(product_price) + "/" + btoa(product_quantity);
			}
			else {
				window.location = ROOT_URL+"/eshop/cod_payment/" + btoa(product_id) + "/" + btoa(product_title) + "/" + btoa(product_brand) + "/" + btoa(product_price) + "/" + btoa(product_quantity) + "/" + btoa("cod");
			}
		}
		else {
			alert("please select any payment mode");
		}
	});
});

//start product availibility in respictive pincode coding

$(document).ready(function () {
	$(".check-pin-btn").click(function () {
		var pincode = $("#check-pin").val();
		$.ajax({
			type: "POST",
			url: ROOT_URL+"/eshop/pages/php/check_pincode.php",
			data: {
				pincode: pincode
			},
			beforeSend: function () {
				$(".check-pin-btn").html("<i class='fa fa-circle-o-notch fa-spin'></i>");
				$(".check-pin-btn").attr("disabled", "disabled");
			},
			success: function (response) {
				$(".pincode-massage").html(response);
				$(".check-pin-btn").html("Check");
				$(".check-pin-btn").attr("disabled", false);
			}
		});
	});
});


//product stock availibility coding

$(document).ready(function () {
	$(".qty").on("input", function () {
		var stock = Number($(".product-stock").html());
		if ($(this).val() > stock) {
			alert("negative stock !!");
			$(this).val("1");
		}
	});
});

//buy product preview coding

$(document).ready(function () {
	$(".pro-pic").each(function () {
		$(this).click(function () {
			var src = $(this).attr("src");
			$(".preview-pic").attr("src", src);
			$(".preview-pic").addClass("animated zoomIn");
			setTimeout(function () {
				$(".preview-pic").removeClass("animated zoomIn");
			}, 1000);
		});
	});
});

//filter brands coding in product page

$(document).ready(function () {
	$(".filter-btn").each(function () {
		$(this).click(function () {
			$(".filter-btn").each(function () {
				$(this).removeClass("btn-danger");
				$(this).addClass("btn-dark");
			});
			$(this).removeClass("btn-dark");
			$(this).addClass("btn-danger");
			var cat_name = $(this).attr("cat-name");
			var brand_name = $(this).attr("brand-name");
			$.ajax({
				type: "POST",
				url: ROOT_URL+"/eshop/pages/php/filter_product.php",
				data: {
					cat_name: cat_name,
					brand_name: brand_name
				},
				beforeSend: function () {
					$(".product-box").html("please wait..");
				},
				success: function (response) {
					$(".product-box").html("");
					if (response.trim() != "No product avilable") {
						var product_obj = JSON.parse(response.trim());
						var i;
						for (i = 0; i < product_obj.length; i++) {
							var card = document.createElement("DIV");
							card.className = "card shadow-sm";
							var img = document.createElement("IMG");
							img.src = "../" + product_obj[i].thumb_pic;
							img.width = "250";
							img.height = "315";
							$(card).append(img);

							//brand 

							var brand = document.createElement("SPAN");


							//title


							//price

							//buttons
							var btn_group = document.createElement("DIV");
							btn_group.className = "btn-group";
							var add_cart_btn = document.createElement("BUTTON");
							add_cart_btn.className = "btn font-weight-bold text-white rounded-0 py-3 border-0 shadow-sm add-to-cart-btn";
							add_cart_btn.innerHTML = "<i class='fa fa-shopping-cart px-2'></i>Add to Cart";
							add_cart_btn.style.background = "#E83350";
							$(add_cart_btn).attr("product-id", product_obj[0].id);
							$(add_cart_btn).attr("product-title", product_obj[0].product_name);
							$(add_cart_btn).attr("product-price", product_obj[0].price);
							$(add_cart_btn).attr("product-brand", product_obj[0].brand);
							$(add_cart_btn).attr("product-pic", product_obj[0].thumb_pic);
							$(add_cart_btn).attr("qty","1");
							var buy_btn = document.createElement("BUTTON");
							buy_btn.className = "btn font-weight-bold text-white rounded-0 border-0 shadow-sm py-3 buy-btn";
							buy_btn.innerHTML = "<i class='fa fa-shopping-bag px-2'></i>";
							buy_btn.style.background = "#2B2B52";
							$(buy_btn).attr("product-id", product_obj[0].id);
							$(buy_btn).attr("product-title", product_obj[0].product_name);
							$(buy_btn).attr("product-price", product_obj[0].price);
							$(buy_btn).attr("product-brand", product_obj[0].brand);
							$(buy_btn).attr("product-pic", product_obj[0].thumb_pic);
							$(buy_btn).attr("qty","1");
							$(btn_group).append(add_cart_btn);
							$(btn_group).append(buy_btn);
							$(card).append(btn_group);
							$(".product-box").append(card);

							add_to_cart();
							buy_product();
						}
					}
					else {
						$(".product-box").html("<b>" + response + "</b>");
					}

				}
			});
		});
	});
});

// by default fillter products

$(document).ready(function () {
	var filter_btn = $(".filter-btn");
	filter_btn[0].click();
});

// start filter by price coding

$(document).ready(function () {
	$(".price-filter-btn").click(function () {
		var min_price = $(".min-price").val();
		var max_price = $(".max-price").val();
		var cat_name = $(this).attr("cat-name");
		$.ajax({
			type: "POST",
			url: ROOT_URL+"/eshop/pages/php/filter_by_price.php",
			data: {
				min_price: min_price,
				max_price: max_price,
				category: cat_name
			},
			beforeSend: function () {
				$(".price-filter-btn").html("Please wait...");
			},
			success: function (response) {
				$(".price-filter-btn").html("Get product");
				console.log(response);
				if (response.trim() != "No product avilable") {
					console.log(response);
					var product_obj = JSON.parse(response.trim());
					console.log(product_obj);
					var i;
					for (i = 0; i < product_obj.length; i++) {
						var card = document.createElement("DIV");
						card.className = "card shadow-sm";
						var img = document.createElement("IMG");
						img.src = "../" + product_obj[i].thumb_pic;
						img.width = "250";
						img.height = "315";
						$(card).append(img);

						//brand 

						var brand = document.createElement("SPAN");


						//title


						//price

						//buttons
						var btn_group = document.createElement("DIV");
						btn_group.className = "btn-group";
						var add_cart_btn = document.createElement("BUTTON");
						add_cart_btn.className = "btn font-weight-bold text-white rounded-0 py-3 border-0 shadow-sm add-to-cart-btn";
						add_cart_btn.innerHTML = "<i class='fa fa-shopping-cart px-2'></i>Add to Cart";
						add_cart_btn.style.background = "#E83350";
						$(add_cart_btn).attr("product-id", product_obj[0].id);
						$(add_cart_btn).attr("product-title", product_obj[0].product_name);
						$(add_cart_btn).attr("product-price", product_obj[0].price);
						$(add_cart_btn).attr("product-brand", product_obj[0].brand);
						$(add_cart_btn).attr("product-pic", product_obj[0].thumb_pic);
						var buy_btn = document.createElement("BUTTON");
						buy_btn.className = "btn font-weight-bold text-white rounded-0 border-0 shadow-sm py-3 buy-btn";
						buy_btn.innerHTML = "<i class='fa fa-shopping-bag px-2'></i>";
						buy_btn.style.background = "#2B2B52";
						$(buy_btn).attr("product-id", product_obj[0].id);
						$(buy_btn).attr("product-title", product_obj[0].product_name);
						$(buy_btn).attr("product-price", product_obj[0].price);
						$(buy_btn).attr("product-brand", product_obj[0].brand);
						$(buy_btn).attr("product-pic", product_obj[0].thumb_pic);
						$(btn_group).append(add_cart_btn);
						$(btn_group).append(buy_btn);
						$(card).append(btn_group);
						$(".product-box").append(card);

						add_to_cart();
						buy_product();
					}
				}
				else {
					$(".product-box").html("<b>" + response + "</b>");
				}

			}
		});
	});
});

//start sort by coding

$(document).ready(function () {
	$(".sort-by").on("change", function () {
		var cat_name, brand_name = "";
		$(".filter-btn").each(function () {
			if ($(this).attr("class").indexOf("btn-danger") != -1) {
				cat_name = $(this).attr("cat-name");
				brand_name = $(this).attr("brand-name");
			}
		});

		var sort_val = $(this).val();
		$.ajax({
			type: "POST",
			url: ROOT_URL+"/eshop/pages/php/sort_product.php",
			data: {
				cat_name: cat_name,
				brand_name: brand_name,
				sort_val: sort_val
			},
			beforeSend: function () {
				$(".product-box").html("please wait..");
			},
			success: function (response) {
				$(".product-box").html("");
				if (response.trim() != "No product avilable") {
					var product_obj = JSON.parse(response.trim());
					var i;
					for (i = 0; i < product_obj.length; i++) {
						var card = document.createElement("DIV");
						card.className = "card shadow-sm";
						var img = document.createElement("IMG");
						img.src = "../" + product_obj[i].thumb_pic;
						img.width = "250";
						img.height = "315";
						$(card).append(img);

						//brand 

						var brand = document.createElement("SPAN");


						//title


						//price

						//buttons
						var btn_group = document.createElement("DIV");
						btn_group.className = "btn-group";
						var add_cart_btn = document.createElement("BUTTON");
						add_cart_btn.className = "btn font-weight-bold text-white rounded-0 py-3 border-0 shadow-sm add-to-cart-btn";
						add_cart_btn.innerHTML = "<i class='fa fa-shopping-cart px-2'></i>Add to Cart";
						add_cart_btn.style.background = "#E83350";
						$(add_cart_btn).attr("product-id", product_obj[0].id);
						$(add_cart_btn).attr("product-title", product_obj[0].product_name);
						$(add_cart_btn).attr("product-price", product_obj[0].price);
						$(add_cart_btn).attr("product-brand", product_obj[0].brand);
						$(add_cart_btn).attr("product-pic", product_obj[0].thumb_pic);
						var buy_btn = document.createElement("BUTTON");
						buy_btn.className = "btn font-weight-bold text-white rounded-0 border-0 shadow-sm py-3 buy-btn";
						buy_btn.innerHTML = "<i class='fa fa-shopping-bag px-2'></i>";
						buy_btn.style.background = "#2B2B52";
						$(buy_btn).attr("product-id", product_obj[0].id);
						$(buy_btn).attr("product-title", product_obj[0].product_name);
						$(buy_btn).attr("product-price", product_obj[0].price);
						$(buy_btn).attr("product-brand", product_obj[0].brand);
						$(buy_btn).attr("product-pic", product_obj[0].thumb_pic);
						$(btn_group).append(add_cart_btn);
						$(btn_group).append(buy_btn);
						$(card).append(btn_group);
						$(".product-box").append(card);

						add_to_cart();
						buy_product();
					}
				}
				else {
					$(".product-box").html("<b>" + response + "</b>");
				}

			}
		});
	});
});


// personal information update coding

$(document).ready(function () {
	$(".personal-form").submit(function (event) {
		$("#mobile").attr("disabled", false);
		event.preventDefault();
		$.ajax({
			type: "POST",
			url: ROOT_URL+"/eshop/pages/php/personal_info.php",
			data: new FormData(this),
			processData: false,
			contentType: false,
			cache: false,
			beforeSend: function () {
				$(".update-info-btn").val("Please wait...");
				$(".update-info-btn").attr("disabled", "disabled");
			},
			success: function (response) {
				$("#mobile").attr("disabled", "disabled");
				if (response.trim() == "update success") {
					$(".update-info-btn").val("Update");
					$(".update-info-btn").attr("disabled", false);
				}
				else {
					alert(response);
				}
			}
		});
	});
});


// password change coding

$(document).ready(function () {
	$(".privacy-form").submit(function (event) {
		event.preventDefault();
		var new_password = $("#new-pass").val();
		var reenter_password = $("#reenter-pass").val();
		if (new_password == reenter_password) {
			$.ajax({
				type: "POST",
				url: ROOT_URL+"/eshop/pages/php/change_password.php",
				data: new FormData(this),
				processData: false,
				contentType: false,
				cache: false,
				beforeSend: function () {
					$(".privacy-form button").html("Please wait...");
					$(".privacy-form button").attr("disabled", "disabled");
				},
				success: function (response) {
					$(".privacy-form button").html("Update");
					$(".privacy-form button").attr("disabled", false);
					alert(response);
					$(".privacy-form").trigger("reset");
				}
			});
		}
		else {
			alert("new passwords are not matched");
		}
	});
});


//rate purchased items coding

$(document).ready(function () {
	$(".star-icons").each(function () {
		$(this).click(function () {
			$(".rating-btn").removeClass("d-none");
			var stars = $(".star-icons");
			var i = 0;
			var index = $(this).attr("index");
			index++;
			for (i = 0; i < 5; i++) {
				$(stars[i]).removeClass("fa fa-star");
				$(stars[i]).addClass("fa fa-star-o");

				if (i < index) {
					$(stars[i]).removeClass("fa fa-star-o");
					$(stars[i]).addClass("fa fa-star");
				}
			}

			$(".rating-btn").click(function () {
				var product_id = $(this).attr("product-id");
				var comment = $("#comment").val();
				var pic = $("#pic").val();
				if (comment != "") {
					if (pic != "") {
						var photo = document.querySelector("#pic").files[0];
						var formdata = new FormData();
						formdata.append("photo", photo);
						formdata.append("comment", comment);
						formdata.append("rating", index);
						formdata.append("product_id", product_id);
						$.ajax({
							type: "POST",
							url: ROOT_URL+"/eshop/pages/php/rating.php",
							data: formdata,
							processData: false,
							contentType: false,
							cache: false,
							beforeSend: function () {
								$(".rating-btn").html("Please wait...");
							},
							success: function (response) {
								$(".rating-btn").html("Send feedback");
								if (response.trim() == "update success") {
									$(".rating-btn").addClass("d-none");
									$(".comment-box").addClass("d-none");
									$(".pic-box").addClass("d-none");
									$(".comment-notice").html("Comment posted");
									$(".comment-notice").addClass("text-success");
									$(".comment-header").html("Your Rating");
									setTimeout(function () {
										$(".comment-notice").html($("#comment").val());
										$(".comment-notice").removeClass("text-success");
									}, 3000);
								}
								else {
									alert(response);
								}
							}
						});
					}
					else {
						alert("Please choose your pic");
					}
				}
				else {
					alert("Please write some review");
				}

			});
		});
	});
});


//subscribe coding

$(document).ready(function () {
	$(".subscribe-btn").click(function () {
		var email = $("#subscribe").val();
		$.ajax({
			type: "POST",
			url: ROOT_URL+"/eshop/pages/php/subscribe_verify.php",
			data: {
				email: email,
			},
			success: function (response) {
				if (response.trim() != "email not send") {
					var count = 3;
					function verify() {
						$data_obj = JSON.parse(response.trim());
						var prompt = window.prompt("Please enter your varification code");
						var code = $data_obj[1];
						if (prompt == code) {
							alert("subscribe successfully");
							$.ajax({
								type: "POST",
								url: ROOT_URL+"/eshop/pages/php/subscriber.php",
								data: {
									email: email
								},
								success: function (response) {
									alert(response);
								}
							});
						}
						else if (prompt == null || prompt == "") {
							verify();
						}
						else {
							alert("code not matched");
							if (--count > 0) {
								verify();
							}
						}
					}

					verify();
				}
				else {
					alert(response);
				}
			}
		});
	});
});

//product hover details coding

$(document).ready(function () {
	$(".card").each(function () {
		$(this).hover(function () {
			var product_detail = this.getElementsByClassName("product-hover-details")[0];
			var product_box = this.getElementsByClassName("product-detail-box")[0];
			$(product_detail).css({
				height: "100%",
				transition: "0.2s",
				padding: "20px"
			});
			setTimeout(function () {
				$(product_box).removeClass("d-none");
			}, 100);

		}, function () {
			var product_detail = this.getElementsByClassName("product-hover-details")[0];
			var product_box = this.getElementsByClassName("product-detail-box")[0];
			$(product_box).addClass("d-none");
			$(product_detail).css({
				height: "0",
				transition: "0.5s",
				padding: "0"
			});
		});
	});
});


//ajax live search product coding

$(document).ready(function () {
	$(".search-product").on("input", function () {
		var keyword = $(this).val();
		$.ajax({
			type: "POST",
			url: ROOT_URL+"/eshop/pages/php/search_product.php",
			data: {
				keyword: keyword
			},
			success: function (response) {
				$(".search-hint-box").html("");
				if (response.trim() != "No such product") {
					$(".search-hint-box").html(response);
					$(".search-result").hover(function () {
						$(this).css({
							background: '#f8f8f8',
							borderRadius: "5px",
							cursor: "pointer"
						});
					}, function () {
						$(this).css({
							background: 'white',
							borderRadius: "5px"
						});
					});

					$(".search-result").each(function () {
						$(this).click(function () {
							var k_word = $(this).html();
							var product_id = $(this).attr("product-id");
							$(".search-product").val($(this).html().trim());
							$(".search-hint-box").html("");
							window.location = ROOT_URL+"/eshop/search/" + k_word;
						});
					});
				}
				else {
					$(".search-hint-box").html("<p class='p-3 search-result' style='font-size:13px;'>" + response + "</p>");
				}
			}
		});
	});
});

//search by enter and search icon coding

$(document).ready(function () {
	$(".search-product").on("keypress", function (event) {
		if (event.keyCode == 13 && $(this).val() != "") {
			var keyword = $(this).val().trim();
			window.location = ROOT_URL+"/eshop/search/" + keyword;
		}
	});
});

$(document).ready(function () {
	$(".search-icon").on("click", function () {
		if ($(".search-product").val() != "") {
			var keyword = $(".search-product").val().trim();
			window.location = ROOT_URL+"/eshop/search/" + keyword;
		}
		else {
			alert("please write something !!");
		}
	});
});


//change mobile number coding

$(document).ready(function () {
	$(".send-otp-btn").click(function () {
		var mobile = $("#mobile").val();
		$.ajax({
			type: "POST",
			url: ROOT_URL+"/eshop/pages/php/change_mobile.php",
			data: {
				mobile: mobile
			},
			beforeSend: function () {
				$(".send-otp-btn").html("<i class='fa fa-circle-o-notch fa-spin'></i>");
				$(".send-otp-btn").attr("disabled", "disbled");
			},
			success: function (response) {
				if (response.trim() == "success") {
					$(".send-otp-btn").attr("disabled", false);
					$(".send-otp-btn").html("Send OTP");
					$(".verify-mobile-box").removeClass("d-none");
					$(".verify-mobile").click(function () {
						var v_code = $("#verification-code").val();
						$.ajax({
							type: "POST",
							url: ROOT_URL+"/eshop/pages/php/verify_mobile.php",
							data: {
								v_code: v_code
							},
							beforeSend: function () {
								$(".verify-mobile").html("<i class='fa fa-circle-o-notch fa-spin'></i>");
								$(".verify-mobile").attr("disabled", "disabled");
							},
							success: function (response) {
								if (response.trim() == "success") {
									$(".verify-mobile").html("Verify");
									$(".verify-mobile").attr("disabled", false);
									$("#mobile").attr("disabled", false);
									$("#mobile").attr("placeholder", "Please enter your new mobile number");
									$(".verify-mobile-box").addClass("d-none");
								}
								else {
									$(".verify-mobile").html("failed");
									setTimeout(function () {
										$(".verify-mobile").html("Verify");
										$(".verify-mobile").attr("disabled", false);
									}, 2000);
								}
							}
						});
					});
				}
				else {
					alert(response);
				}
			}
		});
	});
});