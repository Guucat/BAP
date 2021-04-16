<?php


namespace app\api\controller;

use think\Db;


class User extends Common
{
    /* 注册 */
    public function register()
    {
        //接收参数
        $data = $this->params;
        //检查验证码
        //$this->check_code($data['user_name'], $data['code']);
        //检查用户名
        $user_name_type = $this->check_username($data['user_name']);
        switch ($user_name_type) {
            case 'phone':
                $this->check_exist($data['user_name'], 'phone', '0');
                $data['user_phone'] = $data['user_name'];
                break;
            case 'email':
                $this->check_exist($data['user_name'], 'email', '0');
                $data['user_email'] = $data['user_name'];
                break;
        }
        //将用户信息写入数据库
        unset($data['user_name']);
        unset($data['code']);
        //$data['create_time'] = time(); //register time
        $data['user_role'] = '普通用户';
        $res = Db::table('iip_user')->insert($data);
        if (!$res) {
            $this->return_msg(400, '用户注册失败!');
        } else {
            $this->return_msg(200, '用户注册成功');
        }

    }
    /* 登录 */
    public function login(){
//      $this->check_time($this->request->only('time','post'));//验证时间戳
//      $this->check_token($this->request->param());//验证token
        #$this->check_params($this->request->except(['time','token']));//验证其他参数
        $data = $this->params;//过滤后的参数数组
        /*判断user_name是邮箱还是手机号，其他情况已经在check_username()返回*/
        $user_name_type = $this->check_username($data['user_name']);
        if($user_name_type=='email'){
            $userInfo = Db::table('iip_user')->where('user_email',$data['user_name'])->findOrEmpty();
        }
        elseif($user_name_type=='phone'){
            $userInfo = Db::table('iip_user')->where('user_phone',$data['user_name'])->findOrEmpty();
        }
        if(empty($userInfo)){
            $this->return_msg(400,'用户名不存在');
        }else{//验证密码是否正确
            if($userInfo['user_pwd'] == $data['user_pwd']){
                $this->return_msg(200,'登录成功',$userInfo);
            }else {
                $this->return_msg(400,'密码输入错误');
            }
        }
    }
}
