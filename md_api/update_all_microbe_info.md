# 修改所有微生物信息接口
> `post`   `api.lyhbio.com/rest/v1/update_all_microbe_info`

#### 注意:发送json格式内容给后端，示例如下:
``` javascript
{
    "time": 11,
    "token": 1,
    "data": [
        {
            "all_microbe__microbe_id": "1",
            "all_microbe__standard_name": "黑蝙蝠",
            "all_microbe__synonym_name": "小黑狗蝙蝠",
            "all_microbe__rank": "哺乳动物",
            "all_microbe__taxid": 1
        }
    ]
}
```


