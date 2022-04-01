<div class="home-right-r">
    <div class="search_bar">
        <div class="line"><img src="img/homepage_header_line.webp" alt=""></div>
        <?php
            $tn_arr = isset($_GET['tn']) ? explode("-", $_GET['tn']) : array();
            foreach ($tinhnang as $rows) {
                if($rows['id_parent'] != 0) continue;
        ?>
        <div class="filter-li4">
            <div class="title4">
                <h2><?=SHOW_text($rows['tenbaiviet_'.$lang]) ?></h2>
                <i class="fa fa-plus"></i>
                <i class="fa fa-minus" style="display: none"></i>
            </div>
            <div class="main highlights4" style="display: none;">
                <div class="list-group">
                    <?php
                        foreach ($tinhnang as $ktn) {
                            if($ktn['id_parent'] != $rows['id']) continue;
                    ?>
                        <label class="list-group-item">
                            <input class="cke_tinhnang" name="days" type="checkbox" value="<?=$ktn['id'] ?>" <?=in_array($ktn['id'],$tn_arr) ? 'checked="checked"' : "" ?>>
                            <span for="event_availability_label_1"> <?=SHOW_text($ktn['tenbaiviet_'.$lang]) ?></span>
                        </label>
                    <?php } ?>
                </div>
            </div>
        </div>
        <?php } ?>
        <input class="js_search_text siteSearchInput ui-autocomplete-input" type="text" name="text" value="" maxlength="100" placeholder="<?=$glo_lang['nhap_tu_khoa_tim_kiem'] ?>">
        <div class="text-right div-filter-button">
            <button class="btn btn-search filter-button" id="button-filter" type="button" onclick="timkiem_sp_left()"><?=$glo_lang['tim_kiem'] ?></button>
        </div>
        <script type="text/javascript">
            $(".filter-li4 .title4").click(function(){
                $("~ .highlights4", this).toggle();
                $(".fa-minus", this).show();
                $(".fa-plus", this).toggle();
              });
            function timkiem_sp_left(){
                var key_timkiem = $(".js_search_text").val().trim().replace(/ /g, "+");
                var js_tinhnang = "";
                $(".cke_tinhnang").each(function(){
                    if($(this).is(":checked")) {
                        if(js_tinhnang == "") js_tinhnang += $(this).val();
                        else js_tinhnang += "-"+$(this).val();
                    }
                });
                window.location.href = full_url + "/search/?key=" + key_timkiem + "&tn=" + js_tinhnang;
            }

            $('.js_search_text').keypress(function (event) {
                var keycode = (event.keyCode ? event.keyCode : event.which);
                if (keycode == '13') {
                    timkiem_sp_left();
                }
            });
        </script>
        <div class="clear"></div>
    </div>

    <div class="bh-right-ad" style="width: 100%;">
        <div class="box_right_pro_view" style="padding-bottom: 2px;    margin-bottom: 25px;">
        <div class="title_right_pro_view" style="margin-bottom: 7px;"><?=$glo_lang['danh_muc'] ?></div>
        <?php
            $danhmuc = LAY_danhmuc(2,0, "`id_parent` = 0");
            $quantang = LAY_step(6,1);
            foreach ($danhmuc as $dmm) {
        ?>
        <ul>
            <li class="filter filter-li9"><a <?=full_href($dmm) ?>><?=SHOW_text($dmm['tenbaiviet_'.$lang]) ?></a></li>
        </ul>
        <?php } ?>
        <ul>
            <li class="filter filter-li9"><a <?=full_href($quantang) ?>><?=SHOW_text($quantang['tenbaiviet_'.$lang]) ?></a></li>
        </ul>

  </div>
  <div class="clear"></div>
</div>
<div class="box_right_pro_view wow fadeInRight">
    <div class="title_right_pro_view"><?=$glo_lang['uu_dai_moi_nhat'] ?></div>
    <div class="new_right">
        <?php
            $baiviet = LAY_baiviet(7, 10, "`opt` = 1");
            foreach ($baiviet as $rows) {
        ?>
      <ul>
        <li><a <?=full_href($rows) ?>><img src="<?=full_src($rows) ?>" alt="<?=SHOW_text($rows['tenbaiviet_'.$lang]) ?>"></a></li>
        <h3><a <?=full_href($rows) ?>><?=SHOW_text($rows['tenbaiviet_'.$lang]) ?></a></h3>
        <div class="clr"></div>
      </ul>
      <?php } ?>
    </div>
  <div class="clr"></div>
  </div>
<div class="clr"></div>
</div>