# encoding:utf-8
import urllib, urllib2, random, time, cookielib, json
def zan(x):
    data = {'to_userid':'12:1479172953', 'mid':'734', 'from_id':str(int(time.time()))+str(random.randint(100,999))}
    hdr = {'Connection':'keep-alive', 'Content-Type':'application/x-www-form-urlencoded', 'Host':'xuanyan.xxx.com:8081', 'Origin':'http://xuanyan.xxx.com:8081', 'Referer':'http://xuanyan.xxx.com:8081/end.php?userid=12:1479172953&mid=734&from=timeline&isappinstalled=1', 'User-Agent':'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.65 Safari/537.36', 'X-Requested-With':'XMLHttpRequest'}
    f = urllib2.Request(
            url     = 'http://xuanyan.xxx.com:8081/praise.php',
            data    = urllib.urlencode(data),
            headers = hdr, 
            )
    response = urllib2.urlopen(f)
    # print(response.read())
    sta = response.read()
    # print(sta)
    if sta[11] == '1':
        print('第'+str(x)+'次点赞')
    else:
        print('出现未知错误')

x = 0
while x < 300:
    x+=1
    zan(x)
    time.sleep(1)
