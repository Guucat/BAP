<?php


namespace app\api\controller;


use think\Db;

class Index extends Common
{
    public function index()
    {
        $data = Db::table('iip_source')->select();
        dump($data);
        #$this->return_msg(200,'success',$data);
    }
}