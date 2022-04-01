<?php
if (isset($_SESSION['id'])) {
    $info_acc = DB_fet("*", "#_members", "`id` = '" . $_SESSION['id'] . "' AND `phanquyen` = 0", "`id` DESC", 1);
    if (mysqli_num_rows($info_acc)) {
        $info_acc = mysqli_fetch_assoc($info_acc);
        foreach ($info_acc as $key => $value) {
            ${$key} = $value;
        }
    }
}
// full_src($thongtin_step, '')
include _source . "box-header.php";
?>
<div class="page_conten_page">
    <?php include _source."menu_right.php"; ?>
    <div class="pagewrap">
        <div class="left_contact">
            <?php
            $i = 0;
            $baiviet = LAY_baiviet($thongtin_step['id']);
            foreach ($baiviet as $rows) {
                $i++;
                // if($i > 1) continue;
                // full_img($rows, '')
                ?>
                <h3><?=$rows['tenbaiviet_'.$lang]?></h3>
                <div class=""><?= $rows['noidung_' . $lang] ?></div>
                <div class="clr"></div>
            <?php } ?>
        </div>
        <div class="right_contact">
            <h3><?=$glo_lang['form_lien_he']?></h3>
            <div class="contact">
                <?php include _source."lien_he_form.php";?>
            </div>
        </div>
        <div class="clr"></div>
        <div class="contact-maps">
            <li>
                <?php if ($thongtin_step['map_google'] != "") { ?>
                    <iframe class="iframe_load" iframe-src="<?= $thongtin_step['map_google'] ?>" width="100%"
                            height="350" frameborder="0" style="border:0" allowfullscreen></iframe>
                <?php } ?>
            </li>
            <div class="clr"></div>
        </div>
        <div class="clr"></div>
    </div>
</div>