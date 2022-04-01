<?php
    $tin_xemnhieu = LAY_baiviet(3,3,"","`soluotxem` DESC");
    $banner_phai = LAY_banner_new("`id_parent` = 27",3);
?>
<div class="tin_right">
    <?php if(!empty($tin_xemnhieu)){ ?>
    <div class="box_right_pro_view">
        <div class="title_right_pro_view"><?=$glo_lang['bai_viet_duoc_quan_tam']?></div>
        <?php foreach ($tin_xemnhieu as $rows){ ?>
        <div class="blog-item">
            <div class="img-box">
                <a <?=full_href($rows)?> class="open-post">
                    <img class="img-fluid lazy" <?=full_src_lazy($rows)?>>
                </a>
            </div>
            <div class="text-box">
                <a <?=full_href($rows)?> class="title-blog">
                    <h5 class="lm_4"><?=$rows['tenbaiviet_'.$lang]?></h5>
                </a>
            </div>
        </div>
        <?php } ?>
    </div>
    <?php } ?>
    <?php if(!empty($tin_xemnhieu)){ ?>
    <div class="box_right_pro_view">
        <?php foreach ($banner_phai as $rows){ ?>
        <a <?=full_href($rows)?> target="<?=$rows['blank']?>"><img class="lazy" <?=full_src_lazy($rows,"")?>></a>
        <?php } ?>
    </div>
    <?php } ?>
</div>