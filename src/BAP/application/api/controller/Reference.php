<?php


namespace app\api\controller;


use think\Db;
use think\facade\Request;

class Reference extends Common
{
    public function reference_info()
    {
        $data = $this->params;
        $ref = Db::table('iip_reference')
            ->where('reference__ref_id', $data['ref_id'])
            ->select();
        if (!$ref) {
            $this->return_msg(400, '查询失败！');
        }else{
            $this->return_msg(200,'查询成功',$ref);
        }
    }

    public function update_reference_info()
    {
        $params = Request::post();
        #$this->check_time($params['time']);
        #$this->check_token($params['token']);
        $data = $params['data'];
        $total = 0;

        $one = $data['0'];
        $key_num = $one['reference__ref_id'];
        $special_key = ['reference__ref_id'];
        foreach ($one as $key=>$value){
            if (in_array($key,$special_key)){
                $total = $total + 0;
            }else{
                $res = Db::table('iip_reference')
                    ->where('reference__ref_id', $key_num)
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