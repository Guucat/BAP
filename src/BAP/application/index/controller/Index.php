<?php
namespace app\index\controller;

use think\Controller;
use think\Db;

class Index extends Controller
{
    public function index()
    {
        $data = Db::table('iip_source')->select();
        $this->return_msg(201,'success',$data);
    }


    public function return_404() {
    	$this->return_msg(404, 'Not Found');
    }


    public function return_msg($code, $msg = '', $data = [])
    {
        $return_data['code'] = $code;
        $return_data['msg'] = $msg;
        $return_data['data'] = $data;

        echo json_encode($return_data, JSON_UNESCAPED_UNICODE);
        die;
    }
}
