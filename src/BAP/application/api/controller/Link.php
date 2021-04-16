<?php


namespace app\api\controller;


use think\Db;

class Link extends Common
{
    public function source(){
//      $this->check_time($this->request->only('time','post'));//验证时间戳
//      $this->check_token($this->request->param());//验证token
        $data = $this->params;//过滤后的参数数组
        $sourceInfo = Db::table('iip_source')->where('source_id',$data['source_id'])->findOrEmpty();
        if(empty($sourceInfo)){
            $this->return_msg(400,'该资源不存在');
        }else{
            $this->return_msg(200,'返回资源链接',$sourceInfo);
        }
    }

    public function tool(){
//      $this->check_time($this->request->only('time','post'));//验证时间戳
//      $this->check_token($this->request->param());//验证token
        $data = $this->params;//过滤后的参数数组
        $toolInfo = Db::table('iip_tool')->where('tool_id',$data['tool_id'])->findOrEmpty();
        if(empty($toolInfo)){
            $this->return_msg(400,'该工具不存在');
        }else{
            $this->return_msg(200,'返回工具链接',$toolInfo);
        }
    }
}