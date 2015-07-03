<?php
/*
	@author hongxiaoqiang
	@email cool.hxq@gmail.com
	@desc 数据的打包解包接口封装
*/

function _read_fp($fp, $len, $type)
{
    $data = fread($fp, $len);
    $ret = unpack($type, $data);
    return $ret[1];
}

//uint8 
function pack_uint8($number)
{
    return pack("C", $number);
}
function unpack_uint8($fp)
{
    return _read_fp($fp, 1, "C");
}

//int8
function pack_int8($number)
{
    return pack("c", $number);
}
function unpack_int8($fp)
{
    return _read_fp($fp, 1, "c");
}

//uint16
function pack_uint16($number)
{
    return pack("S", $number);
}
function unpack_uint16($fp)
{
    return _read_fp($fp, 2, "S");
}

//int16
function pack_int16($number)
{
    return pack("s", $number);
}
function unpack_int16($fp)
{
    return _read_fp($fp, 2, "s");
}

//uint32
function pack_uint32($number)
{
    return pack("L", $number);
}
function unpack_uint32($fp)
{
    return _read_fp($fp, 4, "L");
}

//int32
function pack_int32($number)
{
    return pack("l", $number);
}
function unpack_int32($fp)
{
    return _read_fp($fp, 4, "l");
}

//string
//同时会在前面打包字符串的长度(uint32)
function pack_string($str)
{
    $len = strlen($str);
    $ret = pack_uint32($len);
    $ret .= $str;
    return $ret;
}

function unpack_string($fp)
{
    $length = unpack_uint32($fp);
    if ($length == 0)
    {
        $ret = '';
        return $ret;
    }

    $ret = '';
    $len = $length;
    while ($len > 0)
    {
        if ($len > 8192)
        {
            $ret .= fread($fp, 8192);
        }
        else
        {
            $ret .= fread($fp, $len);
        }

        $len = $length - strlen($ret);
    }

    return $ret;
}

//定长string
function pack_fixed_string($str, $length)
{
    $len = strlen($str);
    if ($len <= $length)
    {
        $ret = $str;
        $remain = $length - $len;
        for ($i = 0; $i < $remain; $i++)
        {
            $ret .= pack_uint8(0);
        }
    }
    else
    {
        //no data
        $ret = '';
        for ($i = 0; $i < $length; $i++)
        {
            $ret .= pack_uint8(0);
        }
    }

    return $ret;
}

function unpack_fixed_string($fp, $length)
{
    if ($length == 0)
    {
        $ret = '';
        return $ret;
    }

    $ret = '';
    $len = $length;
    while ($len > 8192)
    {
        $ret .= fread($fp, 8192);
        $len -= 8192;
    }
    $ret .= fread($fp, $len);

    return $ret;
}
?>
