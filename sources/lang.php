<?php
	if($thongtin['is_lang'] == 1){
	$las_url    = "";
	if($motty  != "") $las_url    .= "/".$motty;
	if($haity  != "") $las_url    .= "/".$haity;
	if($baty   != "") $las_url    .= "/".$baty;
	if($bonty  != "") $las_url    .= "/".$bonty;
	if($namty  != "") $las_url    .= "/".$namty;
	// if($lang == "vi"){
?>
<div class="dropdown">
	<?php if($lang == "vi"){ ?>
    <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <a><img src="images/icon/vn.png"><span>Việt Nam <i class="fa fa-caret-down"></i></span></a>
    </button>
<?php }else { ?>
	<button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <a><img src="images/icon/eng.png"><span>English <i class="fa fa-caret-down"></i></span></a>
    </button>
<?php } ?>
    <button class="dropdown-menu" aria-labelledby="dropdownMenu1">
        <li><a href="<?=$fullpath.$las_url."/?actilang=true" ?>"><img src="images/icon/vn.png"><span>Việt Nam</span></a></li>
        <li><a href="<?=$fullpath.'/en'.$las_url."/?actilang=true" ?>"><img src="images/icon/eng.png"><span>English</span></a></li>
    </button>
</div>
<?php } ?>