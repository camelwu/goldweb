<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Valid
{


    public function is_date($date, $msg, $option)
    {
        if (empty($msg)) {
            $msg ="日期格式不合法";
        }
        if (empty($date)) {
            return null;
        }
        $defaultFormats = array("Y-m-d", "Y/m/d", "Y-m-d\TH:i:s", "Y-m-d H:i:s");

        $unixTime = strtotime($date);
        if (!$unixTime) { //strtotime转换不对，日期格式显然不对。
            return $msg;
        }
        if (!empty($option) && !empty($option["format"])) {
            if (date($option["format"], $unixTime) == $date) {
                return null;
            }
        } else {
            //校验日期的有效性，只要满足其中一个格式就OK
            foreach ($defaultFormats as $f) {
                if (date($f, $unixTime) == $date) {
                    return null;
                }
            }
        }

        return $msg;
    }

    public function is_number($str, $msg, $option)
    {
        if (empty($msg)) {
            $msg ="数字格式不合法";
        }
        if (empty($str)) {
            return null;
        }
        return (preg_match("/^[0-9]*$/", $str)) ? null : $msg;
    }

    public function is_float($str, $msg, $option)
    {
        if (empty($msg)) {
            $msg ="浮点型数字格式不合法";
        }
        if (empty($str)) {
            return null;
        }
        return (preg_match("/^[-\\+]?\\d+(\\.\\d+)?$/", $str)) ? null : $msg;
    }

    public function is_email($str, $msg, $option)
    {
        if (empty($msg)) {
            $msg ="邮件格式不合法";
        }
        if (empty($str)) {
            return null;
        }
        return (preg_match("/^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/", $str)) ? null : $msg;
    }

    public function is_name($str, $msg, $option)
    {
        if (empty($msg)) {
            $msg ="姓名只能包含中文和字母";
        }
        if (empty($str)) {
            return null;
        }
        return (preg_match("/^[\x{4e00}-\x{9fa5}a-zA-Z]*$/u", $str)) ? null : $msg;
    }

    public function is_phone_number($str, $msg, $option)
    {
        if (empty($msg)) {
            $msg ="手机号格式不合法";
        }
        if (empty($str)) {
            return null;
        }
        return (preg_match("/^(13[0-9]{9})|(18[0-9]{9})|(14[0-9]{9})|(17[0-9]{9})|(15[0-9]{9})$/", $str)) ? null : $msg;
    }

    public function not_empty($str, $msg, $option)
    {
        if (empty($msg)) {
            $msg ="不能为空";
        }
        if (empty($str)) {
            return $msg;
        }
        return null;
    }


    /**
     * 判断array是否合法, 支持的表达式有
     * 一级节点, 如 "a" => array("is_name", "a不是名称!", null)
     * 多级节点, 如 "m.n.x.y" => array("not_empty", "m.n.x.y不能为空")
     * 数组对象节点, 如 "f[].aa" => array("not_empty", "数组f中每个元素的aa属性不能为空")
     * 纯数组节点, 如 "g[]" => array("is_number", "数组g中的每个元素必须是数字!")
     * 例如:
     * var_dump($this->valid->invoke($_POST, array(
     *     "a" => array("is_name", "a不是名称!", null),
     *     "b" => array(
     *         array("not_empty", "b不能为空!"),
     *         array("is_number", "b不是数字!")
     *     ),
     *     "c.d" => array("is_date", "c.d不是日期!"),
     *     "m.n.x.y" => array("not_empty", "m.n.x.y不能为空"),
     *     "f[].aa" => array("not_empty", "数组f中每个元素的aa属性不能为空"),
     *     "g[]" => array("is_name", "数组g中的每个元素都仅可包含字母和中文!")
     * )));
     *
     * ajax发送的请求如下:
     * $.ajax({
     *     type: "POST",
     *     url: "/hotelticket/test",
     *     data: {
     *         a: 'asdf'
     *         b: '111',
     *         c: {
     *             d: '2016-09-10T10:30:00',
     *             e: 4
     *         },
     *         m : {
     *             n: {
     *                 x: {
     *                     y: '123'
     *                 }
     *             }
     *         },
     *         f: [{
     *             aa:123,
     *             bb:123
     *         }, {
     *             aa:123,
     *             bb:123
     *         }],
     *         g: ['a', 'b', '中文1']
     *     },
     *     async: true,//是否是异步
     *     cache: false,//是否带缓存
     *     success: function (res) {
     *         console.log(arguments);
     *     },
     *     error: function (res) {
     *         console.log(arguments);
     *     }
     * })
     *
     * @param $obj
     * @param $rules
     * @return null|string
     */
    public function invoke($obj, $rules)
    {

        foreach ($rules as $key => $option) {

            // 判断校验条件是否是数组
            if (is_array($option[0])) {
                foreach ($option as $opt) {
                    $rst = $this->invoke_one($obj, $key, $opt);
                    if ($rst) return $rst;
                }
            } else {
                $rst = $this->invoke_one($obj, $key, $option);
                if ($rst) return $rst;
            }
        }

        return null;
    }

    private function invoke_one($obj, $key, $option) {
        $type = $option[0];
        $msg = count($option) > 1 ? $option[1] : null;
        $opt = count($option) > 2 ? $option[2] : null;

        $value = $obj;
        $arr = explode(".", $key);
        $arr_len = count($arr);
        for ($i=0; $i<$arr_len; $i++) {
            $v = $arr[$i];
            if (empty($value)) {
                break;
            }
            $is_arr = strpos($v, "[]");
            if ($is_arr) $v = substr($v, 0, -2);

            $value = empty($value[$v]) ? null : $value[$v];

            if ($is_arr && $value) {
                // 拼接当前节点的后续节点
                $sub_key = null;
                for ($j = $i+1; $j < $arr_len; $j++) {
                    if ($sub_key) {
                        $sub_key = $sub_key . "." . $arr[$j];
                    } else {
                        $sub_key = $arr[$j];
                    }
                }
                // 根据有无后续节点遍历数组
                if ($sub_key) {
                    // 数组有后续节点, 如: a[].b
                    foreach ($value as $v2) {
                        $rst = $this->invoke_one($v2, $sub_key, $option);
                        if ($rst) return $rst;
                    }
                } else {
                    // 数组没有后续节点, 如: a[]
                    foreach ($value as $v2) {
                        $rst = $this->invoke_switch($type, $v2, $msg, $opt);
                        if ($rst) return $rst;
                    }
                }
                return null;
            }
        }
        return $this->invoke_switch($type, $value, $msg, $opt);
    }
    private function invoke_switch($type, $value, $msg, $opt) {
        switch ($type) {
            case "not_empty" :
                $rst = $this->not_empty($value, $msg, $opt);
                if ($rst != null) {
                    return $rst;
                }
                break;
            case "is_date" :
                $rst = $this->is_date($value, $msg, $opt);
                if ($rst != null) {
                    return $rst;
                }
                break;
            case "is_number" :
                $rst = $this->is_number($value, $msg, $opt);
                if ($rst != null) {
                    return $rst;
                }
                break;
            case "is_float" :
                $rst = $this->is_float($value, $msg, $opt);
                if ($rst != null) {
                    return $rst;
                }
                break;
            case "is_email" :
                $rst = $this->is_email($value, $msg, $opt);
                if ($rst != null) {
                    return $rst;
                }
                break;
            case "is_name" :
                $rst = $this->is_name($value, $msg, $opt);
                if ($rst != null) {
                    return $rst;
                }
                break;
            case "is_phone_number" :
                $rst = $this->is_phone_number($value, $msg, $opt);
                if ($rst != null) {
                    return $rst;
                }
                break;
        }
        return null;
    }
}

