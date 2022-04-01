<?php
$step = DB_que("SELECT `id` FROM `#_step` WHERE `id` = 12 LIMIT 1");
$step = mysqli_fetch_assoc($step);
?>

<div class="bmi-advice__input-board__right">
    <script src="myadmin/js/jquery-ui.js"></script>
    <link rel="stylesheet" href="myadmin/css/jquery-ui.css?v=2">
    <div class="row-weight">
        <div class="product-gpw-input">
            <label class="product-gpw-input__label"><?= $glo_lang['ngay_sinh'] ?></label>
            <div class="wpcf7-form-control-wrap">
                <input type="text" id="datepicker" name="ngay-sinh" readonly>
            </div>
        </div>
        <div class="product-gpw-input">
            <label class="product-gpw-input__label"><?= $glo_lang['can_nang'] ?></label>
            <div class="wpcf7-form-control-wrap">
                <input type="number" name="cannang" class="cannang" placeholder="KG">
            </div>
        </div>
        <div class="product-gpw-input">
            <label class="product-gpw-input__label"><?= $glo_lang['chieu_cao'] ?></label>
            <div class="wpcf7-form-control-wrap">
                <input type="number" name="chieucao" class="chieucao" placeholder="CM">
            </div>
        </div>
        <div class="bmi-advice__form__gender flex">
            <label><?= $glo_lang['gioi_tinh'] ?></label>
            <div class="checkbox-add">
                <div class="checkbox">
                    <label>
                        <input type="radio" checked="checked" name="gender" value="1">
                        <span><?= $glo_lang['nam'] ?></span>
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                        <input type="radio" name="gender" value="2">
                        <span><?= $glo_lang['nu'] ?></span>
                    </label>
                </div>
            </div>
        </div>
        <div class="bmi-advice__form__cell -submit col-xs-12 col-sm-12"
             style="width: 75%; float: right;margin-top: 20px;">
            <a class="product-gpw-btn cur" onclick="doCanNang(<?= $step['id'] ?>)"><?= $glo_lang['xem_ket_qua'] ?></a>
        </div>
        <p></p></div>

    <div class="wpcf7-response-output wpcf7-display-none" aria-hidden="true">
        <div class="weight-result">
            <p class="luu_y_weight"></p>
            <p class="read-more"><a onclick="$('.row-weight').show();$('.weight-result').hide()" class="color_cam cur">
                    <?= $glo_lang['xem_lai'] ?></a></p>
        </div>
    </div>
    <script type="text/javascript">
        function doCanNang(step) {
            var can_nang = $(".cannang").val();
            var chieu_cao = $(".chieucao").val();
            if (can_nang == "") {
                $(".cannang").focus();
            }
            if (chieu_cao == "") {
                $(".chieucao").focus();
            }

            $.ajax({
                type: "POST",
                url: "<?=$full_url . "/tinh-chieu-cao-can-nang/" ?>",
                data: {
                    "can_nang": can_nang,
                    "chieu_cao": chieu_cao,
                    "ngaysinh" : $("#datepicker").val(),
                    "step": step
                },
                success: function (data) {
                    data = JSON.parse(data);
                    // if(data.type == 1){

                    $(".luu_y_weight").html(data.data);
                    $(".row-weight").hide();
                    $(".weight-result").show();

                    // }
                }
            });


        }

        $(function () {
            $("#datepicker").datepicker({
                autoclose: true,
                changeMonth: true,
                changeYear: true,
                format: 'dd/mm/yyyy',
            });
        });
    </script>
</div>