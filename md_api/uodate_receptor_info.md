# 修改受体信息接口
> `post`   `api.lyhbio.com/rest/v1/update_receptor_info`

#### 注意:发送json格式内容给后端，示例如下:
``` javascript
{
    "time": 11,
    "token": 1,
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


