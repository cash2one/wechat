<?php
/*
	@author hongxiaoqiang
	@email cool.hxq@gmail.com
	@desc mysql驱动
*/

class mysql_db
{
    function connect($host, $user, $passwd, $dbname)
    {
        $this->connid = mysql_connect($host, $user, $passwd);
        if ($this->connid)
        {
            if (mysql_select_db($dbname))
            {
                return $this->connid;
            }
            else
            {
                return $this->error();
            }
        }
        else
        {
            return $this->error();
        }
    }

    function error()
    {
        if (mysql_error() != '')
        {
            return '<b>MYSQL Error</b>:' . mysql_error() . '<br/>';
        }
    }

    function query($query)
    {
        if ($query != NULL)
        {
            $this->query_result = mysql_query($query, $this->connid);
            if (!$this->query_result)
            {
                return $this->error();
            }
            else
            {
                return $this->query_result;
            }
        }
        else
        {
            return '<b>MySQL Error</b>: Empty Query!';
        }
    }

    function get_num_rows($query_id = "")
    {
        if($query_id == NULL)
        {
            $return = mysql_num_rows($this->query_result); 
        }
        else
        {
            $return = mysql_num_rows($query_id);
        }
        if(!$return)
        {
            $this->error();
        }
        else
        {
            return $return;
        }
    }

    function fetch_row($query_id = "")
    {
        if($query_id == NULL)
        {
            $return = mysql_fetch_array($this->query_result); 
        }
        else
        {
            $return = mysql_fetch_array($query_id);
        }
        if(!$return)
        {
            $this->error();
        }
        else
        {
            return $return;
        }
    }

    function get_affected_rows($query_id = "")
    {
        if($query_id == NULL)
        {
            $return = mysql_affected_rows($this->query_result); 
        }
        else
        {
            $return = mysql_affected_rows($query_id);
        }
        if(!$return)
        {
            $this->error();
        }
        else
        {
            return $return;
        }
    }

    function close()
    {
        if ($this->connid)
        {
            return mysql_close($this->connid);
        }
    }
}
?>
