<?php

namespace app\api\controller;

use think\Controller;
use think\Db;
use \think\facade\Validate;
use think\facade\Request;

class Common extends Controller
{
    protected $request; //处理参数
    protected $validater;   //验证数据和参数
    protected $params;  //过滤后符合要求的参数
    protected $rules = array(
        'User' => array(
            'login' => array(
                'user_name' => ['require', /*'chsDash',*/ 'max' => 20],
                'user_pwd' => ['require', 'length:0,32']//方便调试暂时改为(0,32)位
            ),
            'register' => array(
                'user_name' => ['require'],
                'user_pwd' => ['require', 'length:32'],
                'code' => ['require', 'length:6', 'number']
            )
        ),
        'Code' => array(
            'get_code' => array(
                'username' => ['require'],
                'is_exist' => ['require', 'number', 'length:1']
            )
        ),
        'Link' => array(
            'source'=>array(
                'source_id'=> ['require','number','length:0,3'],
            ),
            'tool' => array(
                'tool_id'=>['require','number','length:0,3'],
            )
        ),
        'Microbe'=>array(
            'microbe_info' => array(
                'microbe_id'=>['require','number','length:0,3'],),
            'update_microbe_info' => array(),
        ),
        'Classification'=>array(
            'classification_info' => array(
                'microbe_id'=>['require','number','length:0,3'],),
            'update_classification_info' => array(),
        ),
        'Reference'=>array(
            'reference_info' => array(
                'ref_id'=>['require','number','length:0,3'],),
            'update_reference_info' => array(),
        ),
        'Allmicrobe'=>array(
            'all_microbe_info' => array(
                'microbe_id'=>['require','number','length:0,3'],),
            'update_all_microbe_info' => array(),
        ),
        'Receptor'=>array(
            'receptor_info' => array(
                'receptor_id'=>['require','number','length:0,3'],),
            'update_receptor_info' => array(),
        ),
        'Antigen'=>array(
            'antigen_info' => array(
                'antigen_id'=>['require','number','length:0,3'],),
            'update_antigen_info' => array(),
        ),
        'Antibody'=>array(
            'antibody_info' => array(
                'antibody_id'=>['require','number','length:0,3'],),
            'update_antibody_info' => array(),
        ),
        'Vaccine'=>array(
            'vaccine_info' => array(
                'vaccine_id'=>['require','number','length:0,3'],),
            'update_vaccine_info' => array(),
        ),
        'Clinicaltesting'=>array(
            'clinical_testing_info' => array(
                'testing_id'=>['require','number','length:0,3'],),
            'update_clinical_testing_info' => array(),
        ),
        'Test'=>array(
            'test_get' => array(
                'microbe_id'=>['require','number','length:0,3'],),
            'solve_bug' => array(
                'antibody_id'=>['require','number','length:0,3'],),
            'test_select' => array(),
            'test_json' => array(),
            'solve_bugg' => array(),
            'test_re' => array(
                'test_id'=>['require','number','length:0,3'],),
        ),
    );

    /* 初始化 */
    protected function initialize()
    {
        parent::initialize();
        $this->request = Request::instance(); #实例化
        #$this->check_time($this->request->only('time','post'));
        #$this->check_token($this->request->param());
        $this->check_params($this->request->except(['time', 'token']));
    }

    /* 验证时间戳，防止非法请求 */
    public function check_time($arr)
    {
        #注意intval方法
        if (!isset($arr['time']) || intval($arr['time']) <= 1) {
            $this->return_msg(400, '时间戳不存在!');
        }
        if (time() - $arr['time'] > 60) {
            $this->return_msg(400, '请求超时');
        }
    }

    /* 验证token,防止外部人员篡改数据 */
    public function check_token($arr)
    {
        #api传过来的token
        if (!isset($arr['token']) || empty($arr['token'])) {
            $this->return_msg(400, 'token不能为空');
        }
        $app_token = $arr['token']; #api传过来的token
        #服务器端生成token
        unset($arr['token']);
        $service_token = '';
        /*
        foreach ($arr as $key => $value) {
            $service_token .= md5($value);
        }
        $service_token = md5('api_'.$service_token.'_api'); #服务端即时生成的token
        */
        $iterations = 1000; //加密参数iterations
        $salt_token = "iip"; //加密参数salt
        foreach ($arr as $key => $value) {
            $service_token .= hash_pbkdf2("sha256", $value, $salt_token, $iterations, 32);
        }
        $service_token = hash_pbkdf2("sha256", $service_token, $salt_token, $iterations, 32); #服务端即时生成的token
        #对比token
        if ($app_token !== $service_token) {
            $this->return_msg(400, 'token值不正确');
        } else {
            $this->return_msg(200, 'token正确');
        }
    }

    /* 验证参数是否符合规则 */
    public function check_params($arr)
    {
        #print_r($arr); //测试
        #获取参数验证规则
        $rule = $this->rules[Request::controller()][Request::action()];//获取当前控制器和方法以对应规则
        #验证参数并返回错误
        $this->validater = Validate::instance($rule);
        if (!$this->validater->check($arr)) {
            $this->return_msg(400, Validate::getError());
        }
        #参数正常，通过验证
        $this->params = $arr;
    }

    /* 判断传进来的是邮箱还是手机 */
    public function check_username($username)
    {
        //$is_email = Validate::checkRule($username,'email');?1:0;
        //$is_email = Validate::checkRule($username,'alpha'); #test
        $is_email = preg_match('/^\w{3,}(\.\w+)*@[A-z0-9]+(\.[A-z]{2,5}){1,2}$/', $username);
        if ($is_email != 1) {
            $is_email = 0;
        } //是，返回1;不是，返回0
        $is_phone = preg_match('/^1[345789]\d{9}$/', $username) ? 4 : 2; //是，返回4;不是，返回2
        $flag = $is_email + $is_phone; //判断传进来的值
        switch ($flag) {
            case 2: //既不是手机也不是邮箱
                $this->return_msg(400, '邮箱或手机号不正确');
                break;
            case 3: //是邮箱
                return 'email';
                break;
            case 4: //是手机
                return 'phone';
                break;
        }
    }

    /* 验证用户是否存在 */
    public function check_exist($value, $type, $exist)
    {
        //$type_num = $type == "phone" ? 2 : 4; //手机为2，邮箱为4
        if ($type == "email") {
            $type_num = 4;
        }
        if ($type == "phone") {
            $type_num = 2;
        }
        $flag = $type_num + $exist;
        $phone_res = Db::table('iip_user')->where('user_phone', $value)->find();
        $email_res = Db::table('iip_user')->where('user_email', $value)->find();
        switch ($flag) {
            case 2: //2+0
                if ($phone_res) {
                    $this->return_msg(400, '此手机号已被占用！');
                }
                break;
            case 3: //2+1
                if (!$phone_res) {
                    $this->return_msg(400, '手机号不存在！');
                }
                break;
            case 4: //4+0
                if ($email_res) {
                    $this->return_msg(400, '此邮箱已被占用！');
                }
                break;
            case 5: //4+1
                if (!$email_res) {
                    $this->return_msg(400, '此邮箱不存在！');
                }
                break;
        }
    }

    /* 验证验证码 */
    public function check_code($user_name, $code)
    {
        //监测是否超时
        $last_time = session($user_name . '_last_send_time');
        if (time() - $last_time > 60) {
            $this->return_msg(400, '验证超时，请在一分钟内完成！');
        }
        //验证验证码是否正确
        //$md5_code = md5($user_name.'_'.md5($code));
        $iterations = 1000; //加密参数iterations
        $salt_code = "iip"; //加密参数salt
        $hash_code = hash_pbkdf2("sha256", $code, $salt_code, $iterations, 32);
        if (session($user_name . "_code") !== $hash_code) {
            $this->return_msg(400, '验证码不正确！');
        }
        //验证码只验证一次，清楚session
        session($user_name . '_code_', null);
    }

    /* 自定义返回数据函数 */
    public function return_msg($code, $msg = '', $data = [])
    {
        $return_data['code'] = $code;
        $return_data['msg'] = $msg;
        $return_data['data'] = $data;

        echo json_encode($return_data, JSON_UNESCAPED_UNICODE);
        die;
    }
}

