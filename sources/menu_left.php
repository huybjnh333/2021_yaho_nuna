<div class="left-menu">
    <?php
        $cskh = LAYTEXT_rieng(90);
        if(!empty($cskh)){
    ?>
    <div class="agent-details">
        <div class="agent-header">
            <div class="agent-img"><img class="avatar"
                                        src="<?=full_src($cskh,"")?>"
                                        alt="agent"></div>
            <h5 class="name"><?=$cskh['tenbaiviet_'.$lang]?> </h5>
        </div>
        <div class="showText_lienhe">
            <?=SHOW_text($cskh['noidung_'.$lang])?>
        </div>
        <!-- server result /-->
        <p class="view_all"><a <?=full_href($cskh)?> class="view-more"><?=$cskh['p1_'.$lang]?></a></p>
    </div>
    <?php } ?>
    <div class="bh-right-ad">
        <div class="box_right_pro_view pro_view_sp">
            <div class="title_right_pro_view"><i class="fa fa-bars"></i><?=$glo_lang['san_pham_hot']?></div>
            <?php
                $sp_hot = LAY_baiviet(2,"5","`opt4` = 1");
                foreach ($sp_hot as $rows){
            ?>
            <div class="plc2_1 i-st1">
                <a <?=full_href($rows)?>>
                    <li><img src="<?=full_src($rows,"")?>" alt="<?=$rows['tenbaiviet_'.$lang]?>"></li>
                    <h3 class="limit-row-3"><?=$rows['tenbaiviet_'.$lang]?></h3>
                </a>
            </div>
            <?php } ?>
            <div class="clr"></div>
            <p class="view_all"><a href="<?=$full_url."/san-pham-noi-bat/"?>"><?=$glo_lang['xem_tat_ca']?></a></p>
        </div>
        <div class="clear"></div>
    </div>

</div>