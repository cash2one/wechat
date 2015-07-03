<?php

require_once "../db.php";

$db = new mysql_db();
$connid = $db->connect('127.0.0.1', 'hxq', '123456', 'wechat');
if (!$connid)
{
    echo "连接数据库失败";
    exit;
}

$data = "insert into tb_auto_news values(null, 'title2','desc','xxx.jpg','http://www.baidu.com')";

//$ret = $db->query("select * from `user`");
$ret = $db->query($data);
var_dump($ret);
//var_dump($db->get_num_rows() );
//var_dump($db->fetch_row() );
//var_dump($db->fetch_row() );
//var_dump($db->get_affected_rows());

$db->close();
?>
