<?php
/*
	@author hongxiaoqiang
	@email cool.hxq@gmail.com
	@desc 向游戏区请求区列表
*/

require_once "global_func.php";
require_once "global_define.php";
require_once "request.php";

function get_zonelist()
{
    $xml = simplexml_load_file('config/zonelist.xml');
    if (! $xml)
    {
        return 'unable to load zonelist.xml';
    }

    $result = '';
    foreach ($xml->zone as $zone)
    {
        $result .= $zone["id"] . " " . $zone["name"] . "\n";
    }
    return $result;
}

function get_zonelist_fromserver()
{
    var_dump("geting zonelist");
    global $MSG_TYPE_GET_ZONES;
    $msgtype = $MSG_TYPE_GET_ZONES;
    $zoneid = 0;
    $charid = 0;
    $data = "";
    $result = request($msgtype, $zoneid, $charid, $data);

    //这里需要对result检查 todo
    $zoneinfo = new msg_ZoneInfo();
    $zoneinfo->read($result);

    for ($i = 0; $i < count($zoneinfo->zones); $i++)
    {
        $item = $zoneinfo->zones[$i];
        $idname = $item->zoneid . "," . $item->zonename;
        echo $idname;
    }
}
?>
