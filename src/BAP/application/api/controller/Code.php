<?php

namespace app\api\controller;


class Code extends Common
{
    /* 取到手机或邮箱验证码 */
    public function get_code()
    {
        $username = $this->params['username'];
        $exist = $this->params['is_exist'];
        $username_type = $this->check_username($username);
        switch ($username_type) {
            case 'phone':
                $this->get_code_by_username($username, 'phone', $exist);
                break;
            case 'email':
                $this->get_code_by_username($username, 'email', $exist);
                break;
        }
    }

    /* 通过手机或者邮箱获取验证码 */
    public function get_code_by_username($username, $type, $exist)
    {
        if ($type == 'phone') {
            $type_name = '手机';
        } else {
            $type_name = '邮箱';
        }
        //监测手机号是否存在
        $this->check_exist($username, $type, $exist);
        //监测验证码请求频率 30s一次
        if (session("?" . $username . '_last_send_time')) {
            if (time() - session($username . '_last_send_time') < 30) {
                $this->return_msg(400, $type_name . '验证码每30秒只能发送一次！');
            }
        }
        //生成验证码
        $code = $this->make_code(6);
        //使用session存储验证码，便于比对，md5加密
        //$md5_code = md5($username.'_'.md5($code));

        $iterations = 1000; //加密参数iterations
        $salt_code = "iip"; //加密参数salt
        $hash_code = hash_pbkdf2("sha256", $code, $salt_code, $iterations, 32);
        //使用session存储验证码
        session($username . '_code', $hash_code);
        //使用session存储验证码发送时间
        session($username . '_last_send_time', time());
        //发送验证码
        if ($type == 'phone') {
            $this->send_code_to_phone($username, $code);
        } else {
            $this->send_code_to_email($username, $code);
        }
    }

    /* 随机生成验证码 */
    public function make_code($num)
    {
        $max = pow(10, $num) - 1;
        $min = pow(10, $num - 1);
        return rand($min, $max);
    }

    /* 向手机发送验证码 */
    public function send_code_to_phone()
    {
        echo "send to phone";
    }

    /* 向邮箱发送验证码 */
    public function send_code_to_email()
    {
        echo "send to email";
    }

}
