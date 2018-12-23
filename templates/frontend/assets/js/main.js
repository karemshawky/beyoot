// /*Sync Links*/
// function syncLink () {
//     $(".section").each(function () {
//         if ($(window).scrollTop() >= $(this).offset().top-200) {
//             var secId = $(this).attr("id");
//             $("ul.nav li[data-scroll='" + secId + "']").addClass("active").siblings("li").removeClass("active");
//         }
//     });
// }
// /*Change Active Class on Navbar*/
// $(".nav li").click(function () {
//     $(this).addClass("active").siblings("li").removeClass("active");
// });
// $(window).on("scroll", syncLink);

var theUrl = 'http://localhost/beyoot/';
var theFrontUrl = theUrl + 'templates/frontend/';

/*=======
 * Slider
=======*/
/*Home Slider*/
$('.mainSlider').slick({
	infinite: true,
	autoplay: true,
	speed: 3000,
	fade: true,
	draggable: false,
	cssEase: 'linear',
	pauseOnFocus: false,
	pauseOnHover: false,
	pauseOnDotsHover: false,
	rtl: true,
	dots: false
});
/*Project Details Slider*/
$('.projectDetails').slick({
	infinite: true,
	autoplay: true,
	speed: 1000,
	fade: true,
	arrow: true,
	prevArrow: '<div class="slick-prev"><img class="right-arr" src="../../templates/frontend/assets/images/icons/arrow-right.svg"> </div>',
	nextArrow: '<div class="slick-next"><img class="left-arr" src="../../templates/frontend/assets/images/icons/Arrow-left.svg"> </div>',
	draggable: false,
	cssEase: 'linear',
	pauseOnFocus: false,
	pauseOnHover: false,
	pauseOnDotsHover: false,
	rtl: true,
	dots: false
});
/*Property Slider*/
$('.propSlider').slick({
	infinite: true,
	autoplay: true,
	speed: 1000,
	fade: true,
	arrow: true,
	prevArrow: '<div class="slick-prev"><img class="right-arr" src="../../templates/frontend/assets/images/icons/arrow-right.svg"> </div>',
	nextArrow: '<div class="slick-next"><img class="left-arr" src="../../templates/frontend/assets/images/icons/Arrow-left.svg"> </div>',
	draggable: false,
	cssEase: 'linear',
	pauseOnFocus: false,
	pauseOnHover: false,
	pauseOnDotsHover: false,
	rtl: true,
	dots: false
});
/*Tourism Slider*/
$('.tourSlider').slick({
	infinite: true,
	autoplay: true,
	speed: 1000,
	fade: true,
	arrow: true,
	prevArrow: '<div class="slick-prev"><img class="right-arr" src="../templates/frontend/assets/images/icons/arrow-right.svg"> </div>',
	nextArrow: '<div class="slick-next"><img class="left-arr" src="../templates/frontend/assets/images/icons/Arrow-left.svg"> </div>',
	draggable: false,
	cssEase: 'linear',
	pauseOnFocus: false,
	pauseOnHover: false,
	pauseOnDotsHover: false,
	rtl: true,
	dots: false
});
/*Hide Logo On click On menu Button*/
$(".icon-bar").click(function() {
	$(".navbar .logo").fadeToggle();
});
/*Skip Padding on Modal Popup*/
$('.modal').on('show.bs.modal', function() {
	$("body").addClass("paddingZero");
}).on("hidden.bs.modal", function() {
	$("body").removeClass("paddingZero");
	$(".form").removeClass("hide");
	$(".success").addClass("hide");
});
/*Show Success Message*/
$(".sendForm").click(function() {
	$("[name='name']").attr("required", true);
	$("[name='email']").attr("required", true);
	$("[name='phone']").attr("required", true);
	$("[name='details']").attr("required", true);
	$(".form").toggleClass("hide");
	$(".success").toggleClass("hide");
});
/*Show Phone Number on Call Button*/
if(window.matchMedia('(min-width: 767px)').matches) {
	$(".tel").click(function(event) {
		event.preventDefault();
		$(".call").addClass("hide");
		$(".phone").removeClass("hide");
	});
};

/////////////////////////////////////// The footer scripts  
jQuery(document).ready(function($) {
	// Easy Youtube Auto Play Script when visible
	// Author: Vitalii Rizo 2017
	"use strict";
	var iframe = document.getElementById("autoplay-video"),
		disableAutoPlay = false;

	function isScrolledIntoView(el) {
		var elemTop = el.getBoundingClientRect().top,
			elemBottom = el.getBoundingClientRect().bottom,
			isVisible = (elemTop >= 0) && (elemBottom <= window.innerHeight);
		return isVisible;
	}
	$(window).scroll(function() {
		if(!disableAutoPlay) {
			if(iframe) {
				if(isScrolledIntoView(iframe)) {
					iframe.contentWindow.postMessage('{"event":"command","func":"playVideo","args":""}', '*');
				} else {
					iframe.contentWindow.postMessage('{"event":"command","func":"pauseVideo","args":""}', '*');
				}
			}
		}
	});
	$(iframe).on("mouseleave", function() {
		disableAutoPlay = true;
	});
});

/*Intialize nice Select*/
$(document).ready(function() {
	$('select').niceSelect();
});

// send data to contact us ( houses - projects )
$(document).ready(function() {
	$('#formcontact').click(function(e) {
		e.preventDefault();
		$.ajax({
			type: 'post',
			url: theUrl + 'contact/send',
			data: $('.formz').serialize(),
			success: function() {
				//alert('شكراً .. تم إرسال بياناتكم للإدارة وسيتم التواصل معكم في أقرب وقت');
			}
		});
	});
});

// Register & Login
$(document).ready(function() {
	$('#formReg').click(function(e) {
		$("#formRegy").validate({
			rules: {
				name: {
					required: true,
					minlength: 4,
				},
				phone: {
					required: true,
					minlength: 7,
				}
			},
			messages: {
				name: {
					required: "خطأ فى أدخال الأسم",
					minlength: "عدد الحروف قليل "
				},
				phone: {
					required: "خطأ فى رقم الهاتف",
					minlength: "عدد الارقام قليل "
				}
			}
		});
		e.preventDefault();
		$.ajax({
			type: 'post',
			url: theUrl + 'user/reg',
			data: $('#formRegy').serialize(),
			success: function(results) {
					if(results.message) {
						$.alert({
							icon: 'fa fa-warning',
							title: 'خطأ',
							content: results.message,
							type: 'red',
							buttons: {
								confirm: {
									text: 'موافق',
								},
							}
						});
					} else {
						$.alert({
							icon: 'fa fa-check',
							title: 'تمت الموافقة',
							content: results.succ,
							type: 'green',
							buttons: {
								confirm: {
									text: 'موافق',
									action: function() {
										jQuery('.sendForm').click();
									}
								},
							}
						});
					}
				} // end success  
		});
	});
});

// load more for housing & projects
$('.loadMore').on('click', function(event) {
	event.preventDefault();
	var offset = $('#page_num').val();
	var urlz = $('#url').val();
	$('.loadMore').val('نحميل .....');
	$.ajax({
		type: 'POST',
		url: theUrl + urlz + '/load',
		data: {
			page_num: offset
		},
		dataType: 'json',
		success: function(data) {
			if(data != '') {
				$('#page_num').val(parseInt(offset) + 1);
				data.forEach(function(item) {
					if(urlz == 'housing') {
					var append = "<div class='home col-sm-4 col-xs-12'><div class='card'><div class='img'>";
						append += "<img src='" + theUrl + "uploads/img/thumbs/" + item['pic'] + "' /></div>";
						append += "<div class='details'><p class='price'><span class='number'>" + item['price'].toFixed().replace(/(\d)(?=(\d{3})+(,|$))/g, '$1,') + " </span>ريال سعودي</p>";
						append += "<p class='description'><span class='type'>" + item['tpy'] + "</span> - " + item['title'] + "</p>";
						append += "<div class='address'><div class='icon col-xs-1'><img src=" + theFrontUrl + "assets/images/icons/location%20brown%20.svg /></div><div class='addr col-xs-11'>";
						append += "<address>" + item['address'] + "<a target='_blank' href='https://www.google.com/maps/?q=" + item['lat'] + "," + item['lang'] + "' class='show'>(عرض على الخريطة)</a> </address></div></div>";
						append += "<a href='" + theUrl + "housing/details/" + item['id'] + "' class='readMore btn btn-primary center-block'>تفاصيل أكثر</a></div></div></div>";
					}
					if(urlz == 'projects') {
					var append = "<div class='home col-sm-4 col-xs-12'><div class='card'><div class='img'>";
						append += "<img src='" + theUrl + "uploads/img/thumbs/" + item['pic'] + "' /></div>";
						append += "<div class='details'><p class='description projDescription'>" + item['title'] + "</p>";
						append += "<div class='address'><div class='icon col-xs-1'><img src=" + theFrontUrl + "assets/images/icons/location%20brown%20.svg /></div><div class='addr col-xs-11'>";
						append += "<address>" + item['address'] + "<a target='_blank' href='https://www.google.com/maps/?q=" + item['lat'] + "," + item['lang'] + "' class='show'>(عرض على الخريطة)</a> </address></div></div>";
						append += "<a href='" + theUrl + "projects/details/" + item['id'] + "' class='readMore btn btn-primary center-block'>تفاصيل أكثر</a></div></div></div>";
					}
					$('.list-more').append(append);
					$('.loadMore').val('تحميل المزيد');
					if(data.length < 6) {
						$('.loadMore').addClass('hidden');
					}
				});
			} else {
				$('.loadMore').addClass('hidden');
			}
		},
		error: function() {
			alert('fail');
		}
	});
});

// load more for housing search 
$('.schMore').on('click', function(event) {
	event.preventDefault();
	var offset = $('#page_numz').val();
	$('.schMore').val('نحميل .....');
	$.ajax({
		type: 'POST',
		url: theUrl + 'housing/search/load',
		data: $('form').serialize(),
		dataType: 'json',
		success: function(data) {
			if(data != '') {
				$('#page_numz').val(parseInt(offset) + 1);
				data.forEach(function(item) {
				var append = "<div class='home col-sm-4 col-xs-12'><div class='card'><div class='img'>";
					append += "<img src='" + theUrl + "uploads/img/thumbs/" + item['pic'] + "' /></div>";
					append += "<div class='details'><p class='price'><span class='number'>" + item['price'].toFixed().replace(/(\d)(?=(\d{3})+(,|$))/g, '$1,') + " </span>ريال سعودي</p>";
					append += "<p class='description'><span class='type'>" + item['type'] + "</span> - " + item['title'] + "</p>";
					append += "<div class='address'><div class='icon col-xs-1'><img src=" + theFrontUrl + "assets/images/icons/location%20brown%20.svg /></div><div class='addr col-xs-11'>";
					append += "<address>" + item['address'] + "<a target='_blank' href='https://www.google.com/maps/?q=" + item['lat'] + "," + item['lang'] + "' class='show'>(عرض على الخريطة)</a> </address></div></div>";
					append += "<a href='" + theUrl + "housing/details/" + item['id'] + "' class='readMore btn btn-primary center-block'>تفاصيل أكثر</a></div></div></div>";
					$('.list-more').append(append);
					$('.schMore').val('تحميل المزيد');
					if(data.length < 6) {
						$('.schMore').addClass('hidden');
					}
				});
			} else {
				$('.schMore').addClass('hidden');
			}
		},
		error: function() {
			alert('fail');
		}
	});
});

// load more for blogs
$('.blogMore').on('click', function(event) {
	event.preventDefault();
	var offset = $('#page_num').val();
	var url = $('#url').val();
	$('.blogMore').val('نحميل .....');
	$.ajax({
		type: 'POST',
		url: theUrl + 'blogs/load',
		data: {
			page_num: offset,
			type: url
		},
		dataType: 'json',
		success: function(data) {
			if(data != '') {
				$('#page_num').val(parseInt(offset) + 1);
				data.forEach(function(item) {
				var append = "<div class='home col-sm-4 col-xs-12'><div class='card blogcard'><div class='img'>";
					append += "<img src=" + theUrl + "uploads/img/thumbs/" + item['pic'] + " /></div><div class='details'><p class='description'>" + item['title'] + "</p></div>";
					append += "<a href=" + theUrl + "blogs/news/" + item['id'] + " class='readMore btn btn-primary center-block'>تفاصيل أكثر</a></div></div></div>";
					$('.list-more').append(append);
					$('.blogMore').val('تحميل المزيد');
					if(data.length < 6) {
						$('.blogMore').addClass('hidden');
					}
				});
			} else {
				$('.blogMore').addClass('hidden');
			}
		},
		error: function() {
			alert('fail');
		}
	});
});

// Login user to add favorite
$(document).ready(function() {
	$(".notlogin").on('click', function(event) {
		event.preventDefault();
		$.alert({
			icon: 'fa fa-sign-in',
			title: 'سجل دخول',
			content: 'قم بتسجيل الدخول لتتمكن من إضافة مفضلات',
			type: 'blue',
			buttons: {
				confirm: {
					text: 'موافق',
				},
			}
		});
	});
});

// Add smooth scrolling to all links
$(document).ready(function() {
	$(".cnt").on('click', function(event) {
		if(this.hash !== "") {
			event.preventDefault();
			var hash = this.hash;
			$('html, body').animate({
				scrollTop: $(hash).offset().top
			}, 800, function() {
				window.location.hash = hash;
			});
		} // End if
	});
});

// $(document).ready(function(){
//     var path = window.location.pathname.split('/').pop();
//     if( path == '' ){
//         path = theUrl+'';
//     }
//     var target = $('.nav li a[href="' + path + '"]');
//     target.addClass('active');
// });
//  $('.nav li a').click(function(event){
//     console.log('hellllo');
//     event.preventDefault();
//  });
// $('.nav ul li').click(function(){
//      localStorage.setItem('lastTab', $(e.target).attr('id'));
//      $('li').removeClass("active"); 
//      $(this).addClass("active"); 
// });
// $(document).ready(function(){
//     $(".nav > ul > li").click(function () {
//         $(this).siblings().removeClass("active");
//         $(this).addClass("active");
//     });
// });