<?php
/* Google App Client Id */
define('CLIENT_ID', $thongtin['gg_client_id']);
/* Google App Client Secret */
define('CLIENT_SECRET', $thongtin['gg_client_secret']);
/* Google App Redirect Url */
define('CLIENT_REDIRECT_URL', $thongtin['gg_url']);


class GoogleLoginApi
{
	public function GetAccessToken($client_id, $redirect_uri, $client_secret, $code) {	
		$url = 'https://accounts.google.com/o/oauth2/token';			
		
		$curlPost = 'client_id=' . $client_id . '&redirect_uri=' . $redirect_uri . '&client_secret=' . $client_secret . '&code='. $code . '&grant_type=authorization_code';
		$ch = curl_init();		
		curl_setopt($ch, CURLOPT_URL, $url);		
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);		
		curl_setopt($ch, CURLOPT_POST, 1);		
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $curlPost);	
		$data = json_decode(curl_exec($ch), true);
		$http_code = curl_getinfo($ch,CURLINFO_HTTP_CODE);		
		if($http_code != 200) 
			throw new Exception('Error : Failed to receieve access token');
			
		return $data;
	}

	public function GetUserProfileInfo($access_token) {	
		// $url = 'https://www.googleapis.com/plus/v1/people/me';	
		$url = 'https://www.googleapis.com/oauth2/v1/userinfo?alt=json';
		
		$ch = curl_init();		
		curl_setopt($ch, CURLOPT_URL, $url);		
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer '. $access_token));
		$data = json_decode(curl_exec($ch), true);
		$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);		
		if($http_code != 200) 
			throw new Exception('Error : Failed to get user information');
			
		return $data;
	}
}

if(isset($_GET['code'])) {
	try {
		$gapi = new GoogleLoginApi();
		
		// Get the access token 
		$data = $gapi->GetAccessToken(CLIENT_ID, CLIENT_REDIRECT_URL, CLIENT_SECRET, $_GET['code']);
		
		// Get user information
		$user_info = $gapi->GetUserProfileInfo($data['access_token']);

		// echo '<pre>';print_r($user_info); echo '</pre>';

		$id 			= $user_info['id'];
		// $hoten 			= $user_info['displayName'];
		$hoten 			= $user_info['name'];
		// $hinhanh 		= $user_info['image']['url'];
		$hinhanh 		= $user_info['picture'];
		// $email 			= $user_info['emails'][0]['value'];
		$email 			= $user_info['email'];

		$check_fb = DB_que("SELECT * FROM `#_members` WHERE `email` = '".$email."' LIMIT 1");
		if(!DB_num($check_fb)) {
		  $tentruycap = md5($user['id'].time());

		  DB_que("INSERT INTO `#_members`(`tentruycap`, `matkhau`, `hoten`, `email`, `id_google`,`google_icon`) VALUES('$tentruycap', '$tentruycap','".$hoten."','".$email."','".$id."', '$hinhanh')");
		  $_SESSION['id']    = DB_que_id();
		}
		else {
		
		  DB_que("UPDATE `#_members` SET `tentruycap` = '$tentruycap', `hoten` = '".$hoten."', `email` = '".$email."', `google_icon` = '$hinhanh' WHERE `email` = '".$email."'");
		  $check_fb = DB_arr($check_fb, 1);
		  if($check_fb ['showhi'] != 1){
		    ALERT_js($glo_lang['tai_khoan_da_bi_khoa']);
		    LOCATION_js($full_url);
		    exit();
		  }
		  $_SESSION['id']    = $check_fb["id"];
		}



		header("Location: ".$full_url);  

		// Now that the user is logged in you may want to start some session variables
 
		// You may now want to redirect the user to the home page of your website
		// header('Location: home.php');
		exit();
	}
	catch(Exception $e) {
		echo $e->getMessage();
		exit();
	}
}

header('Location: https://accounts.google.com/o/oauth2/v2/auth?scope=' . urlencode('https://www.googleapis.com/auth/userinfo.profile https://www.googleapis.com/auth/userinfo.email https://www.googleapis.com/auth/plus.me') . '&redirect_uri=' . urlencode(CLIENT_REDIRECT_URL) . '&response_type=code&client_id=' . CLIENT_ID . '&access_type=online');
?>