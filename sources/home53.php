<?php include _source."banner_top.php";?>
<?php
  
  $sanpham = LAY_step(2, 1);
?>
<div class="home-1">
	<div class="home-1-full wow fadeInDown">
    <div class="dv-cont-tnhome">
      <?php foreach ($tinhnang as $rows) { if($rows['opt1'] == 0) continue; ?>
    	<div class="home-1-l">
    			<a <?=full_href($sanpham, "?tn=".$rows['id']) ?>>
    				<h3><?=SHOW_text($rows['tenbaiviet_'.$lang]) ?></h3>
    			</a>
    	</div>
      <?php } ?>
      <div class="clr"></div>
    </div>
    
		</div>
	<div class="clr"></div>
</div>

<?php
  $banner_top = LAY_banner_new("`id_parent` = 31", 4);
  if(is_array($banner_top)){
?>
<div class="foot-list home-sp-a">
	<div class="pagewrap">
		<div class="panel-section-title">
    		<div class="stripe wow pulse animated" style="visibility: visible; animation-name: pulse;">
    			<h2><?=$glo_lang['san_pham_tim_kiem_nhieu'] ?></h2>
    			<h6><?=$glo_lang['san_pham_tim_kiem_nhieu_mo_ta'] ?></h6>
    		</div>
    </div>
    <ul class="flex">
      <?php
          foreach ($banner_top as $rows) {
        ?>
        <li class="">
          <div class="img">
            <a <?=full_href($rows) ?>><?=full_img($rows, '') ?></a>
          </div>
          <div class="titleOfFoodComponent"><?=SHOW_text($rows['tenbaiviet_'.$lang]) ?></div>
          <p><span class="lm_4">
            <?=SHOW_text(strip_tags($rows['mota_'.$lang])) ?>
          </span></p>
          <div class="orange-optional">
            <a <?=full_href($rows) ?> class="orange-button"><?=$glo_lang['mua_ngay'] ?> »</a>
          </div>
        </li>
      <?php } ?>    
      <div class="clr"></div>
    </ul>
</div>

</div>
<?php } ?>
<div class="home-search-a">
	<div class="pagewrap">
		<div class="home-search no_box">
      <?php foreach ($tinhnang as $rows) {
        if($rows['id_parent'] != 0) continue;
        if($rows['opt2'] == 0) continue;
      ?>
			<div class="custom-select">
  			<select class="js_sel_timkiem">
			    <option value=""><?=SHOW_text($rows['tenbaiviet_'.$lang]) ?></option>
			    <option value=""><?=$glo_lang['xem_tat_ca'] ?></option>
          <?php foreach ($tinhnang as $rows_2) {
            if($rows_2['id_parent'] != $rows['id']) continue;
            if($rows_2['opt2'] == 0) continue;
          ?>
			    <option value="<?=$rows_2['id'] ?>"><?=SHOW_text($rows_2['tenbaiviet_'.$lang]) ?></option>
          <?php } ?>
			  </select>
			</div>
      <?php } ?>
      
      <div class="custom-select">
      <input class="js_search_text siteSearchInput ui-autocomplete-input" type="text" name="text" value="" maxlength="100" placeholder="<?=$glo_lang['nhap_tu_khoa_tim_kiem'] ?>">
    </div>
			<div class="custom-select custom-select-lastchild">
				<a class="cur" onclick="timkiem_sp()"><?=$glo_lang['tim_kiem'] ?></a>
			</div>

		</div>

	</div>
  <div class="clr"></div>
</div>
<?php
  $sp_baiviet  = LAY_baiviet(2, 20, "`opt` = 1");
  
  // $sp_step    = LAY_step(2, 1);
  // $tinhnang   = LAY_bv_tinhnang(2);
  if(count($sp_baiviet)){
?>
<div class="nhacungcap_view home-product">
  <div class="pagewrap">
    <div class="panel-section-title">
      <div class="stripe">
        <h2><?=$glo_lang['ruou_vang_cua_thang'] ?></h2>
        <h6><?=$glo_lang['ruou_vang_cua_thang_mo_ta'] ?></h6>
        </div>
    </div>
    <div class="home-pro-f flex autoplay">
      <div class="pro_id pro_id_slider no_box">
        <!--  -->
        <?php $data = array("1","2","2","3","4","4") ?>
          <div class="owl-auto owl-carousel owl-theme flex" data0="<?=$data[0] ?>" data1="<?=$data[1] ?>" data2="<?=$data[2] ?>" data3="<?=$data[3] ?>" data4="<?=$data[4] ?>" data5="<?=$data[5] ?>" is_slidespeed="1000" is_navigation="1" is_dots="1" is_autoplay="1">
        <?php
          $view  = "slider";
          foreach ($sp_baiviet as $rows) {
            $gia = GET_gia($rows['giatien'], $rows['giakm'], $glo_lang['dvt'], $glo_lang['gia_lienhe'], "gia_ban", "gia_km", '','', $thongtin['is_giamuti'], $rows['id']);
        ?>
        <div class="item"><?php include _source.'home_temp.php'; ?></div>
        <?php } ?>
        </div>
        <div class="clr"></div>
      </div>
    </div>
  </div>
  <div class="clr"></div>
</div>
<?php } ?>
<?php
  $banner_top = LAY_banner_new("`id_parent` = 30", 4);
  if(is_array($banner_top)){
?>
<div class="foot-list home-sp-a" style="background: #fff">
	<div class="pagewrap">
		<div class="panel-section-title">
    		<div class="stripe wow pulse animated animated" style="visibility: visible; animation-name: pulse;">
    			<h2><?=$glo_lang['kien_thuc_ruu_vang'] ?></h2>
    			<h6><?=$glo_lang['kien_thuc_ruu_vang_mo_ta'] ?></h6>
    		</div>
    </div>
    <ul class="flex">
      <?php
          foreach ($banner_top as $rows) {
        ?>
        <li class="">
          <div class="img">
            <a <?=full_href($rows) ?>><?=full_img($rows, '') ?></a>
          </div>
          <div class="titleOfFoodComponent"><?=SHOW_text($rows['tenbaiviet_'.$lang]) ?></div>
          <p><span class="lm_4">
            <?=SHOW_text(strip_tags($rows['mota_'.$lang])) ?>
          </span></p>
          <div class="orange-optional">
            <a <?=full_href($rows) ?> class="orange-button"><?=$glo_lang['mua_ngay'] ?> »</a>
          </div>
        </li>
      <?php } ?>    
      <div class="clr"></div>
      </ul>
  </div>
</div>
<?php } ?>
<script>
var x, i, j, l, ll, selElmnt, a, b, c;
/*look for any elements with the class "custom-select":*/
x = document.getElementsByClassName("custom-select");
l = x.length;
for (i = 0; i < l; i++) {
  selElmnt = x[i].getElementsByTagName("select")[0];
  if (typeof(selElmnt) != "undefined"){
    ll = selElmnt.length;
  }
  else ll = 0;
  
  /*for each element, create a new DIV that will act as the selected item:*/
  a = document.createElement("DIV");
  a.setAttribute("class", "select-selected");
  
  if (typeof(selElmnt) != "undefined"){
    a.innerHTML = selElmnt.options[selElmnt.selectedIndex].innerHTML;
  }
  else continue;
  // else a.innerHTML = "";

  x[i].appendChild(a);
  /*for each element, create a new DIV that will contain the option list:*/
  b = document.createElement("DIV");
  b.setAttribute("class", "select-items select-hide");
  for (j = 1; j < ll; j++) {
    /*for each option in the original select element,
    create a new DIV that will act as an option item:*/
    c = document.createElement("DIV");
    c.innerHTML = selElmnt.options[j].innerHTML;
    c.setAttribute("id", selElmnt.options[j].value);
    c.addEventListener("click", function(e) {
        /*when an item is clicked, update the original select box,
        and the selected item:*/
        var y, i, k, s, h, sl, yl;
        s = this.parentNode.parentNode.getElementsByTagName("select")[0];
        sl = s.length;
        h = this.parentNode.previousSibling;
        for (i = 0; i < sl; i++) {
          if (s.options[i].innerHTML == this.innerHTML) {
            s.selectedIndex = i;
            h.innerHTML = this.innerHTML;
            y = this.parentNode.getElementsByClassName("same-as-selected");
            yl = y.length;
            for (k = 0; k < yl; k++) {
              y[k].removeAttribute("class");
            }
            this.setAttribute("class", "same-as-selected");
            break;
          }
        }
        h.click();
    });
    b.appendChild(c);
  }
  x[i].appendChild(b);
  a.addEventListener("click", function(e) {
      /*when the select box is clicked, close any other select boxes,
      and open/close the current select box:*/
      e.stopPropagation();
      closeAllSelect(this);
      this.nextSibling.classList.toggle("select-hide");
      this.classList.toggle("select-arrow-active");
    });
}
function closeAllSelect(elmnt) {
  /*a function that will close all select boxes in the document,
  except the current select box:*/
  var x, y, i, xl, yl, arrNo = [];
  x = document.getElementsByClassName("select-items");
  y = document.getElementsByClassName("select-selected");
  xl = x.length;
  yl = y.length;
  for (i = 0; i < yl; i++) {
    if (elmnt == y[i]) {
      arrNo.push(i)
    } else {
      y[i].classList.remove("select-arrow-active");
    }
  }
  for (i = 0; i < xl; i++) {
    if (arrNo.indexOf(i)) {
      x[i].classList.add("select-hide");
    }
  }
}
/*if the user clicks anywhere outside the select box,
then close all select boxes:*/
document.addEventListener("click", closeAllSelect);
</script>