
$(document).ready(function () {

	new WOW().init();
	slidermain();
   	windowscroll();
   	menumobile();
    click_search();
    show_child_mobile();
    $(".loading").hide();

      $(".hamburger-show , .btn_close_recent, .box_recent_post , .box_search ").click(function(e){
           e.stopPropagation();
      });



});

function click_search(){

$(".icon_search").click(function(){
        if($(".box_form_search").hasClass("show")){

            $(".box_form_search").removeClass("show");

        }else {

            $(".box_form_search").addClass("show");

        }
    });

    $(".icon_search , .input_keyword ").click(function(e){
           e.stopPropagation();
      });

    $("body").click(function(){
        $(".box_form_search").removeClass("show");
    });

}

function slidermain(){
	 $owl =  $('.slider_main');
    $owl.owlCarousel({
        loop:true,
        margin:10,
        animateOut: 'slideOutDown',
    	animateIn: 'fadeIn',
        nav:true,
        items:1,
        dots:false,
        navText : ["<img src='images/next.png'>","<img src='images/prev.png'>"],
        onTranslate:removeClassAmimate,
        onTranslated:addClassAmimate
    });

    function removeClassAmimate(){
    	$('.view_more_sider').removeClass('animated fadeInUp');
   		$('.title_caption , .short_caption').removeClass('zoomIn animated');
    }

    function addClassAmimate(){
    	$('.active .title_caption , .active .short_caption').addClass('zoomIn animated');
    	$('.active .view_more_sider').addClass('animated fadeInUp')
    }
}


function windowscroll(){
	$(window).scroll(function(e){
    var topH = $(".header_top").height();
		if( $(this).scrollTop() > topH ){
			$(".header_bottom").addClass("fixed_menu");
		} else {
			$(".header_bottom").removeClass("fixed_menu");
		}
	})
}


function menumobile(){

	$(".hamburger-show , .btn_close_recent").click(function(){
        if($("body").hasClass('show_recent')){

            $("body").removeClass('show_recent')
            $("html,body").css('overflow','inherit');


        } else {
            $("body").addClass('show_recent')
            $("html,body").css('overflow','inherit');
        }
    });

    $("body , html").click(function(){

          $("body").removeClass('show_recent')
          $("html,body").css('overflow','inherit');
          $(".box_search").removeClass("active");


    });

}


function show_child_mobile(){
    w = $(window).width();
    if(w<=1280){
        $(".menu-item-has-children").append( '<i class="fa fa-plus-circle show_more_mobile" ></i>' );
        $(".show_more_mobile").click(function(){

            var check = $(this).siblings("ul.sub-menu").css("display");
            if(check=="block"){
                $(this).removeClass("fa-times-circle-o").addClass('fa-plus-circle');
                  $(this).siblings("ul.sub-menu").css("display","none");
            } else {

                 $(this).removeClass('fa-plus-circle').addClass("fa-times-circle-o");
                 $(this).siblings("ul.sub-menu").css("display","block");

            }

z
        });
    }
}

