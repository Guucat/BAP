<?php


namespace app\api\controller;

use think\Db;
use think\db\exception\DataNotFoundException;
use think\exception\PDOException;
use think\facade\Request;
class Genome extends Common
{
    public function genome_info(){
        $data = $this->params;
        $id = $data['microbe_id'];
        //查询表iip_microbe_2_genome
        $microbe_2_genome = Db::query("SELECT *
        FROM iip_microbe_2_genome
        WHERE microbe_2_genome__microbe_id = $id");
        //若判断传入的"microbe_id"不存在则查询失败
        if (!$microbe_2_genome) {
            $this->return_msg(400, '查询失败！');
        }
        //自然联结查询,一个"microbe_id"可能对应多个"genome_id"
        $genome_2_chr = Db::query("SELECT A.*
        FROM iip_genome_2_chr AS A,iip_microbe_2_genome AS B
        WHERE A.genome_2_chr__genome_id = B.microbe_2_genome__genome_id
        AND B.microbe_2_genome__microbe_id = $id");
        //自然联结查询,一个"microbe_id"可能对应多个"genome_id"
        $genome = Db::query("SELECT A.*
        FROM iip_genome AS A,iip_microbe_2_genome AS B
        WHERE A.genome__genome_id = B.microbe_2_genome__genome_id 
        AND B.microbe_2_genome__microbe_id = $id");
        //自然联结查询,一个"microbe_id"可能对应多个"genome_id"
        $genome_2_gene = Db::query("SELECT A.*
        FROM iip_genome_2_gene AS A,iip_microbe_2_genome AS B
        WHERE A.genome_2_gene__genome_id = B.microbe_2_genome__genome_id 
        AND B.microbe_2_genome__microbe_id = $id");
        //将查询结果放入'datas'数组
        $datas = [
            "microbe_2_genome" => $microbe_2_genome,
            "genome_2_chr"=> $genome_2_chr,
            "genome" => $genome,
            "genome_2_gene" => $genome_2_gene
        ];
        $this->return_msg(200,'查询成功！',$datas);
        //echo json_encode($datas,JSON_UNESCAPED_UNICODE);
    }

    public function update_genome_info()
    {
        $result = 0;
        $params = Request::post();
        //dump($params['data']);
        foreach ($params['data'] as $key1 => $value1) {
            foreach ($value1 as $key2 => $value2) {
                $num = Db::name($key1)->update($value2);
                $result = $result + $num;
            }
        }
        //若$result变量为0表示全部未修改，修改失败
        if(!$result){
            $this->return_msg(400,"修改失败!");
        }
        else{
            $this->return_msg(200,"修改成功!");
        }
    }
}