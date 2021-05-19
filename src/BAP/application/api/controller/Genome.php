<?php


namespace app\api\controller;

use think\Db;
use think\facade\Request;
class Genome extends Common
{
    public function genome_info(){
        $data = $this->params;
        $id = $data['genome_id'];
        //查询表iip_microbe_2_genome
        $microbe_2_genome = Db::query("SELECT *
        FROM iip_microbe_2_genome
        WHERE microbe_2_genome__microbe_id = $id;");
        //连接查询
        $genome_2_chr = Db::query("SELECT *
        FROM iip_genome_2_chr AS A,iip_microbe_2_genome AS B
        WHERE A.genome_2_chr__genome_id = B.microbe_2_genome__genome_id 
        AND B.microbe_2_genome__microbe_id = $id");
        //连接查询
        $genome = Db::query("SELECT *
        FROM iip_genome AS A,iip_microbe_2_genome AS B
        WHERE A.genome__genome_id = B.microbe_2_genome__genome_id 
        AND B.microbe_2_genome__microbe_id = $id");
        //连接查询
        $genome_2_gene = Db::query("SELECT *
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
        $params = Request::post();
        dump($params);
        foreach ($params['data'] as $key1 => $value1) {
            $arr = [];
            foreach ($value1 as $key2 => $value2) {

                $arr[$key2] = $value2;

            }
            Db::name($key1)->update($arr);
        }
    ///////////////////////////////////////////////////////////////////////////////////////
        //       $data = {"1":[{"microbe_2_genome__microbe_genome_id":"2","microbe_2_genome__microbe_id":"2","microbe_2_genome__genome_id":"2","microbe_2_genome__ref_id":"2"},{"microbe_2_genome__microbe_genome_id":"3","microbe_2_genome__microbe_id":"2","microbe_2_genome__genome_id":"4","microbe_2_genome__ref_id":"3"}],"2":[{"genome_2_chr__id":"2","genome_2_chr__genome_id":"2","genome_2_chr__chr_number":"2","genome_2_chr__ncbi_id":"2","genome_2_chr__sequence_id":"2","microbe_2_genome__microbe_genome_id":"2","microbe_2_genome__microbe_id":"2","microbe_2_genome__genome_id":"2","microbe_2_genome__ref_id":"2"},{"genome_2_chr__id":"3","genome_2_chr__genome_id":"2","genome_2_chr__chr_number":"3","genome_2_chr__ncbi_id":"3","genome_2_chr__sequence_id":"3","microbe_2_genome__microbe_genome_id":"2","microbe_2_genome__microbe_id":"2","microbe_2_genome__genome_id":"2","microbe_2_genome__ref_id":"2"},{"genome_2_chr__id":"4","genome_2_chr__genome_id":"2","genome_2_chr__chr_number":"4","genome_2_chr__ncbi_id":"4","genome_2_chr__sequence_id":"4","microbe_2_genome__microbe_genome_id":"2","microbe_2_genome__microbe_id":"2","microbe_2_genome__genome_id":"2","microbe_2_genome__ref_id":"2"},{"genome_2_chr__id":"5","genome_2_chr__genome_id":"4","genome_2_chr__chr_number":"5","genome_2_chr__ncbi_id":"5","genome_2_chr__sequence_id":"5","microbe_2_genome__microbe_genome_id":"3","microbe_2_genome__microbe_id":"2","microbe_2_genome__genome_id":"4","microbe_2_genome__ref_id":"3"}],"3":[{"genome__genome_id":"2","genome__genome_desc":"蟑螂的合作方式","genome__figure_name":"蟑螂的居所","genome__genome_source":"360","genome__genome_url":"www.360.com","genome__genome_ref_id":"2","microbe_2_genome__microbe_genome_id":"2","microbe_2_genome__microbe_id":"2","microbe_2_genome__genome_id":"2","microbe_2_genome__ref_id":"2"},{"genome__genome_id":"4","genome__genome_desc":"蟑螂的合作方式444","genome__figure_name":"蟑螂的居所444","genome__genome_source":"360444","genome__genome_url":"www.360.com444","genome__genome_ref_id":"4","microbe_2_genome__microbe_genome_id":"3","microbe_2_genome__microbe_id":"2","microbe_2_genome__genome_id":"4","microbe_2_genome__ref_id":"3"}],"4":[{"genome_2_gene__id":"2","genome_2_gene__genome_id":"2","genome_2_gene__gene_id":"2","genome_2_gene__gene_name":"蟑螂的长基因序列","genome_2_gene__gene_synonym":"长基因","genome_2_gene__ncbi_gene_id":"2","genome_2_gene__ensembl_gene_id":"2","genome_2_gene__hgnc_gene_id":"2","genome_2_gene__sequence_id":"2","genome_2_gene__chr":"四号染色体","genome_2_gene__start":500026,"genome_2_gene__end":500039,"genome_2_gene__chain":"蟑螂的其他","microbe_2_genome__microbe_genome_id":"2","microbe_2_genome__microbe_id":"2","microbe_2_genome__genome_id":"2","microbe_2_genome__ref_id":"2"},{"genome_2_gene__id":"3","genome_2_gene__genome_id":"2","genome_2_gene__gene_id":"3","genome_2_gene__gene_name":"蟑螂的长基因序列333","genome_2_gene__gene_synonym":"长基因333","genome_2_gene__ncbi_gene_id":"3","genome_2_gene__ensembl_gene_id":"3","genome_2_gene__hgnc_gene_id":"3","genome_2_gene__sequence_id":"3","genome_2_gene__chr":"四号染色体333","genome_2_gene__start":500026333,"genome_2_gene__end":500039333,"genome_2_gene__chain":"蟑螂的其他333","microbe_2_genome__microbe_genome_id":"2","microbe_2_genome__microbe_id":"2","microbe_2_genome__genome_id":"2","microbe_2_genome__ref_id":"2"},{"genome_2_gene__id":"4","genome_2_gene__genome_id":"2","genome_2_gene__gene_id":"3","genome_2_gene__gene_name":"蟑螂的长基因序列444","genome_2_gene__gene_synonym":"长基因444","genome_2_gene__ncbi_gene_id":"4","genome_2_gene__ensembl_gene_id":"4","genome_2_gene__hgnc_gene_id":"4","genome_2_gene__sequence_id":"4","genome_2_gene__chr":"四号染色体444","genome_2_gene__start":500026444,"genome_2_gene__end":500039444,"genome_2_gene__chain":"蟑螂的其他444","microbe_2_genome__microbe_genome_id":"2","microbe_2_genome__microbe_id":"2","microbe_2_genome__genome_id":"2","microbe_2_genome__ref_id":"2"},{"genome_2_gene__id":"5","genome_2_gene__genome_id":"4","genome_2_gene__gene_id":"5","genome_2_gene__gene_name":"蟑螂的长基因序列555","genome_2_gene__gene_synonym":"长基因555","genome_2_gene__ncbi_gene_id":"5","genome_2_gene__ensembl_gene_id":"5","genome_2_gene__hgnc_gene_id":"5","genome_2_gene__sequence_id":"5","genome_2_gene__chr":"四号染色体555","genome_2_gene__start":555,"genome_2_gene__end":555,"genome_2_gene__chain":"555","microbe_2_genome__microbe_genome_id":"3","microbe_2_genome__microbe_id":"2","microbe_2_genome__genome_id":"4","microbe_2_genome__ref_id":"3"}]};
//        foreach ($data as $key1 => $value1){
//            foreach ($value1 as $key2 => $value2){
//                Db::table($key1)
//                    ->update($value2);
//            }
//        }
//        $this->return_msg('200','修改成功');
    }
}