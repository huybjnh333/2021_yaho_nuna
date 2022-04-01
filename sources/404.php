<div class="page_conten_page pagewrap">
    <div class="tin_left_nd tin_left_2column">
        <div class="title_news">
            <h2><?= $arr_running['tenbaiviet_' . $lang] ?></h2>
        </div>
        <div class="showText2">
            <?php
            $nd = SHOW_text($arr_running['noidung_' . $_SESSION['lang']]);
            $nd = str_replace('[tencongty]', $thongtin['tenbaiviet_' . $lang], $nd);
            echo $nd;
            ?>
        </div>
        <div class="dv_404_gohome">
            <a href="<?= $full_url ?>"><?= $glo_lang['ve_trang_chu'] ?> <span class="time_doi"></span></a>
        </div>
        <script type="text/javascript">
            var time_doi = 11;
            setInterval(function () {
                time_doi--;
                $('.time_doi').html("(" + time_doi + ")");
                if (time_doi < 1) window.location.href = '<?=$full_url ?>'
            }, 1000);
        </script>
    </div>
    <div class="clr"></div>
</div>
