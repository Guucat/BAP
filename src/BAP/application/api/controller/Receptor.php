<?php


namespace app\api\controller;


use think\Db;
use think\facade\Request;

class Receptor extends Common
{
    public function receptor_info(){
        $data = $this->params;
        $class = Db::table('iip_microbe_receptor')
            ->where('microbe_receptor__receptor_id', $data['receptor_id'])
            ->select();
        if (!$class) {
            $this->return_msg(400, '查询失败！');
        }else{
            $this->return_msg(200,'查询成功',$class);
        }
    }

    public function update_receptor_info(){
        $params = Request::post();
        #$this->check_time($params['time']);
        #$this->check_token($params['token']);
        $data = $params['data'];
        $total = 0;

        $one = $data['0'];
        $key_num = $one['microbe_receptor__receptor_id'];
        $special_key = ['microbe_receptor__receptor_id','microbe_receptor__microbe_id',
            'microbe_receptor__receptor_ref_id','microbe_receptor__ref_id'];
        foreach ($one as $key=>$value){
            if (in_array($key,$special_key)){
                $total = $total + 0;
            }else{
                $res = Db::table('iip_microbe_receptor')
                    ->where('microbe_receptor__receptor_id', $key_num)
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
