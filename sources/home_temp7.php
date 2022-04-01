
<div class="pro-l-1">
    <a <?=full_href($rows) ?>>
      <?=!empty($view) && $view  == "slider" ? '<img src="'.full_src($rows).'" alt="'.SHOW_text($rows['tenbaiviet_'.$lang]).' title="'.SHOW_text($rows['tenbaiviet_'.$lang]).'">' : full_img($rows) ?>
      <div class="prl_title_c"><h3><?=SHOW_text($rows['tenbaiviet_'.$lang]) ?></h3>
      <p><sp class="lm_3"><?=SHOW_text($rows['thuoc_tinh_1_'.$lang]) ?></sp></p>
    </div>
    <div class="price-sp">
      <div class="price"><?=$gia['text_gia'].$gia['text_km'] ?></div>
      <div class="sp-cart"><a <?=$full_url."/gio-hang/?id=".$rows['id'] ?>><i class="fa fa-shopping-cart"></i><?=$glo_lang['dat_hang'] ?></a></div>
      <p><?= GET_sao_sp($rows['num_1'], $rows['num_2'], $rows['id']) ?></p>
    </div>
    </a>
</div>