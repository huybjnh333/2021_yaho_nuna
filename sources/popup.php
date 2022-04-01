<?php 
  if(!isset($_SESSION['lhpopup'])){ 
    $r = @LAY_banner_new("  `id_parent` = 25 ", 1);
    if(is_array($r)){
    $_SESSION['lhpopup'] = 1;
?>
<style>
  .dv-popup-change { position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: #0000007a; z-index: 9999; }
  .dv-pop-up-change-none { position: fixed; top: 50%; left: 50%; z-index: 999999; transform: translate(-50%,-50%); max-width: 1200px; max-height: 90%; }
  .dv-pop-up-change-none a.a_x_icon img { height: 16px; width: 16px; }
  .dv-pop-up-change-none a.a_x_icon { position: absolute; right: 0; margin-top: -12px; margin-right: -12px; cursor: pointer; background: rgba(0, 0, 0, 0.94); border-radius: 100px; padding: 3px; }
  .dv-pop-up-change-none a{display: block;}
  .dv-pop-up-change-none img{width: 100%; max-height: 100%; float: left;}
  .dv-email-popup { position: absolute; bottom: 0; width: 100%; padding: 5px; }
  .dv-email-popup input , .dv-email-popup input:focus{ width: calc(35% - 6px); float: left; border: none; border-radius: 0; box-shadow: none; font-size: 13px; padding: 0 10px; height: 36px; background: rgba(0, 0, 0, 0.1); font-family: Arial; margin-right: 6px; transition: none; outline: none !important; }
  .dv-email-popup a ,.dv-email-popup a:focus{ background: #3db54a; float: left; width: 30%; font-size: 14px; font-family: Arial; text-align: center; height: 36px; line-height: 36px; padding: 0; color: #fff; outline: none}
  .dv-email-popup a:hover { background: #119549 }
  @media only screen and (max-width: 757px){
    .dv-pop-up-change-none  { width: calc(100% - 30px) }
  }
</style>
<div class="dv-popup-change"></div>
<div class="dv-pop-up-change-none no_box">
  <div style="position: relative; width: 100%; height: 100%; display: table;">
  <a onclick="$('.dv-popup-change').remove();$('.dv-pop-up-change-none').remove()" class="a_x_icon"><img src="images/x_icon.svg" alt=""></a>
  <a <?=full_href($r) ?> ><img src="<?=$fullpath."/".$r['duongdantin']."/".$r['icon'] ?>" alt=""></a>

  </div>
</div>
<?php }} ?>