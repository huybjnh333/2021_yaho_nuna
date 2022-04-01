<?php
if (!defined("MOTTY")) die();
if (!empty($_POST) && $motty == 'update_token') {
    $_SESSION['token'] = md5(RANDOM_chuoi(5));
    echo $_SESSION['token'];
    exit();
}
if ($motty == 'clear_cache') {
    DEL_redis_table_page("#_baiviet");
    exit();
}
if (isset($_POST) && $motty == 'load_view_sp') {
    $id = isset($_POST['id']) ? $_POST['id'] : 0;
    $thongtin_step = null;
    $slug_step = 2;
    $load_ajax_all = 1;
    $mySlides = 2;
    $arr_running = DB_que("SELECT * FROM `#_baiviet` WHERE `step` = 2 AND `showhi` = 1 AND `id` = '$id' LIMIT 1");
    $arr_running = DB_arr($arr_running, 1);
    include "step/2a.php";
    exit();
}
if (isset($_POST) && $motty == 'change_count') {
    $id = isset($_POST['id']) ? $_POST['id'] : time();
    $_du_lieu_sn = DB_fet_rd("* ", " `#_du_lieu_sn` ", " `showhi` = 1 AND `id_parent` = '$id' ", " `catasort` ASC");

    echo '<option>' . $glo_lang['select'] . '</option>';

    foreach ($_du_lieu_sn as $rows) {
        echo '<option value="' . $rows['tenbaiviet_' . $lang] . '">' . $rows['tenbaiviet_' . $lang] . '</option>';
    }
    exit();
}

if (isset($_POST['action_ajax']) && $_POST['action_ajax'] == 'xoa_popup_child') {
    setcookie("delete_popup_child", "1", time() + 24 * 60 * 60, "/");
    exit();
}

if ($motty == "xoa_sosanh" && isset($_POST)) {
    $id = isset($_POST['id']) ? $_POST['id'] : 0;
    $axxx = explode(",", $_SESSION['so_sanh']);
    $xaxx = "";
    foreach ($axxx as $ke) {
        if ($id == $ke) continue;
        $xaxx .= $xaxx == "" ? $ke : "," . $ke;
    }
    $_SESSION['so_sanh'] = $xaxx;
    exit();
}
if ($motty == "mua_ngay_sp" && isset($_POST)) {
    $id = isset($_POST['id']) ? $_POST['id'] : 0;
    $sl = isset($_POST['sl']) ? $_POST['sl'] : 0;
    if (is_numeric($sl) && $sl > 0) {
        $_SESSION['cart'][$id] = $sl;
    }
    echo count($_SESSION['cart']);
    sleep(1);
    exit();
}
if ($motty == "load_tthanh_new" && isset($_POST)) {
    $id = isset($_POST['id']) ? $_POST['id'] : 0;
    echo '<option value="">' . $glo_lang['chon_quan_huyen'] . '</option>';
    $danhmuc_dd = LAY_danhmuc(5);
    foreach ($danhmuc_dd as $r_2) {
        if ($r_2['id_parent'] != $id) continue;
        echo '<option value="' . $r_2['id'] . '">' . SHOW_text($r_2['tenbaiviet_' . $lang]) . '</option>';
    }
    exit();
}
if ($motty == "add_sanpham_menu" && isset($_POST)) {
    $id = isset($_POST['id']) ? $_POST['id'] : 0;
    $step = 2;
    $lay_all_kx = LAYDANHSACH_idkietxuat($id, $step);
    $sp_baiviet = LAY_baiviet($step, 2, "(`id_parent` IN ($lay_all_kx)) AND `opt1` = 1");
    // $sp_baiviet     = LAY_baiviet($step, 2, "(`id_parent` IN ($lay_all_kx) OR FIND_IN_SET('".$id."', `id_parent_muti`)) AND `opt1` = 1");

    $chude = LAY_danhmuc($step, 1, "`id` = '$id'");

    if (count($sp_baiviet)) {
        echo '<ul class="fs-mnsul-gia">
              <p>' . $glo_lang['ban_chay_nhat'] . '</p>';
        foreach ($sp_baiviet as $rows) {
            $gia = GET_gia($rows['giatien'], $rows['giakm'], $glo_lang['dvt'], $glo_lang['gia_lienhe'], "gia_ban", "gia_km", '', '');
            echo '<div class="dv-sp-banchay-menu"> <a ' . full_href($rows) . '> <img src="' . full_src($rows) . '" alt="' . SHOW_text($rows['tenbaiviet_' . $lang]) . '"><h3>' . SHOW_text($rows['tenbaiviet_' . $lang]) . '</h3></a><div class="dgia-menu">' . $gia['text_gia'] . $gia['text_km'] . '</div><div class="clr"></div></div>';
        }
        echo '<p><a href="' . $full_url . "/" . $chude[0]['seo_name'] . "/?p=2" . '">' . $glo_lang['xem_them'] . ' +</a></p></ul>';
    }


    exit();
}
// /check dang tin
if ($motty == "check_isdangtin" && isset($_POST)) {
    $id = isset($_POST['id']) ? $_POST['id'] : 0;
    $id_parent = isset($_POST['id_parent']) ? $_POST['id_parent'] : "";
    $tenbaiviet_vi = isset($_POST['tenbaiviet_vi']) ? $_POST['tenbaiviet_vi'] : "";
    $noidung_vi = isset($_POST['noidung_vi']) ? $_POST['noidung_vi'] : "";
    $ma_bao_ve = isset($_POST['ma_bao_ve']) ? $_POST['ma_bao_ve'] : "";

    if (empty($_SESSION['id'])) {
        exit();
    }
    if (strtolower($ma_bao_ve) == strtolower($_SESSION['captcha']['code']) || $id > 0) {
        if ($tenbaiviet_vi != "" && $noidung_vi != "") {
            $duongdantin = "datafiles/setone";
            $file = UPLOAD_file("inputfile", "./$duongdantin/", time());
            if (!empty($file)) {
                TAO_anhthumb("./" . $duongdantin . "/" . $file, "./" . $duongdantin . "/thumb_" . $file, 380, 250, "myadmin/images/trang_380_250.png");
            }
            $seo_name = CONVERT_vn($tenbaiviet_vi);
            $step = 4;
            $catasort = layCatasort("#_baiviet", '`step` = ' . $step);
            $catasort = number_format(SHOW_text($catasort), 0, ',', '.');

            $data = array();
            $data['tenbaiviet_vi'] = $tenbaiviet_vi;
            $data['tenbaiviet_en'] = $tenbaiviet_vi;
            $data['noidung_vi'] = $noidung_vi;
            $data['noidung_en'] = $noidung_vi;

            $data['seo_title_vi'] = $tenbaiviet_vi;
            $data['seo_title_en'] = $tenbaiviet_vi;
            $data['seo_description_vi'] = $tenbaiviet_vi;
            $data['seo_description_en'] = $tenbaiviet_vi;
            $data['seo_keywords_vi'] = $tenbaiviet_vi;
            $data['seo_keywords_en'] = $tenbaiviet_vi;

            $data['showhi'] = 0;
            $data['id_parent'] = @$id_parent;
            $data['ngaydang'] = time();
            $data['step'] = $step;
            $data['catasort'] = $catasort + 1;
            if (!empty($file)) {
                $data['icon'] = $file;
                if ($id > 0) {
                    $sql_th = DB_que("SELECT * FROM `#_baiviet` WHERE `id` = '$id' AND `id_user` = '" . $_SESSION['id'] . "' LIMIT 1");
                    $sql_th = DB_arr($sql_th, 1);
                    @unlink("./" . $sql_th['duongdantin'] . "/" . $sql_th['icon']);
                    @unlink("./" . $sql_th['duongdantin'] . "/thumb_" . $sql_th['icon']);
                }
            }
            $data['id_user'] = $_SESSION['id'];

            if ($id == 0) {
                $id = ACTION_db($data, "#_baiviet", 'add', NULL, NULL);
                THEM_seoname($id, $seo_name, "#_baiviet", $step, "0");
                $return = array("err" => 0, "ms" => $glo_lang['dang_tin_thanh_cong']);

            } else {
                ACTION_db($data, "#_baiviet", 'update', NULL, "`id` = '$id' AND `id_user` = '" . $_SESSION['id'] . "' ");
                THEM_seoname($id, $seo_name, "#_baiviet", $step, "1");
                $return = array("err" => 0, "ms" => $glo_lang['cap_nhat_tin_thanh_cong']);

            }
        } else {
            exit();
        }
    } else {
        $return = array("err" => 1, "ms" => $glo_lang['nhap_ma_bao_ve_chua_dung']);
    }
    echo json_encode($return);
    exit();
}
if (!empty($_POST) && $motty == "get_gia_sptinhang") {
    $list_tn = isset($_POST['list_tn']) ? $_POST['list_tn'] : "";
    $js_idbv = isset($_POST['js_idbv']) ? $_POST['js_idbv'] : "";
    $baiviet = DB_fet("*", "`#_baiviet`", "`id` = '" . $js_idbv . "' ", "", 1, "arr");

    $list_tn = trim($list_tn);
    $list_tn = explode(",", $list_tn);
    sort($list_tn);
    $list_tn = implode(",", $list_tn);

    $gia_tien = $baiviet[0]['giatien'];
    if ($list_tn != "") {
        $bvtinhnang = DB_fet("*", "`#_baiviet_thuoctinh`", "`id_sp` = '" . $js_idbv . "' AND `phien_ban` = '" . trim($list_tn) . "' ", "", "", "arr");
        if (count($bvtinhnang)) {
            $gia_tien = $bvtinhnang[0]['gia'];
        }
    }

    if ($gia_tien == 0) echo $glo_lang['gia_lienhe'];
    else {
        echo number_format($gia_tien) . ' <span class="dvt">' . $glo_lang['dvt'] . '</span>';
        // echo $glo_lang['gia_ban'].': '.number_format($gia_tien).' <span class="dvt">'.$glo_lang['dvt'].'</span>';
    }
    exit();
}
//sp da xem
if (!empty($slug_table) && $slug_table == "baiviet" && !empty($thongtin_step) && $thongtin_step['id'] == 2) {
    if (empty($_COOKIE['viewed_products'])) {
        setcookie("viewed_products", $arr_running['id'], time() + (365 * 24 * 60 * 60), "/");
    } else {
        $list_arr = $arr_running['id'] . ',' . $_COOKIE['viewed_products'];
        $list_arr = explode(",", $list_arr);
        //bo id trung
        $list_arr = array_unique($list_arr);
        //xoa pt cuoi mang 
        if (count($list_arr) > 30) {
            array_pop($list_arr);
        }
        setcookie("viewed_products", implode(',', $list_arr), time() + (365 * 24 * 60 * 60), "/");
    }
}

//
if (!empty($_POST) && $motty == "ajax_timkiem") {
    include _source . "phantrang_kietxuat_ajax.php";
    exit();
}

if (!empty($_POST) && $motty == "load_mausac") {
    $dt = isset($_POST['dt']) ? $_POST['dt'] : 0;
    $idbv = isset($_POST['idbv']) ? $_POST['idbv'] : 0;

    $tinhnang_arr = LAY_bv_tinhnang(2);
    $mausac = DB_fet("*", "`#_baiviet_select_tinhnang`", "`id_baiviet` = '" . $idbv . "' AND `id_tinhnang` = '$dt'", "`id` ASC", '', "arr");
    foreach ($mausac as $rows) {
        echo '<ul>
              <p>' . $tinhnang_arr[$rows['id_tinhnang_2']]['tenbaiviet_' . $lang] . '</p>
              <h2>' . ($rows['gia'] != 0 ? number_format($rows['gia']) . ' ' . $glo_lang['dvt'] : $gia['text_gia']) . '</h2>
              <h2>' . $rows['mota_' . $lang] . '</h2>
              <li>
                <div class="mobileqty">
                  <input type="button" value="-" onclick="add_num_sp(\'#soluong_' . $rows['id'] . '\',-1)" />
                  <input type="text" name="quantity_' . $dt . '_' . $rows['id'] . '" value="0" class="qty" id="soluong_' . $rows['id'] . '"/>
                  <input type="button" value="+" onclick="add_num_sp(\'#soluong_' . $rows['id'] . '\',+1)" />
                </div>
              </li>
              <div class="clr"></div>
            </ul>';
    }
    exit();
}

if (!empty($_POST) && $motty == "yeu_thich") {
    $idbv = isset($_POST['idbv']) ? $_POST['idbv'] : 0;
    if ($idbv == 0) exit();
    if (empty($_SESSION['id'])) {
        echo 2;
        exit();
    }

    $data = array();
    $data['id_baiviet'] = $idbv;
    $data['id_member'] = $_SESSION['id'];
    $check = DB_que("SELECT `showhi` FROM `#_yeuthich` WHERE `id_baiviet` = '$idbv' AND `id_member` = '" . $_SESSION['id'] . "' LIMIT 1");
    if (DB_num($check)) {
        $check = DB_arr($check, 1);
        $data['showhi'] = $check['showhi'] == 1 ? 0 : 1;
        ACTION_db($data, "#_yeuthich", "update", NULL, "`id_baiviet` = '$idbv' AND `id_member` = '" . $_SESSION['id'] . "'");
        echo $check['showhi'] == 1 ? 0 : 1;
    } else {
        $data['showhi'] = 1;
        ACTION_db($data, "#_yeuthich", "add", NULL, NULL);
        echo 1;
    }
    DEL_redis_table_page("#_baiviet");
    exit();
}
if (!empty($_POST) && $motty == "ajax_timkiem") {
    include _source . "phantrang_kietxuat_ajax.php";
    exit();
}
if (!empty($_POST) && $motty == "check_phi_ship") {
    $n_tinhthanh_new2 = isset($_POST['n_tinhthanh_new2']) ? $_POST['n_tinhthanh_new2'] : 0;
    $id_quanhuyen_new = isset($_POST['id_quanhuyen_new']) ? $_POST['id_quanhuyen_new'] : 0;

    $check_phiship = DB_que("SELECT * FROM `#_ship_vanchuyen_khac` WHERE `id_kv` = '$n_tinhthanh_new2' LIMIT 1");
    if (!DB_num($check_phiship)) {
        $check_phiship = DB_que("SELECT * FROM `#_ship_vanchuyen_khac` WHERE `id_kv` = '0' LIMIT 1");
    }
    $check_phiship = DB_arr($check_phiship, 1);
    $gia_dieu_chinh = json_decode($check_phiship['gia_dieu_chinh'], true);


    $du_kien = $check_phiship['du_kien'];
    $phi_van_chuyen = $check_phiship['phi_van_chuyen'] + $gia_dieu_chinh[$id_quanhuyen_new];
    $tenbaiviet_vi = $check_phiship['tenbaiviet_' . $lang];

    $l_dk = "";
    $l_dk_n = "";
    if ($du_kien != "") {
        $du_kien = explode(",", $du_kien);
        foreach ($du_kien as $val) {
            $day = time() + (int)($val) * 3600;
            $l_dk .= $l_dk == "" ? CONVER_thu(date("l", $day), $glo_lang) : ' - ' . CONVER_thu(date("l", $day), $glo_lang);
            $l_dk_n .= $l_dk_n == "" ? date('d/m/Y', $day) : ' - ' . date('d/m/Y', $day);
        }
    }
    $phi_van_chuyen = $phi_van_chuyen != 0 ? NUMBER_fomat($phi_van_chuyen) . ' ' . $glo_lang['dvt'] : $glo_lang['mien_phi'];
    $khuvuc = LAY_khuvuc();

    $_SESSION['nhom_1_pvc'] = $glo_lang['giao_hang_toi'] . ' ' . $khuvuc[$id_quanhuyen_new]['tenbaiviet_' . $lang] . ', ' . $khuvuc[$n_tinhthanh_new2]['tenbaiviet_' . $lang] . ' - <a class="cur" onclick="LOAD_popup_new(\'' . $full_url . '/pa-size-child/check_phi_ship/\', \'450px\')">' . $glo_lang['chon_dia_chi_khac'] . '</a>';
    $_SESSION['nhom_2_pvc'] = $tenbaiviet_vi . ". " . $glo_lang['du_kien_giao'] . ': ' . $l_dk . ', ' . $l_dk_n . ' - ' . $phi_van_chuyen;

    $arr = array("ght" => $glo_lang['giao_hang_toi'] . ' ' . $khuvuc[$id_quanhuyen_new]['tenbaiviet_' . $lang] . ', ' . $khuvuc[$n_tinhthanh_new2]['tenbaiviet_' . $lang] . ' - <a class="cur" onclick="LOAD_popup_new(\'' . $full_url . '/pa-size-child/check_phi_ship/\', \'450px\')">' . $glo_lang['chon_dia_chi_khac'] . '</a>', 'dk' => $tenbaiviet_vi . ". " . $glo_lang['du_kien_giao'] . ': ' . $l_dk . ', ' . $l_dk_n . ' - ' . $phi_van_chuyen);
    echo json_encode($arr);
    // 
    exit();
}
//
//
if (isset($_POST) && $motty == 'load_map_goole') {
    $array = array(
        'address' => str_replace(",", "+", $_POST['address']),
        'key' => 'AIzaSyCk0kCNLUaWagmDHLai2it9_9YaCVHuriQ'
    );
    $url = "https://maps.googleapis.com/maps/api/geocode/json?" . http_build_query($array);
    $check = file_get_contents($url);
    $check = json_decode($check, true);
    $lat = !empty($check['results'][0]['geometry']['location']['lat']) ? $check['results'][0]['geometry']['location']['lat'] : "";
    $lng = !empty($check['results'][0]['geometry']['location']['lng']) ? $check['results'][0]['geometry']['location']['lng'] : "";
    if ($lat != "" && $lng != "") {
        $arrr = array('lat' => $lat, 'lng' => $lng, 'address' => $_POST['address']);
        echo json_encode($arrr);
    }
    exit();
}
//check makh new
if (!empty($_POST) && $motty == "check_mkm") {
    $ma_khuyen_mai = $_POST['cls_makm'];
    $tongtien = $_POST['tt'];
    $tiengoc = $_POST['tg'];

    $return_kq = CHECK_ma_km_new($ma_khuyen_mai, $glo_lang, $tongtien);
    if ($return_kq['err'] == 1) {
        echo json_encode($return_kq);
    } else {
        $_SESSION['ma_giam_gia']['ma'] = $ma_khuyen_mai;
        $_SESSION['ma_giam_gia']['loai'] = $return_kq['vnd'];
        $_SESSION['ma_giam_gia']['val'] = $return_kq['val'];

        $giatien = $return_kq['vnd'] == 0 ? $tiengoc * $return_kq['val'] / 100 : $return_kq['val'];
        $giam = $return_kq['vnd'] == 0 ? $return_kq['val'] . "%" : number_format($return_kq['val']) . " " . $glo_lang['dvt'];

        $return = array();
        $return['err'] = $return_kq['err'];
        $return['text'] = $return_kq['text'] . " (-" . number_format($giatien) . " " . $glo_lang['dvt'] . ")";
        $return['giatien'] = number_format($tongtien - $giatien) . " " . $glo_lang['dvt'] . " (-" . $giam . ")";
        // print_r($return);
        echo json_encode($return);
    }
    exit();
}
//end
//check ma seri
if ($motty == 'check-ma-seri' && isset($_POST)) {

    if (empty($_POST['mabaove']) || strtolower($_POST['mabaove']) != strtolower($_SESSION['captcha']['code'])) {
        $messenge['error'] = 10;
        echo json_encode($messenge);
        exit();
    }

    if (isset($_POST['ma_seri'])) {
        $ma_seri = addslashes($_POST['ma_seri']);

        //Kiểm tra tên đăng nhập có tồn tại không
        $query = DB_que("SELECT `id`,`matkhau`,`keypass`, `hoten`, `email` FROM `#_members` WHERE `showhi` = 1 AND `ma_kich_hoat`='" . addslashes($ma_seri) . "' AND `phanquyen` = 0 LIMIT 1");
        if (DB_num($query) == 0) {
            $messenge['error'] = 1;
            echo json_encode($messenge);
            exit();
        }
        DB_que("UPDATE  `#_members` SET `ma_kich_hoat` = '' WHERE `ma_kich_hoat`='" . addslashes($ma_seri) . "' AND `phanquyen` = 0 LIMIT 1");
        //Lấy mật khẩu trong database ra
        $row = DB_arr($query, 1);

        //Lưu tên đăng nhập
        $_SESSION['id'] = $row['id'];
        $messenge['error'] = 0;
        echo json_encode($messenge);
        exit();
    }
    $messenge['error'] = 1;
    echo json_encode($messenge);
    exit();
}
//

//gui don hang nwe
if (isset($_POST['action_ajax']) && $_POST['action_ajax'] == 'captcha') {
    echo $_SESSION['cap'] = RAND(11111, 99999);
    exit();
}
if (!empty($_POST)) {
    //add sao
    if ($motty == "add-sao") {
        $idsp = isset($_POST['idsp']) && is_numeric($_POST['idsp']) ? $_POST['idsp'] : 0;
        $sao = isset($_POST['sao']) && is_numeric($_POST['sao']) ? $_POST['sao'] : 0;
        if ($idsp != 0 && $sao != 0 && empty($_SESSION['sao'][$idsp])) {


            DB_que("UPDATE `#_baiviet` SET  `num_1` = `num_1` + $sao, `num_2` = `num_2` + 1 WHERE `id` = '$idsp' LIMIT 1");
            $_SESSION['sao'][$idsp] = 1;
            $check_sao = DB_que("SELECT * FROM `#_baiviet_sao` WHERE `id_baiviet` = '$idsp' LIMIT 1");


            if (!DB_num($check_sao)) {
                DB_que("INSERT INTO `#_baiviet_sao` (`id_baiviet`, `sao_" . $sao . "`) VALUES ('$idsp', 1)");
            } else {
                DB_que("UPDATE `#_baiviet_sao` SET  `sao_" . $sao . "` = `sao_" . $sao . "` + 1  WHERE `id_baiviet` = '$idsp' LIMIT 1");
            }
        }
        echo $glo_lang['cam_on_danh_gia'];
        DEL_redis_table_page("#_baiviet");
        exit();
    }
    //end add sao
}
//check buy new
if (!empty($_POST) && $motty == "check_buy_new_form") {
    $tongtien = GET_price_weight($_SESSION['cart']);
    $phi_ship = is_numeric($_POST['phiship_client']) ? $_POST['phiship_client'] : 0;
    $ma_khuyen_mai = $_POST['ma_khuyen_mai'];

    $return_kq = CHECK_thanhtien($ma_khuyen_mai, $glo_lang, $tongtien, $phi_ship, $_SESSION['cart']);
    $array_return = array(
        'gia_km' => $return_kq['gia_km'],
        'gia_km_err' => $return_kq['gia_km_err'],
        'gia_km_num' => $return_kq['gia_km_num'],
        'gia_kmtext' => $return_kq['gia_kmtext'],
        'js_tamtinh' => NUMBER_fomat($return_kq['tam_tinh']) . " " . $glo_lang['dvt'],
        'phiship' => NUMBER_fomat($phi_ship) . " " . $glo_lang['dvt'],
        'tongtien' => NUMBER_fomat($return_kq['thanh_tien']) . " " . $glo_lang['dvt'],
        'num_tongtien' => $return_kq['thanh_tien']
    );
    echo json_encode($array_return);
    exit();
}
// load phi ship
if (!empty($_POST) && $motty == "load_phi_ship") {
    // if(!empty($_POST) && $motty == "load_phi_ship"){
    $n_tinhthanh_new2 = $_POST['n_tinhthanh'];
    $id_quanhuyen_new = $_POST['id_quanhuyen'];
    // $total          = GET_price_weight($_SESSION['cart']);

    //ton tien

    $array = load_phivanchuyen($_SESSION['cart'], $n_tinhthanh_new2, $id_quanhuyen_new, $glo_lang);
    echo json_encode($array);
    // $return        = SHIP_return($n_tinhthanh, $id_quanhuyen, $total);
    // echo Table_ship($return, $glo_lang);
    exit();
}
//
////load tinh thanh
if (!empty($_POST) && $motty == "load-tinh-thanh") {
    $id = $_POST['id'];
    $name = $_POST['name'];

    echo '<option value="">' . $name . '</option>';
    echo '<option value="0">' . $glo_lang['tat_ca_quan_huyen'] . '</option>';


    $diadiem = DB_fet_rd("*", "`#_ship_khuvuc`", "", "`catasort` ASC, `id` DESC");
    foreach ($diadiem as $val_1) {
        if ($val_1['id_parent'] != $id) continue;
        echo '<option value="' . $val_1['id'] . '">' . $val_1['tenbaiviet_' . $lang] . '</option>';
    }
    exit();
}
//dat hang nnhanh
if (isset($_POST['action']) && $_POST['action'] == "dat_hang_nhanh") {
    $add = 0;
    if ($_POST['load'] == 1) {
        $ma_sp = $_POST['ma_sp'];
        $so_luong = $_POST['so_luong'];
        $c_msp = count($ma_sp);
        for ($i = 0; $i < $c_msp; $i++) {
            if ($ma_sp[$i] != '') {
                $sl = is_numeric(trim($so_luong[$i])) ? trim($so_luong[$i]) : 1;
                $check = DB_que("SELECT `id` FROM `#_baiviet` WHERE `step` = 2 AND `p1` = '" . $ma_sp[$i] . "' LIMIT 1");
                if (!DB_num($check)) continue;
                $check = DB_arr($check, 1);
                $check = $check["id"];
                $_SESSION['cart'][$check] = $sl;
                $add++;

            }
        }
    } else if ($_POST['load'] == 2) {
        $nd_dathangnhanh = $_POST['nd_dathangnhanh'];
        $nd_dathangnhanh = explode("\n", $nd_dathangnhanh);
        foreach ($nd_dathangnhanh as $value) {
            if ($value == "") continue;
            $val = explode(",", $value);
            if ($val[0] == "") continue;
            $check = DB_que("SELECT `id` FROM `#_baiviet` WHERE `step` = 2 AND `p1` = '" . $val[0] . "' LIMIT 1");
            if (!DB_num($check)) continue;
            $check = DB_arr($check, 1);
            $check = $check["id"];
            $sl = is_numeric(trim($val[1])) ? trim($val[1]) : 1;
            $_SESSION['cart'][$check] = $sl;
            $add++;
        }
    }
    echo $add;
    exit();
}

//check masp
if (!empty($_POST) && $motty == "check-masp") {
    $masp = $_POST['masp'];
    $check = DB_que("SELECT `id` FROM `#_baiviet` WHERE `step` = 2 AND `p1` = '$masp' LIMIT 1");
    echo DB_num($check);
    exit();
}
//
//gui binh luan
if ($motty == "gui-binh-luan" && !empty($_POST)) {
    if (!empty($_POST['id_token']) && $_POST['id_token'] == $_SESSION['token']) {

        $data = array();
        $data['tenbaiviet_vi'] = LOC_char($_POST['bl_tieude']);
        $data['noidung_vi'] = LOC_char($_POST['bl_noidung']);
        $data['id_sp'] = LOC_char($_POST['id_sp']);
        $data['id_parent'] = LOC_char($_POST['id_parent']);
        $data['ip_gui'] = GET_ip();
        $data['ngay_dang'] = time();

        $data['showhi'] = 0;
        ACTION_db($data, '#_binhluan', 'add', NULL, NULL);


        $_SESSION['token'] = md5(RANDOM_chuoi(5));
        $return = array("err" => 1, "token" => $_SESSION['token']);
        echo json_encode($return);


    } else {
        $_SESSION['token'] = md5(RANDOM_chuoi(5));
        $return = array("err" => 2, "token" => $_SESSION['token']);
        echo json_encode($return);
    }
    exit();
}
//end gui binh luan
if ($motty == "add-sao" && !empty($_POST)) {
    $id = $_POST['id'];
    $sao = $_POST['sao'];
    // unset($_SESSION['sao'][$id]);
    if (!empty($_SESSION['sao'][$id])) {
        echo $glo_lang['ban_da_binh_chon_cho_san_pham_nay'];
        exit();
    }
    $_SESSION['sao'][$id] = $id;
    DB_que("UPDATE `#_baiviet` SET `sao_" . $sao . "` = `sao_" . $sao . "` + 1, `num_1` = `num_1` + $sao, `num_2` = `num_2` + 1 WHERE `id` = '$id'");
    echo $glo_lang['cam_on_ban_da_binh_chon_cho_san_pham_nay'];
    exit();
}
if (isset($_POST['action_s']) && $_POST['action_s'] == "get_diadiem") {
    $id = $_POST['id'];
    $text = $_POST['text'];
    echo '<option value="">' . $text . '</option>';
    $diadiem = LAY_diadiem();
    foreach ($diadiem as $val_1) {
        if ($val_1['id_parent'] != $id) continue;
        echo '<option value="' . $val_1['id'] . '">' . $val_1['tenbaiviet_' . $lang] . '</option>';
    }
    exit();
}
if ($motty == "send_form" && isset($_POST['send_lienhe'])) {
    if ((!empty($_POST['mabaove']) && strtolower($_POST['mabaove']) == strtolower($_SESSION['captcha']['code'])) || (!empty($_POST['id_token']) && $_POST['id_token'] == $_SESSION['token']) || (!empty($_POST['capcha_hd']) && $_POST['capcha_hd'] == $_SESSION['cap'])) {

        $admin_email = LAY_email(1);
        $htmlbox = file_get_contents("myadmin/htmlbox/1m.html");
        $logo = $fullpath . "/" . $thongtin['duongdantin'] . "/" . $thongtin['icon'];
        $thongtinheader = $thongtin['tenbaiviet_' . $lang];
        $footer = "<p><b>" . $thongtin['tenbaiviet_' . $lang] . "</b></p>";
        $footer .= $thongtin['sodienthoai_vi'] != "" ? "<p>" . $glo_lang['so_dien_thoai'] . ": " . $thongtin['sodienthoai_vi'] . "</p>" : "";
        $footer .= $thongtin['email_vi'] != "" ? "<p>" . $glo_lang['email'] . ": " . $thongtin['email_vi'] . "</p>" : "";
        $footer .= $thongtin['diachi_' . $lang] != "" ? "<p>" . $glo_lang['dia_chi'] . ": " . $thongtin['diachi_' . $lang] . "</p>" : "";

        $file = UPLOAD_file("inputfile", "./datafiles/post/", time());
        if (!empty($file)) {
            $file_1 = $file;
        }
        $file = UPLOAD_file("inputfile_1", "./datafiles/post/", time());
        if (!empty($file)) {
            $file_2 = $file;
        }


        $s_fullname = isset($_POST['s_fullname']) ? $_POST['s_fullname'] : "";
        $s_fullname_s = isset($_POST['s_fullname_s']) ? $_POST['s_fullname_s'] : "";

        $s_dienthoai = isset($_POST['s_dienthoai']) ? $_POST['s_dienthoai'] : "";
        $s_dienthoai_s = isset($_POST['s_dienthoai_s']) ? $_POST['s_dienthoai_s'] : "";

        $s_email = isset($_POST['s_email']) ? $_POST['s_email'] : "";
        $s_email_s = isset($_POST['s_email_s']) ? $_POST['s_email_s'] : "";

        $s_address = isset($_POST['s_address']) ? $_POST['s_address'] : "";
        $s_address_s = isset($_POST['s_address_s']) ? $_POST['s_address_s'] : "";

        $s_title = isset($_POST['s_title']) ? $_POST['s_title'] : "";
        $s_title_s = isset($_POST['s_title_s']) ? $_POST['s_title_s'] : "";

        $s_message = isset($_POST['s_message']) ? $_POST['s_message'] : "";
        $s_message_s = isset($_POST['s_message_s']) ? $_POST['s_message_s'] : "";


        $tieude_lienhe = isset($_POST['tieude_lienhe']) ? $_POST['tieude_lienhe'] : "";

        $noidung = "";
        $noidung .= RETURN_title_lienhe($tieude_lienhe);
        $noidung .= RETURN_text_lienhe($s_fullname_s, $s_fullname);
        $noidung .= RETURN_text_lienhe($s_dienthoai_s, $s_dienthoai);
        $noidung .= RETURN_text_lienhe($s_email_s, $s_email);
        $noidung .= RETURN_text_lienhe($s_address_s, $s_address);
        $noidung .= RETURN_text_lienhe($s_title_s, $s_title);
        $noidung .= RETURN_text_lienhe($s_message_s, $s_message);

        if (!empty($file_1) || !empty($file_2)) {
            $link = "";
            if (!empty($file_1)) {
                $link .= '<a href="../datafiles/post/' . $file_1 . '" download>[' . $file_1 . ']</a> ';
            }
            if (!empty($file_2)) {
                $link .= '<a href="../datafiles/post/' . $file_2 . '" download>[' . $file_2 . ']</a> ';
            }

            $noidung .= RETURN_text_lienhe(base64_encode("Đính kèm"), $link);
        }

        $array_json = array();
        $array_json[] = array('k' => 'title', 'v' => $tieude_lienhe);
        if ($s_fullname != "")
            $array_json[] = array('k' => $s_fullname_s, 'v' => $s_fullname);
        if ($s_dienthoai != "")
            $array_json[] = array('k' => $s_dienthoai_s, 'v' => $s_dienthoai);
        if ($s_email != "")
            $array_json[] = array('k' => $s_email_s, 'v' => $s_email);
        if ($s_address != "")
            $array_json[] = array('k' => $s_address_s, 'v' => $s_address);
        if ($s_title != "")
            $array_json[] = array('k' => $s_title_s, 'v' => $s_title);
        if ($s_message != "")
            $array_json[] = array('k' => $s_message_s, 'v' => $s_message);

        for ($i = 1; $i < 50; $i++) {
            if (isset($_POST['group_form_send_' . $i])) {
                $noidung .= RETURN_text_lienhe($_POST['group_form_send_' . $i . '_s'], $_POST['group_form_send_' . $i]);
                if ($_POST['group_form_send_' . $i] != "")
                    $array_json[] = array('k' => $_POST['group_form_send_' . $i . '_s'], 'v' => $_POST['group_form_send_' . $i]);
            }
        }

        $message = str_replace(array("%footer%", '%logo%', '%thongtinheader%', '%noidung%'),
            array($footer, LOC_char($logo), $thongtinheader, $noidung), $htmlbox);

        $data = array();
        $data['tenbaiviet_vi'] = LOC_char(base64_decode($tieude_lienhe));
        $data['ip_gui'] = GET_ip();
        $data['ngay_dang'] = time();
        $data['noi_dung_vn'] = addslashes($message);
        $data['nd_json'] = serialize($array_json);
        $data['loai'] = isset($_POST['loai']) && is_numeric($_POST['loai']) ? $_POST['loai'] : 0;
        $data['id_bv'] = isset($_POST['idbv']) && is_numeric($_POST['idbv']) ? $_POST['idbv'] : 0;

        if (!empty($file_1)) {
            $data['file_1'] = $file_1;
        }
        if (!empty($file_2)) {
            $data['file_2'] = $file_2;
        }

        $data['showhi'] = 0;
        ACTION_db($data, '#_form_lienhe', 'add', NULL, NULL);

        $tieude_lienhe = "=?utf-8?B?".$tieude_lienhe."?=";
        ob_start();
        GUI_email("$admin_email", "", $tieude_lienhe, $_SERVER['SERVER_NAME'], $message, $thongtin);
        ob_end_clean();

        // send mai dowload
        if (isset($_POST['dowload_file'])) {
            $noidung = LAYTEXT_rieng(54);
            ob_start();
            GUI_email($_POST['s_email'], "", $noidung['tenbaiviet_' . $lang] . " " . $_POST['s_email'], $_SERVER['SERVER_NAME'], $noidung['noidung_' . $lang], $thongtin);
            ob_end_clean();
        }
        //

        if (!empty($_POST['id_token'])) {
            $_SESSION['token'] = md5(RANDOM_chuoi(5));
            $return = array("err" => 1, "token" => $_SESSION['token']);
            echo json_encode($return);
        } else {
            echo 1;
        }
    } else {
        if (!empty($_POST['id_token'])) {
            $_SESSION['token'] = md5(RANDOM_chuoi(5));
            $return = array("err" => 2, "token" => $_SESSION['token']);
            echo json_encode($return);
        } else echo 2;
    }
    exit();
}

if ($motty == "check_donhang" && isset($_POST)) {
    $list = isset($_POST['list']) ? $_POST['list'] : "";
    $list_ar = explode("|", $list);
    $madh = @$list_ar[0];
    $email = @$list_ar[1];

    $wh = "AND (`madh`= '$madh' OR `sodienthoai`= '$email' OR `email`= '$email')";
    include _source . "kiem-tra-don-hang-list.php";
    exit();
}
if ($motty == "send_form" && isset($_POST['gui_donhang'])) {

    global $thongtin;

    if (isset($_SESSION['cart']) && $_SESSION['cart'] != NULL) {
        $list_id_sp = "";
        $so_luong = "";
        $don_gia = "";
        $is_key = "";
        $don_vi = "";

        $thongtin_dathang = "<div id='cart_list' class='tb_rps'><table border='1'  cellspacing='0' cellpadding='4' style='width:100%; border-collapse: collapse; font-family:Tahoma; font-size:11px;text-align: center;' bordercolor='#cccccc' class='tb-chitietdh-tv'>";
        $thongtin_dathang .= '<tr> <th width="5%" class="cls_cart_mb">STT</th> <th>' . $glo_lang['cart_ten_sp'] . '</th> <th width="15%">' . $glo_lang['cart_qty'] . '</th> <th width="15%">' . $glo_lang['cart_dongia'] . '</th> <th width="10%">' . $glo_lang['cart_thanhtien'] . '</th> </tr>';

        $phi_ship = 0;

        if (isset($_POST['n_tinhthanh']) && $_POST['n_tinhthanh'] != 0 && isset($_POST['n_quanhuyen']) && $_POST['n_quanhuyen'] != 0) {
            $phi_ship = load_phivanchuyen($_SESSION['cart'], @$_POST['n_tinhthanh'], $_POST['n_quanhuyen'], $glo_lang);
            $phi_ship = $phi_ship['phivc_num'];
        }

        $tongtien = 0;
        $stt = 0;
        // $tinhnang_arr  = LAY_bv_tinhnang(LAY_id_step(2));
        // $tinhnang_arr  = LAY_bv_tinhnang(2);
        if ($thongtin['is_giamuti'] == 1) $tinhnang_arr = LAY_bv_gia(2);
        else $tinhnang_arr = LAY_bv_tinhnang(2);
        foreach ($_SESSION['cart'] as $key => $value) {

            // $id_sp     = $key;
            $id_sp = explode("_", $key);
            $id_sp = $id_sp[0];

            $sanpham = DB_que("SELECT * FROM `#_baiviet` WHERE `showhi` = 1 AND `id` = '" . $id_sp . "' LIMIT 1");
            if (DB_num($sanpham) > 0) {
                $sanpham = DB_arr($sanpham, 1);
                $dongia = check_gia_sql($id_sp, @$_SESSION['tinhnang'][$key], $sanpham['giatien']);
                //
                // $thuoctinh  = thuoctinh_lang($sanpham, $lang);
                //
                $is_key .= @$_SESSION['tinhnang'][$key] . "|";
                $don_vi .= @$_SESSION['n_donvi'][$id_sp] . "|";

                $list_id_sp .= $id_sp . ",";
                $so_luong .= $value . ",";
                $don_gia .= $dongia . ",";
                $thanhtien = $value * $dongia;
                $tongtien += $thanhtien;
                $stt++;
                // $tinhnang_arr  = @DB_fet("*","#_baiviet_tinhnang","`id` IN (".@$_SESSION['tinhnang'][$id_sp].")","`catasort` DESC","","arr");
                //
                // anh sp
                $anhsp = checkImage($fullpath, $sanpham['icon'], $sanpham['duongdantin'], 'thumb_');
                $check_sl_tinhnang = DB_fet_rd("* ", " `#_baiviet_select_tinhnang` ", "`id_baiviet` = '" . $id_sp . "'", "", "", "id_val");

                $isthuoctinh = @explode(",", $_SESSION['tinhnang'][$key]);
                if (is_array($isthuoctinh)) {
                    foreach ($isthuoctinh as $ittinh) {
                        if (@$check_sl_tinhnang[$ittinh]['icon'] == "") continue;
                        $anhsp = checkImage($fullpath, $check_sl_tinhnang[$ittinh]['icon'], $check_sl_tinhnang[$ittinh]['duongdantin']);
                        break;
                    }
                }
                //
                $thongtin_dathang .= '<tr>
                <td class="cls_cart_mb">' . $stt . '</td>
                <td title="' . $glo_lang['cart_ten_sp'] . '" class="dv-anh-cart-sp">
                  <a href="' . GET_link($full_url, SHOW_text($sanpham['seo_name'])) . '"><img src="' . $anhsp . '" style="max-height: 100px"/></a>
                  <div class="dv-anh">
                  <a href="' . $full_url . "/" . $sanpham['seo_name'] . '">' . $sanpham['tenbaiviet_' . $_SESSION['lang']] . '</a>
                  <p class="p_mota_cart">';

                $isthuoctinh = @explode(",", $_SESSION['tinhnang'][$key]);
                if (is_array($isthuoctinh)) {
                    foreach ($isthuoctinh as $ittinh) {
                        if (@$tinhnang_arr[$ittinh]['tenbaiviet_' . $lang] == "") continue;
                        $thongtin_dathang .= '<span>' . $tinhnang_arr[$ittinh]['tenbaiviet_' . $lang] . '</span>';
                    }
                }

                $thongtin_dathang .= '</p>
                  </div>
                </td>
                <td title="' . $glo_lang['cart_qty'] . '">' . $value . '</td>
                <td title="' . $glo_lang['cart_dongia'] . '">' . NUMBER_fomat($dongia) . '</td>
                <td title="' . $glo_lang['cart_thanhtien'] . '">' . NUMBER_fomat($thanhtien) . '</td>
              </tr>';
            }
        }

        //
        //gia km
        $ma_giam_gia = isset($_POST['ma_khuyen_mai']) ? $_POST['ma_khuyen_mai'] : "";
        $gia_km = 0;
        if ($ma_giam_gia != "") {
            $return_kq = CHECK_thanhtien($ma_giam_gia, $glo_lang, $tongtien, $phi_ship, $_SESSION['cart']);
            $gia_km = $return_kq['gia_km_num'];
        }
        if ($phi_ship != 0 || $gia_km != 0) {
            $thongtin_dathang .= '<tr> <td colspan="4" style="text-align:right;font-weight:bold;">' . $glo_lang['tam_tinh'] . ':</td> <td colspan="2" ><span id="pro_sum"> <label style="color:red;font-weight:bold;">' . NUMBER_fomat($tongtien) . ' ' . $glo_lang['dvt'] . '</label> </span> </td> </tr>';
            if ($phi_ship != 0) {
                $thongtin_dathang .= '<tr> <td colspan="4" style="text-align:right;font-weight:bold;">' . $glo_lang['phi_van_chuyen'] . ':</td> <td colspan="2" ><span id="pro_sum"> <label style="color:red;font-weight:bold;">' . NUMBER_fomat($phi_ship) . ' ' . $glo_lang['dvt'] . '</label> </span> </td> </tr>';
            }
            if ($gia_km != 0) {
                $thongtin_dathang .= '<tr> <td colspan="4" style="text-align:right;font-weight:bold;">' . $glo_lang['khuyen_mai'] . ':</td> <td colspan="2" ><span id="pro_sum"> <label style="color:red;font-weight:bold;">' . NUMBER_fomat($gia_km) . ' ' . $glo_lang['dvt'] . '</label> </span> </td> </tr>';
            }
        }
        //
        //
        $thongtin_dathang .= '<tr> <td colspan="4" style="text-align:right;color:red;font-weight:bold;">' . $glo_lang['cart_tong_tien'] . ':</td> <td colspan="2" title="' . $glo_lang['cart_tong_tien'] . '"><span id="pro_sum"> <label style="color:red;font-weight:bold;">' . NUMBER_fomat($tongtien + $phi_ship - $gia_km) . ' ' . $glo_lang['dvt'] . '</label> </span> </td> </tr>';
        $thongtin_dathang .= "</table></div>";

        $list_id_sp = trim($list_id_sp, ",");
        $so_luong = trim($so_luong, ",");
        $don_gia = trim($don_gia, ",");
        $is_key = trim($is_key, "|");
        $don_vi = trim($don_vi, "|");


        $s_thanhtoan = $_POST['type_payment'];
        // if($s_thanhtoan   == 1) $s_thanhtoannd = $glo_lang['thanh_toan_tien_mat'];
        // else                    $s_thanhtoannd = $glo_lang['thanh_toan_chuyen_khoan'];
        $s_thanhtoannd = "";
        $pthucthanhtoan = DB_fet("*", "#_phuongthucthanhtoan", "`id` = '" . $_POST['type_payment'] . "'", "`catasort` DESC", 1, "arr");
        if (count($pthucthanhtoan)) {
            $s_thanhtoannd = $pthucthanhtoan[0]['tenbaiviet_' . $lang];
        }

        //

        $s_fullname = isset($_POST['s_fullname']) ? $_POST['s_fullname'] : "";
        $s_fullname_s = base64_encode($glo_lang['ho_va_ten']);

        $s_dienthoai = isset($_POST['s_dienthoai']) ? $_POST['s_dienthoai'] : "";
        $s_dienthoai_s = base64_encode($glo_lang['so_dien_thoai']);

        $s_email = isset($_POST['s_email']) ? $_POST['s_email'] : "";
        $s_email_s = base64_encode($glo_lang['email']);

        $s_address = isset($_POST['s_address']) ? $_POST['s_address'] : "";
        $s_address_s = base64_encode($glo_lang['dia_chi']);

        $s_message = isset($_POST['s_message']) ? $_POST['s_message'] : "";
        $s_message_s = base64_encode($glo_lang['noi_dung']);

        //gui mail
        $admin_email = LAY_email(1);
        $htmlbox = file_get_contents("myadmin/htmlbox/1m.html");
        $logo = $fullpath . "/" . $thongtin['duongdantin'] . "/" . $thongtin['icon'];
        $thongtinheader = $thongtin['tenbaiviet_' . $lang];
        $footer = "<p><b>" . $thongtin['tenbaiviet_' . $lang] . "</b></p>";
        $footer .= $thongtin['sodienthoai_vi'] != "" ? "<p>" . $glo_lang['so_dien_thoai'] . ": " . $thongtin['sodienthoai_vi'] . "</p>" : "";
        $footer .= $thongtin['email_vi'] != "" ? "<p>" . $glo_lang['email'] . ": " . $thongtin['email_vi'] . "</p>" : "";
        $footer .= $thongtin['diachi_' . $lang] != "" ? "<p>" . $glo_lang['dia_chi'] . ": " . $thongtin['diachi_' . $lang] . "</p>" : "";


        $tieude_lienhe = $glo_lang['thong_tin_dat_hang'];
        $diachi_text = "";
        $khuvuc = LAY_khuvuc();
        if (isset($_POST['n_tinhthanh']) && $_POST['n_tinhthanh'] != 0) {
            $diachi_text = @$khuvuc[$_POST['n_quanhuyen']]['tenbaiviet_vi'] . ", " . @$khuvuc[$_POST['n_tinhthanh']]['tenbaiviet_vi'];
        }


        $noidung = "<table class='tb-thongtin-tv' border='1' cellspacing='0' cellpadding='4' style='width:100%; border-collapse: collapse; font-family:Tahoma; font-size:11px;text-align: left;' bordercolor='#cccccc'><tr/>";
        $noidung .= RETURN_title_lienhe(base64_encode($glo_lang['thong_tin_nguoi_mua_hang']));

        $noidung .= RETURN_text_lienhe($s_fullname_s, $s_fullname);
        $noidung .= RETURN_text_lienhe($s_dienthoai_s, $s_dienthoai);
        $noidung .= RETURN_text_lienhe($s_email_s, $s_email);
        $noidung .= RETURN_text_lienhe($s_address_s, $s_address);

        if (isset($_POST['is_checkbox'])) {
            $noidung .= RETURN_title_lienhe(base64_encode(@$glo_lang['thong_tin_nguoi_nhan_hang']));
            $noidung .= RETURN_text_lienhe($s_fullname_s, @$_POST['hoten_nhan']);
            $noidung .= RETURN_text_lienhe($s_dienthoai_s, @$_POST['sodienthoai_nhan']);
            $noidung .= RETURN_text_lienhe($s_email_s, @$_POST['email_nhan']);
            $noidung .= RETURN_text_lienhe($s_address_s, @$_POST['diachi_nhan']);
        }
        if ($phi_ship != 0 || $gia_km != 0) {
            if ($phi_ship != 0) {
                $noidung .= RETURN_text_lienhe(base64_encode($glo_lang['phi_van_chuyen']), NUMBER_fomat($phi_ship) . ' ' . $glo_lang['dvt']);
            }
            if ($gia_km != 0) {
                $noidung .= RETURN_text_lienhe(base64_encode($glo_lang['khuyen_mai']), NUMBER_fomat($gia_km) . ' ' . $glo_lang['dvt']);
                $noidung .= RETURN_text_lienhe(base64_encode($glo_lang['ma_khuyen_mai']), $ma_giam_gia);
            }
        }

        // $noidung       .= RETURN_text_lienhe(base64_encode($glo_lang['dia_chi_nhan']), $diachi_text);

        $noidung .= RETURN_text_lienhe($s_message_s, $s_message);
        $noidung .= "</tr></table>";
        $noidung .= '<td colspan="7" >' . $thongtin_dathang . '</td>';

        $data = array();
        $data['iduser'] = !empty($_SESSION['id']) ? $_SESSION['id'] : 0;
        $data['hoten'] = $s_fullname;
        $data['sodienthoai'] = $s_dienthoai;
        $data['email'] = $s_email;
        $data['diachi'] = $s_address;
        $data['ghichu'] = $s_message;
        $data['idsp'] = $list_id_sp;
        $data['soluong'] = $so_luong;
        $data['dongia'] = $don_gia;
        $data['ngaydat'] = time();
        $data['thanhtoan'] = $s_thanhtoan;
        $data['trangthai'] = 1;
        $data['thongtin_thanhtoan'] = addslashes($noidung);
        $data['is_key'] = $is_key;
        $data['don_vi'] = $don_vi;

        if (isset($_POST['is_checkbox'])) {
            $data['is_nhan'] = 1;
            $data['hoten_nhan'] = @$_POST['hoten_nhan'];
            $data['sodienthoai_nhan'] = @$_POST['sodienthoai_nhan'];
            $data['email_nhan'] = @$_POST['email_nhan'];
            $data['diachi_nhan'] = @$_POST['diachi_nhan'];
        }


        // phi_ship

        $data['gia_km'] = is_numeric($gia_km) ? $gia_km : 0;
        $data['ma_giam_gia'] = @$ma_giam_gia;
        $data['phi_ship'] = !empty($phi_ship) ? $phi_ship : 0;
        $data['thanh_pho'] = isset($_POST['n_tinhthanh']) ? $_POST['n_tinhthanh'] : 0;
        $data['quan_huyen'] = isset($_POST['n_quanhuyen']) ? $_POST['n_quanhuyen'] : 0;

        $id_order = ACTION_db($data, "#_order", 'add', NULL, NULL);

        $madh = 'DH' . mt_rand(1000, 9999) . $id_order;
        $data1['madh'] = $madh;
        ACTION_db($data1, "#_order", 'update', NULL, "`id` = $id_order");

        $message = str_replace(array("%thongtin_lienhe%", "%footer%", '%logo%', '%thongtinheader%', '%noidung%'),
            array(LOC_char($tieude_lienhe), $footer, LOC_char($logo), $thongtinheader, $noidung), $htmlbox);


        ob_start();
        GUI_email("$admin_email", "", $tieude_lienhe, $_SERVER['SERVER_NAME'], $message, $thongtin);
        ob_end_clean();
        unset($_SESSION['cart']);
        if ($ma_giam_gia != "") {
            DB_que("UPDATE `#_magiamgia_chitiet` SET `so_lan_su_dung` = `so_lan_su_dung` + 1 WHERE `ma_giam_gia` = '$ma_giam_gia'");
        }
        // echo $message;
        $return = array("err" => 1, "thanhtien" => $tongtien, "id" => $id_order, "token" => $_SESSION['token']);
        echo json_encode($return);
    }

    exit();
}

if ($motty == "robots.txt") {
    header('Content-Type: text/plain');
    echo $thongtin['robots'];
    exit();
}

if ($motty == "pa-size-child" && is_file(_source . "code_site/pa-" . $haity . ".php")) {
    include _source . "code_site/pa-" . $haity . ".php";
    exit();
}

if ($motty == "sitemap.xml") {
    include "sitemap.php";
    exit();
}

if ($motty == "load-capcha") {
    include("myadmin/plugins/captcha/simple-php-captcha.php");
    exit();
}

if ($motty == 'load-products-ajax') {
    include "phan_trang_load_ajax.php";
    exit();
}
if ($motty == 'load-binhluan') {
    include "phantrang_binhluan_ajax.php";
    exit();
}


if ($motty == 'doi-mat-khau' && !empty($_POST)) {

    $table = "#_members";
    $sql = DB_que("SELECT * FROM $table WHERE `showhi` = 1 AND `id` = '" . $_SESSION['id'] . "' AND `phanquyen` = 0 LIMIT 1");
    $row = DB_arr($sql, 1);
    $sql_keypass = SHOW_text($row['keypass']);
    $sql_matkhau = SHOW_text($row['matkhau']);

    $matkhau_old = $_REQUEST['passold_dk'];
    $keypass = RANDOM_chuoi(5);
    $matkhau = create_pass($auto_key_pass . md5($auto_key_pass . $_POST['pass_dk']), $keypass);
    $matkhau_old = create_pass($auto_key_pass . md5($auto_key_pass . $matkhau_old), $sql_keypass);
    if ($matkhau_old == $sql_matkhau) {
        if (trim($_POST['pass_dk']) != '') {
            $data['keypass'] = $keypass;
            $data['matkhau'] = $matkhau;
        }

        ACTION_db($data, "#_members", 'update', NULL, "`id` = '" . $_SESSION['id'] . "' AND `phanquyen` = 0 LIMIT 1");
        echo 1;
    } else echo 2;
    exit();
}
if ($motty == "lay-mat-khau" && !empty($_POST)) {
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $key = isset($_POST['key']) ? $_POST['key'] : '';
    $sql = DB_que("SELECT * FROM `#_members` WHERE `showhi` = 1 AND `email` = '" . $email . "' AND `active` = '" . $key . "' AND `phanquyen` = 0 LIMIT 1");

    $row = DB_arr($sql, 1);
    $sql_keypass = SHOW_text($row['keypass']);
    $keypass = RANDOM_chuoi(5);
    $matkhau = create_pass($auto_key_pass . md5($auto_key_pass . $_POST['pass_dk']), $sql_keypass);

    $ex_key = @explode("O_K", $key);
    if ($_POST['pass_dk'] == "") {
        $messenge['error'] = 1;
        echo json_encode($messenge);
        exit();
    } else {
        $data = array();
        $data['matkhau'] = $matkhau;
        $data['active'] = '';
        ACTION_db($data, "#_members", 'update', NULL, "`email` = '" . $email . "' AND `active`  = '" . $key . "' AND `phanquyen` = 0 LIMIT 1");
        $messenge['error'] = 0;
        echo json_encode($messenge);
        exit();
    }
    exit();
}

if ($motty == 'check-doi-thong-tin') {
    $hoten = $_REQUEST['fullname_dk'];
    $sodienthoai = isset($_REQUEST['phone_dk']) ? $_REQUEST['phone_dk'] : "";
    $diachi = isset($_REQUEST['diachi']) ? $_REQUEST['diachi'] : "";
    $gioitinh = isset($_REQUEST['gioi_tinh']) ? $_REQUEST['gioi_tinh'] : "";

    // $bd_date        = $_REQUEST['bd_date'];
    // $bd_month       = $_REQUEST['bd_month'];
    // $bd_year        = $_REQUEST['bd_year'];
    $ngaysinh = isset($_POST['nam_sinh']) ? $_POST['nam_sinh'] : 0;

    $data = array();
    $data['hoten'] = $hoten;
    $data['sodienthoai'] = $sodienthoai;
    $data['diachi'] = $diachi;
    // $data['gioitinh']       = $gioitinh;
    // $data['ngaysinh']       = $ngaysinh;
    // $data['cmnd']       = isset($_POST['cmnd']) ? $_POST['cmnd'] : 0;

    //upload
    $file = "file_upload";
    $hinhanh = "";
    $folder = "./datafiles/member/";
    $newname = time();

    if (isset($_FILES[$file]) && !$_FILES[$file]['error']) {
        $ext = explode('.', $_FILES[$file]['name']);
        $ext = end($ext);
        $name = basename($_FILES[$file]['name'], '.' . $ext);

        if ($_FILES[$file]['type'] == "image/jpeg" || $_FILES[$file]['type'] == "image/png" || $_FILES[$file]['type'] == "image/gif" || $_FILES[$file]['type'] == "image/x-icon" || $_FILES[$file]['type'] == "image/vnd.microsoft.icon") {
            if ($_FILES[$file]["size"] < 10485760) //10mb
            {
                $_FILES[$file]['name'] = $newname . '_' . CONVERT_vn($name) . '.' . $ext;
                if (!copy($_FILES[$file]["tmp_name"], $folder . $_FILES[$file]['name'])) {
                    if (!move_uploaded_file($_FILES[$file]["tmp_name"], $folder . $_FILES[$file]['name'])) {
                        $messenge['error'] = 30;
                        echo json_encode($messenge);
                        exit();
                    }
                }
                $data['icon'] = $_FILES[$file]['name'];
                //xoa anh cu
                $cauquery = DB_que("SELECT * FROM `#_members` WHERE `id` = '" . $_SESSION['id'] . "' AND `phanquyen` = 0");
                $cauquery = DB_arr($cauquery, 1);
                @unlink($folder . $cauquery['icon']);
                //
            } else {
                $messenge['error'] = 30;
                echo json_encode($messenge);
                exit();
            }
        } else {
            $messenge['error'] = 30;
            echo json_encode($messenge);
            exit();
        }
    }

    ACTION_db($data, "#_members", 'update', NULL, "`id` = '" . $_SESSION['id'] . "' AND `phanquyen` = 0 LIMIT 1");
    exit();
}

if ($motty == 'dang-ky-mail' && !empty($_POST)) {
    $v_email = !empty($_POST['ip_sentmail']) ? $_POST['ip_sentmail'] : "";
    $v_name = !empty($_POST['ip_sentmail_name']) ? $_POST['ip_sentmail_name'] : "";
    $v_phone = !empty($_POST['ip_sentmail_phone']) ? $_POST['ip_sentmail_phone'] : "";
    $capcha_hd = !empty($_POST['capcha_hd']) ? $_POST['capcha_hd'] : "";

    if (isset($_SESSION['cap']) && $_SESSION['cap'] == $capcha_hd) {
        $_SESSION['cap'] = RAND(11111, 99999);
        if (!filter_var($v_email, FILTER_VALIDATE_EMAIL) === false) {
            $check_query = DB_que("SELECT `id` FROM `#_email_follow` WHERE `email` = '" . $v_email . "' LIMIT 1");
            if (DB_num($check_query) == 0) {
                $data = array();
                $data['email'] = LOC_char($v_email);
                $data['v_name'] = LOC_char($v_name);
                $data['v_phone'] = LOC_char($v_phone);
                $data['ddate'] = time();
                $data['showhi'] = 1;
                //$data['nstatus']  = 1;
                //upload
                $hinhanh = UPLOAD_file("inputfile", "./datafiles/post/", time());
                if (!empty($hinhanh)) {
                    $data['icon'] = $hinhanh;
                }

                $check_send = ACTION_db($data, '#_email_follow', 'add', NULL);
                $thongbao = $glo_lang['them_dia_chi_email_thanh_cong'];
            } else $thongbao = $glo_lang['dia_chi_email_da_ton_tai'];
        } else {
            $thongbao = $glo_lang['dia_chi_email_khong_hop_le'];
        }
    } else $thongbao = $glo_lang['loi_dang_ky'];

    $return = array("new_cap" => $_SESSION['cap'], "message" => $thongbao);
    echo json_encode($return);

    //gui mai
    // if(!empty($check_send) && $check_send) {
    //   $admin_email    = LAY_email(1);
    //   $htmlbox        = file_get_contents("myadmin/htmlbox/1m.html");
    //   $logo           = $fullpath . "/".$thongtin['duongdantin']."/".$thongtin['icon'];
    //   $thongtinheader = $thongtin['tenbaiviet_'.$lang];
    //   $footer         = "<p><b>".$thongtin['tenbaiviet_'.$lang]."</b></p>";
    //   $footer        .= $thongtin['sodienthoai_vi'] != "" ? "<p>".$glo_lang['so_dien_thoai'].": ". $thongtin['sodienthoai_vi']."</p>" : "";
    //   $footer        .= $thongtin['email_vi'] != "" ? "<p>".$glo_lang['email'].": ". $thongtin['email_vi']."</p>" : "";
    //   $footer        .= $thongtin['diachi_'.$lang] != "" ? "<p>".$glo_lang['dia_chi'].": ". $thongtin['diachi_'.$lang]."</p>" : "";

    //   $noidung        = RETURN_title_lienhe(base64_encode($glo_lang['dang_ky_nhan_ban_tin']));


    //   $noidung       .= RETURN_text_lienhe(base64_encode($glo_lang['ho_va_ten']), $v_name);
    //   $noidung       .= RETURN_text_lienhe(base64_encode($glo_lang['so_dien_thoai']), $v_phone);
    //   $noidung       .= RETURN_text_lienhe(base64_encode($glo_lang['email']), $v_email);
    //   $message        = str_replace(array( "%footer%", '%logo%', '%thongtinheader%', '%noidung%'),
    //     array($footer, LOC_char($logo), $thongtinheader, $noidung), $htmlbox);

    //   ob_start();
    //   GUI_email("$admin_email","", $glo_lang['dang_ky_nhan_ban_tin']  , $_SERVER['SERVER_NAME'], $message, $thongtin);
    //   ob_end_clean();
    // }
    //end
    exit();
}

if ($motty == 'add-cart') {
    if (isset($_SESSION['cart'][$_POST['idsp']])) {
        $_SESSION['cart'][$_POST['idsp']] = $_SESSION['cart'][$_POST['idsp']] + $_POST['qty'];
    } else {
        $_SESSION['cart'][$_POST['idsp']] = $_POST['qty'];
    }
    exit();
}

if ($motty == 'update-qty') {
    $id_sp = $id = $_POST['id'];
    $qty = trim($_POST['qty']);
    $keytn = trim($_POST['keytn']);

    if (!is_numeric($qty)) exit();
    if ($qty == 0) {
        unset($_SESSION['cart'][$id]);
        echo "reload";
        exit();
    }

    $sanpham = DB_que("SELECT * FROM `#_baiviet` WHERE `id` = '" . $id_sp . "' LIMIT 1");
    if (!DB_num($sanpham)) exit();

    $sanpham = DB_arr($sanpham, 1);
    $_SESSION['cart'][$id . "_" . md5($keytn)] = $qty;


    $dongia = check_gia_sql($id_sp, @$keytn, $sanpham['giatien']);

    $thanhtien = $dongia * $qty;

    $tongtien = 0;

    foreach ($_SESSION['cart'] as $key => $value) {

        $id_sp = $key;
        $sanpham = DB_que("SELECT * FROM `#_baiviet` WHERE `id` = '" . $id_sp . "' LIMIT 1");
        $sanpham = DB_arr($sanpham, 1);
        $dongia = check_gia_sql($id_sp, @$_SESSION['tinhnang'][$key], $sanpham['giatien']);

        $tongtien += $dongia * $value;;
    }

    $return = array("thanhtien" => NUMBER_fomat($thanhtien), "tongtien" => NUMBER_fomat($tongtien) . " " . $glo_lang['dvt']);
    echo json_encode($return);
    exit();
}

if ($motty == 'check-dang-nhap' && !empty($_POST)) {
    if (isset($_POST['txt_email'])) {
        $email = addslashes($_POST['txt_email']);
        $pass = addslashes($_POST['txt_pass']);

        //Kiểm tra tên đăng nhập có tồn tại không
        $query = DB_que("SELECT * FROM `#_members` WHERE `email`='" . addslashes($email) . "' AND `phanquyen` = 0 LIMIT 1");
        if (DB_num($query) == 0) {
            $messenge['error'] = 1;
            $messenge['ms'] = $glo_lang['email_pass_khong_khong_dung'];
            echo json_encode($messenge);
            exit();
        }

        //Lấy mật khẩu trong database ra
        $row = DB_arr($query, 1);
        // tai khoan bi khoa
        if ($row['showhi'] != 1) {
            $messenge['error'] = 1;
            $messenge['ms'] = $glo_lang['tai_khoan_da_bi_khoa'];
            echo json_encode($messenge);
            exit();
        }
        // 
        $keypass = $row['keypass'];
        // $phannhom = $row['diemuytin'];
        $pass = create_pass($auto_key_pass . md5($auto_key_pass . $pass), $keypass);

        //So sánh 2 mật khẩu có trùng khớp hay không
        if ($pass != $row['matkhau']) {
            $messenge['error'] = 1;
            $messenge['ms'] = $glo_lang['email_pass_khong_khong_dung'];
            echo json_encode($messenge);
            exit();
        }

        //Lưu tên đăng nhập
        $_SESSION['id'] = $row['id'];
        $messenge['error'] = 0;
        $messenge['ms'] = "";
        echo json_encode($messenge);
        exit();
    }
    exit();
}

if ($motty == 'check-dang-ky' && !empty($_POST)) {
    if (empty($_POST['mabaove']) || strtolower($_POST['mabaove']) != strtolower($_SESSION['captcha']['code'])) {
        $messenge['error'] = 10;
        echo json_encode($messenge);
        exit();
    }

    if (isset($_POST['email_dk'])) {
        $email = $_POST['email_dk'];
        $hoten = $_POST['fullname_dk'];
        $sodienthoai = isset($_POST['phone_dk']) ? $_POST['phone_dk'] : "";
        $diachi = isset($_POST['diachi']) ? $_POST['diachi'] : "";
        $keypass = RANDOM_chuoi(5);
        $matkhau = create_pass($auto_key_pass . md5($auto_key_pass . addslashes($_POST['pass_dk'])), $keypass);

        $query = DB_que("SELECT * FROM `#_members` WHERE `email`='" . addslashes($email) . "' LIMIT 1");
        if (DB_num($query) > 0) {
            $messenge['error'] = 1;
            echo json_encode($messenge);
            exit();
        }

        $data = array();
        $data['tentruycap'] = str_replace(strstr($email, '@'), '', $email) . (rand(999, 9999)) . time();
        $data['email'] = $email;
        $data['hoten'] = $hoten;
        $data['sodienthoai'] = $sodienthoai;
        $data['keypass'] = $keypass;
        $data['matkhau'] = $matkhau;
        $data['diachi'] = $diachi;
        $data['gioitinh'] = isset($_POST['gioi_tinh']) ? $_POST['gioi_tinh'] : 0;
        $data['ngaysinh'] = isset($_POST['nam_sinh']) ? $_POST['nam_sinh'] : "";
        $data['cmnd'] = isset($_POST['cmnd']) ? $_POST['cmnd'] : "";


        $data['phanquyen'] = 0;
        $data['showhi'] = 1;

        $id = ACTION_db($data, '#_members', 'add', array("themmoi"), NULL);

        //gui mai
        // $admin_email    = LAY_email(1);
        $htmlbox = file_get_contents("myadmin/htmlbox/1m.html");
        $logo = $fullpath . "/" . $thongtin['duongdantin'] . "/" . $thongtin['icon'];
        $thongtinheader = $thongtin['tenbaiviet_' . $lang];
        $footer = "<p><b>" . $thongtin['tenbaiviet_' . $lang] . "</b></p>";
        $footer .= $thongtin['sodienthoai_vi'] != "" ? "<p>" . $glo_lang['so_dien_thoai'] . ": " . $thongtin['sodienthoai_vi'] . "</p>" : "";
        $footer .= $thongtin['email_vi'] != "" ? "<p>" . $glo_lang['email'] . ": " . $thongtin['email_vi'] . "</p>" : "";
        $footer .= $thongtin['diachi_' . $lang] != "" ? "<p>" . $glo_lang['dia_chi'] . ": " . $thongtin['diachi_' . $lang] . "</p>" : "";

        $subject = "Thông tin tài khoản khách hàng";

        $noidung = '<tr><td colspan="7"><p>Kính gửi: ' . $hoten . '</p><p>Chào Quý khách,</p><p>Cảm ơn quý khách đã đăng ký thành viên tại website ' . $_SERVER['HTTP_HOST'] . '</p><p>Chúng tôi xin gửi thông tin tài khoản như sau:</p><p>Email: ' . $email . '<br/><br/>Mật khẩu: ' . $_POST['pass_dk'] . '</p></td></tr>';

        $message = str_replace(array("%thongtin_lienhe%", "%footer%", '%logo%', '%thongtinheader%', '%noidung%'),
            array(LOC_char($subject), $footer, LOC_char($logo), $thongtinheader, $noidung), $htmlbox);

        ob_start();
        GUI_email("$email", "$hoten", "$subject", $_SERVER['SERVER_NAME'], $message, $thongtin);
        ob_end_clean();
        //end gui mai

        $messenge['error'] = 0;
        echo json_encode($messenge);
        exit();
    }
    exit();
}

if ($motty == 'check-email' && !empty($_POST)) {
    if (isset($_POST['email'])) {
        $email = $_POST['email'];
        $sql = DB_que("SELECT * FROM `#_members` WHERE `showhi` = 1 AND `phanquyen` = 0 AND `email` = '" . $email . "' LIMIT 1");
        if (DB_num($sql) > 0) {
            $r = DB_arr($sql, 1);
            $hoten = $r['hoten'];
            $active = md5(time()) . "O_K" . md5(GET_ip());
            $data = array();
            $data['active'] = $active;

            $sql = ACTION_db($data, '#_members', 'update', array("capnhat"), "`email` = '" . $email . "' AND `phanquyen` = 0");

            $admin_email = LAY_email(1);
            $htmlbox = file_get_contents("myadmin/htmlbox/1m.html");
            $logo = $fullpath . "/" . $thongtin['duongdantin'] . "/" . $thongtin['icon'];
            $thongtinheader = $thongtin['tenbaiviet_' . $lang];
            $footer = "<p><b>" . $thongtin['tenbaiviet_' . $lang] . "</b></p>";
            $footer .= $thongtin['sodienthoai_vi'] != "" ? "<p>" . $glo_lang['so_dien_thoai'] . ": " . $thongtin['sodienthoai_vi'] . "</p>" : "";
            $footer .= $thongtin['email_vi'] != "" ? "<p>" . $glo_lang['email'] . ": " . $thongtin['email_vi'] . "</p>" : "";
            $footer .= $thongtin['diachi_' . $lang] != "" ? "<p>" . $glo_lang['dia_chi'] . ": " . $thongtin['diachi_' . $lang] . "</p>" : "";


            $url = $full_url . '/mat-khau-moi/?email=' . $r['email'] . '&key=' . $active;
            $subject = $glo_lang['guide_change_pass'];

            $noidung = '<tr><td colspan="7"><p>Xin Chào ' . $hoten . ',</p><p>Chúng tôi nhận được yêu cầu đổi mật khẩu từ email của bạn. Bạn hãy <a href="' . $url . '">nhấn vào đây</a> để tiến hành thay đổi mật khẩu.</p><p>Xin cảm ơn và rất mong tiếp tục nhận được sự ủng hộ của bạn!</p></td></tr>';
// echo $noidung;
            $message = str_replace(array("%thongtin_lienhe%", "%footer%", '%logo%', '%thongtinheader%', '%noidung%'),
                array(LOC_char($subject), $footer, LOC_char($logo), $thongtinheader, $noidung), $htmlbox);

            ob_start();
            GUI_email("$email", "$hoten", "$subject", $_SERVER['SERVER_NAME'], $message, $thongtin);
            ob_end_clean();

            $messenge['link'] = $url;
            $messenge['error'] = 0;
            $messenge['ms'] = $email;
        } else {
            $messenge['error'] = 1;
        }

        echo json_encode($messenge);
        exit();
    }
    exit();
}

if ($motty == 'dang-xuat') {
    unset($_SESSION['id']);
    LOCATION_js($full_url);
    exit();
}

if ($motty == 'change-chu-de') {
    $arr_data = array(
        'data' => "",
        'type' => "",
        'dataoption' => "",
        'data_tn1' => "",
        'data_tn2' => "",
    );

    foreach ($_POST as $k => $v) {
        ${$k} = $v;
    }

    if(!empty($id)){
        $chude = LAY_danhmuc($id,"","`id_parent` = 0");
        $tinhnang = LAY_bv_tinhnang($id,"2","`opt2` = 1 AND `id_parent` = 0");
        if(!empty($chude)){
            $arr_data['type'] = 1;
            foreach ($chude as $rows){
                $arr_data['data'] .= '<div id="'.$rows['id'].'">'.$rows['tenbaiviet_'.$lang].'</div>';
//                $arr_data['dataoption'] .= '<option value="'.$rows['id'].'">'.$rows['tenbaiviet_'.$lang].'</option>';
            }
            $i = 1;
            foreach ($tinhnang as $val){
                $tncon = LAY_bv_tinhnang($id,""," `id_parent` = ".$val['id']);
                foreach ($tncon as $val_2){
                    $arr_data['data_tn'.$i] .= '<div id="'.$val_2['id'].'">'.$val_2['tenbaiviet_'.$lang].'</div>';
                }
                $i++;
            }
        }
    }

    echo json_encode($arr_data);
    exit;
}

if ($motty == "send_form" && isset($_POST['send_tuvan'])) {
    foreach ($_POST as $k => $v) {
        ${$k} = $v;
    }

    if ((!empty($_POST['mabaove']) && strtolower($_POST['mabaove']) == strtolower($_SESSION['captcha']['code'])) || (!empty($_POST['id_token']) && $_POST['id_token'] == $_SESSION['token']) || (!empty($_POST['capcha_hd']) && $_POST['capcha_hd'] == $_SESSION['cap'])) {

        $htmlbox = file_get_contents("myadmin/htmlbox/1m.html");
        $logo = $fullpath . "/" . $thongtin['duongdantin'] . "/" . $thongtin['icon'];
        $thongtinheader = $thongtin['tenbaiviet_' . $lang];
        $footer = "<p><b>" . $thongtin['tenbaiviet_' . $lang] . "</b></p>";
        $footer .= $thongtin['sodienthoai_vi'] != "" ? "<p>" . $glo_lang['so_dien_thoai'] . ": " . $thongtin['sodienthoai_vi'] . "</p>" : "";
        $footer .= $thongtin['email_vi'] != "" ? "<p>" . $glo_lang['email'] . ": " . $thongtin['email_vi'] . "</p>" : "";
        $footer .= $thongtin['diachi_' . $lang] != "" ? "<p>" . $glo_lang['dia_chi'] . ": " . $thongtin['diachi_' . $lang] . "</p>" : "";

        $file = UPLOAD_file("s_hoadon", "./datafiles/post/", time());
        if (!empty($file)) {
            $file_1 = $file;
            $s_hoadon_s = isset($_POST['s_hoadon_s']) ? $_POST['s_hoadon_s'] : "";
        }

        $s_fullname = isset($_POST['s_fullname']) ? $_POST['s_fullname'] : "";
        $s_fullname_s = isset($_POST['s_fullname_s']) ? $_POST['s_fullname_s'] : "";
        $s_dienthoai = isset($_POST['s_dienthoai']) ? $_POST['s_dienthoai'] : "";
        $s_dienthoai_s = isset($_POST['s_dienthoai_s']) ? $_POST['s_dienthoai_s'] : "";
        $s_email = isset($_POST['s_email']) ? $_POST['s_email'] : "";
        $s_email_s = isset($_POST['s_email_s']) ? $_POST['s_email_s'] : "";

        $s_message = isset($_POST['s_message']) ? $_POST['s_message'] : "";
        $s_message_s = isset($_POST['s_message_s']) ? $_POST['s_message_s'] : "";

        $tieude_lienhe = isset($_POST['tieude_lienhe']) ? $_POST['tieude_lienhe'] : "";

        $noidung = "";
        $noidung .= RETURN_title_lienhe($tieude_lienhe);
        $noidung .= RETURN_text_lienhe($s_fullname_s, $s_fullname);
        $noidung .= RETURN_text_lienhe($s_dienthoai_s, $s_dienthoai);
        $noidung .= RETURN_text_lienhe($s_email_s, $s_email);
        $noidung .= RETURN_text_lienhe($s_message_s, $s_message);

        if (!empty($file_1) || !empty($file_2)) {
            $link = "";
            if (!empty($file_1)) {
                $link .= '<a href="../datafiles/post/' . $file_1 . '" download>[' . $file_1 . ']</a> ';
            }
            $noidung .= RETURN_text_lienhe_download($s_hoadon_s, $link);
        }

        $array_json = array();
        $array_json[] = array('k' => 'title', 'v' => $tieude_lienhe);
        if ($s_fullname != "")
            $array_json[] = array('k' => $s_fullname_s, 'v' => $s_fullname);
        if ($s_dienthoai != "")
            $array_json[] = array('k' => $s_dienthoai_s, 'v' => $s_dienthoai);
        if ($s_email != "")
            $array_json[] = array('k' => $s_email_s, 'v' => $s_email);
        if ($s_message != "")
            $array_json[] = array('k' => $s_message_s, 'v' => $s_message);


        for ($i = 1; $i < 50; $i++) {
            if (isset($_POST['group_form_send_' . $i])) {
                $noidung .= RETURN_text_lienhe($_POST['group_form_send_' . $i . '_s'], $_POST['group_form_send_' . $i]);
                if ($_POST['group_form_send_' . $i] != "")
                    $array_json[] = array('k' => $_POST['group_form_send_' . $i . '_s'], 'v' => $_POST['group_form_send_' . $i]);
            }
        }

        $message = str_replace(array("%footer%", '%logo%', '%thongtinheader%', '%noidung%'),
            array($footer, LOC_char($logo), $thongtinheader, $noidung), $htmlbox);

        $data = array();
        $data['tenbaiviet_vi'] = LOC_char(base64_decode($tieude_lienhe));
        $data['ip_gui'] = GET_ip();
        $data['ngay_dang'] = time();
        $data['noi_dung_vn'] = addslashes($message);
        $data['nd_json'] = serialize($array_json);
        $data['loai'] = isset($_POST['loai']) && is_numeric($_POST['loai']) ? $_POST['loai'] : 0;
        $data['id_bv'] = isset($_POST['idbv']) && is_numeric($_POST['idbv']) ? $_POST['idbv'] : 0;

        if (!empty($file_1)) {
            $data['file_1'] = $file_1;
        }
        if (!empty($file_2)) {
            $data['file_2'] = $file_2;
        }

        $data['showhi'] = 0;
        ACTION_db($data, '#_form_datlichhen', 'add', NULL, NULL);

        $admin_email = LAY_email(2);
        $tieude_lienhe = "=?utf-8?B?".$tieude_lienhe."?=";
        ob_start();
        GUI_email("$admin_email", "", $tieude_lienhe, $_SERVER['SERVER_NAME'], $message, $thongtin);
        ob_end_clean();

        // send mai dowload
//        if (isset($_POST['dowload_file'])) {
//            $noidung = LAYTEXT_rieng(54);
//            ob_start();
//            GUI_email($_POST['s_email'], "", $noidung['tenbaiviet_' . $lang] . " " . $_POST['s_email'], $_SERVER['SERVER_NAME'], $noidung['noidung_' . $lang], $thongtin);
//            ob_end_clean();
//        }
        //

        if (!empty($_POST['id_token'])) {
            $_SESSION['token'] = md5(RANDOM_chuoi(5));
            $return = array("err" => 1, "token" => $_SESSION['token']);
            echo json_encode($return);
        } else {
            echo 1;
        }
    } else {
        if (!empty($_POST['id_token'])) {
            $_SESSION['token'] = md5(RANDOM_chuoi(5));
            $return = array("err" => 2, "token" => $_SESSION['token']);
            echo json_encode($return);
        } else echo 2;
    }
    exit();
}

if ($motty == 'update-luot-tai') {
    $arr_data = array(
        'type' => "",
        'data' => "",
    );

    foreach ($_POST as $k => $v) {
        ${$k} = $v;
    }

    if(!empty($id)){
        $id = addslashes(strip_tags($id));
        @DB_que("UPDATE `#_baiviet` SET `soluotxem` = `soluotxem` + 1 WHERE `id` = '$id' LIMIT 1");
        $data = DB_que("SELECT `soluotxem` FROM `#_baiviet` WHERE `id`='" . $id . "' LIMIT 1");
        $data = DB_arr($data);
        $arr_data['type'] = 1;
        $arr_data['data'] = (int) $data[0]['soluotxem'];
    }

    echo json_encode($arr_data);
    exit;
}

if($motty == "lay-ngay"){
    $arr_data = array(
        "type" => "",
        "data" => ""
    );

    foreach ($_POST as $k => $v) {
        ${$k} = addslashes($v);
    }
    if(!empty($thang) && !empty($nam)){
        $tinhngay = cal_days_in_month(0, $thang, $nam);
        for ($i = 1; $i <= $tinhngay; $i++){
            $arr_data['data'] .= '<option value="'.$i.'">'.$i.'</option>';
        }
        $arr_data['type'] = 1;
    }else{
        $arr_data['type'] = 2;
    }

    echo json_encode($arr_data);
    exit();
}

if($motty == "tinh-ngay-du-sinh"){
    $arr_data = array(
        "type" => "",
        "data" => ""
    );

    foreach ($_POST as $k => $v) {
        ${$k} = addslashes($v);
    }
    if(!empty($ngay) && !empty($thang) && !empty($nam)){
        $input_time = $ngay."-".$thang."-".$nam;
        $input_time = strtotime($input_time);
//        $final_time = strtotime("+ 38 weeks 1 day",$current_time."");
        $final_time = strtotime("+ 9 months 7 days",$input_time);
        $arr_data['data'] = date("d/m/Y",$final_time);
        $arr_data['data_2'] = $glo_lang['ngay_thu_thai']. " : ". date("d/m/Y",strtotime("+ 2 days",$input_time));
        $arr_data['type'] = 1;
    }else{
        $arr_data['type'] = 2;
    }

    echo json_encode($arr_data);
    exit();
}

if($motty == "tinh-ngay-sinh"){
    $arr_data = array(
        "type" => "",
        "data" => ""
    );

    foreach ($_POST as $k => $v) {
        ${$k} = addslashes($v);
    }
    if(!empty($ngay) && !empty($thang) && !empty($nam)){
        if($nam > date("Y",time())){
            $arr_data['type'] = 2;
        }else{
            if($thang > date("m",time()) && $nam >= date("Y",time())){
                $arr_data['type'] = 2;
            }else{
                if($ngay > date("d",time()) && $thang >= date("m",time()) && $nam >= date("Y",time())){
                    $arr_data['type'] = 2;
                }else{
                    $input_time = $ngay."-".$thang."-".$nam;
                    $diff = date_diff(date_create(), date_create($input_time));
                    $age = $diff->format('%Y'). " ".$glo_lang['tuoi'];
                    if($age > 1) $age = $diff->format('%Y')." ".$glo_lang['tuoi_sonhieu'];
                    if($age == 0){
                        if($diff->format('%m') != 0){
                            $age = $diff->format('%m')." ".$glo_lang['thang_tuoi'];
                            if($age > 1) $age = $diff->format('%m')." ".$glo_lang['thang_tuoi_sonhieu'];

                        }else{
                            $age = $diff->format('%d')." ".$glo_lang['ngay_tuoi'];
                            if($age > 1) $age = $diff->format('%d')." ".$glo_lang['ngay_tuoi_sonhieu'];
                        }
                    }
                    $arr_data['data'] = $age;
                    $arr_data['type'] = 1;
                }
            }
        }
        if($arr_data['type'] == 2){
            $arr_data['data'] = $glo_lang['vui_long_nhap_ngay_thang_nho_hon'];
        }
    }

    echo json_encode($arr_data);
    exit();
}

if($motty == "tinh-chieu-cao-can-nang"){
    $arr_data = array("data" => $glo_lang['khong_co_du_lieu_ban_can_tim']);
    foreach ($_POST as $k => $v){
        ${$k} = addslashes($v);
    }


    if(!empty($chieu_cao) && !empty($can_nang) && !empty($ngaysinh)){
        $ngaysinh = str_replace("/","-",$ngaysinh);
        $ngaysinh = date_diff(date_create(), date_create($ngaysinh));
        $tuoi = $ngaysinh->format('%Y');
        $chieu_cao = (float) $chieu_cao / 100;
        $bmi = $can_nang / ($chieu_cao * $chieu_cao);
        $check = 0;

        if($tuoi <= 2){
            if($bmi < 14.2)$check = 1;
            else if($bmi >= 14.2 && $bmi < 18) $check = 2;
             else if($bmi >= 18 && $bmi < 19) $check = 3;
            else if($bmi >= 19 && $bmi < 32) $check = 4;
        }
        if($tuoi == 3){
            if($bmi < 13.9)$check = 1;
            else if($bmi >= 13.9 && $bmi < 17.4) $check = 2;
            else if($bmi >= 17.4 && $bmi < 18.2) $check = 3;
            else if($bmi >= 18.2 && $bmi < 32) $check = 4;
        }
        if($tuoi == 4){
            if($bmi < 13.8)$check = 1;
            else if($bmi >= 13.8 && $bmi < 17) $check = 2;
            else if($bmi >= 17 && $bmi < 18.1) $check = 3;
            else if($bmi >= 18.1 && $bmi < 32) $check = 4;
        }
        if($tuoi == 5){
            if($bmi < 13.5)$check = 1;
            else if($bmi >= 13.5 && $bmi < 17) $check = 2;
            else if($bmi >= 17 && $bmi < 18.2) $check = 3;
            else if($bmi >= 18.2 && $bmi < 32) $check = 4;
        }
        if($tuoi == 6){
            if($bmi < 13.4)$check = 1;
            else if($bmi >= 13.4 && $bmi < 17.2) $check = 2;
            else if($bmi >= 17.2 && $bmi < 19) $check = 3;
            else if($bmi >= 19 && $bmi < 32) $check = 4;
        }
        if($tuoi == 7){
            if($bmi < 13.6)$check = 1;
            else if($bmi >= 13.6 && $bmi < 17.8) $check = 2;
            else if($bmi >= 17.8 && $bmi < 19.8) $check = 3;
            else if($bmi >= 19.8 && $bmi < 32) $check = 4;
        }
        if($tuoi == 8){
            if($bmi < 13.5)$check = 1;
            else if($bmi >= 13.5 && $bmi < 18.4) $check = 2;
            else if($bmi >= 18.4 && $bmi < 20.8) $check = 3;
            else if($bmi >= 20.8 && $bmi < 32) $check = 4;
        }
        if($tuoi == 9){
            if($bmi < 13.8)$check = 1;
            else if($bmi >= 13.8 && $bmi < 19.3) $check = 2;
            else if($bmi >= 19.3 && $bmi < 21.8) $check = 3;
            else if($bmi >= 21.8 && $bmi < 32) $check = 4;
        }
        if($tuoi == 10){
            if($bmi < 14)$check = 1;
            else if($bmi >= 14 && $bmi < 20.1) $check = 2;
            else if($bmi >= 20.1 && $bmi < 23) $check = 3;
            else if($bmi >= 23 && $bmi < 32) $check = 4;
        }
        if($tuoi == 11){
            if($bmi < 14.3)$check = 1;
            else if($bmi >= 14.3 && $bmi < 21) $check = 2;
            else if($bmi >= 21 && $bmi < 24.2) $check = 3;
            else if($bmi >= 24.2 && $bmi < 32) $check = 4;
        }
        if($tuoi == 12){
            if($bmi < 14.8)$check = 1;
            else if($bmi >= 14.8 && $bmi < 21.8) $check = 2;
            else if($bmi >= 21.8 && $bmi < 25.4) $check = 3;
            else if($bmi >= 25.4 && $bmi < 32) $check = 4;
        }
        if($tuoi == 13){
            if($bmi < 15.2)$check = 1;
            else if($bmi >= 15.2 && $bmi < 22.7) $check = 2;
            else if($bmi >= 22.7 && $bmi < 26.3) $check = 3;
            else if($bmi >= 26.3 && $bmi < 32) $check = 4;
        }
        if($tuoi == 14){
            if($bmi < 15.8)$check = 1;
            else if($bmi >= 15.8 && $bmi < 23.3) $check = 2;
            else if($bmi >= 23.3 && $bmi < 27.2) $check = 3;
            else if($bmi >= 27.2 && $bmi < 32) $check = 4;
        }
        if($tuoi == 15){
            if($bmi < 16.2)$check = 1;
            else if($bmi >= 16.2 && $bmi < 24.1) $check = 2;
            else if($bmi >= 24.1 && $bmi < 28.1) $check = 3;
            else if($bmi >= 28.1 && $bmi < 32) $check = 4;
        }
        if($tuoi == 16){
            if($bmi < 16.8)$check = 1;
            else if($bmi >= 16.8 && $bmi < 24.8) $check = 2;
            else if($bmi >= 24.8 && $bmi < 29) $check = 3;
            else if($bmi >= 29 && $bmi < 32) $check = 4;
        }
        if($tuoi == 17){
            if($bmi < 17.2)$check = 1;
            else if($bmi >= 17.2 && $bmi < 25.3) $check = 2;
            else if($bmi >= 25.3 && $bmi < 29.6) $check = 3;
            else if($bmi >= 29.6 && $bmi < 32) $check = 4;
        }
        if($tuoi == 18){
            if($bmi < 17.5)$check = 1;
            else if($bmi >= 17.5 && $bmi < 25.9) $check = 2;
            else if($bmi >= 25.9 && $bmi < 31.3) $check = 3;
            else if($bmi >= 31.3 && $bmi < 32) $check = 4;
        }

        if($check == 1) $arr_data['data'] = $glo_lang['tre_thieu_can'];
        if($check == 2) $arr_data['data'] = $glo_lang['tre_binh_thuong'];
        if($check == 3) $arr_data['data'] = $glo_lang['tre_nguy_co_beo_phi'];
        if($check == 4) $arr_data['data'] = $glo_lang['tre_beo_phi'];

    }
    echo json_encode($arr_data);
    exit;
}
