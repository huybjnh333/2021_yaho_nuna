<?php
	include "OnePay.php";
	

	$sql_se       = DB_que("SELECT * FROM `#_ship_thanhtoan_setup` WHERE `id`= 1 LIMIT 1");
	$sql_se       = mysql_fetch_assoc($sql_se);

	$type       = isset($_GET['type']) && is_numeric($_GET['type']) ? $_GET['type'] : "";
	$iddh       = isset($_GET['id']) && is_numeric($_GET['id']) ? $_GET['id'] : "";
    $donhang    = DB_fet("*", "#_order", "`id` = '".$iddh."'","", 1);
    if(!mysql_num_rows($donhang)){
    	LOCATION_js($full_url);
    	exit();
    }
    $donhang    = mysql_fetch_assoc($donhang);
	$thongtin_thanhtoan = SHOW_text($donhang['thongtin_thanhtoan']);
	$madh = SHOW_text($donhang['madh']);

// print_r($donhang);

    $idSanphams = explode(',', $donhang['idsp']);
    $dongias    = explode(',', $donhang['dongia']);
    $soluongs   = explode(',', $donhang['soluong']);

    $tongtien   = 0;
    $i          = 0;
    foreach ($idSanphams as $value) {
        $sanpham   = DB_fet("*", "#_baiviet", "`id` = '".$value."'", "", 1);
        $sanpham   = mysql_fetch_assoc($sanpham);

        $dongia    = $dongias[$i];
        $thanhtien = $soluongs[$i] * $dongia;
        $tongtien += $thanhtien;
        $i++;
    }
    $tongtien = $tongtien + $donhang['phi_ship'];
 
	// config noi dia

	// Thẻ ABB:
	// Số thẻ: 9704250000000001 
	// Tháng/Năm phát hành: 01/13 
	// Tên: NGUYEN VAN A
	// Mã OTP: 123456 
	$merchantnoidia 		= $sql_se['merchantnoidia'];
	$accesscodenoidia 		= $sql_se['accesscodenoidia'];
	$secretnoidia 			= $sql_se['secretnoidia'];
	// 
	// Thông tin thẻ test: 
	// Loại tài khoản: Visa
	// Số thẻ: 4000000000000002 or 5313581000123430 
	// Date Exp: 05/21 
	// CVV/CSC: 123 
	// Street: Tran Quang Khai 
	// City/Town: Hanoi 
	// State/Province: North 
	// Postcode(zip code): 1234 
	// Country: VietNam 
	// 
	$accesscodequocte 	= $sql_se['merchantquocte'];
	$merchantquocte 	= $sql_se['accesscodequocte'];
	$secretquocte 		= $sql_se['secretquocte'];
	// 
	$type  = $type == 2 ? 2 : 1;
	$money = $tongtien;
	$donhang = $iddh;

	$array_config = array(
	    'gateway' => 1,
	    'URLNoidia' => 'https://mtf.onepay.vn/onecomm-pay/vpc.op?',
	    'AccessCodeNoidia' => $accesscodenoidia,
	    'MerchantNoidia' => $merchantnoidia,
	    'SecretNoidia' => $secretnoidia,
	    'URLQuocte' => 'https://mtf.onepay.vn/vpcpay/vpcpay.op?',
	    'AccessCodeQuocte' => $accesscodequocte,
	    'MerchantQuocte' => $merchantquocte,
	    'SecretQuocte' => $secretquocte,
	    'ReturnURL' => $full_url.'/thanh-toan-onepay/?id='.$iddh.'&type='.$type,
	    'TitlePayment' => 'VPC 3-Party',
	    'vpc_MerchTxnRef' => '',
	    'vpc_OrderInfo' => '',
	);
	

	if(isset($_GET['thanhtoan'])){
		$array_config['vpc_MerchTxnRef'] = $type."_" . rand();
	    $array_config['vpc_OrderInfo'] = $donhang;
	    $error['payment'] = 'onepay';
	    
	    if ($type == 1) {
	        $type = 'Inland';
	    }
	    $array_config['gateway'] = $type;
	    $onepay = new OnePay($array_config);
	    $url = $onepay->getUrlPayment($money);
	   	LOCATION_js($url);
	   	exit();
   	}
   	$kieu_type = @explode("_", $_GET['vpc_MerchTxnRef']);
   	$kieu_type = @$kieu_type[0];

   	if($kieu_type == 1){
	    $SECURE_SECRET 			= $secretnoidia;
	    $vpc_Txn_Secure_Hash 	= @$_REQUEST ["vpc_SecureHash"];
		unset ( $_REQUEST ["vpc_SecureHash"] );
		$errorExists 			= false;

		if (strlen ( $SECURE_SECRET ) > 0 && @$_REQUEST ["vpc_TxnResponseCode"] != "7" && @$_REQUEST ["vpc_TxnResponseCode"] != "No Value Returned") {
			ksort($_REQUEST);
		    $stringHashData = "";
			foreach ( $_REQUEST as $key => $value ) {
		        if ($key != "vpc_SecureHash" && (strlen($value) > 0) && ((substr($key, 0,4)=="vpc_") || (substr($key,0,5) =="user_"))) {
				    $stringHashData .= $key . "=" . $value . "&";
				}
			}
		    $stringHashData = rtrim($stringHashData, "&");	
			if (strtoupper ( $vpc_Txn_Secure_Hash ) == strtoupper(hash_hmac('SHA256', $stringHashData, pack('H*',$SECURE_SECRET)))) {
				$hashValidated = "CORRECT";
			} else {
				$hashValidated = "INVALID HASH";
			}
		} else {
			$hashValidated = "INVALID HASH";
		}

		$amount 			= @null2unknown ( $_REQUEST ["vpc_Amount"] );
		$locale 			= @null2unknown ( $_REQUEST ["vpc_Locale"] );
		$command 			= @null2unknown ( $_REQUEST ["vpc_Command"] );
		$version 			= @null2unknown ( $_REQUEST ["vpc_Version"] );
		$orderInfo 			= @null2unknown ( $_REQUEST ["vpc_OrderInfo"] );
		$merchantID 			= @null2unknown ( $_REQUEST ["vpc_Merchant"] );
		$merchTxnRef 			= @null2unknown ( $_REQUEST ["vpc_MerchTxnRef"] );
		$transactionNo 			= @null2unknown ( $_REQUEST ["vpc_TransactionNo"] );
		$txnResponseCode 			= @null2unknown ( $_REQUEST ["vpc_TxnResponseCode"] );
	}
	else if($kieu_type == 2){ //quoc te
		// 
		$SECURE_SECRET 			= $secretquocte;
		$vpc_Txn_Secure_Hash = $_GET["vpc_SecureHash"];
		$vpc_MerchTxnRef = $_GET["vpc_MerchTxnRef"];
		$vpc_AcqResponseCode = $_GET["vpc_AcqResponseCode"];
		unset($_GET["vpc_SecureHash"]);
		$errorExists = false;
		if (strlen($SECURE_SECRET) > 0 && $_GET["vpc_TxnResponseCode"] != "7" && $_GET["vpc_TxnResponseCode"] != "No Value Returned") {

			ksort($_GET);
			$md5HashData = "";
			foreach ($_GET as $key => $value) {
				if ($key != "vpc_SecureHash" && (strlen($value) > 0) && ((substr($key, 0,4)=="vpc_") || (substr($key,0,5) =="user_"))) {
				    $md5HashData .= $key . "=" . $value . "&";
				}
			}
			$md5HashData = rtrim($md5HashData, "&");
			if (strtoupper ( $vpc_Txn_Secure_Hash ) == strtoupper(hash_hmac('SHA256', $md5HashData, pack('H*',$SECURE_SECRET)))) {
				$hashValidated = "CORRECT";
			} 
			else {
				$hashValidated = "INVALID HASH";
			}
		} 
		else {
			$hashValidated = "INVALID HASH";
		}

		$amount = @null2unknown($_GET["vpc_Amount"]);
		$locale = @null2unknown($_GET["vpc_Locale"]);
		$batchNo = @null2unknown($_GET["vpc_BatchNo"]);
		$command = @null2unknown($_GET["vpc_Command"]);
		$message = @null2unknown($_GET["vpc_Message"]);
		$version = @null2unknown($_GET["vpc_Version"]);
		$cardType = @null2unknown($_GET["vpc_Card"]);
		$orderInfo = @null2unknown($_GET["vpc_OrderInfo"]);
		$receiptNo = @null2unknown($_GET["vpc_ReceiptNo"]);
		$merchantID = @null2unknown($_GET["vpc_Merchant"]);
		$merchTxnRef = @null2unknown($_GET["vpc_MerchTxnRef"]);
		$transactionNo = @null2unknown($_GET["vpc_TransactionNo"]);
		$acqResponseCode = @null2unknown($_GET["vpc_AcqResponseCode"]);
		$txnResponseCode = @null2unknown($_GET["vpc_TxnResponseCode"]);
		$verType = @array_key_exists("vpc_VerType", $_GET) ? $_GET["vpc_VerType"] : "No Value Returned";
		$verStatus = @array_key_exists("vpc_VerStatus", $_GET) ? $_GET["vpc_VerStatus"] : "No Value Returned";
		$token = @array_key_exists("vpc_VerToken", $_GET) ? $_GET["vpc_VerToken"] : "No Value Returned";
		$verSecurLevel = @array_key_exists("vpc_VerSecurityLevel", $_GET) ? $_GET["vpc_VerSecurityLevel"] : "No Value Returned";
		$enrolled = @array_key_exists("vpc_3DSenrolled", $_GET) ? $_GET["vpc_3DSenrolled"] : "No Value Returned";
		$xid = @array_key_exists("vpc_3DSXID", $_GET) ? $_GET["vpc_3DSXID"] : "No Value Returned";
		$acqECI = @array_key_exists("vpc_3DSECI", $_GET) ? $_GET["vpc_3DSECI"] : "No Value Returned";
		$authStatus = @array_key_exists("vpc_3DSstatus", $_GET) ? $_GET["vpc_3DSstatus"] : "No Value Returned";
		// 
	}

	if($hashValidated=="CORRECT" && $txnResponseCode=="0"){
		$transStatus = $glo_lang['thanh_toan_thanh_cong'];
		DB_que("UPDATE `#_order` SET `thanh_toan` = 1, `ma_paypal` = '".@$_GET["vpc_MerchTxnRef"]."' WHERE `id` = '".$orderInfo."' LIMIT 1 ");
		// $orderInfo
	}
	else{
		$transStatus = $glo_lang['thanh_toan_khong_thanh_cong'];
	}

	function null2unknown($data) {
		if ($data == "") {
			return "No Value Returned";
		} else {
			return $data;
		}
	}
	$bre  = $type == 1 ? $glo_lang['one_pay_noi_dia'] : $glo_lang['one_pay_quoc_te'];
    $donhang    = DB_fet("*", "#_order", "`id` = '".$iddh."'","", 1);
    $donhang    = mysql_fetch_assoc($donhang);
?>
<div class="link_pageload">
  <div class="pagewrap">
    <ul>
      <li><i class="fa fa-home"></i><a href="<?=$full_url ?>"><?=$glo_lang['trang_chu'] ?></a><span><i class="fa fa-angle-right"></i></span><a><?=$bre ?></a></li>
      <div class="clr"></div>
    </ul>
  </div>
</div>
<div class="pagewrap page_conten_page">
  <div class="title_page_id">
  	<?=$bre ?>
    <p style="font-size: 14px; color: red;"><?=$glo_lang['ma_dh'] ?>: <?=$madh ?>. <?=$donhang['thanh_toan'] == 1 ?$glo_lang['thanh_toan_thanh_cong'] :$glo_lang['thanh_toan_khong_thanh_cong'] ?></p>
  </div>
  <!--  -->
  <div class="kiemtra_donhang no_box">
    <ul>
      <div class="clr"></div>
      <div class="dv-load-hd-js-new dv-load-hd-js">
      	<div class="dv-table-reposive dv-thongtin-thanhtoan	 ">
      	<?=SHOW_text($thongtin_thanhtoan) ?></div> 
      </div>
    </ul>
  </div>
  <!--  -->
</div>

