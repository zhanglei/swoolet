#常量说明

##房间消息类型
```
const TYPE_MESSAGE = 1;//普通消息
const TYPE_HORN = 2;//广播喇叭
const TYPE_FOLLOW = 3;//关注主播
const TYPE_ENTER = 4;//进入房间
const TYPE_PRAISE = 5;//点赞
const TYPE_GIFT = 10;//送礼
```

#服务器接口
开发环境地址:
> ws://192.168.0.85:9512

测试环境地址:
> ws://test.camhow.com.cn:9502


##直播间

###进入直播间
```
请求:
{"m":"room_join","room_id":"1","token":"xxxxxxxx"}

返回:
{"m":"room_join","live":{"play_url":"rtmp:\/\/pili-publish.camhow.com.cn\/camhow\/test_1"},"msg":"欢迎光临直播间。主播身高：170cm，星座：白羊座，城市：上海市。","user":{"uid":1,"nickname":"15921258181","avatar":""},"c":0}

房间消息(t值参考`房间消息类型`):
{"t":4,"uid":"10001","nickname":"nickname10001"}
```

###发消息
```
请求:
{"m":"room_sendMsg","msg":"一条消息","horn":1,"cb":"fadfad"}

horn这个值可传也不可传,传的话表示发弹幕


返回:
{"msg":"发送成功","c":0}

房间消息(t值参考`房间消息类型`):
{"t":4,"user":{"uid":"10001","nickname":"nickname10001"},"msg":"一条消息"}
```

###退出直播间
```
请求:
{"m":"room_leave"}

返回:
无

房间消息(t值参考`房间消息类型`):
无
```

###点赞
```
请求:
{"m":"room_parise"}

返回:
无

房间消息(t值参考`房间消息类型`):
{"t":5,"n":1}
```

###关注主播
```
请求:
{"m":"room_follow"}

返回:
无

房间消息(t值参考`房间消息类型`):
{"t":3,"user":{"uid":"10001","nickname":"nickname10001"},"msg":"关注了主播"}
```

###送礼
```
请求:
{"m":"room_sendGift","gift_id":1}

返回:
无

房间消息(t值参考`房间消息类型`):
{"t":3,"user":{"uid":"10001","nickname":"nickname10001"},"msg":"送给主播","gift_id":1}
```

###开播

```
请求:
{"m":"room_start","token":"xxxxxx"}

返回:
{"publish_url":"rtmp://xxxxxxxx","c":0}
```

###停播

```
请求:
{"m":"room_stop","token":"xxxxxx"}

返回:
{""}
```