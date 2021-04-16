# 获取微生物信息接口
> `get`   `api.lyhbio.com/rest/v1/microbe_info`

| 参数           |   必选   |    类型    | 说明                  |
| :----------- | :----: | :------: | :------------------ |
| *time*       | *true* |  *int*   | *时间戳* (用于确定接口的访问时间) |
| *token*      | *true* | *string* | *确定访问者身份*           |
| *microbe_id* | *true* | *string* | *微生物唯一id*           |

``` javascript
{
    {
    "code": 200,
    "msg": "success",
    "data": {
        "table_microbe": [
            {
                "microbe__microbe_id": "1",
                "microbe__standard_name": "蝙蝠",
                "microbe__synonym_name": "盐老鼠",
                "microbe__rank": "哺乳动物",
                "microbe__taxid": 1,
                "microbe__description": "头酷似小狗，有翅膀，只能倒立起飞",
                "microbe__figure_name": "最大的蝙蝠",
                "microbe__shape": "黑不溜秋",
                "microbe__shape_ref": "1",
                "microbe__size": "10多cm长",
                "microbe__size_ref": "1",
                "microbe__nuc_type": "dna,rna",
                "microbe__nuc_type_ref": "1",
                "microbe__transmission_route": "空气，血液",
                "microbe__transmission_route_ref": "1",
                "microbe__species_curation_status": "注释中"
            }
        ],
        "table_microbe_host": [
            {
                "microbe_host__id": "1",
                "microbe_host__microbe_id": "1",
                "microbe_host__host_species_strand_name": "狗",
                "microbe_host__host_species_synonym_name": "田园犬",
                "microbe_host__host_species_taxid": 1,
                "microbe_host__host_type": "中间宿主",
                "microbe_host__host_ref": "1"
            }
        ],
        "table_microbe_tax": [
            {
                "microbe_tax__microbe_id": "1",
                "microbe_tax__kingdom": "动物界",
                "microbe_tax__kingdom_taxid": 1,
                "microbe_tax__phylum": "脊索动物门",
                "microbe_tax__phylum_taxid": 1,
                "microbe_tax__class": "哺乳纲",
                "microbe_tax__class_taxid": 1,
                "microbe_tax__order": "翼手目",
                "microbe_tax__order_taxid": 1,
                "microbe_tax__family": "黑蝙蝠科",
                "microbe_tax__family_taxid": 1,
                "microbe_tax__genus": "黑属",
                "microbe_tax__genus_taxid": 1,
                "microbe_tax__species": "蝙蝠",
                "microbe_tax__species_taxid": 1,
                "microbe_tax__serotype": "o",
                "microbe_tax__serotype_taxid": 1,
                "microbe_tax__genotype": "ccagct",
                "microbe_tax__genotype_taxid": 1
            }
        ]
    }
}
```
