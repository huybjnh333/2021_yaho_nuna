<div class="home-right-r">
    <div class="bh-right-ad" style="width: 100%;">
        <div class="box_right_pro_view_another" style="padding-bottom: 2px;margin-bottom: 25px;">
<!--            <div class="title_right_pro_view">--><?//= $glo_lang['danh_muc'] ?><!--</div>-->
            <ul class="flex">
                <?php if (empty($_SESSION['id'])) { ?>
                    <li><a href="<?= $full_url . "/dang-nhap" ?>"
                           style="color: #c0212f;"><?= $glo_lang['dang_nhap'] ?></a></li>
                    <li><a href="<?= $full_url . "/dang-ky" ?>"><?= $glo_lang['dang_ky'] ?></a></li>
                    <li><a href="<?= $full_url . "/quen-mat-khau" ?>"><?= $glo_lang['quen_mat_khau'] ?></a></li>
                <?php } else { ?>
                    <li><a class="<?=$motty == "tai-khoan" ? "active" : ""?>" href="<?= $full_url . "/tai-khoan" ?>"><i class="fa fa-user-circle-o"></i>
                            <?= $glo_lang['thong_tin_ca_nhan'] ?></a></li>
                    <li><a class="<?=$motty == "doi-mat-khau" ? "active" : ""?>" href="<?= $full_url . "/doi-mat-khau" ?>"><i class="fa fa-key"></i>
                            <?= $glo_lang['doi_mat_khau'] ?></a></li>
                    <!--                    <li><a href="--><? //= $full_url . "/lich-su-mua-hang" ?><!--">--><? //= $glo_lang['lich_su_mua_hang'] ?><!--</a></li>-->
                    <li><a href="<?= $full_url . "/thoat" ?>"><i class="fa fa-sign-out"></i>
                            <?= $glo_lang['thoat'] ?></a></li>
                <?php } ?>
            </ul>
        </div>
        <div class="clear"></div>
    </div>
    <div class="clr"></div>
</div>
<style>
    .box_right_pro_view_another ul {list-style: none;}
    .box_right_pro_view_another ul li {border: 1px solid #ccc;/*border-top: unset;*/padding: 5px;text-align: center;display: inline-block;width: calc(100% / 3);background: #b90e0e;box-sizing: border-box;}
    .box_right_pro_view_another ul li a:hover {color: #fff000;}
    .box_right_pro_view_another ul li a {width: 100%;font-weight: 500;font-size: 14px;color: #fff;line-height: 23px;}
    .title_right_pro_view {text-align: center;}
    .box_right_pro_view_another ul li a i{padding-right: 5px;}
    .active {color: #fff000!important;}
</style>