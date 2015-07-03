<?php
session_start();

require_once "../global_func.php";
require_once "../global_define.php";
require_once "../request.php";

$zone_id = $_POST['zone'];
$role_id = $_POST['role'];
$open_id = $_SESSION['open_id'];
server_logger("[绑定操作], zone=" . $zone_id . " role=" . $role_id . " open_id=" . $open_id);

global $MSG_TYPE_BIND_ROLE;
$msgtype = $MSG_TYPE_BIND_ROLE;
$data = "申请从微信中绑定游戏角色";
$result = request($msgtype, $zone_id, $role_id, $data);
if (! $result)
{
    echo "bind failed, maybe connected game server failed ";
}
else
{
    echo "bind success";
}

/*
<html>
<body>
zone is <?php echo $_POST["zone"]; ?><br>
name is <?php echo $_POST["role"]; ?><br>
openid is <?php echo $_SESSION['open_id']; ?><br>
</body>
</html>
 */

?>

