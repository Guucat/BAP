# 获取受体信息接口
> `get`   `api.lyhbio.com/rest/v1/receptor_info`

| 参数            |   必选   |    类型    | 说明                  |
| :------------ | :----: | :------: | :------------------ |
| *time*        | *true* |  *int*   | *时间戳* (用于确定接口的访问时间) |
| *token*       | *true* | *string* | *确定访问者身份*           |
| *receptor_id* | *true* | *string* | *微生物受体唯一id*         |

``` javascript
{
    "code": 200,
    "msg": "查询成功",
    "data": [
        {
            "microbe_receptor__receptor_id": "1",
            "microbe_receptor__receptor_name": "蝙蝠受体",
            "microbe_receptor__microbe_id": "1",
            "microbe_receptor__receptor_desc": "受体呈现圆形",
            "microbe_receptor__receptor_desc_figure_name": "蝙蝠圆形受体",
            "microbe_receptor__type": "蛋白质",
            "microbe_receptor__uniprot_id": "1",
            "microbe_receptor__sequence_id": "1",
            "microbe_receptor__PDB_id": "1",
            "microbe_receptor__PDB_figure_name": "蝙蝠的蛋白质结构",
            "microbe_receptor__receptor_ref_id": "1",
            "microbe_receptor__invasion_mechanism_desc": "通过直接侵入",
            "microbe_receptor__invasion_mechanism_desc_figure_name": "如何侵入",
            "microbe_receptor__ref_id": "1"
        }
    ]
}
```

