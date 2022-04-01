<div class="calc-body">
    <p class="calc-body-para color_cam"><?= $glo_lang['hay_de_nuna_du_doan_ngay_sinh'] ?></p>
    <div class="date-picker-section">
        <div class="last-period-wrapper">
            <p class="due-first-day-para"><?= $glo_lang['ngay_dau_tien_ky_kinh'] ?></p>
            <div class="day-block">
                <select class="due-date-dd" id="duedate_day">
                    <?php
                    $days = cal_days_in_month(0, 2, 2022);
                    $day = array();
                    for ($i = 1; $i <= $days; $i++) {
                        $day[$i] = $i;
                    }
                    foreach ($day as $key => $val) {
                        ?>
                        <option <?= date("d", time()) == $key ? "selected" : "" ?>
                            value="<?= $key ?>"><?= $val ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="month-block">
                <select class="due-date-mm mrgin-left20"
                        id="duedate_month" onchange="changeDay()">
                    <?php
                    $month = array();
                    for ($i = 1; $i <= 12; $i++) {
                        $month[$i] = $glo_lang["thang_" . $i];
                    }
                    foreach ($month as $key => $val) {
                        ?>
                        <option <?= date("m", time()) == $key ? "selected" : "" ?>
                            value="<?= $key ?>"><?= $val ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="year-block">
                <select class="due-date-yyyy mrgin-left20"
                        id="duedate_year">
                    <option value="<?= date("Y", strtotime("-1 year")) ?>"><?= date("Y", strtotime("-1 year")) ?></option>
                    <option selected
                            value="<?= date("Y", time()) ?>"><?= date("Y", time()) ?></option>
                    <option value="<?= date("Y", strtotime("+1 year")) ?>"><?= date("Y", strtotime("+1 year")) ?></option>
                </select>
            </div>
        </div>

        <p class="read-more"><a onclick="tinhNgayDuSinh()"
                                class="color_cam cur"><?= $glo_lang['tinh_ngay_du_sinh'] ?>
            </a></p>
    </div>
    <div class="date-result">
        <p class="due-congratulations-text"><?= $glo_lang['chuc_mung_be'] ?></p>
        <p class="date-caculated"></p>
        <p class="date-thuthai"></p>
        <p class="luu_y"><?= $glo_lang['luu_y'] ?></p>
        <p class="read-more"><a onclick="$('.date-picker-section').show();
                                                $('.calc-body-para').show();$('.date-result').hide()"
                                class="color_cam cur">
                <?= $glo_lang['tinh_lai'] ?></a></p>
    </div>
</div>
<script type="text/javascript">
    function tinhNgayDuSinh() {
        $.ajax({
            type: "POST",
            url: "<?=$full_url . "/tinh-ngay-du-sinh"?>",
            data: {
                "ngay": $("#duedate_day").find(":selected").val(),
                "thang": $("#duedate_month").find(":selected").val(),
                "nam": $("#duedate_year").find(":selected").val()
            },
            success: function (data) {
                data = JSON.parse(data);
                $(".date-caculated").html(data.data);
                $(".date-thuthai").html(data.data_2);
                $(".date-result").show();
                $('.date-picker-section').hide();
                $('.calc-body-para').hide();
            }
        });
    }
</script>