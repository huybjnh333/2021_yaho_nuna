<?php
  $rows       = LAY_banner_new("`id_parent` = 16", 1);
  $rows_n     = LAY_banner_new("`id_parent` = 27", 1);
  $rows_toado = LAY_banner_new("`id_parent` = 37");
  
?>
<section id="event-maps" class="block" style="background: url(<?=$fullpath."/".$rows['duongdantin']."/".$rows['icon'] ?>) top left no-repeat; background-size: cover;">
  <div class="pagewrap">
    <div class="row">
      <div class="dv-banner-left" id="event-img">
        <div id="event-img-wrapper">
          <img src="<?=$fullpath."/".$rows_n['duongdantin']."/".$rows_n['icon'] ?>">
          <?php
            $name_itoop = "";
            $id_itoop   = "";
            foreach ($rows_toado as $rows_td) {
              if($id_itoop == ""){
                $name_itoop = SHOW_text($rows_td['tenbaiviet_'.$lang]);
                $id_itoop   = $rows_td['id'];
              }
          ?>
          <div onclick="show_banner(<?=$rows_td['id'] ?>, '<?=SHOW_text($rows_td['tenbaiviet_'.$lang]) ?>')" class="event-location" id="location-<?=$rows_td['id'] ?>" data-location="<?=$rows_td['id'] ?>"
            style="top: <?=$rows_td['p1'] ?>; left: <?=$rows_td['p2'] ?>" title="<?=SHOW_text($rows_td['tenbaiviet_'.$lang]) ?>"></div>
          <?php } ?>
          </div>
        </div>
      <div class="dv-banner-right" id="event-list">
        <h3 class="event-header"><?=$name_itoop ?></h3>
        <table>
        <?php 
          $rows_nd_arr = LAY_banner_new("`id_parent` = 25");
          foreach ($rows_nd_arr as $rnd) {
        ?>
        <tr class="event-item event-item-<?=$rnd['id_danhmuc'] ?>" >
            <td class="event-item-title">
              <a <?=full_href($rnd) ?>>
                <?=SHOW_text($rnd['tenbaiviet_'.$lang]) ?>
                <span><?=SHOW_text($rnd['mota_'.$lang]) ?></span>
              </a>
            </td>
            <td class="event-item-img">
              <a <?=full_href($rnd) ?>><img src="<?=$fullpath."/".$rnd['duongdantin']."/".$rnd['icon'] ?>" alt="<?=$rnd['tenbaiviet_'.$lang] ?>" class="attachment-thumb size-thumb wp-post-image"></a>
            </td>
        </tr>
        <?php } ?>
        </table>            
      </div>
    </div>
  </div>
  <div class="clr"></div>
</section>
<div class="clr"></div>
<script type="text/javascript">
  function marker_up() {
      jQuery(".event-location").stop().animate({"margin-top": "-25px"}, 300, function() {
          marker_down();
      });
  }

  function marker_down() {
      jQuery(".event-location").stop().animate({"margin-top": "-30px"}, 300, function() {
          marker_up();
      });
  }
  function show_banner(id, name){
    $(".event-header").html(name);
    $(".event-item").hide();
    $(".event-item-"+id).show();
  }
  $(function(){
    $(".event-item-<?=$id_itoop ?>").show();
    <?php if(!isset($_GET['off'])){ ?>
    marker_up();
    <?php } ?>
  })
</script>