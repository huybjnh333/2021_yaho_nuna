<div class="tin_right">
    <?php
        $anhbanggia = LAY_banner_new("`id_parent` = 25",1);
    ?>
    <div class="box_right_pro_view box_right">
        <a <?=full_href($anhbanggia)?> target="<?=$anhbanggia['blank']?>"><img class="lazy" <?=full_src_lazy($anhbanggia)?>></a>
        <p><?=$anhbanggia['tenbaiviet_'.$lang]?></p>
        <p class="read_more"><a class="wow fadeInUp" <?=full_href($anhbanggia)?> target="<?=$anhbanggia['blank']?>">
                <?=strip_tags($anhbanggia['mota_'.$lang])?><i class="fa fa-caret-right"></i></a></p>
        <div class="clr"></div>
    </div>
    <div class="box_right_pro_view">
        <div class="title_right_pro_view"><?=$glo_lang['dich_vu_dieu_tri']?></div>
        <ul>
            <?php
                $danhmuc_tieubieu = LAY_danhmuc(2,"","`opt` = 1");
                foreach ($danhmuc_tieubieu as $rows){
            ?>
            <li><a <?=full_href($rows)?> title="<?=$rows['tenbaiviet_'.$lang]?>"><?=$rows['tenbaiviet_'.$lang]?></a></li>
            <?php } ?>
        </ul>
        <div class="clr"></div>
    </div>
    <?php $chamsoc = LAY_baiviet(8,"","`opt3` = 1");
        if(!empty($chamsoc)){
    ?>
    <div class="box_right_pro_view">
        <div class="title_right_pro_view"><?=$glo_lang["cham_soc_rang_mieng"]?></div>
        <ul>
            <?php
            foreach ($chamsoc as $rows){
                ?>
                <li><a <?=full_href($rows)?> title="<?=$rows['tenbaiviet_'.$lang]?>"><?=$rows['tenbaiviet_'.$lang]?></a></li>
            <?php } ?>
        </ul>
        <div class="clr"></div>
    </div>
    <?php } ?>
    <?php
        $anhbenphai = LAY_banner_new("`id_parent` = 26");
        if(!empty($anhbenphai)){
    ?>
    <div class="box_right_pro_view box_right_img">
        <?php foreach ($anhbenphai as $rows){ ?>
        <a <?=full_href($rows)?> target="<?=$rows['blank']?>"><img class="lazy" <?=full_src_lazy($rows)?>></a>
        <?php } ?>
    </div>
    <?php } ?>
    <div class="box_right_pro_view">
        <div class="title_right_pro_view"><?=$glo_lang['thong_ke_truy_cap']?></div>
        <div class="new_right">
            <ul>
                <h4><?=$glo_lang['so_luot_dang_online']?>: <span><?=NUMBER_fomat($online_tv) ?></span></h4>
                <h4><?=$glo_lang['so_luot_truy_cap']?>: <span><?=NUMBER_fomat($thongke_tv) ?></span></h4>
                <div class="clr"></div>
            </ul>
        </div>
    </div>
</div>