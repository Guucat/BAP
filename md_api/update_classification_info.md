# 修改微生物分类信息接口
> `post`   `api.lyhbio.com/rest/v1/update_classification_info`

#### 注意:发送json格式内容给后端，示例如下:
``` javascript
{
    "time": 11,
    "token": 1,
    "data": [
        {
            "microbe_class__microbe_id": "1",
            "microbe_class__classify": "属于哺乳动物类",
            "microbe_class__figure_name": "最大的蝙蝠",
            "microbe_class__ref_id": "1"
        }
    ]
}
```


