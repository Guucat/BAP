<?php


namespace app\api\controller;


use think\Db;
use think\facade\Request;

class Allmicrobe extends Common
{
    public function all_microbe_info()
    {
        $data = $this->params;
        $class = Db::table('iip_all_microbe')
            ->where('all_microbe__microbe_id', $data['microbe_id'])
            ->select();
        if (!$class) {
            $this->return_msg(400, '查询失败！');
        }else{
            $this->return_msg(200,'查询成功',$class);
        }
    }

    public function update_all_microbe_info()
    {
        $params = Request::post();
        #$this->check_time($params['time']);
        #$this->check_token($params['token']);
        $data = $params['data'];
        $total = 0;

        $one = $data['0'];
        $key_num = $one['all_microbe__microbe_id'];
        $special_key = ['all_microbe__microbe_id'];
        foreach ($one as $key=>$value){
            if (in_array($key,$special_key)){
                $total = $total + 0;
            }else{
                $res = Db::table('iip_all_microbe')
                    ->where('all_microbe__microbe_id', $key_num)
                    ->update([$key => $value]);
                $total = $total + $res; }
        }
        if($total==0){
            $this->return_msg('400','修改失败');
        }else{
            $this->return_msg('200','修改成功');
        }
    }
}
