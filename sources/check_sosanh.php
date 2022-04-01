<style type="text/css">
div.dv-check-sosanh.ok { top: 97px; right: 20px; opacity: 1!important; display: block!important; z-index: 150; width: 40px; height: 40px; background-size: 100%; -webkit-transition: all .3s; -moz-transition: all .3s; transition: all .3s; text-align: center; line-height: 37px; font-size: 18px; }
div.dv-check-sosanh { position: fixed; top: 92px; right: 25px; z-index: -1; opacity: 0; width: 50px; height: 50px; background-size: 100%; -webkit-transition: all .5s; -moz-transition: all .5s; transition: all .5s; background: #2a1572; border-radius: 100px; line-height: 46px; text-align: center; font-size: 25px; color: #fff; }
div.dv-check-sosanh a.dv-check-sosanh-a { position: absolute; top: -5px; right: -5px; width: 18px; height: 18px; line-height: 18px; font-size: 13px; background: #da251e; color: #fff; font-family: Arial; font-weight: 600; border-radius: 100px; }
.p_sosanh.acti i { color: yellow; }.dv-check-sosanh i { color: #fff; }
.dv-class-sosanh { background: #fff; width: 100%; overflow: hidden}
.dv-class-sosanh-cont td { max-width: 300px; position: relative; min-width: 200px; }
.dv-class-sosanh-cont img { width: 100%; height: auto; float: left; }
.dv-class-sosanh-cont { margin: 10px; width: calc(100% - 20px); overflow-x: auto; }
.dv-class-sosanh-cont .a_xoa_sp_ss { position: absolute; top: 10px; right: 10px; background: #000000ad; width: 26px; height: 26px; line-height: 24px; text-align: center; border-radius: 100px; color: #fff; font-size: 14px; }
.dv-class-sosanh-cont .a_xoa_sp_ss:hover { background: #da251e;  }
</style>
<div class="dv-check-sosanh">
    <a href="<?=$full_url."/danh-sach-so-sanh" ?>"><i class="fa fa-retweet"></i></a>
    <a class="dv-check-sosanh-a" href="<?=$full_url."/danh-sach-so-sanh" ?>">
        <span class="num">0</span>
    </a>
</div>
<script type="text/javascript">
  function load_sosanh(id){
    $(".dv-check-sosanh").removeClass("ok");

    if($(".p_sosanh_"+id).length) {
      if($(".p_sosanh_"+id).hasClass("acti")){$(".p_sosanh_"+id).removeClass("acti");}
      else $(".p_sosanh_"+id).addClass("acti");
    }
    var cook_yt = getCookie('sp_sosanh');

    var list_new_cont = 0;
    if(cook_yt  == null || cook_yt  == '') {cook_yt = id; list_new_cont = 1;}
    else {
      list_new      = cook_yt.split(",");
      var cook_yt   = "";
      if($(".p_sosanh_"+id).length && $(".p_sosanh_"+id).hasClass("acti")) {
        cook_yt   = id; list_new_cont++;
      }
      list_new.forEach(function(key){
        if(key != id){
          if(cook_yt == "") {  cook_yt += key;} else {cook_yt += "," + key;}
          list_new_cont++;
        }
      });

    }
    if(list_new_cont > 0) {$(".dv-check-sosanh-a .num").html(list_new_cont);$(".dv-check-sosanh").addClass("ok");}
    setCookie('sp_sosanh', cook_yt, 365);
  }

  $(function(){
  <?php
    if(isset($_COOKIE['sp_sosanh']) && $_COOKIE['sp_sosanh'] != ''){
      $cooke = explode(",", $_COOKIE['sp_sosanh']);
      foreach ($cooke as $ke) {
        if($ke == "") continue;
        echo '$(".p_sosanh_'.$ke.'").addClass("acti");';
      }
      if(count($cooke) > 0){
        echo '$(".dv-check-sosanh-a .num").html('.count($cooke).'); $(".dv-check-sosanh").addClass("ok");';
      }
    }
  ?>
  })
</script>