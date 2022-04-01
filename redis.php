<?php
if($_SERVER['HTTP_HOST']    != 'localhost' && $_SERVER['HTTP_HOST'] != $check_fl_domain ) {
    $_SESSION['thumuc']         = "datafiles";
    $_SESSION['sub_demo_check'] = true;
}

$glo_http_host = $_SERVER['HTTP_HOST'];
$glo_http_host = str_replace("www.", "", $glo_http_host);
$glo_http_host = strtolower($glo_http_host);

if($php_vs == "5.6") {
    $glo_db   = @mysql_connect($db_localhost, $db_user, $db_pass);
    if(is_string($glo_db)){
        include("db_mysql_error.php");
        exit();
    }
    $dbuse      = @mysql_select_db($db_data ,$glo_db);
    if(!$dbuse){
        include("db_mysql_error.php");
        exit();
    }
    mysql_query("SET character_set_connection=utf8mb4, character_set_results=utf8mb4, character_set_client=binary");
}
else {
    $glo_db = @mysqli_connect($db_localhost, $db_user, $db_pass);
    if(is_string($glo_db)){
        include("db_mysql_error.php");
        exit();
    }
    $dbuse      = @mysqli_select_db($glo_db, $db_data);
    if(!$dbuse){
        include("db_mysql_error.php");
        exit();
    }
    mysqli_query($glo_db,"SET character_set_connection=utf8mb4, character_set_results=utf8mb4, character_set_client=binary");
}

$domain1ty  = $_SERVER['HTTP_HOST'];
$docpat     = urldecode(mb_strtolower(htmlspecialchars($_SERVER['REQUEST_URI'])));
$docpat     = trim($docpat, "/");
$docpat     = @explode("/", $docpat);
$redis_on_off               = "off";
if($_SERVER['HTTP_HOST'] == 'localhost' || $_SERVER['HTTP_HOST'] == $check_fl_domain){
    $file_coder             = @$docpat[0];
    $domain1ty              = $domain1ty."/".$file_coder;
    $file_coder             = $file_coder."/";
    $motty                  = @CAT_CHUOI_tuchuoi($docpat[1], "?");
    $haity                  = @CAT_CHUOI_tuchuoi($docpat[2], "?");
    $baty                   = @CAT_CHUOI_tuchuoi($docpat[3], "?");
    $bonty                  = @CAT_CHUOI_tuchuoi($docpat[4], "?");
    $namty                  = @CAT_CHUOI_tuchuoi($docpat[5], "?");
} else{
    $file_coder             = "";
    $motty                  = @CAT_CHUOI_tuchuoi($docpat[0], "?");
    $haity                  = @CAT_CHUOI_tuchuoi($docpat[1], "?");
    $baty                   = @CAT_CHUOI_tuchuoi($docpat[2], "?");
    $bonty                  = @CAT_CHUOI_tuchuoi($docpat[3], "?");
    $namty                  = @CAT_CHUOI_tuchuoi($docpat[4], "?");
}

if(!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on')  $fullpath       = 'https://'.$domain1ty;
else  $fullpath       = 'http://'.$domain1ty;
$fullpath_admin     = $fullpath."/myadmin/";
$auto_key_pass      = "wlh_2019";
$is_myadmin         = $motty == "myadmin" ? "on" : "off";

if(!empty($_GET)){
    $_GET = PROCESS_data($_GET);
}
if(!empty($_POST)){
    $_POST = PROCESS_data($_POST);
}
if(!empty($_COOKIE)){
    $_COOKIE = PROCESS_data($_COOKIE);
}
if(!empty($_REQUEST)){
    $_REQUEST = PROCESS_data($_REQUEST);
}
if($redis_on_off    == "on") {
    $redis_ip       = gethostbyname($_SERVER['HTTP_HOST']);
    $redis_pass     = "";
    $redis_port     = "6379";
    $co_so_du_lieu  = 1;
    $redis_id       = str_replace(".", "_", $_SERVER['HTTP_HOST']);
    try {
        if(class_exists('Redis')) {
            $ob_redis   = new Redis();
            $ob_redis->connect($redis_ip, $redis_port, $co_so_du_lieu);
            $ob_redis->auth($redis_pass);
            if($ob_redis->ping() != "+PONG") {
                $redis_on_off     = "off";
            }
        }
    }
    catch(RedisException $e) {
        $redis_on_off     = "off";
    }

}
function CAT_CHUOI_tuchuoi($str, $char){
    $str = addslashes($str);
    $vitri = strpos("pa".$str, $char);
    if($vitri >= 2){
        return trim(substr($str, 0,$vitri-2));
    }
    return $str;
}
function SET_redis($key, $value) {
    global $ob_redis, $redis_id, $redis_on_off, $cache_file, $is_myadmin;
    $key = empty($key) ? "wyc_pa" : strtolower($key);
    if($ob_redis === NULL || $redis_on_off != "on") {
        if($cache_file == "on" && $is_myadmin == "off") {
            $thumuc_check   = explode("@", $key);
            $thumuc         = trim($thumuc_check[0]);
            if($thumuc != "") {
                if (!is_dir('datafiles/cache')) {
                    mkdir('datafiles/cache');
                    chmod('datafiles/cache', 0777);
                }
                if (!is_dir('datafiles/cache/'.$thumuc)) {
                    mkdir('datafiles/cache/'.$thumuc);
                    chmod('datafiles/cache/'.$thumuc, 0777);
                }
                if(!empty($thumuc_check[1]) && $thumuc_check[1] != "") {
                    $path = "datafiles/cache/".$thumuc."/".$thumuc_check[1].".txt";
                    if(!file_exists($path)) {
                        file_put_contents($path, $value);
                    }
                }
            }
        }
        return;
    }
    $time_luu = 864000;
    $ob_redis->setex($redis_id.'@' . $key, $time_luu, $value);
}

function GET_redis($key) {
    global $ob_redis, $redis_id, $redis_on_off, $cache_file, $is_myadmin;
    $key = empty($key) ? "wyc_pa" : strtolower($key);
    if($ob_redis === NULL){
        if($cache_file == "on" && $is_myadmin == "off") {
            $thumuc_check   = explode("@", $key);
            if(!empty($thumuc_check[0]) && !empty($thumuc_check[1])) {
                $path = "datafiles/cache/".$thumuc_check[0]."/".$thumuc_check[1].".txt";
                if(file_exists($path)) {
                    return file_get_contents($path);
                }
            }
        }
        return;
    }
    return $ob_redis->get($redis_id.'@' . $key);
}

function CHECK_redis($key) {
    global $ob_redis, $redis_id, $redis_on_off;
    $key = empty($key) ? "wyc_pa" : strtolower($key);
    if($ob_redis === NULL || $redis_on_off != "on") return false;
    return $ob_redis->exists( $redis_id.'@' . $key);
}

function DEL_redis($key = ''){
    global $ob_redis, $redis_id, $redis_on_off;
    if($redis_on_off != "on") return false;

    $key    = empty($key) ? "" : strtolower($key);
    $pathen = $redis_id.'@*';
    if($key != "") {
        $pathen .= $key . '*';
    }
    @$ob_redis->del($ob_redis->keys($pathen));
}
function DEL_redis_table_page($table, $key = ''){
    global $ob_redis, $redis_id, $redis_on_off, $cache_file;
    $table      = str_replace("#_", "", $table);
    $table      = trim($table);
    if($table   == "" || $redis_on_off != "on") {
        if($cache_file == "on") {
            $table      = str_replace("`", "", $table);
            if($table != "") {
                XOA_thumuc("datafiles/cache/".$table);
            }
            if($table == "baiviet") {
                XOA_thumuc("../datafiles/cache/danhmuc");
                XOA_thumuc("../datafiles/cache/baiviet_chitiet");
                XOA_thumuc("../datafiles/cache/baiviet_img");
                XOA_thumuc("../datafiles/cache/baiviet_sao");
                XOA_thumuc("../datafiles/cache/baiviet_select_tinhnang");
                XOA_thumuc("../datafiles/cache/baiviet_thuoctinh");
                XOA_thumuc("../datafiles/cache/baiviet_tinhnang");
            }

        }
        return;
    }
    $key        = empty($key) ? "" : strtolower($key);
    $pathen     = $redis_id.'@'.$table.'@*';
    if($key != "") {
        $pathen .= $key . '*';
    }
    @$ob_redis->del($ob_redis->keys($pathen));
}
function DEL_redis_table($table, $key = ''){
    global $ob_redis, $redis_id, $redis_on_off, $cache_file;
    $table      = str_replace("#_", "", $table);
    $table      = trim($table);
    if($table   == "" || $redis_on_off != "on") {
        if($cache_file == "on") {
            $table      = str_replace("`", "", $table);
            if($table != "") {
                XOA_thumuc("../datafiles/cache/".$table);
            }
            if($table == "baiviet") {
                XOA_thumuc("../datafiles/cache/danhmuc");
                XOA_thumuc("../datafiles/cache/baiviet_chitiet");
                XOA_thumuc("../datafiles/cache/baiviet_img");
                XOA_thumuc("../datafiles/cache/baiviet_sao");
                XOA_thumuc("../datafiles/cache/baiviet_select_tinhnang");
                XOA_thumuc("../datafiles/cache/baiviet_thuoctinh");
                XOA_thumuc("../datafiles/cache/baiviet_tinhnang");
            }

        }
        return;
    }
    $key        = empty($key) ? "" : strtolower($key);
    $pathen     = $redis_id.'@'.$table.'@*';
    if($key != "") {
        $pathen .= $key . '*';
    }
    @$ob_redis->del($ob_redis->keys($pathen));
}
function XOA_thumuc($dirname) {
    if (!file_exists($dirname)) {
        return false;
    }
    if (is_file($dirname)) {
        return unlink($dirname);
    }
    $dir = dir($dirname);
    while (false !== $entry = $dir->read()) {
        if ($entry == '.' || $entry == '..') {
            continue;
        }
        XOA_thumuc("$dirname/$entry");
    }
    $dir->close();
}
function DB_fet_rd($sql, $table, $where = "", $order_by = "", $limit = "", $col = "", $where_orther = "", $showsql = ""){
    global $php_vs, $glo_http_host;

    $http_host = str_replace("www.", "", $_SERVER['HTTP_HOST']);
    $http_host = strtolower($http_host);
    if($glo_http_host != $http_host) exit();

    $where          = trim($where);
    $order_by       = trim($order_by);
    $limit          = trim($limit);
    $col            = trim($col);
    $where_orther   = trim($where_orther);

    if ($where == "" && $where_orther != "") {
        $where =  " WHERE $where_orther ";
    }
    else {
        $where = " WHERE `showhi` = 1 ".($where  != "" ? " AND $where " : "");
    }

    $limit = str_replace(".", ",", $limit);

    if($order_by != "") $order_by   = " ORDER BY $order_by ";

    if($limit       == "" || (strlen($limit) == 1 && ($limit == 0 || $limit == "0"))) {
        $limit      = "";
    }
    else $limit     = " LIMIT $limit";

    $where_keys     = "SELECT $sql FROM $table $where $order_by $limit";
    if($showsql == 1){echo $where_keys;}

    $new_table      = str_replace("#_", "", $table);
    $new_table      = str_replace("`", "", $new_table);
    $new_table      = trim($new_table);
    $new_table      = str_replace("`", "", $new_table);
    $key_redis  = $new_table."@".md5($where_keys);
    $return     = GET_redis($key_redis);
    $return     = json_decode($return, true);
    if($return) return $return;

    $sql_que        = DB_que($where_keys);


    $array      = array();
    if(DB_num($sql_que)){
        if($php_vs == "5.6"){
            while ($row = mysql_fetch_assoc($sql_que)) {
                if($col == "") {
                    $array[] = $row;
                }
                else {
                    $array[$row[$col]] = $row;
                }
            }
        }
        else {
            while ($row = mysqli_fetch_assoc($sql_que)) {
                if($col == "") {
                    $array[] = $row;
                }
                else {
                    $array[$row[$col]] = $row;
                }
            }
        }
    }

    $return = json_encode($array);
    SET_redis($key_redis, $return);
    return $array;
}

function DB_num_rd($where_keys, $table){
    global $php_vs;
    $new_table      = str_replace("#_", "", $table);
    $new_table      = str_replace("`", "", $new_table);
    $new_table      = trim($new_table);
    $new_table      = str_replace("`", "", $new_table);
    $key_redis      = $new_table."@num_".md5($where_keys);
    $return         = GET_redis($key_redis);
    if($return) return $return;

    $sql_que = DB_que($where_keys);
    if($php_vs == "5.6"){
        $return  = mysql_num_rows($sql_que);
    }
    else {
        $return  = mysqli_num_rows($sql_que);
    }

    SET_redis($key_redis, $return);
    return $return;
}

function XOA_table($table) {
    DEL_redis_table($table);
}
function XOA_all_file($path) {
    $handle = opendir($path);
    while (false !== ($file = readdir($handle))) {
      if (substr($file, 0, 1) != '.') {
        if (is_dir($path . '/' . $file)) {
            XOA_all_file($path . '/' . $file);
        }else if(is_file($path . '/' . $file)){
           unlink($path . '/' . $file);
        }
      }
    }
    closedir($handle);
}
function DB_que_id(){
        if($php_vs == "5.6"){
            return mysql_insert_id();
        }
        else {
            return mysqli_insert_id();
        }
}
function DB_que($str, $table = ""){
    global $glo_db, $php_vs, $glo_http_host;

    $http_host = str_replace("www.", "", $_SERVER['HTTP_HOST']);
    $http_host = strtolower($http_host);
    if($glo_http_host != $http_host) exit();

    $str = str_replace("#_", "lh_", $str);
    if($php_vs == "5.6"){
        $return = mysql_query($str);
    }
    else {
        $return = mysqli_query($glo_db,$str);
    }

    DEL_redis_table($table);
    return $return;
}
function DB_fet($sql, $table, $where    = "", $order_by = "", $limit = "", $arr = "", $loai = 0, $sql_return = ""){
    global $php_vs;
    if($where       != "") $where       = "WHERE $where ";
    if($order_by    != "") $order_by    = "ORDER BY $order_by ";
    if($limit       != "") $limit       = "LIMIT $limit ";
    $str            = "SELECT $sql FROM $table $where $order_by $limit";

    if($sql_return != "") echo $str;

    $sql_que        = DB_que($str);
    if($arr         == "") return $sql_que;
    else{
        $retuen_arr = array();
        if($php_vs == "5.6"){
            while ($r   = mysql_fetch_array($sql_que)) {
                if($loai == 0) {
                    $retuen_arr[] = $r;
                }
                else if($loai == 1) {
                    $retuen_arr[$r['id']] = $r;
                }
                else {
                    $retuen_arr[$loai] = $r;
                }
            }
        }
        else {
            while ($r   = mysqli_fetch_array($sql_que)) {
                if($loai == 0) {
                    $retuen_arr[] = $r;
                }
                else if($loai == 1) {
                    $retuen_arr[$r['id']] = $r;
                }
                else {
                    $retuen_arr[$loai] = $r;
                }
            }
        }
        return $retuen_arr;
    }
}
function DB_arr($sql_que, $col = ""){
    global $php_vs;
    $retuen_arr = array();
    if(DB_num($sql_que)){
        if($php_vs == "5.6"){
            if($col == 1) return mysql_fetch_assoc($sql_que);
            while ($r   = mysql_fetch_assoc($sql_que)) {
                if($col == "")
                    $retuen_arr[] = $r;
                else
                    $retuen_arr[$r[$col]] = $r;
            }
        }
        else {
            if($col == 1) return mysqli_fetch_assoc($sql_que);
            while ($r   = mysqli_fetch_assoc($sql_que)) {
                if($col == "")
                    $retuen_arr[] = $r;
                else
                    $retuen_arr[$r[$col]] = $r;
            }
        }
    }
    return $retuen_arr;
}
function DB_num($sql_que){
    global $php_vs;
    if($php_vs == "5.6"){
        return mysql_num_rows($sql_que);
    }
    else {
        return mysqli_num_rows($sql_que);
    }
}
function ACTION_db($array,$table,$kieu='add',$array_remove=array(),$condition=NULL, $truy_sql = ""){
    global $glo_db, $php_vs;
    if($kieu=='delete')
        {
            $sqldel = DB_que("DELETE FROM `$table` WHERE $condition");
            DEL_redis_table($table);
            return true;
        }
    $bang_db        = "";
    $bang_value     = "";
    $soluong        = count($array);
    foreach($array as $key => $value)
        {
            if($kieu=='add')
                {
                    if(@in_array($key, $array_remove)) continue;
                    $bang_db        .= "`$key`,";
                    $bang_value     .= "'".$value."',";
                }
            if($kieu=='update')
                {
                    if(@in_array($key, $array_remove)) continue;
                    $bang_db        .= "`$key`='".$value."',";
                }
        }
    $bang_db        = substr($bang_db,0,-1);
    $bang_value     = substr($bang_value,0,-1);

    if($kieu=='add')
        {
            @DB_que("INSERT INTO `$table`($bang_db) VALUES($bang_value)");
            if($truy_sql != ""){
                echo "INSERT INTO `$table`($bang_db) VALUES($bang_value)";
                exit();
            }

        }
    if($kieu=='update')
        {
            @DB_que("UPDATE `$table` SET $bang_db WHERE $condition");
            if($truy_sql != ""){
                echo "UPDATE `$table` SET $bang_db WHERE $condition";
                exit();
            }

        }
    DEL_redis_table($table);
    if($php_vs == "5.6"){
        return mysql_insert_id($glo_db);
    }
    else {
        return mysqli_insert_id($glo_db);
    }
}
function fun_show_hethan($hethan = 0){
    $text_hethang = "Tên miền chưa được kích hoạt. Vui lòng nhập <b>ID</b> và <b>Key</b> để kích hoạt tên miền. Nếu quý khách đang sử dụng tên miền phụ, quý khách truy cập tên miền chính, vào admin > thiết lập website để khai báo tên miền phụ.";
    if($hethan != 0) {
        $text_hethang = "<b>ID</b>- <b>Key</b> đã hết hạng sử dụng (".date('d-m-Y', $hethan)."). Quý khách vui lòng nhập <b>ID</b>- <b>Key</b> để tiếp tục sử dụng.";
    }
    return '<div style="width: 95%; margin: 40px auto; padding: 15px; border: double #afafaf 4px; font-size: 13px; font-family: \'Arial\'; line-height: 22px; max-width: 450px;">
            <form action="" method="post" style="margin: 0; padding: 0 0 4px;">
                <p style="margin: 0; padding: 0; margin-bottom: 10px;">'.$text_hethang.'</p>
            
                <div>
                    <input type="text" name="lic_txt_id" value="" placeholder="Nhập ID " style="width: 100%; padding: 0 7px; box-sizing: border-box; height: 30px; border: 1px solid #ccc; margin-bottom: 10px; outline: none;"/>
                    <input type="text" name="lic_txt_key" value=""  placeholder="Nhập Key" style="width: 100%; padding: 0 7px; box-sizing: border-box; height: 30px; border: 1px solid #ccc; margin-bottom: 10px; outline: none;"/>
                </div>
                <div>
                    <input type="submit" name="btnpacheck_lic_key" value="Kích hoạt" style="height: 28px; padding: 0px 16px; margin-top: 3px; cursor: pointer;"/>
                </div>
            </form>
        </div>';
}
function utf8_char_code_at_deco($char) {
    return pack("H*",dechex($char));
}
function lic_web_pa_check_lic ($namelic,$str_lic){
    if(strlen($str_lic) != 29) {
        $arr = array(0,0);
        return json_encode($arr);
    }

    $namelic    = strtoupper($namelic);
    $namelic_ar = str_split($namelic);

    $str_lic    = strtoupper($str_lic);

    $check_key  = '123456789ABCDEFGHJKLMNPQRSTUVWXYZ';
    $data_char  = str_split($check_key);
    $str_lic_ar = str_split($str_lic);

    if ($namelic && $str_lic) {
        $vt_1   = "";
        $vt_2   = "";
        $vt_3   = "";
        $vt_4   = "";
        $key_1  = "";
        $key_2  = "";
        $key_3  = "";
        $key_4  = "";

        $ngay       = "";
        $thang      = "";
        $nam        = "";
        $s_thang    = "";

        foreach ($data_char as $key => $value) {
            if($str_lic_ar[1] == $value) $vt_1 = $key.$vt_1;
            if($str_lic_ar[2] == $value) $vt_1 = $vt_1.$key;

            if($str_lic_ar[6] == $value) $vt_2 = $key.$vt_2;
            if($str_lic_ar[7] == $value) $vt_2 = $vt_2.$key;

            if($str_lic_ar[11] == $value) $vt_3 = $key.$vt_3;
            if($str_lic_ar[12] == $value) $vt_3 = $vt_3.$key;

            if($str_lic_ar[16] == $value) $vt_4 = $key.$vt_4;
            if($str_lic_ar[17] == $value) $vt_4 = $vt_4.$key;

            if($str_lic_ar[20] == $value) $key_1 = $key;
            if($str_lic_ar[22] == $value) $key_2 = $key;
            if($str_lic_ar[26] == $value) $key_3 = $key;
            if($str_lic_ar[28] == $value) $key_4 = $key;


            if($str_lic_ar[21] == $value) $ngay     = $key;
            if($str_lic_ar[23] == $value) $thang    = $key;
            if($str_lic_ar[25] == $value) $nam      = $key;
            if($str_lic_ar[27] == $value) $s_thang  = $key;
        }

        $key_1 = $namelic_ar[$key_1];
        $key_2 = $namelic_ar[$key_2];
        $key_3 = $namelic_ar[$key_3];
        $key_4 = $namelic_ar[$key_4];
        $vt_1  = utf8_char_code_at_deco($vt_1);
        $vt_2  = utf8_char_code_at_deco($vt_2);
        $vt_3  = utf8_char_code_at_deco($vt_3);
        $vt_4  = utf8_char_code_at_deco($vt_4);

        $hsd = $s_thang == 0 ? 0 : mktime(23,59,59, $thang, $ngay, "20".$nam);


        if($key_1 == $vt_1 && $key_2 == $vt_2 && $key_3 == $vt_3 && $key_4 == $vt_4){
            $arr = array(1,$hsd);
            return json_encode($arr);
        }
    }
    $arr = array(0,0);
    return json_encode($arr);
}


    if(isset($_POST['btnpacheck_lic_key'])){
        $lic_txt_id     = isset($_POST['lic_txt_id']) ? $_POST['lic_txt_id'] : "";
        $lic_txt_key    = isset($_POST['lic_txt_key']) ? $_POST['lic_txt_key'] : "";
        $check_lic_pa   = @lic_web_pa_check_lic ($lic_txt_id, $lic_txt_key);
        $check_lic_pa   = json_decode($check_lic_pa, true);
        $check_lic_pa_0 = @$check_lic_pa[0];
        if(@$check_lic_pa_0){
            DB_que("UPDATE `#_seo` SET `lic_name` = '$lic_txt_id', `lic_key` = '$lic_txt_key' ");
            echo '<script type="text/javascript"><script type="text/javascript">window.location.reload()</script></script>';
        }
        else {
            echo '<script type="text/javascript">alert("Quý khách nhập ID - Key không đúng!")</script>';
        }

    }

    if(isset($_GET['check_subdomain'])){
        $check_subdomain = DB_que("SELECT * FROM `#_subdomain` WHERE `tenbaiviet_vi` = '".$_GET['check_subdomain']."' LIMIT 1", 1);
        if(DB_num($check_subdomain)){
            $check_subdomain = DB_arr($check_subdomain, 1);
            echo $check_subdomain['keycode'];
        }
        exit();
    }

    $thongtin           = DB_que("SELECT * FROM `#_seo` LIMIT 1", 1);
    $thongtin           = DB_arr($thongtin, 1);

    $check_nlic     = strtoupper($_SERVER['HTTP_HOST']);
    $check_nlic     = str_replace("WWW.", "", $check_nlic);



    $lic_name       = strtoupper($thongtin['lic_name']);
    $lic_key        = strtoupper($thongtin['lic_key']);

    if($check_nlic == $lic_name){
        $check_lic_pa   = @lic_web_pa_check_lic ($lic_name, $lic_key);
        $check_lic_pa   = json_decode($check_lic_pa, true);


        $check_lic_pa_0 = @$check_lic_pa[0];
        $check_lic_pa_1 = @$check_lic_pa[1];

        if(!$check_lic_pa_0){
            echo fun_show_hethan();
            exit();
        }
        else if($check_lic_pa_1 != 0 && $check_lic_pa_1 < time()){
            echo fun_show_hethan($check_lic_pa_1);
            exit();
        }
    }
    else {
        $save_check = md5($check_nlic.date("d-m-Y", time()));
        if($thongtin['lic_name'] != ""){
            DB_que("UPDATE `#_subdomain` SET `keycode` = '$save_check' WHERE `tenbaiviet_vi` = '$check_nlic' LIMIT 1");
            $check_sub = @file_get_contents("http://".$thongtin['lic_name']."/?check_subdomain=".$check_nlic);
            if($check_sub != $save_check){
                echo fun_show_hethan();
                exit();
            }
        }
        else {
            echo fun_show_hethan();
            exit();
        }

    }

?>
