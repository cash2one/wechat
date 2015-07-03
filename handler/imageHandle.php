<?php
/*
	@author hongxiaoqiang
	@email cool.hxq@gmail.com
	@desc 图片处理
*/
require_once "wechatsdk/wechat.class.php"; 

function deal($weObj)
{
	$weObj->text("想看更多美图么，请继续关注我吧")->reply();
}

?>
