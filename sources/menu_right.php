<?php
$dudoan_ngaysinh = DB_fet("`tenbaiviet_$lang`,`mota_$lang`,`seo_name`", "#_baiviet", "`showhi` = 1 and `p2` = 1 and step = 10", "", 1,1);
$dudoan_ngaysinh = reset($dudoan_ngaysinh);
$datten_chobe = DB_fet("`tenbaiviet_$lang`,`p3_$lang`,`seo_name`", "#_step", "`showhi` = 1 and `id` = 11", "", 1,1);
$datten_chobe = reset($datten_chobe);
$do_cannang = DB_fet("`tenbaiviet_$lang`,`p3_$lang`,`seo_name`", "#_step", "`showhi` = 1 and `id` = 12", "", 1,1);
$do_cannang = reset($do_cannang);
?>
<div class="level2navbar">
    <div class="click-right">
        <i class="fa fa-life-ring" aria-hidden="true"></i><br><?=str_replace(" ","<br>",$glo_lang['ho_tro_khach_hang'])?>
    </div>
    <div class="l2links">
        <ul class="nav navbar-nav navbar-left">
            <li>
                <a <?=full_href($dudoan_ngaysinh)?> class="btn-rounded">
                    <img src="delete/trangchu/cloudsoft.png" alt="" width="24" height="24"> <?=$dudoan_ngaysinh['tenbaiviet_'.$lang]?>
                </a>
            </li>
            <li>
                <a <?=full_href($datten_chobe)?> class="btn-rounded  blue">
                    <img src="delete/trangchu/cloudsoft.png" alt="" width="24" height="24"> <?=$datten_chobe['tenbaiviet_'.$lang]?>
                </a>
            </li>
            <li>
                <a <?=full_href($do_cannang)?> class="btn-rounded  red">
                    <img src="delete/trangchu/cloudsoft.png" alt="" width="24" height="24"> <?=$do_cannang['tenbaiviet_'.$lang]?>
                </a>
            </li>
        </ul>
    </div>
</div>

<script>
    $(document).ready(function () {
        $(".level2navbar").click(function () {
            $(".l2links").toggle();
        });
    });
</script>