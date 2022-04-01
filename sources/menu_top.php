<ul class="menu tree_parent no_box" id="menu">
	<!-- <li class="homepage"><a href="<?=$full_url ?>"><i class="fa fa-home"></i></a></li> -->
  	<?=$amenu = GET_menu_new($full_url, $lang, '', '', '', 1) ?>
</ul>
<div class="mn-mobile" >
	<a href="<?=$full_url ?>" class="a_trangchu_mb"><i class="fa fa-home"></i></a>
	<!-- <a href="<?=$full_url ?>" class="a_trangchu_mb"><?=$glo_lang['trang_chu'] ?></a> -->
	<div class="menu-bar hidden-md hidden-lg">
		<a href="#nav-mobile">
			<!-- <img src="images/menu-mobile-lh.png" alt=""> -->
			<span>&nbsp;</span>
			<span>&nbsp;</span>
			<span>&nbsp;</span>
		</a>
	</div>

	<div id="nav-mobile" style="display: none">
		<ul>
			<?=$amenu ?>
		</ul>
	</div>
</div>
<script>
	$(function(){
		$(".menu  li").each(function(){
			if($("ul", this).length > 0){
				var a_ok = $("a",this).eq(0).attr('addok');
				if(a_ok != "ok"){
					$("a",this).eq(0).append('<i class="fa fa-angle-down"></i>');
					$("a",this).eq(0).attr("addok","ok");
				}
			}
			// 
			// var ulx 	= $("ul", this).html();
			// var link 	= $("a", this).attr("href");
			// var link_id = $("a", this).attr("dataid");
			// $("ul", this).remove();
			// var ax 	= $(this).html();
			// if(ulx != "" && ulx != undefined && ulx != 'undefined') {
			// 	var menu_addgia 	= add_gia_menu(link);
			// 	$(this).append('<ul class="flex_new"><li class="li_mn1">'+ax+'<ul class="flex">'+ulx+'</ul></li>'+menu_addgia+'<li class="li_menu_timkiem li_menu_timkiem_2 li_onload_sp" data="'+link_id+'"></li>'+'</ul>');
			// }
			// 
		});
		<?php
			$danhmuc  = LAY_danhmuc(2,0,"`id_parent` = 0");
			$tinhnang = LAY_tinhnang(2);
			foreach ($danhmuc as $rows) {
				if($rows['id_parent_muti'] == '') continue;
				$id_parent_muti = explode(",", $rows['id_parent_muti']);
				$ndappend = "";
				foreach ($tinhnang as $ktn) {
					if($ktn['opt'] == 0) continue;
					if(!in_array($ktn['id'], $id_parent_muti) || $ktn['id_parent'] != 0) continue;


					$ndappend .= '<li><a>'.SHOW_text($ktn['tenbaiviet_'.$lang]).'</a><ul>';
					foreach ($tinhnang as $ktn_2) {
						if($ktn_2['opt'] == 0) continue;
						if($ktn_2['id_parent'] != $ktn['id']) continue;
						$ndappend .= '<li><a href="'.$full_url."/".$rows['seo_name']."/?tn=".$ktn_2['id'].'">'.SHOW_text($ktn_2['tenbaiviet_'.$lang]).'</a></li>';
					}
					$ndappend .= '</ul></li>';
				}
				if($ndappend != "") {
					$ndappend = "<ul>$ndappend</ul>";
					echo '$(".menu li.is_step_2.hide_'.$rows['id'].'").addClass("menu_bar");';
					echo '$(".menu li.is_step_2.hide_'.$rows['id'].'").append(\''.$ndappend.'\');';
				}
				
			}
		?>
		
		
		// $(".menu li.is_step_2.hide_4 > ul").html('<div class="projects-menu flex no_box">'+$("li.is_step_2.hide_4 > ul").html()+'</div>');
		// $(".li_onload_sp").each(function(){
		// 	var id = $(this).attr("data");var obj = this;AJAX_post(full_url +"/add_sanpham_menu/",{"id": id}, function(r){$(obj).html(r);});
		// });
		
		<?php
			$id_prrr = 0;
			if(!empty($slug_table) && $slug_table == "danhmuc") $id_prrr = $arr_running['id'];
			else if(!empty($slug_table) && $slug_table == "baiviet") $id_prrr = $arr_running['id_parent'];
			if($id_prrr != 0){
				echo '$(".is_step_1.hide_'.$id_prrr.'").addClass("acti")';
			}
			else {
				echo '$(".is_step_0").addClass("acti")';
			}
		?>
	});
	// function add_gia_menu(link){
	// 	var addgia = '<li class="li_menu_timkiem"><ul class="fs-mnsul-gia"><p><?php //$glo_lang['muc_gia']?></p><?php 
 //          $tkgia = LAY_tkgia();
 //            foreach ($tkgia as $rows) {
	// 			echo "<li><a href=\"'+link+'/?pri=".$rows['id']."\">".SHOW_text($rows['tenbaiviet_'.$lang])."</a></li>";
 //            }
 //          ?></ul></li>';
	// 	return addgia;
	// }

</script>
