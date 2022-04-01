<style>
    .dv-load-xong {
        position: fixed;
        right: 68px;
        bottom: 40px;
        z-index: -1;
        background: rgba(0, 0, 0, 0.5490196078431373);
        padding: 0 16px 0 10px;
        font-size: 13px;
        color: #fff;
        border-radius: 100px;
        min-width: 120px;
        margin-bottom: -15px;
        opacity: 0;
        transition: all .4s;
        height: 26px;
        line-height: 26px;
    }

    .dv-load-xong.active {
        z-index: 9;
        margin-bottom: 10px;
        opacity: 1
    }

    .dv-load-xong img {
        height: 20px;
        position: relative;
        top: -1px;
        margin-right: 6px;
    }
</style>
<div class="dv-load-xong "><img src="../images/loadernew.gif" alt="">Update data ...</div>
<script>
    $(document).on("change", "input.minimal_click", function () {
        var check = 0;
        if ($(this).is(":checked")) {
            check = 1;
        }
        var colum = $(this).attr("colum");
        var idcol = $(this).attr("idcol");
        var table = $(this).attr("table");
        $(".dv-load-xong").addClass('active');
        $.ajax({
            type: "POST",
            url: "index.php",
            data: {
                'id': idcol, 'check': check, 'col': colum, 'table': table,
                'action': '<?=$action ?>',
                'step': '<?=$step ?>',
                'id_step': '<?=$id_step ?>',
                "ajax_action": "update_colum"
            },

            success: function (data) {
                if (data == "1") {
                    setTimeout(function () {
                        $(".dv-load-xong").removeClass('active');
                    }, 1000);
                } else {
                    alert(data);
                    window.location.reload();
                }
            }
        });
    });

    function UPDATE_colum(obj, id, col, table) {
        $(".dv-load-xong").addClass('active');
        $.ajax({
            type: "POST",
            url: "index.php",
            data: {
                'id': id, 'val': $(obj).val(), 'col': col, 'table': table,
                'action': '<?=$action ?>',
                'step': '<?=$step ?>',
                'id_step': '<?=$id_step ?>',
                "ajax_action": "update_colum_change"
            },
            success: function (data) {
                if (data == "1") {
                    setTimeout(function () {
                        $(".dv-load-xong").removeClass('active');
                    }, 1000);
                } else {
                    alert(data);
                    window.location.reload();
                }
            }
        });
    }
</script>

<script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>

<script src="bower_components/jquery-ui/jquery-ui.min.js"></script>
<script>
    $.widget.bridge('uibutton', $.ui.button);
</script>
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="bower_components/raphael/raphael.min.js"></script>
<script src="bower_components/morris.js/morris.min.js"></script>
<script src="bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<script src="bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
<script src="bower_components/moment/min/moment.min.js"></script>
<!-- <script src="bower_components/bootstrap-daterangepicker/daterangepicker.js"></script> -->
<!-- <script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script> -->
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<script src="bower_components/Flot/jquery.flot.js"></script>
<script src="bower_components/Flot/jquery.flot.resize.js"></script>
<script src="bower_components/Flot/jquery.flot.pie.js"></script>
<script src="bower_components/Flot/jquery.flot.categories.js"></script>
<!-- <script src="bower_components/Flot/jquery.flot.categories.js"></script> -->
<script src="js/me.js?v=3"></script>
<!-- <script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script> -->
<script src="js/jquery-ui.js?v=2"></script>
<link rel="stylesheet" href="css/jquery-ui.css?v=2">
<script type="text/javascript">
    $('.datepicker').attr('autocomplete', 'off');
    $(".datepicker").each(function () {
        $(this).datepicker({
            autoclose: true,
            changeMonth: true,
            changeYear: true,
            format: 'dd/mm/yyyy'
        });
    });
    $("#datepicker").datepicker({
        autoclose: true,
        changeMonth: true,
        changeYear: true,
        format: 'dd/mm/yyyy'
    });
    $(function () {
        $(".sidebar-menu a").each(function () {
            var url_goc = "<?php
                if (isset($_GET['id-parent'])) echo $url_page . "&id-parent=" . @$_GET['id-parent'];
                else if (isset($_GET['them-moi']) && isset($_GET['step'])) echo $url_page . "&step=" . @$_GET['step'] . "&id_step=" . @$_GET['id_step'];
                else if (isset($_GET['step'])) echo $url_page . "&step=" . @$_GET['step'] . "&id_step=" . @$_GET['id_step'];
                else echo $url_page;
                ?>";
            var href = $(this).attr("href");
            var full = "<?php
                if (isset($_GET['id-parent'])) echo $url_page . "&id-parent=" . @$_GET['id-parent'];

                else if (isset($_GET['noi-dung'])) echo $url_page . "&noi-dung=true";
                else if (isset($_GET['them-moi']) && !isset($_GET['step'])) echo $url_page . "&them-moi=true";
                else if (isset($_GET['them-moi']) && isset($_GET['step'])) echo $url_page . "&them-moi=true&step=" . @$_GET['step'] . "&id_step=" . @$_GET['id_step'];
                else if (isset($_GET['step'])) echo $url_page . "&step=" . @$_GET['step'] . "&id_step=" . @$_GET['id_step'];
                else echo $url_page;
                ?>";
            var check_ok = $(this).attr("check");
            if (href == full || (check_ok == "ok") && url_goc == href) {
                $(this).parent().addClass("active");
                $(this).parent().parent().parent("li.treeview").addClass("menu-open");
                $(this).parent().parent().parent("li.treeview").addClass("active");
                $(this).parent().parent().parent().parent().parent("li.treeview").addClass("menu-open");
                $(this).parent().parent().parent().parent().parent("li.treeview").addClass("active");
            }
        })
    });
    <?php if(@$lang_nb2 || @$lang_nb3 || @$lang_nb3){  ?>
    jQuery(window).scroll(function () {
        if ($(".nav-tabs-custom").length > 0) {
            var hei = $('.nav-tabs-custom').offset().top;
            if (jQuery(window).scrollTop() >= hei) {
                jQuery('.nav-tabs-custom > .nav-tabs').addClass('fixed');
            } else {
                jQuery('.nav-tabs-custom > .nav-tabs').removeClass('fixed');
            }
        }
    });
    <?php } ?>
    <?php
    $forder_goc = str_replace("/", "\/", $_SESSION['sub_demo']);
    if ($_SERVER['HTTP_HOST'] != 'localhost' && $_SERVER['HTTP_HOST'] != $check_fl_domain) {
        $forder_goc = "";
    }
    ?>
    window.CKEDITOR_BASEPATH = 'ckeditor';
    $('.paEditor').each(function () {
        CKEDITOR.replace($(this).attr('name'), {
            height: 300,
            "filebrowserBrowseUrl": "\/<?=$forder_goc ?>myadmin\/bower_components\/ckfinder\/ckfinder.html",
            "filebrowserImageBrowseUrl": "\/<?=$forder_goc ?>myadmin\/bower_components\/ckfinder\/ckfinder.html?type=Images",
            "filebrowserFlashBrowseUrl": "\/<?=$forder_goc ?>myadmin\/bower_components\/ckfinder\/ckfinder.html?type=Flash",
            "filebrowserUploadUrl": "\/<?=$forder_goc ?>myadmin\/bower_components\/ckfinder\/core\/connector\/php\/connector.php?command=QuickUpload&type=Files",
            "filebrowserImageUploadUrl": "\/<?=$forder_goc ?>myadmin\/bower_components\/ckfinder\/core\/connector\/php\/connector.php?command=QuickUpload&type=Images",
            "filebrowserFlashUploadUrl": "\/<?=$forder_goc ?>myadmin\/bower_components\/ckfinder\/core\/connector\/php\/connector.php?command=QuickUpload&type=Flash"
        });
    });
    var settingSelect = {
        csvDispCount: 6,
        captionFormat: '{0} Danh mục',
        captionFormatAllSelected: 'Chọn tất cả ({0})',
        search: true,
        searchText: 'Nhập tìm kiếm...',
        selectAll: true,
        multiple: 'multiple',
        locale: ['Chọn', 'Thoát', 'Chọn tất cả', ' aa'],
        noMatch: 'Không tìm thấy kết quả phù hợp \'{0}\' ',
    };

    if ($('.SlectBoxNew').length > 0) {
        $('.SlectBoxNew').SumoSelect(settingSelect);
    }

    if ($('.SlectBox').length > 0) {
        $('.SlectBox').select2();
    }
    $(function () {
        if ($('.v2_select').length > 0) {
            $('.v2_select').css("opacity", "1");
        }
    });
</script>
<style>
    table.table.table-hover.table-danhsach.fixed tr:nth-child(1) {
        position: fixed;
        top: 0;
        z-index: 9;
    }
</style>
<script type="text/javascript">
    $(function () {
        if ($(".table-danhsach").length > 0) {
            var w = $(".table.table-hover.table-danhsach").width();
            $(".table.table-hover.table-danhsach tr:nth-child(1)").width(w);
            var topH = $(".table.table-hover.table-danhsach").offset().top + 20;
            $(".table.table-hover.table-danhsach tr:nth-child(1) th").each(function () {
                var ww = $(this).width();
                $(this).width(ww);
            });
            $(".table.table-hover.table-danhsach tr:nth-child(2) td").each(function () {
                var ww = $(this).width();
                $(this).width(ww);
            });
        }
        $(window).scroll(function () {
            if ($(".table-danhsach").length > 0) {
                if ($(this).scrollTop() > topH) {
                    $('.table.table-hover.table-danhsach').addClass("fixed");
                } else {
                    $('.table.table-hover.table-danhsach').removeClass("fixed");
                }
            }
        });
    });
</script>