<?php
/*
	@author hongxiaoqiang
	@email cool.hxq@gmail.com
	@desc 消息请求
*/
require_once "global_define.php";
require_once "global_func.php";
require_once "command.php";


function request($msgtype, $zoneid, $charid, $data, $nickname="")
{
    global $masterIP,$masterPort;
    server_logger("[游戏服务器请求],msgtype=". $msgtype . ",zoneid=" . $zoneid . ",charid=" . $charid . ",nickname=" . $nickname);
    return _send_request($masterIP, $masterPort, $msgtype, $zoneid, $charid, $data, $nickname);
}

function _send_request($ip, $port, $msgtype, $zoneid, $charid, $data, $nickname="")
{
    $fp = stream_socket_client("tcp://$ip:$port", $errno, $errstr, 2);  //timeout=2
    if (!$fp)
    {
        server_logger("stream_socket_client error:" . $errno . "-" . $errstr);
        return false;
    }
    else
    {
        global $MAX_NAMESIZE;
        $msg = pack_uint8(1);   //主消息号
        $msg .= pack_uint8(2);  //次消息号
        $msg .= pack_uint16($msgtype);  //消息类型
        $msg .= pack_uint16($zoneid);
        $msg .= pack_uint32($charid);
        $msg .= pack_fixed_string($nickname, $MAX_NAMESIZE);
        $msg .= pack_string($data);

        //add prefix of msg
        $send_data = pack_uint16(strlen($msg)); //包长度
        $send_data .= pack_uint16(0);           //无加密无压缩
        $send_data .= $msg;
        fwrite($fp, $send_data);
        server_logger("[fwite]" . $send_data);

        unpack_uint16($fp);
        unpack_uint16($fp);
        unpack_uint8($fp);
        unpack_uint8($fp);
        $cur_count = unpack_uint32($fp);
        $total_count = unpack_uint32($fp);
        $result = unpack_string($fp);

        while ($cur_count < $total_count)
        {
            unpack_uint16($fp);
            unpack_uint16($fp);
            unpack_uint8($fp);
            unpack_uint8($fp);
            $cur_count = unpack_uint32($fp);
            $total_count = unpack_uint32($fp);
            $result .= unpack_string($fp);
        }

        fclose($fp);

        return $result;
    }
}
?>
