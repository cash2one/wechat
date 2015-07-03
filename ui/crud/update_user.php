<?php

$id = intval($_REQUEST['id']);
$keywords = $_REQUEST['keywords'];
$article = $_REQUEST['article'];

include 'conn.php';

#$sql = "update users set firstname='$firstname',lastname='$lastname',phone='$phone',email='$email' where id=$id";
$sql = "update tb_kewords_article set keywords='$keywords',article='$article' where id=$id";
@mysql_query($sql);
echo json_encode(array(
	'id' => $id,
    'keywords' => $keywords,
    'article' => $article,
));
?>
