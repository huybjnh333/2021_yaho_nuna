$(document).ready(function () {
	new WOW().init();
})
$(document).on('click', '.cls_check_show_checkbox', function(){
  $($(this).attr('datagr')).hide();
  if($(this).is(":checked")) {
    $($(this).attr('data')).show();
  }
});
$(document).ready(function(){
	$(".diemban-nt1").click(function(){
		$(".diemban-nt1 li .dv-mota-show").toggle();
	});
	$(".diemban-nt2").click(function(){
		$(".diemban-nt2 li .dv-mota-show").toggle();
	});
	$(".diemban-nt3").click(function(){
		$(".diemban-nt3 li .dv-mota-show").toggle();
	});
});
$(document).ready(function(){
	$(".vertical-menu i.fa-angle-down").click(function(){
		$(".vertical-menu ul.sub-3").toggle();
		$(".vertical-menu i.fa-angle-up").show();
		$(".vertical-menu i.fa-angle-down").toggle();
	});
	$(".vertical-menu i.fa-angle-up").click(function(){
		$(".vertical-menu ul.sub-3").toggle();
		$(".vertical-menu i.fa-angle-down").show();
		$(".vertical-menu i.fa-angle-up").toggle();
	});
	$(".vertical-menu1 i.fa-angle-down").click(function(){
		$(".vertical-menu1 ul.sub-4").toggle();
		$(".vertical-menu1 i.fa-angle-up").show();
		$(".vertical-menu1 i.fa-angle-down").toggle();
	});
	$(".vertical-menu1 i.fa-angle-up").click(function(){
		$(".vertical-menu1 ul.sub-4").toggle();
		$(".vertical-menu1 i.fa-angle-down").show();
		$(".vertical-menu1 i.fa-angle-up").toggle();
	});
	$(".vertical-menu2 i.fa-angle-down").click(function(){
		$(".vertical-menu2 ul.sub-5").toggle();
		$(".vertical-menu2 i.fa-angle-up").show();
		$(".vertical-menu2 i.fa-angle-down").toggle();
	});
	$(".vertical-menu2 i.fa-angle-up").click(function(){
		$(".vertical-menu2 ul.sub-5").toggle();
		$(".vertical-menu2 i.fa-angle-down").show();
		$(".vertical-menu2 i.fa-angle-up").toggle();
	});
	$(".vertical-menu3 i.fa-angle-down").click(function(){
		$(".vertical-menu3 ul.sub-6").toggle();
		$(".vertical-menu3 i.fa-angle-up").show();
		$(".vertical-menu3 i.fa-angle-down").toggle();
	});
	$(".vertical-menu3 i.fa-angle-up").click(function(){
		$(".vertical-menu3 ul.sub-6").toggle();
		$(".vertical-menu3 i.fa-angle-down").show();
		$(".vertical-menu3 i.fa-angle-up").toggle();
	});
});
function close_popup(){
	$(".fancybox-overlay").html("");
	$('.fancybox-overlay').removeClass("fancybox-overlay-fixed");
	$('body').removeClass("fancybox-lock");
}

$(function () {	
	$('.count').each(function () {
		$(this).prop('Counter', 0).animate({
			Counter: $(this).text()
		}, {
			duration: 10000,
			easing: 'swing',
			step: function (now) {
				$(this).text(Math.ceil(now));
			}
		});
	});
	
});
jQuery(document).ready(function(){
	$('#backTop').hide();
	$(window).scroll(function () {
		if ($(this).scrollTop() > 100) {
			$('#backTop').fadeIn(100);
		} else {
			$('#backTop').fadeOut();
		}
	});
	$('#backTop').click(function () {
		$('body,html').animate({
			scrollTop: 0
		}, 800);
		return false;
	});
	$('.preview').fancybox();
	$("a[rel='zoomImg']").fancybox({
		openEffect	: 'fade',
		closeEffect	: 'fade',
		autoPlay   : false,
		playSpeed  : 6000,
		prevEffect		: 'fade',
		nextEffect		: 'fade',
	});
	$("a[rel='imgZoom']").fancybox({
		openEffect	: 'fade',
		closeEffect	: 'fade',
		autoPlay   : false,
		prevEffect		: 'none',
		nextEffect		: 'none',
	});
	$('.number-up').click(function () {
		var val=parseInt($('#number').val());
		$('#number').val(val+1);
	});
	$('.number-down').click(function () {
		var val=parseInt($('#number').val());
		if(val>1){
			$('#number').val(val-1);
		}

	});
	$("nav#menu").mmenu({

		"navbars": [
		{
			content		: [ 'prev', 'close' ]
		},
		]
	});
	var topH = $(".dv-header").height();
	$(window).scroll(function () {
		if ($(this).scrollTop() > topH) {
			$('.dv-header-bt').addClass("fixed");
		} else {
			$('.dv-header-bt').removeClass("fixed");
		}
	});
	/*menu*/
	var menuH = $(".box_menu").height() - 0;
	$(".header");
	
	$(".clickShow").click(function(){
		$("#comment").addClass("showComment");
	});
	$(".clickHide").click(function(){
		$("#comment").removeClass("showComment");
	});
	/*menu mobile*/
	$("#menuMobile h1").click(function(){
		$(this).next("ul").slideToggle(300)
		.siblings("ul:visible").slideUp(300);
		$(this).toggleClass("active");
		$(this).siblings("h1").removeClass("active");
	});
	$("#menuMobile h2").click(function(){
		$(this).next("ul").slideToggle(300)
		.siblings("ul:visible").slideUp(300);
		$(this).toggleClass("active");
		$(this).siblings("h2").removeClass("active");
	});
	$("#popSlide h6").click(function(){
		$("#popSlide").toggleClass("active");
		$("#popSlide h6").toggleClass("active");
	});
	/*
	var ua = navigator.userAgent,
	event = (ua.match(/iPad/i)) ? 'touchstart' : 'click';
	*/
	$('[data-image]').each(function() {
		var bg = 'url('+$(this).attr('data-image')+")";
		$(this).css({'background-image': bg});
	});

	jQuery("#owl-banner").owlCarousel({
		lazyLoad: true,
		loop: true,
		dots: false,
		nav: true,
		autoplay: true,
		autoplayTimeout: 5000,
		smartSpeed: 1000,
		autoplayHoverPause: true,
		responsiveClass: true,
		responsive: {
			0: {
				items: 1
			}, 319: {
				items: 1
			}, 479: {
				items: 1
			}, 600: {
				items: 1
			}, 767: {
				items: 1
			}, 991: {
				items: 1
			}, 1199: {
				items: 1
			}
		}
	});
	jQuery("#owl-banner1").owlCarousel({
		lazyLoad: true,
		loop: true,
		dots: true,
		nav: false,
		autoplay: true,
		autoplayTimeout: 5000,
		smartSpeed: 1000,
		autoplayHoverPause: true,
		responsiveClass: true,
		responsive: {
			0: {
				items: 1
			}, 319: {
				items: 1
			}, 479: {
				items: 1
			}, 600: {
				items: 1
			}, 767: {
				items: 1
			}, 991: {
				items: 1
			}, 1199: {
				items: 1
			}
		}
	});
	jQuery("#images_slide").owlCarousel({
		lazyLoad: true,
		loop: true,
		dots: false,
		nav: true,
		margin: 20,
		autoplay: true,
		autoplayTimeout: 5000,
		autoplayHoverPause: true,
		responsiveClass: true,
		responsive: {
			0: {
				items: 2
			}, 319: {
				items: 2
			}, 479: {
				items: 2
			}, 600: {
				items: 2
			}, 767: {
				items: 2
			}, 991: {
				items: 3
			}, 1199: {
				items: 3
			}
		}
	});
	jQuery("#images_slide1").owlCarousel({
		lazyLoad: true,
		loop: true,
		dots: true,
		nav: false,
		autoplay: true,
		autoplayTimeout: 5000,
		autoplayHoverPause: true,
		responsiveClass: true,
		responsive: {
			0: {
				items: 2
			}, 319: {
				items: 2
			}, 479: {
				items: 4
			}, 600: {
				items: 4
			}, 767: {
				items: 4
			}, 991: {
				items: 7
			}, 1199: {
				items: 7
			}
		}
	});
	jQuery("#tintuc_slide").owlCarousel({
		lazyLoad: true,
		loop: true,
		dots: false,
		margin: 20,
		nav: true,
		autoplay: true,
		autoplayTimeout: 5000,
		smartSpeed: 1000,
		autoplayHoverPause: true,
		responsiveClass: true,
		responsive: {
			0: {
				items: 1
			}, 319: {
				items: 1
			}, 479: {
				items: 1
			}, 600: {
				items: 2
			}, 767: {
				items: 2
			}, 991: {
				items: 3
			}, 1199: {
				items: 3
			}
		}
	});
	jQuery("#pro_slide").owlCarousel({
		lazyLoad: true,
		loop: true,
		dots: false,
		margin: 20,
		nav: true,
		autoplay: true,
		autoplayTimeout: 5000,
		smartSpeed: 1000,
		autoplayHoverPause: true,
		responsiveClass: true,
		responsive: {
			0: {
				items: 1
			}, 319: {
				items: 1
			}, 479: {
				items: 1
			}, 600: {
				items: 2
			}, 767: {
				items: 2
			}, 991: {
				items: 3
			}, 1199: {
				items: 3
			}
		}
	});
	jQuery("#dichvu_slide").owlCarousel({
		lazyLoad: true,
		loop: true,
		dots: false,
		margin: 20,
		nav: true,
		autoplay: true,
		autoplayTimeout: 5000,
		autoplayHoverPause: true,
		responsiveClass: true,
		responsive: {
			0: {
				items: 1
			}, 319: {
				items: 1
			}, 479: {
				items: 1
			}, 600: {
				items: 2
			}, 767: {
				items: 2
			}, 991: {
				items: 2
			}, 1199: {
				items: 2
			}
		}
	});
});
jQuery(document).ready(function(e){
	e(document).on("click",".plus, .minus",function(){
		var t=e(this).closest(".quantity").find(".qty"),n=parseFloat(t.val()),r=parseFloat(t.attr("max")),i=parseFloat(t.attr("min")),s=t.attr("step");
		if(!n||n==""||n=="NaN")n=0;
		if(r==""||r=="NaN")r="";if(i==""||i=="NaN")i=0;
		if(s=="any"||s==""||s==undefined||parseFloat(s)=="NaN")s=1;
		e(this).is(".plus")?r&&(r==n||n>r)?t.val(r):t.val(n+parseFloat(s)):i&&(i==n||n<i)?t.val(i):n>0&&t.val(n-parseFloat(s));
		t.trigger("change")
	});
});
this.sitemapstyler = function(){
	var sitemap = document.getElementById("sitemap")
	if(sitemap){
		this.listItem = function(li){
			if(li.getElementsByTagName("ul").length > 0){
				var ul = li.getElementsByTagName("ul")[0];
				ul.style.display = "none";
				var span = document.createElement("span");
				span.className = "collapsed";
				span.onclick = function(){
					ul.style.display = (ul.style.display == "none") ? "block" : "none";
					this.className = (ul.style.display == "none") ? "collapsed" : "expanded";
				};
				li.appendChild(span);
			};
		};
		var items = sitemap.getElementsByTagName("li");
		for(var i=0;i<items.length;i++){
			listItem(items[i]);
		};
	};	
};
function openNav() {
	document.getElementById("mySidenav").style.width = " 20%";
	document.getElementById("main").style.marginLeft = " 20%";
}

/* Set the width of the side navigation to 0 and the left margin of the page content to 0 */
function closeNav() {
	document.getElementById("mySidenav").style.width = "0";
	document.getElementById("navbar").style.marginLeft = "0";
}
window.onload = sitemapstyler;