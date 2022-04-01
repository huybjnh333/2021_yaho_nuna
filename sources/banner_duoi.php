<?php $banner_duoi = LAY_banner_new("`id_parent` = 32",1);
if(!empty($banner_duoi)){
    ?>
    <section class="dv-home-khuyenmai dv-hoidap-a" style="<?= !empty($banner_duoi['icon']) ? "background: url('" . $fullpath . '/' . $banner_duoi['duongdantin'] . '/' . $banner_duoi['icon'] . "') fixed;
    background-repeat: no-repeat;
    background-size: cover;" : "" ?>">
        <div class="pagewrap">
            <div class="title_home align_center wow flipInX">
                <h1 class="brand-title"><?=$banner_duoi['tenbaiviet_'.$lang]?></h1>
                <h3 class="lm_3"><?=SHOW_text($banner_duoi['noidung_'.$lang])?></h3>
                <p class="read-more"><a <?=full_href($banner_duoi)?> target="<?=$banner_duoi['blank']?>">
                        <?=$banner_duoi['mota_'.$lang]?></a></p>
            </div>
        </div>
        <div class="clr"></div>
    </section>
<?php } ?>