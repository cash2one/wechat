<?php
/*
	@author hongxiaoqiang
	@email cool.hxq@gmail.com
	@desc 一些全局的函数定义
*/
require_once "global_define.php";
require_once "config.php";

function server_logger($log_content)
{
    global $logdir;
	if(isset($_SERVER['HTTP_APPNAME']))
    {   //SAE
    	sae_set_display_errors(false);
    	sae_debug($log_content);
    	sae_set_display_errors(true);
    }else if($_SERVER['REMOTE_ADDR'] != "127.0.0.1")
    { //LOCAL
    	$max_size = 10000;
    	$log_filename = $logdir . "/log" . date("Ymd-H") . ".xml";
    	if(file_exists($log_filename) and (abs(filesize($log_filename)) > $max_size)){unlink($log_filename);}
    	file_put_contents($log_filename, date('H:i:s')." ".$log_content."\r\n", FILE_APPEND);
    }
}

?>
