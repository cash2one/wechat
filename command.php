<?php
/*
	@author hongxiaoqiang
	@email cool.hxq@gmail.com
	@desc 消息定义
*/
require_once "pack_unpack.php";


//消息类型定义
$MSG_TYPE_SEND_MAIL = 1;    //发送邮件
$MSG_TYPE_GET_ZONES = 2;    //获取区列表
$MSG_TYPE_BIND_ROLE = 3;    //绑定角色

class stZoneItem
{
    public $zoneid;
    public $zonename;

    public function read($data)
    {
        global $MAX_NAMESIZE;
        $this->zoneid = unpack_uint16($data);
        $this->zonename = unpack_fixed_string($data, $MAX_NAMESIZE);
    }
}

class msg_ZoneInfo
{
    public $zonecount;
    public $zones;      //array()

    public function read($data)
    {
        $this->zonecount = unpack_uint32($data);
        for ($i = 0; $i < $this->zonecount; $i++)
        {
            $item = new stZoneItem();
            $item->read($data);
            $this->zones[] = $item;
        }
    }
}

?>
