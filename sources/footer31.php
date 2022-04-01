<?php 
    $step          = 5;
    $sp_step       = LAY_step($step, 1);
    $sp_baiviet    = LAY_baiviet($step, 18,"`opt1` = 1 ");
    if(count($sp_baiviet)) {
?>
<style>
  img.border_img {width: 170px; height: 90px; margin: 0 4px}
</style>
<div class="box_doitac_home">
  <div class="pagewrap">
    <?php if($glo_lang['doi_tac_khach_hang'] != ""){ ?>
    <div class="title_id"><?=$glo_lang['doi_tac_khach_hang'] ?></div>
    <?php } ?>
    <div class="logo_doitac" style="display: none">
      <!--  -->
      <?php $data = array("2","3","4","5","6","6") ?>
        <div class="owl-auto owl-carousel owl-theme flex" data0="<?=$data[0] ?>" data1="<?=$data[1] ?>" data2="<?=$data[2] ?>" data3="<?=$data[3] ?>" data4="<?=$data[4] ?>" data5="<?=$data[5] ?>" is_slidespeed="1000" is_navigation="0" is_dots="1" is_autoplay="1">
        <?php 
          foreach ($sp_baiviet as $rows) { 
        ?>
        <div class="item">
          <ul>
            <a <?=full_href($rows) ?> >
            <li><img src="<?=full_src($rows) ?>" alt="<?=SHOW_text($rows['tenbaiviet_'.$lang]) ?>"></li>
            </a>
          </ul>
        </div>
        <?php } ?>

      </div>
      <div class="clr"></div>
      <!--  -->
    </div>
    <!--  -->
    <script type="text/javascript">

    /***********************************************
    * Conveyor belt slideshow script- � Dynamic Drive DHTML code library (www.dynamicdrive.com)
    * This notice MUST stay intact for legal use
    * Visit Dynamic Drive at http://www.dynamicdrive.com/ for full source code
    ***********************************************/


    //Specify the slider's width (in pixels)
    var sliderwidth="100%"
    //Specify the slider's height
    var sliderheight="100px"
    //Specify the slider's slide speed (larger is faster 1-10)
    var slidespeed=1
    //configure background color:
    slidebgcolor=""

    //Specify the slider's images
    var leftrightslide=new Array()
    var finalslide=' ';
    <?php
      $i = 0; 
      foreach ($sp_baiviet as $rows) { 
        echo 'leftrightslide['.$i.']=\'<a '.full_href($rows).' ><img src="'.full_src($rows).'"class="border_img" alt="'.SHOW_text($rows['tenbaiviet_'.$lang]).'"></a>\';';
        $i++;
      }
    ?>

    //Specify gap between each image (use HTML):
    var imagegap="&nbsp; "

    //Specify pixels gap between each slideshow rotation (use integer):
    var slideshowgap=5


    ////NO NEED TO EDIT BELOW THIS LINE////////////

    var copyspeed=slidespeed
    leftrightslide='<nobr>'+leftrightslide.join(imagegap)+'</nobr>'
    var iedom=document.all||document.getElementById
    if (iedom)
    document.write('<span id="slider_temp" style="visibility:hidden;position:absolute;top:-100px;left:-9000px">'+leftrightslide+'</span>')
    var actualwidth=''
    var cross_slide, ns_slide

    function fillup(){
    if (iedom){
    cross_slide=document.getElementById? document.getElementById("slider_new_2") : document.all.slider_new_2
    cross_slide2=document.getElementById? document.getElementById("slider_new_3") : document.all.slider_new_3
    cross_slide.innerHTML=cross_slide2.innerHTML=leftrightslide
    actualwidth=document.all? cross_slide.offsetWidth : document.getElementById("slider_temp").offsetWidth
    cross_slide2.style.left=actualwidth+slideshowgap+"px"
    }
    else if (document.layers){
    ns_slide=document.ns_slidemenu.document.ns_slidemenu2
    ns_slide2=document.ns_slidemenu.document.ns_slidemenu3
    ns_slide.document.write(leftrightslide)
    ns_slide.document.close()
    actualwidth=ns_slide.document.width
    ns_slide2.left=actualwidth+slideshowgap
    ns_slide2.document.write(leftrightslide)
    ns_slide2.document.close()
    }
    lefttime=setInterval("slideleft()",30)
    }
    window.onload=fillup

    function slideleft(){
    if (iedom){
    if (parseInt(cross_slide.style.left)>(actualwidth*(-1)+8))
    cross_slide.style.left=parseInt(cross_slide.style.left)-copyspeed+"px"
    else
    cross_slide.style.left=parseInt(cross_slide2.style.left)+actualwidth+slideshowgap+"px"

    if (parseInt(cross_slide2.style.left)>(actualwidth*(-1)+8))
    cross_slide2.style.left=parseInt(cross_slide2.style.left)-copyspeed+"px"
    else
    cross_slide2.style.left=parseInt(cross_slide.style.left)+actualwidth+slideshowgap+"px"

    }
    else if (document.layers){
    if (ns_slide.left>(actualwidth*(-1)+8))
    ns_slide.left-=copyspeed
    else
    ns_slide.left=ns_slide2.left+actualwidth+slideshowgap

    if (ns_slide2.left>(actualwidth*(-1)+8))
    ns_slide2.left-=copyspeed
    else
    ns_slide2.left=ns_slide.left+actualwidth+slideshowgap
    }
    }


    if (iedom||document.layers){
    with (document){
    document.write('<div class="dv-slider-ss">')
    if (iedom){
    write('<div style="position:relative;width:'+sliderwidth+';height:'+sliderheight+';overflow:hidden">')
    write('<div style="position:absolute;width:'+sliderwidth+';height:'+sliderheight+';background-color:'+slidebgcolor+'" onMouseover="copyspeed=0" onMouseout="copyspeed=slidespeed">')
    write('<div id="slider_new_2" style="position:absolute;left:0px;top:0px"></div>')
    write('<div id="slider_new_3" style="position:absolute;left:-1000px;top:0px"></div>')
    write('</div></div>')
    }
    else if (document.layers){
    write('<ilayer width='+sliderwidth+' height='+sliderheight+' name="ns_slidemenu" bgColor='+slidebgcolor+'>')
    write('<layer name="ns_slidemenu2" left=0 top=0 onMouseover="copyspeed=0" onMouseout="copyspeed=slidespeed"></layer>')
    write('<layer name="ns_slidemenu3" left=0 top=0 onMouseover="copyspeed=0" onMouseout="copyspeed=slidespeed"></layer>')
    write('</ilayer>')
    }
    document.write('</div>')
    }
    }
    </script>
    <!--  -->
  </div>
</div>
<?php } ?>
<div class="bottom_id_copyright">
  <div class="pagewrap">
    <p><?=$glo_lang['ban_quyen_name'] ?> | <a href="https://web30s.vn/" title="thiết kế website" target="_blank">Thiết kế và phát triển bởi</a> <a href="https://web30s.vn/" target="_blank">P.A Việt Nam</a></p>
    <p><?=$glo_lang['dang_online'] ?>: <?=number_format($online_tv) ?> | <?=$glo_lang['tong_view'] ?>: <?=number_format($thongke_tv) ?></p>
  </div>
</div>
<div id="back-top"><a href="#top">TOP</a></div>
