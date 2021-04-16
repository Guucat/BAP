# 获取抗原信息接口
> `get`   `api.lyhbio.com/rest/v1/antigen_info`

| 参数           |   必选   |    类型    | 说明                  |
| :----------- | :----: | :------: | :------------------ |
| *time*       | *true* |  *int*   | *时间戳* (用于确定接口的访问时间) |
| *token*      | *true* | *string* | *确定访问者身份*           |
| *antigen_id* | *true* | *string* | *抗原唯一id*            |

``` javascript
{
    "code": 200,
    "msg": "查询成功！",
    "data": {
        "table_antigen": [
            {
                "antigen__antigen_id": "1",
                "antigen__antigen_name": "蝙蝠抗原",
                "antigen__microbe_id": "1",
                "antigen__description": "该抗原又大又圆",
                "antigen__figure_name": "蝙蝠抗原彩色图",
                "antigen__molecule_type": "蛋白质和核苷酸",
                "antigen__uniprot_id": "1",
                "antigen__sequence_id": "1",
                "antigen__PDB_id": "1",
                "antigen__PDB_figure_name": "蝙蝠抗原蛋白质图片",
                "antigen__protein_type": "核蛋白"
            }
        ],
        "table_antigen_modification": [
            {
                "antigen_modification__modification_id": "1",
                "antigen_modification__receptor_id": "1",
                "antigen_modification__antigen_id": "1",
                "antigen_modification__antibody_id": "1",
                "antigen_modification__location": "1号位置",
                "antigen_modification__modification_type": "长修饰",
                "antigen_modification__modification_desc": "修饰蛋白质为圆形",
                "antigen_modification__ref_id": "1"
            }
        ],
        "table_antigenic_epitope": [
            {
                "antigenic_epitope__antigenic_epitope_id": "1",
                "antigenic_epitope__antigen_id": "1",
                "antigenic_epitope__microbe_id": "1",
                "antigenic_epitope__type": "圆形",
                "antigenic_epitope__location": "11号位置",
                "antigenic_epitope__PDB_id": "1",
                "antigenic_epitope__PDB_figure_name": "表面圆形蛋白质图片",
                "antigenic_epitope__antibody_id": "1",
                "antigenic_epitope__ref_id": "1"
            }
        ],
        "table_antigen_property": [
            {
                "antigen_property__antigen_id": "1",
                "antigen_property__hydrophobicity": "一般",
                "antigen_property__stability": "一般",
                "antigen_property__half_life": "短",
                "antigen_property__isoelectric_point": "2.3",
                "antigen_property__extinction_coefficient": "14",
                "antigen_property__aggregate": "是",
                "antigen_property__theory": "通过沉淀"
            }
        ],
        "table_antigen_protein_production": [
            {
                "antigen_protein_production__APP_method_id": "1",
                "antigen_protein_production__antigen_id": "1",
                "antigen_protein_production__microbe_id": "1",
                "antigen_protein_production__expression_system": "随机表达ya",
                "antigen_protein_production__expression_system_ref_id": "1",
                "antigen_protein_production__purification": "过滤",
                "antigen_protein_production__purification_ref_id": "1"
            }
        ],
        "table_antigen_mutation": [
            {
                "antigen_mutation__AM_id": "1",
                "antigen_mutation__antigen_id": "1",
                "antigen_mutation__location": "3号位置",
                "antigen_mutation__type": "点突变",
                "antigen_mutation__immunogenicity_effection": "影响小",
                "antigen_mutation__new_antibody_id": "1",
                "antigen_mutation__ref_id": "1"
            }
        ]
    }
}
```
