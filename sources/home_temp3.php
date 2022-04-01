<ul>
	<a <?=full_href($rows) ?>>
	<li><?=!empty($view) && $view  == "slider" ? '<img src="'.full_src($rows).'" alt="'.SHOW_text($rows['tenbaiviet_'.$lang]).' title="'.SHOW_text($rows['tenbaiviet_'.$lang]).'">' : full_img($rows) ?></li>
	<h3><?=SHOW_text($rows['tenbaiviet_'.$lang]) ?></h3>
</a>
</ul>
<ul>
	<li><a href="index.php?page=sanpham_view"><img src="delete/sanpham/5.jpg" width="400" height="400" /></a></li>
	<h3><a href="index.php?page=sanpham_view">cà phê rang mộc 100% không phối</a></h3>
	<p>Thơm nồng nàn, đậm đà, khó quên</p>
	<h4>Giá: <span>46.000</span> đ/gói 250gr</h4>
</ul>